<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsCash;
use Illuminate\Support\Facades\DB;
use App\Classes\MenuClass;
use App\Log;
use Carbon\Carbon;
use Session;
use Validator;
use App\ConfigText;

class GoldStoreController extends Controller
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
        $getGolds = ItemsCash::select(
                        'item_id',
                        'name',
                        'item_get',
                        'item_type',
                        'price',
                        'trans_type',
                        'google_key',
                        'status',
                        'shop_type',
                        'order'
                    )
                    ->where('shop_type', '=', 1)
                    ->orderBy('order', 'asc')
                    ->get();
        $active   = ConfigText::select(
                        'name', 
                        'value'
                    )
                    ->where('id', '=', 4)
                    ->first();
        $value     = str_replace(':', ',', $active->value);
        $endis     = explode(",", $value);
        $timenow   = Carbon::now('GMT+7');
        return view('pages.store.gold_store', compact('menu', 'getGolds', 'endis', 'mainmenu', 'timenow'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title          = $request->title;
        $goldAwarded    = $request->goldAwarded;
        $priceCash      = $request->priceCash;
        $googleKey      = $request->googleKey;
        $order          = $request->order;

        $validator = Validator::make($request->all(),[
            'title'       => 'required',
            'goldAwarded' => 'required|integer',
            'priceCash'   => 'required|integer',
            'googleKey'   => 'required',
            'order'       => 'required|integer|unique:item_cash,order'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }


          $id = ItemsCash::select('item_id')
                ->orderBy('item_id', 'desc')
                ->first();
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
                  if($file_wtr && in_array($esktensi_wtr, $ekstensi_diperbolehkan) === true)
                  {
                    list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $source = imagecreatefrompng($file->move(public_path('../public/upload/Gold/image1'), $nama_file_unik));

                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/Gold/image2'), $nama_file_unik));

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
                  } else 
                  {
                    $file->move(public_path('../public/upload/Gold'), $nama_file_unik);
                    //   return redirect()->route('Gold_Store')->with('alert','Upload Image Failed');
                  }

                  $gold = ItemsCash::create([
                    'name'       => $title,
                    'item_get'   => $goldAwarded,
                    'price'      => $priceCash,
                    'shop_type'  => 1,
                    'item_type'  => 2,
                    'status'     => 0,
                    'google_key' => $googleKey,
                    'order'      => $order
                  ]);
        
                  Log::create([
                    'op_id' => Session::get('userId'),
                    'action_id' => '3',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Create new in menu Gold Store with title '. $gold->name
                  ]);
        
                return redirect()->route('Gold_Store')->with('success','Data Added');
              } else {
                return redirect()->route('Gold_Store')->with('alert',"Size Image it's to Big");
              }
          } else {
            return redirect()->route('Gold_Store')->with('alert','Image must be in png');
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

        ItemsCash::where('item_id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "name":
                $name = "Name";
                break;
            case "item_get":
                $name = "Gold Awarded";
                break;
            case "price":
                $name = "Price Cash";
                break;
            case "shop_type":
                $name = "Shop Type";
                break;
            case "google_key":
                $name = "Google Key";
                break;
            case "status":
                $name = "Status";
                break;
            case "trans_type":
                $name = "Pay Transaction";
                break;
            case "order":
                $name = "Order";
                break;
            default:
            "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' in menu Gold Store with ID '.$pk.' to '. $value
        ]);
    }

    public function updateImage(Request $request)
    {
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
                    $folder = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $source = imagecreatefrompng($file->move(public_path('../public/upload/Gold/image1'), $nama_file_unik));

                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/Gold/image2'), $nama_file_unik));

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
                } else {
                    $file->move(public_path('../public/upload/Gold'), $nama_file_unik);
                    $path = '../public/upload/Gold/image1/'.$pk.'.png';
                    File::delete($path);
                    $path1 = '../public/upload/Gold/image2/'.$pk.'.png';
                    File::delete($path1);
                    // return redirect()->route('Gold_Store')->with('alert','Upload Image Failed');
                }


                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '2',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit Image In menu Gold Store with ID '.$pk.' to '.$nama_file_unik
                ]);
                return redirect()->route('Gold_Store')->with('success','Update Image Successfull');
            } else  {
                return redirect()->route('Gold_Store')->with('alert','Size Image is to big');
            }
        } else  {
            return redirect()->route('Gold_Store')->with('alert','Image must be in png format');
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
        $getGoldId    = $request->userid;
        $goldreseller = $request->id;
        if($getGoldId != '')
        {
            ItemsCash::where('item_id', '=', $getGoldId)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Gift Store with ID '.$getGoldId
            ]);
            $path = '../public/upload/Gold/'.$getGoldId.'.png';
            File::delete($path);
            
            return redirect()->route('Gold_Store')->with('success','Data Deleted');
        } else if($goldreseller != '') 
        {
            ItemsCash::where('item_id', '=', $goldreseller)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Gift Store Reseller with ID '.$goldreseller
            ]);
            return redirect()->route('Gold_Store_Reseller')->with('success','Data Deleted');
        } else if ($getGoldId == NULL)
        {
            return redirect()->route('Gold_Store')->with('alert','ID must be Fill');  
        } else if($goldreseller == NULL )
        {
            return redirect()->route('Gold_Store_Reseller')->with('alert','ID must be Fill'); 
        }
        
    }
}
