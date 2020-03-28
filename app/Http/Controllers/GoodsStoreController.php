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
use App\ItemsCash;

class GoodsStoreController extends Controller
{

    public function index()
    {
        $menu     = MenuClass::menuName('L_GOODS_STORE');
        $mainmenu = MenuClass::menuName('L_STORE');
        $itemGood = ItemPoint::select(
                        'item_id',
                        'name',
                        'price',
                        'qty',
                        'status',
                        'order'
                    )
                    ->where('status', '!=', 2)
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
        $timenow  = Carbon::now('GMT+7');
        return view('pages.store.goods_store', compact('menu', 'itemGood', 'endis', 'mainmenu', 'timenow'));
    }


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
                    $folder = "../public/upload/Goods/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $rootpath_main    = '../public/upload/Goods/image1/';
                    $upload_imagemain = '../public/upload/Goods/image1';
                    $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    // Memuat gambar watermark
                    $rootpath_wtr    = '../public/upload/Goods/image2/';
                    $upload_imagewtr = '../public/upload/Goods/image2';
                    $watermarkimage  = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                    $putfile_str     = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    $watermark       = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width  = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width  = imagesx($source);
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
                    
                    $temp       = image_data($source);
                    $awsPath    = "unity-asset/store/goods/".$nama_file_unik;
                    $merge      = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                    Storage::disk('s3')->put($awsPath, $temp);
                    
                    $path = '../public/upload/Goods/image1/'.$nama_file_unik;
                    File::delete($path);
                    $path1 = '../public/upload/Goods/image2/'.$nama_file_unik;
                    File::delete($path1);
                    // imagepng($source, $thumbnail);
                    // imagedestroy($source);
                }
                else
                {
                    $rootpath   = 'unity-asset/store/goods/'.$nama_file_unik;
                    // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
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
                    'action_id' => '28',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Menambahkan data di menu Toko Barang dengan nama '. $goods->name
                ]);
                return redirect()->route('Goods_Store')->with('success', alertTranslate('L_INSERT_DATA_SUCCESS'));
            }
            else
            {       
                return redirect()->route('Goods_Store')->with('alert', alertTranslate("Size Image it's too Big"));
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            return redirect()->route('Goods_Store')->with('alert', alertTranslate("Image must be in png"));
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }


    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = ItemPoint::where('item_id', '=', $pk)->first();

        ItemPoint::where('item_id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case 'name':
                $name = 'name';
                $currentvalue = $currentname->name;
                break;
            case 'price':
                $name = 'Price';
                $currentvalue = $currentname->price;
                break;
            case 'qty':
                $name = 'Kuantitas';
                $currentvalue = $currentname->qty;
                break;
            case 'status':
                $name = 'Status';
                $currentvalue = ConfigTextTranslate(strEnabledDisabled($currentname->status));
                if($value == 0):
                    $value = 'Non Aktif';
                else:
                    $value = 'Aktif';
                endif;
                break;
            case 'order':
                $name = 'Memesan';
                $currentvalue = $currentname->order;
                break;            
            default:
                "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '28',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name. ' dengan nama item '.$currentname->name.'. '.$currentvalue.' => '.$value
        ]);
    }

    public function updateimage(Request $request)
    {
        $validator     = Validator::make($request->all(),[
            'file'     => 'required',
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
                    $folder    = "../public/upload/Goods/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $rootpath_main    = '../public/upload/Goods/image1/';
                    $upload_imagemain = '../public/upload/Goods/image1';
                    $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    // Memuat gambar watermark
                    $rootpath_wtr    = '../public/upload/Goods/image2/';
                    $upload_imagewtr = '../public/upload/Goods/image2';
                    $watermarkimage  = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                    $putfile_str     = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    $watermark = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width  = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width  = imagesx($source);
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

                    $temp       = image_data($source);
                    $awsPath    = "unity-asset/store/goods/" .$nama_file_unik;
                    $merge      = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                    Storage::disk('s3')->put($awsPath, $temp);

                    $path = '../public/upload/Goods/image1/'.$nama_file_unik;
                    File::delete($path);
                    $path1 = '../public/upload/Goods/image2/'.$nama_file_unik;
                    File::delete($path1);
                    // imagepng($source, $thumbnail);
                    // imagedestroy($source);
                }
                else 
                {
                    $rootpath   = 'unity-asset/store/goods/'.$nama_file_unik;
                    // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                    // $rootpath   = 'unity-asset/upload/Goods'.$nama_file_unik;
                    // // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    // $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));

                    // $path = '../public/upload/Goods/image1/'.$pk.'.png';
                    // File::delete($path);    
                    // $path = '../public/upload/Goods/image2/'.$pk.'.png';
                    // File::delete($path);    
                    // return redirect()->route('Goods_Store')->with('alert','Gagal Upload File');
                }

                $currentname = ItemCash::where('item_id', '=', $pk)->first();

                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '29',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Update gambar Barang dengan nama '.$currentname->name
                ]);
                return redirect()->route('Goods_Store')->with('success', alertTranslate('Update image successfull'));

            }
            else 
            {
                return redirect()->route('Goods_Store')->with('alert', alertTranslate("Size Image it's too Big"));
            }
        }
        else 
        {
            return redirect()->route('Goods_Store')->with('alert', alertTranslate('Image must be png format'));
        }

    }

    public function ImageItem($item_id)
    {
      $rootpath         = get_headers('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/goods/'.$item_id.'.png');
      $url              = substr($rootpath[0], 9, 3);
      

      if(intval($url) === 200)
      {  
        $file_goods =   file_get_contents('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/goods/'.$item_id.'.png');

        return $file_goods;
      } else {

        $rootpath_empty = '../public/images/image_not_found/';
        $client_empty   = Storage::createLocalDriver(['root' => $rootpath_empty]);
        $file_empty     = $client_empty->get('not_found.png');
        $type_empty     = $client_empty->mimeType('not_found.png');

        $response_empty = Response::make($file_empty, 200);
        $response_empty->header("Content-Type", $type_empty);
        
        return $response_empty;
      }      
    }

  
    public function destroy(Request $request)
    {
        $id    = $request->id;
        $goods = ItemPoint::where('item_id', '=', $id)->first();
        $pathS3 = 'unity-asset/store/goods/'.$id.'.png';


        if($id != '')
        {
            ItemPoint::where('item_id', '=', $id)->update([
                'status' => 2
            ]);

            $path = '../public/upload/Goods/'.$goods->item_id.'.png';
            File::delete($path);
            Storage::disk('s3')->delete($pathS3);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '28',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus gambar Barang dengan nama '.$goods->name
            ]);

            return redirect()->route('Goods_Store')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Goods_Store')->with('alert', alertTranslate('Something wrong'));  
    }

    public function deleteAllSelected(Request $request)
    {
        $ids        =   $request->userIdAll;
        $imageid    =   $request->imageid;
        $currentname = $request->usernameAll;

        //DELETE
        Storage::disk('s3')->delete(explode(",", $imageid));

        DB::table('asta_db.item_point')->whereIn('item_id', explode(",", $ids))->update([
            'status'    => 2
        ]);

        //RECORD LOG
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '28',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus gambar barang yang dipilih dengan nama '.$currentname
        ]);
        
        return redirect()->route('Goods_Store')->with('success', alertTranslate('Data deleted'));
    }
}
