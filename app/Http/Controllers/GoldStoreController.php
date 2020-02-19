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
use Storage;
use App\ConfigText;
use File;
use Response;

class GoldStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('L_GOLD_STORE');
        $mainmenu = MenuClass::menuName('L_STORE');
        $getGolds = ItemsCash::select(
                        'item_id',
                        'name',
                        'item_get',
                        'item_type',
                        'price',
                        'bonus_get',
                        'bonus_type',
                        'trans_type',
                        'google_key',
                        'status',
                        'shop_type',
                        'order'
                    )
                    ->where('shop_type', '=', 1)
                    ->where('status', '!=', 2)
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

        $bonusType  = ConfigText::select(
                        'name',
                        'value'
                    )
                    ->where('id', '=', 5)
                    ->first();
        $valueBonus= str_replace(':', ',', $bonusType->value);
        $bontype  = explode(",", $valueBonus);
        $timenow   = Carbon::now('GMT+7');
        return view('pages.store.gold_store', compact('menu', 'getGolds', 'endis', 'mainmenu', 'timenow', 'bontype'));
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
            'order'       => 'required|integer|unique:item_cash,order',
            'file'        => 'required',
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
          $filebonus              = $request->file('filebonus');
          $ekstensi_diperbolehkan = array('png');
          $nama                   = $_FILES['file']['name'];
          $nama_wtr               = $_FILES['file1']['name'];
          $namafilebonus          = $_FILES['filebonus']['name'];
          $x                      = explode('.', $nama);
          $x_wtr                  = explode('.', $nama_wtr);
          $x_bonus                = explode('.', $namafilebonus);
          $ekstensi               = strtolower(end($x));
          $ekstensi_wtr           = strtolower(end($x_wtr));
          $ekstensi_bonus         = strtolower(end($x_bonus));
          $ukuran                 = $_FILES['file']['size'];
          $nama_file_unik         = $id_new.'.'.$ekstensi;
          $imageBonusname         = $id_new.'-2.'.$ekstensi_bonus;
        //   dd($imageBonusname);
          list($width, $height)   = getimagesize($file);

          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
          {
              if($ukuran < 5242880)
              {
                  if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                  {
                    list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    // Menetapkan nama thumbnail
                    $folder    = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $rootpath_main    = '../public/upload/Gold/image1/';
                    $upload_imagemain = '../public/upload/Gold/image1';
                    $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    // Memuat gambar watermark
                    $rootpath_wtr    = '../public/upload/Gold/image2/';
                    $upload_imagewtr = '../public/upload/Gold/image2';
                    $watermarkimage  = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                    $putfile_str     = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    $watermark       = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

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

                    $temp    = image_data($source);
                    $awsPath = "unity-asset/store/gold/" .$nama_file_unik;
                    $merge = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                    Storage::disk('s3')->put($awsPath, $temp);


                    $path = '../public/upload/Gold/image1/'.$nama_file_unik;
                    File::delete($path);
                    $path1 = '../public/upload/Gold/image2/'.$nama_file_unik;
                    File::delete($path1);
                    // imagepng($source, $thumbnail);
                    // imagedestroy($source);
                  } else 
                  {
                    $rootpath   = 'unity-asset/store/gold/'.$nama_file_unik;
                    // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                    // $file->move(public_path('../public/upload/Gold'), $nama_file_unik);
                    //   return redirect()->route('Gold_Store')->with('alert','Upload Image Failed');
                  }

                  //UPLOAD IMAGE BONUS TO AWS
                  if($filebonus):
                    $awsPath = 'unity-asset/store/gold/' . $imageBonusname;
                    Storage::disk('s3')->put($awsPath, file_get_contents($filebonus));
                  endif;

                  //Simpan ke Database
                  $gold = ItemsCash::create([
                    'name'       => $title,
                    'item_get'   => $goldAwarded,
                    'price'      => $priceCash,
                    'bonus_get'  => $request->itemAwarded,
                    'bonus_type' => $request->BonusType,
                    'shop_type'  => 1,
                    'item_type'  => 2,
                    'status'     => $request->status_item,
                    'google_key' => $googleKey,
                    'order'      => $order
                  ]);
        
                  Log::create([
                    'op_id' => Session::get('userId'),
                    'action_id' => '3',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Menambahkan data baru di menu Toko Koin dengan judul '. $gold->name
                  ]);
        
                return redirect()->route('Gold_Store')->with('success', alertTranslate("Data Added"));
              } else {
                return redirect()->route('Gold_Store')->with('alert', alertTranslate("Size Image it's too Big"));
              }
          } else {
            return redirect()->route('Gold_Store')->with('alert', alertTranslate('Image must be in png'));
          }
    }

    public function ImageItem($item_id)
    {
      $rootpath         = 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$item_id.'.png';
    //   $client           = Storage::createLocalDriver(['root' => $rootpath]);
      $file_exists_gold = file_exists($rootpath);
      

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

    
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = ItemsCash::where('item_id', '=', $pk)->first();

        ItemsCash::where('item_id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "name":
                $name = "Nama";
                break;
            case "item_get":
                $name = "Koin didapatkan";
                break;
            case "price":
                $name = "Harga Uang Tunai";
                break;
            case "google_key":
                $name = "Kunci Google";
                break;
            case "status":
                $name = "Status";
                if($value == 0):
                    $value = 'Disabled';
                else:
                    $value = 'enabled';
                endif;
                break;
            case "trans_type":
                $name = "Transaksi Pembayaran";
                 $value = strTypeTransaction($value);
                break;
            case "order":
                $name = "Memesan";
                break;
            case "bonus_type":
                $name = "Item Bonus";
                if($value == 1):
                    $value = 'Chip';
                elseif($value == 2):
                    $value = 'Koin';
                elseif($value == 3):
                    $value = 'Barang';
                endif;
                break;
            case "bonus_get":
                $name = "Item Bonus yang di dapatkan";
                break;
            default:
            "";
        }

        //RECORD LOG
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' di menu Toko Koin dengan ID '.$currentname->name.' menjadi '. $value
        ]);
    }

    public function updateImage(Request $request)
    {
        $validator              = Validator::make($request->all(),[
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
                    $folder = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $rootpath_main    = '../public/upload/Gold/image1/';
                    $upload_imagemain = '../public/upload/Gold/image1';
                    $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    // Memuat gambar watermark
                    $rootpath_wtr    = '../public/upload/Gold/image2/';
                    $upload_imagewtr = '../public/upload/Gold/image2';
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
                    $pos_x = $width - $width_watermark;
                    $pos_y = $height - $height_watermark;
                    imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 
                    
                    $temp    = image_data($source);
                    $awsPath = "unity-asset/store/gold/".$nama_file_unik;
                    $merge   = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                    Storage::disk('s3')->put($awsPath, $temp);

                    $path = '../public/upload/Gold/image1/'.$nama_file_unik;
                    File::delete($path);
                    $path1 = '../public/upload/Gold/image2/'.$nama_file_unik;
                    File::delete($path1);
                    // imagepng($source, $thumbnail);
                    // imagedestroy($source);
                } else {
                    // $file->move(public_path('../public/upload/Gold'), $nama_file_unik);
                    $rootpath   = 'unity-asset/upload/Gold/';
                    // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));

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
                    'desc'      => 'Update gambar di menu Toko Koin dengan ID '.$pk
                ]);
                return redirect()->route('Gold_Store')->with('success', alertTranslate('Update image successfull'));
            } else  {
                return redirect()->route('Gold_Store')->with('alert', alertTranslate("Size Image it's too Big"));
            }
        } else  {
            return redirect()->route('Gold_Store')->with('alert', alertTranslate('Image must be in png'));
        }
    }


    //UPDATE IMAGE BONUS
    public function updateImageBonus(Request $request){
        
        $validator = Validator::make($request->all(),[
            'fileImageBonus'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $pk                     = $request->pk;
        $fileBonus              = $request->file('fileImageBonus');
        $ekstensi_diperbolehkan = array('png');
        $namaImageBonus         = $_FILES['fileImageBonus']['name'];
        $xBonus                 = explode('.', $namaImageBonus);
        $ekstensiBonus          = strtolower(end($xBonus));
        $ukuran                 = $_FILES['fileImageBonus']['size'];
        $finalname              = $pk.'-2.'.$ekstensiBonus;


        if(in_array($ekstensiBonus, $ekstensi_diperbolehkan) === true)
        {   
            
            $awsPath   = '/unity-asset/store/gold/'.$finalname;
            Storage::disk('s3')->put($awsPath, file_get_contents($fileBonus));

            //RECORD LOG
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '2',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Edit gambar bonus di menu Toko Gold dengan ID '.$pk.' menjadi '.$finalname
            ]);
            
            return redirect()->route('Gold_Store')->with('success', alertTranslate('Update Image Successfull'));
        } else {
            return redirect()->route('Gold_Store')->with('alert', alertTranslate('Image must be in png'));
        }


    }

    
    public function destroy(Request $request)
    {
        $getGoldId    = $request->userid;
        $goldreseller = $request->id;

        $pathS3       = 'unity-asset/store/gold/'.$getGoldId.'.png';
        $awsPath      = 'unity-asset/store/gold' .$getGoldId. '-2.png';
        if($getGoldId != '')
        {
            //DELETE ON AWS
            Storage::disk('s3')->delete([$pathS3, $awsPath]);
            ItemsCash::where('item_id', '=', $getGoldId)->update([
                'status' => 2
            ]);
            
            //RECORD LOG
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus gambar atau foto di menu Toko Koin dengan ID '.$getGoldId
            ]);

            $path = '../public/upload/Gold/'.$getGoldId.'.png';
            File::delete($path);
            
            
            return redirect()->route('Gold_Store')->with('success', alertTranslate('Data deleted'));
        } else if($goldreseller != '') 
        {
            ItemsCash::where('item_id', '=', $goldreseller)->update([
                'status' => 2
            ]);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus gambar atau foto di menu Toko Koin Reseller dengan ID '.$goldreseller
            ]);
            return redirect()->route('Gold_Store_Reseller')->with('success', alertTranslate('Data deleted'));
        } else if ($getGoldId == NULL)
        {
            return redirect()->route('Gold_Store')->with('alert', alertTranslate('ID must be fill'));  
        } else if($goldreseller == NULL )
        {
            return redirect()->route('Gold_Store_Reseller')->with('alert', alertTranslate('ID must be fill')); 
        }
        
    }

    public function deleteAllSelected(Request $request)
    {
        $ids        =   $request->userIdAll;
        $imageid    =   $request->imageid;
        $imgIdBonus =   $request->imageidBonus;

        //DELETE ON AWS
        Storage::disk('s3')->delete(explode(",", $imageid));
        Storage::disk('s3')->delete(explode(",", $imgIdBonus));

        //DELETE ON DB
        DB::table('asta_db.item_cash')->whereIn('item_id', explode(",", $ids))->update([
            'status'    =>  2
        ]);

        //RECORD LOG
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '4',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus gambar dan data yang dipilih di menu toko koin dengan id '.$ids
        ]);
        return redirect()->route('Gold_Store')->with('success', alertTranslate('Data deleted'));
    }
}
