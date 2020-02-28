<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsGold;
use Illuminate\Support\Facades\DB;
use App\Classes\MenuClass;
use App\Log;
use Carbon\Carbon;
use Session;
use App\ConfigText;
use Validator;
use File;
use Response;
use Storage;

class ChipStoreController extends Controller
{
    
    public function index()
    {
        $menu     = MenuClass::menuName('L_CHIP_STORE');
        $mainmenu = MenuClass::menuName('L_STORE');
        $items    = ItemsGold::select(
                        'item_id',
                        'name',
                        'item_type',
                        'price',
                        'item_get',
                        'bonus_get',
                        'bonus_type',
                        'status',
                        'order'
                    )
                    ->where('item_type', '=', 1)
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
                    
                    
        $bonusType= ConfigText::select(
                        'name',
                        'value'
                    )
                    ->where('id', '=', 5)
                    ->first();
        $valueBonus = str_replace(':', ',', $bonusType->value);
        $bontype    = explode(",", $valueBonus);
       

        $timenow  = Carbon::now('GMT+7');
        return view('pages.store.chip_store', compact('items', 'menu', 'endis', 'mainmenu', 'timenow', 'bontype'));
    }

    
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(),[
            'title'       => 'required',
            'goldcost'    => 'required|integer',
            'chipawarded' => 'required|integer',
            'order'       => 'required|integer|unique:item_gold,order',
            'file'        => 'required',
          ]);
    
          if ($validator->fails()) {
            return back()->withErrors($validator->errors());
          }

          $id = ItemsGold::select('item_id')
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
          list($width, $height)  = getimagesize($file);  
          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
          {
              if($ukuran < 5242880)
              {
                  if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                  {
                    list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                        // watermark image
                            // Menetapkan nama thumbnail
                            $folder    = "../public/upload/Chip/";
                            $thumbnail = $folder.$nama_file_unik;

                            // Memuat gambar utama
                            $rootpath_main    = '../public/upload/Chip/image1/';
                            $upload_imagemain = '../public/upload/Chip/image1';
                            $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                            $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                            $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                            // Memuat gambar watermark
                            $rootpath_wtr    = '../public/upload/Chip/image2/';
                            $upload_imagewtr = '../public/upload/Chip/image2';
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
                            $pos_x = $width - $width_watermark;
                            $pos_y = $height - $height_watermark;
                            imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            imagecolortransparent($source); 

                            $temp    = image_data($source);
                            $awsPath = "unity-asset/store/chip/" . $nama_file_unik;
                            $merge   = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                            Storage::disk('s3')->put($awsPath, $temp);

                            $path = '../public/upload/Chip/image1/'.$nama_file_unik;
                            File::delete($path);
                            $path1 = '../public/upload/Chip/image2/'.$nama_file_unik;
                            File::delete($path1);
                            // imagepng($source, $thumbnail);
                            // imagedestroy($source);
                        // end watermark image
                  } else {
                      
                    $rootpath   = 'unity-asset/store/chip/' .$nama_file_unik;
                    // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                  }

                  if($filebonus != NULL){

                    //Upload image bonus to aws
                    $awsPath = "unity-asset/store/chip/" . $imageBonusname;
                    Storage::disk('s3')->put($awsPath, file_get_contents($filebonus));

                  } else {

                    $rootpath   = 'unity-asset/store/chip/' .$nama_file_unik;
                    // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                  }
                  
                  
                  //Simpan ke database
                  $chip = ItemsGold::create([
                    'name'      => $request->title,
                    'item_type' => 1,
                    'price'     => $request->goldcost,
                    'item_get'  => $request->chipawarded,
                    'bonus_get' => $request->itemAwarded,
                    'bonus_type'=> $request->BonusType,
                    'status'    => $request->status_item,
                    'order'     => $request->order
                ]);

                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '26',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Menambahkan data di menu Toko Chip dengan title '. $chip->name
                ]);

                return redirect()->route('Chip_Store')->with('success', alertTranslate('insert data successful'));

              } else {
                return redirect()->route('Chip_Store')->with('alert', alertTranslate("Size Image it's too Big"));
              }
          } else {
            return redirect()->route('Chip_Store')->with('alert', alertTranslate('Image must be in png'));
          }
    }

    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = ItemsGold::where('item_id', '=', $pk)->first();

        ItemsGold::where('item_id', '=', $pk)->update([
            $name =>$value
        ]);
  
        switch ($name) {
          case "name":
              $name = "Nama Chip";
              $currentvalue = $currentname->name; 
              break;
          case "item_get":
              $name = "Chip Dapatkan";
              $currentvalue = $currentname->item_get;
              break;
          case "price":
              $name = "Harga";
              $currentvalue = $currentname->price;
              break;
          case "status":
              $name = "Status";
              $currentvalue = ConfigTextTranslate(strEnabledDisabled($currentname->status));
              if($value == 0):
                $value = 'Disabled';
              else:
                $value = 'enabled';
              endif;
              break;
          case "order":
              $name = "Memesan";
              $currentvalue = $currentname->value;
              break;
          case "bonus_type":
               $name = "Item Bonus";
               $currentvalue = ConfigTextTranslate(strItemBonType($currentname->bonus_type));
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
               $currentvalue = $currentname->bonus_get;
               break;
          default:
            "";
      }
  
      //RECORD LOG
      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '26',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' dengan nama item '.$currentname->name.'. '.$currentvalue.' => '. $value
      ]);
    }


    public function updateImage(Request $request)
    {   

        $validator = Validator::make($request->all(),[
            'file'              => 'required',
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
        list($width, $height)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {
                if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) == true)
                {
                    list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                        // watermark image
                            // Menetapkan nama thumbnail
                            $folder    = "../public/upload/Chip/";
                            $thumbnail = $folder.$nama_file_unik;


                            // Memuat gambar utama
                            $rootpath_main    = '../public/upload/Chip/image1/';
                            $upload_imagemain = '../public/upload/Chip/image1';
                            $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                            $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                            $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                            // Memuat gambar watermark
                            $rootpath_wtr    = '../public/upload/Chip/image2/';
                            $upload_imagewtr = '../public/upload/Chip/image2';
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
                            $awsPath = "unity-asset/store/chip/" . $nama_file_unik;
                            $merge   = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                            
                            Storage::disk('s3')->put($awsPath, $temp);

                            $path = '../public/upload/Chip/image1/'.$nama_file_unik;
                            File::delete($path);
                            $path1 = '../public/upload/Chip/image2/'.$nama_file_unik;
                            File::delete($path1);   
                } else {

                    $rootpath   = 'unity-asset/store/chip/'.$nama_file_unik;
                    $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));

                    $path = '../public/upload/Chip/image1/'.$pk.'.png';
                    File::delete($path);
                    $path1 = '../public/upload/Chip/image2/'.$pk.'.png';
                    File::delete($path1);
                    // return redirect()->route('Chip_Store')->with('alert','Upload Image Failed');
                }

                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '26',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit gambar chip dengan ID '.$pk.' => '.$nama_file_unik
                ]);

                return redirect()->route('Chip_Store')->with('success', alertTranslate('Update image successfull'));
            } else  {
                return redirect()->route('Chip_Store')->with('alert', alertTranslate("Size Image its too big"));
            }
        } else  {
            return redirect()->route('Chip_Store')->with('alert', alertTranslate('Image must be in png'));
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
            
            $awsPath   = '/unity-asset/store/chip/'.$finalname;
            Storage::disk('s3')->put($awsPath, file_get_contents($fileBonus));

            //RECORD LOG
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '26',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Edit gambar bonus chip dengan ID '.$pk.' => '.$finalname
            ]);

            return redirect()->route('Chip_Store')->with('success', alertTranslate('Update image successfull'));
        } else {
            return redirect()->route('Chip_Store')->with('alert', alertTranslate('Image must be in png'));
        }
    }

    public function ImageItem($item_id) 
    {
        //gambar chip
        $rootpath    = get_headers('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$item_id.'.png');
        $url = substr($rootpath[0], 9, 3);
        //Pengecekan pada gambar chip di aws
        if(intval($url) === 200)
        {  
            $file_chip = file_get_contents('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$item_id.'.png');

            return $file_chip;

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

    public function ImageItemBonus($item_id)
    {
        //Pengecekan ada atau tidak ada gambar bonus pada aws 

        $rootpathBonus   = get_headers('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$item_id.'-2.png');
        $url             = substr($rootpathBonus[0], 9, 3);

            if(intval($url) === 200):
                $file_bonus = file_get_contents('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$item_id.'-2.png');

                return $file_bonus;
            else:
                $rootpath_empty = '../public/images/image_not_found/';
                $client_empty   = Storage::createLocalDriver(['root' => $rootpath_empty]);
                $file_empty     = $client_empty->get('not_found.png');
                $type_empty     = $client_empty->mimeType('not_found.png');

                $response_empty = Response::make($file_empty, 200);
                $response_empty->header("Content-Type", $type_empty);

                return $response_empty;
            endif;
    }

    
    public function destroy(Request $request)
    {
        $id = $request->id;
        $pathS3  = 'unity-asset/store/chip/' . $id . '.png';
        $Awspath = 'unity-asset/store/chip/' . $id . '-2.png';

        $currentname = ItemsGold::where('item_id', '=', $id)->first();

        if($id != '')
        {
            // ItemsGold::where('item_id', '=', $id)->delete(); 
            ItemsGold::where('item_id', '=', $id)->update([
                'status' => 2
            ]);

            $path = '../public/store/Chip/'.$id.'.png';
            File::delete($path);
            
            //DELETE ON AWS
            Storage::disk('s3')->delete([$pathS3, $Awspath]);
            
            //RECORD LOG
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '26',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus gambar Chip dengan nama '.$currentname->name
            ]);

            return redirect()->route('Chip_Store')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Chip_Store')->with('alert', alertTranslate('Something wrong'));   
    }

    public function deleteAllSelected(Request $request)
    {
        $ids        =   $request->userIdAll;
        $imageid    =   $request->imageid;
        $imgIdBonus =   $request->imageidBonus;
        $currentname = $request->usernameAll;

        //DELETE ON AWS
        Storage::disk('s3')->delete(explode(",", $imageid));
        Storage::disk('s3')->delete(explode(",", $imgIdBonus));

        //DELETE ON DB
        DB::table('asta_db.item_gold')->whereIn('item_id', explode(",", $ids))->update([
            'Status'    => 2
        ]);

        //RECORD LOG
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '26',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus item chip yang dipilih dengan nama '.$currentname
        ]);
        return redirect()->route('Chip_Store')->with('success', alertTranslate('Data deleted'));
    }
}
