<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\ItemPoint;
use App\Log;
use Session;
use DB;
use File;
use Storage;
use Response;
use Carbon\Carbon;
use Validator;
use App\ConfigText;

class GoodsStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('Gold Store');
        $mainmenu = MenuClass::menuName('Store');
        $itemGood = ItemPoint::select(
                        'item_id',
                        'name',
                        'price',
                        'qty',
                        'status',
                        'order'
                    )
                    ->orderby('order', 'asc')
                    ->get();
        $active   = ConfigText::select(
                        'name',
                        'value'
                    )
                    ->where('id', '=', 4)
                    ->first();
        $value    = str_replace(':', ',', $active->value);
        $endis    = explode(",", $value);
        $timenow = Carbon::now('GMT+7');
        return view('pages.store.goods_store', compact('menu', 'itemGood', 'endis', 'mainmenu', 'timenow'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = ItemPoint::select('item_id')
              ->orderBy('item_id', 'desc')
              ->first();


        $validator = Validator::make($request->all(),[
            'title'            => 'required',
            // 'transaction_type' => 'required|integer|between:1,8',
            'price'            => 'required|integer',
            'qty'              => 'required',
            'order'            => 'required|integer|unique:item_point,order',
            'file'             => 'required',
            'file1'            => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }       

        if($id === NULL)
        {
            $id_lst = 0;
        } else {
            $id_lst = $id->item_id;
        }
        
        $id_new                 = $id_lst + 1;
        $file                   = $request->file('file');
        $file_wtr               = $request->file('file1');
        $ekstensi_diperbolehkan = array('png');
        $nama                   = $_FILES['file']['name'];
        $nama_wtr               = $_FILES['file1']['name'];
        $x                      = explode('.', $nama);
        $x_wtr                  = explode('.', $nama_wtr);
        $ekstensi               = strtolower(end($x));
        $ekstensi_wtr           = strtolower(end($x_wtr));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $id_new.'.'.$ekstensi;
        list($width, $height)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {           
                if ($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                {
                    list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    // Menetapkan nama thumbnail
                    $folder = "../../enginepk/upload/Goods/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $rootpath_main = '../../enginepk/upload/Goods/image1/';
                    $upload_imagemain = '../../enginepk/upload/Goods/image1';
                    $mainimage = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main = $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    // Memuat gambar watermark
                    $rootpath_wtr = '../../enginepk/upload/Goods/image2/';
                    $upload_imagewtr = '../../enginepk/upload/Goods/image2';
                    $watermarkimage = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                    $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    $watermark = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width = imagesx($source);
                    $main_height = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    // $dime_x = -180;
                    // $dime_y = 200;
                    // menyalin kedua gambar
                    // imagecopy($source, $watermark, imagesx($source) - $main_width - $dime_x, imagesy($source) - $water_height - $dime_y, 0, 0, imagesx($watermark), imagesy($watermark));
                    $pos_x = $width - $width_watermark;
                    $pos_y = $height - $height_watermark;
                    imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 

                    imagepng($source, $thumbnail);
                    imagedestroy($source);
                }
                else
                {
                    $rootpath = '../../enginepk/upload/Goods';
                    $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main->put($nama_file_unik, file_get_contents($file));
                }


                $goods = ItemPoint::create([
                    'order'      => $request->order,  
                    'item_id'    => $id_new,
                    'name'       => $request->title,
                    // 'trans_type' => $request->transaction_type,
                    'price'      => $request->price,
                    'status'     => '1',
                    'qty'        => $request->qty
                ]);
    
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '3',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Create new in menu Goods Store with name '. $goods->name
                ]);
                return redirect()->route('Goods_Store')->with('success','Insert Data successfull');
            }
            else
            {       
                return redirect()->route('Goods_Store')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            return redirect()->route('Goods_Store')->with('alert','Image must be in png');
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        ItemPoint::where('item_id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case 'name':
                $name = 'Name';
                break;
            case 'price':
                $name = 'Price';
                break;
            case 'qty':
                $name = 'Quantity';
                break;
            case 'trans_type':
                $name = 'Transaction Type';
                break;
            case 'status':
                $name = 'Status';
                break;
            case 'order':
                $name = 'Order';
                break;            
            default:
                "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.'in menu Goods Store with ID '.$pk.' to '.$value
        ]);
    }

    public function updateimage(Request $request)
    {
        $validator     = Validator::make($request->all(),[
            'file'     => 'required',
            'file1'    => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $pk                     = $request->pk;
        $file                   = $request->file('file');
        $file_wtr               = $request->file('file1');
        $ekstensi_diperbolehkan = array('png');
        $nama                   = $_FILES['file']['name'];
        $nama_wtr               = $_FILES['file1']['name'];
        $x                      = explode('.', $nama);
        $x_wtr                  = explode('.', $nama_wtr);
        $ekstensi               = strtolower(end($x));
        $ekstensi_wtr           = strtolower(end($x_wtr));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $pk.'.'.$ekstensi;
        list($height, $width)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {
                if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                {
                    list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    // Menetapkan nama thumbnail
                    $folder = "../../enginepk/upload/Goods/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $rootpath_main = '../../enginepk/upload/Gold/image1/';
                    $upload_imagemain = '../../enginepk/upload/Gold/image1';
                    $mainimage = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main = $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    // Memuat gambar watermark
                    $rootpath_wtr = '../../enginepk/upload/Gold/image2/';
                    $upload_imagewtr = '../../enginepk/upload/Gold/image2';
                    $watermarkimage = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                    $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    $watermark = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width = imagesx($source);
                    $main_height = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    // $dime_x = -180;
                    // $dime_y = 200;
                    // menyalin kedua gambar
                    // imagecopy($source, $watermark, imagesx($source) - $main_width - $dime_x, imagesy($source) - $water_height - $dime_y, 0, 0, imagesx($watermark), imagesy($watermark));
                    $pos_x = $width - $width_watermark;
                    $pos_y = $height - $height_watermark;
                    imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 

                    imagepng($source, $thumbnail);
                    imagedestroy($source);
                }
                else 
                {
                    $rootpath = '../../enginepk/upload/Goods';
                    $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main->put($nama_file_unik, file_get_contents($file));

                    $path = '../../enginepk/upload/Goods/image1/'.$pk.'.png';
                    File::delete($path);    
                    $path = '../../enginepk/upload/Goods/image2/'.$pk.'.png';
                    File::delete($path);    
                    // return redirect()->route('Goods_Store')->with('alert','Gagal Upload File');
                }
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '2',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit Image in menu Goods Store with ID '.$pk.' to '.$nama_file_unik
                ]);
                return redirect()->route('Goods_Store')->with('success','Update Image successfull');

            }
            else 
            {
                return redirect()->route('Goods_Store')->with('alert','Ukuran file terlalu besar');
            }
        }
        else 
        {
            return redirect()->route('Goods_Store')->with('alert', 'Image Must Be png Format');
        }

    }

    public function ImageItem($item_id)
    {
      $rootpath = '../../enginepk/upload/Goods';
      $client = Storage::createLocalDriver(['root' => $rootpath]);
      $file_exists_gold = $client->exists($item_id.'.png');      
      

      if($file_exists_gold  === false)
      {  
        
        $rootpath_empty = '../public/images/image_not_found';
        $client_empty   = Storage::createLocalDriver(['root' => $rootpath_empty]);
        $file_empty     = $client_empty->get('not_found.png');
        $type_empty     = $client_empty->mimeType('not_found.png');

        $response_empty = Response::make($file_empty, 200);
        $response_empty->header("Content-Type", $type_empty);
        return $response_empty;
      } else if($file_exists_gold  === true){
        $file_gold     = $client->get($item_id.'.png');
        $type_gold     = $client->mimeType($item_id.'.png');
        $response = Response::make($file_gold, 200);
        $response->header("Content-Type", $type_gold);
        return $response;

      }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id    = $request->id;
        $goods = ItemPoint::where('item_id', '=', $id)->first();
        if($id != '')
        {
            ItemPoint::where('item_id', '=', $id)->delete();
            $path = '../../enginepk/upload/Goods/'.$goods->item_id.'.png';
            File::delete($path);            
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Goods Store with ID '.$id
            ]);

            return redirect()->route('Goods_Store')->with('success','Data Deleted');
        }
        return redirect()->route('Goods_Store')->with('success','Something wrong');  
    }
}
