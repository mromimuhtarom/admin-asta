<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystems\FilesystemManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\Gift;
use App\Log;
use Session;
use Carbon\Carbon;
use DB;
use File;
use Validator;
use App\ConfigText;
use Response;
use Illuminate\Support\Facades\Input;

class GiftController extends Controller
{
    public function index(Request $request)
    {
        $sorting    = $request->sorting;
        $namecolumn = $request->namecolumn;
        // if sorting variable is null
        if($sorting == NULL):
            $sorting = 'asc';
        endif;

        if($namecolumn == NULL):
            $namecolumn = 'asta_db.gift.id';
        endif;

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;

        $gifts        = Gift::select(
                            'id', 
                            'name', 
                            'price', 
                            'status', 
                            'category_id'
                        )
                        ->orderBy($namecolumn, $sorting)
                        ->paginate(10);

        $gifts ->appends($request->all());
        $menu     = MenuClass::menuName('L_TABLE_GIFT');
        $mainmenu = MenuClass::menuName('L_ITEM');
        // ---- untuk gift category -----//
        $giftcategory = ConfigText::select(
                            'name', 
                            'value'
                        )
                        ->where('id', '=', 7)
                        ->first();
        $value        = str_replace(':', ',', $giftcategory->value);
        $category     = explode(",", $value);

        $timenow = Carbon::now('GMT+7');

        // ---- untuk enabled disabled ------//
        $active = ConfigText::select(
                    'name', 
                    'value'
                  )
                  ->where('id', '=', 4)
                  ->first();
        $value = str_replace(':', ',', $active->value);
        $endis = explode(",", $value);

        

        return view('pages.item.tablegift', compact('gifts', 'menu', 'category', 'endis', 'mainmenu', 'timenow', 'sortingorder', 'namecolumn'));
    }

    
    
    public function store(Request $request)
    {
        $name = $request->title;
        $id = Gift::select('id')
                ->orderBy('id', 'desc')
                ->first();

        $validator = Validator::make($request->all(),[
            'title'    => 'required',
            'price'    => 'required|integer',
            'category' => 'required|integer|between:1,4',
            'file'     => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($id === NULL )
        {
            $id_last = 0;
        } else {
            $id_last = $id->id;
        }
        $id_new                                   = $id_last + 1;
        $file                                     = $request->file('file');
        // $file_wtr                                 = $request->file('file1');
        $ekstensi_diperbolehkan                   = array('png');
        $filename1                                = $file->getClientOriginalName();
        $filename2                                = $file->getClientOriginalName();
        $x                                        = explode('.', $filename1);
        // $x_wtr                                    = explode('.', $filename2);
        $ekstensi                                 = strtolower(end($x));
        // $ekstensi_wtr                             = strtolower(end($x_wtr));
        $ukuran                                   = $_FILES['file']['size'];
        $nama_file_unik                           = $id_new.'.'.$ekstensi;
        list($width, $height)                     = getimagesize($file);


        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {
                if($height == 320):
                    if($request->title == NULL){
                        return redirect()->route('Table_Gift')->with('alert', alertTranslate("Name can't be NULL"));
                    } else if($request->price == NULL) {
                        return redirect()->route('Table_Gift')->with('alert', alertTranslate("Price can't be NULL"));
                    } else if($request->category == NULL) {
                        return redirect()->route('Table_Gift')->with('alert', alertTranslate("Category can't be NULL"));
                    } else {

                        $validator = Validator::make($request->all(),[
                            'title'    => 'required',
                            'price'    => 'required|integer',
                            'category' => 'required|integer|between:1,4',
                        ]);

                        if ($validator->fails()) {
                            return back()->withErrors($validator->errors());
                        }

                        // if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                        // {
                        //     list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                        // // watermark image
                        //     // Menetapkan nama thumbnail
                    
                        //     $folder = "../public/upload/gifts/";
                        //     $thumbnail = $folder.$nama_file_unik;
    
                            

                        // // Memuat gambar utama
                        //     $rootpath_main    = '../public/upload/gifts/image1/';
                        //     $upload_imagemain = '../public/upload/gifts/image1';
                        //     $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                        //     $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                        //     $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);
                        

                        // // Memuat gambar watermark
                        //     $rootpath_wtr    = '../public/upload/gifts/image2/';
                        //     $upload_imagewtr = '../public/upload/gifts/image2';
                        //     $watermarkimage  = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                        //     $putfile_wtr     = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                        //     $watermark       = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                        //     // mendapatkan lebar dan tinggi dari gambar watermark
                        //     $water_width     = imagesx($watermark);
                        //     $water_height    = imagesy($watermark);

                        //     // mendapatkan lebar dan tinggi dari gambar utama
                        //     $main_width      = imagesx($source);
                        //     $main_height     = imagesy($source);

                        //     // Menetapkan posisi gambar watermark
                        //     $pos_x           = $width - $width_watermark;
                        //     $pos_y           = $height - $height_watermark;
                        //     $copy_wtr        = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                        //     imagealphablending($source, false);
                        //     imagesavealpha($source, true);
                        //     imagecolortransparent($source); 
                        
                        //     $tery = image_data($source);
                            
                        //     $awsPath =  "unity-asset/gift/" . $nama_file_unik;

                        //     $merge = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                        //     Storage::disk('s3')->put($awsPath, $tery);

                        //     //DELETE FILE LOCAL SETELAH DI MERGE
                        //     $path = '../public/upload/gifts/image1/'.$nama_file_unik;
                        //     File:: delete($path);

                        //     $path = '../public/upload/gifts/image2/'.$nama_file_unik;
                        //     File:: delete($path);

                        // // end watermark image
                        // } else {
                            // $rootpath   = '../../asta-api/upload/gifts';
                            //$image_main = Storage::createLocalDriver(['root' => $rootpath]);
                            $rootpath = 'unity-asset/gift/' . $nama_file_unik;
                            $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                            //$image_main->put($nama_file_unik, file_get_contents($file));
                        // }
                            
                        $gift = Gift::create([
                            'id'          => $id_new,
                            'name'        => $request->title,
                            'price'       => $request->price,
                            'category_id' => $request->category,
                            'width'       => $width,
                            'height'      => $height,
                            'img_ver'     => 0,
                            'status'      => 1
                        ]);

                        Log::create([
                            'op_id'     => Session::get('userId'),
                            'action_id' => '11',
                            'datetime'  => Carbon::now('GMT+7'),
                            'desc'      => 'Menambahkan data '.$name
                        ]);
                        return redirect()->route('Table_Gift')->with('success', alertTranslate("L_INSERT_DATA_SUCCESS"));
                    }
                else:
                    $translatealertimage = str_replace('{1}', '320 px', alertTranslate("L_HEIGHT_IMAGE"));
                    return back()->with('alert',  $translatealertimage);
                endif;
            }
            else
            {
                return redirect()->route('Table_Gift')->with('alert', alertTranslate("Size Image it's too Big"));
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Table_Gift')->with('alert', alertTranslate('File extensions are not allowed'));
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }



//thumbnail gambar yang telah di merge
    public function ImageGift($gift_id)
    {
        $linkimage = 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/gift/'.$gift_id.'.png';
        

        $im   = imagecreatefrompng($linkimage);
        $size = min(imagesx($im), imagesy($im));
        $im2  = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
        if($im2 !== FALSE) {
            imagepng($im2);
            imagedestroy($im2);
        }
        imagedestroy($im);
  
        file_put_contents('../public/upload/gifts/crop/', file_get_contents($im2));
        $filepublic = public_path().'/upload/gifts/crop/';
        
        return $linkimage;
      
    }



    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $id                     = Gift::where('id', '=', $pk)
                                  ->first();
        $validator              = Validator::make($request->all(),[
                                    'file'     => 'required',
                                ]);
                        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $imageversion           = $id->img_ver + 1;
        $file                   = $request->file('file');
        $file_wtr               = $request->file('file1');
        $ekstensi_diperbolehkan = array('png');
        $nama                   = $_FILES['file']['name'];
        // $nama_wtr               = $_FILES['file1']['name'];
        $x                      = explode('.', $nama);
        // $x_wtr                  = explode('.', $nama_wtr);
        $ekstensi               = strtolower(end($x));
        // $ekstensi_wtr           = strtolower(end($x_wtr));
        $ukuran                 = $_FILES['file']['size'];
        $filename               = $id->id;
        $nama_file_unik         = $filename.'.'.$ekstensi;
        list($width, $height)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {

            if($height == 320):
                if($ukuran < 5242880)
                {            
                    // if($file_wtr  && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                    // {
                    //     list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    //     // Menetapkan nama thumbnail
                    //     $folder    = "../public/upload/gifts/";
                    //     $thumbnail = $folder.$nama_file_unik;

                    //     // Memuat gambar utama
                    //         $rootpath_main    = '../public/upload/gifts/image1/';
                    //         $upload_imagemain = '../public/upload/gifts/image1';
                    //         $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    //         $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                    //         $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                    //     // Memuat gambar watermark
                    //         $rootpath_wtr    = '../public/upload/gifts/image2/';
                    //         $upload_imagewtr = '../public/upload/gifts/image2';
                    //         $watermarkimage  = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                    //         $putfile_str     = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    //         $watermark       = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                    //     // mendapatkan lebar dan tinggi dari gambar watermark
                    //     $water_width  = imagesx($watermark);
                    //     $water_height = imagesy($watermark);

                    //     // mendapatkan lebar dan tinggi dari gambar utama
                    //     $main_width  = imagesx($source);
                    //     $main_height = imagesy($source);

                    //     // Menetapkan posisi gambar watermark
                    //     // $dime_x = -180;
                    //     // $dime_y = 200;
                    //     // menyalin kedua gambar
                    //     // imagecopy($source, $watermark, imagesx($source) - $main_width - $dime_x, imagesy($source) - $water_height - $dime_y, 0, 0, imagesx($watermark), imagesy($watermark));
                    //     $pos_x = $width - $width_watermark;
                    //     $pos_y = $height - $height_watermark;
                    //     imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                        
                    //     imagealphablending($source, false);
                    //     imagesavealpha($source, true);
                    //     imagecolortransparent($source);
                        
                    //     $tery = image_data($source);
                    //     $awsPath = "unity-asset/gift/" . $nama_file_unik;
                    //     $merge = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                    //     Storage::disk('s3')->put($awsPath, $tery);


                    //     //DELETE FILE LOCAL SETELAH DI MERGE
                    //     $path = '../public/upload/gifts/image1/'.$pk.'.png';
                    //     File:: delete($path);

                    //     $path = '../public/upload/gifts/image2/'.$pk.'.png';
                    //     File:: delete($path);

                    //     // imagepng($source, $thumbnail);
                    //     // imagedestroy($source);
                    // } else {
                        $rootpath   = 'unity-asset/gift/' . $nama_file_unik;
                        // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                        $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                        $path = '../public/upload/gifts/image1/'.$nama_file_unik;
                        File:: delete($path);
                        $path1 = '../public/upload/gifts/image2/'.$nama_file_unik;
                        File::delete($path1);
                    // }

                        Gift::where('id', '=', $pk)->update([
                            'img_ver' =>  $imageversion,
                            'width'   =>  $width,
                            'height'  =>  $height
                        ]);

                        $currentname = Gift::where('id', '=', $pk)->first();


                        Log::create([
                            'op_id'     => Session::get('userId'),
                            'action_id' => '11',
                            'datetime'  => Carbon::now('GMT+7'),
                            'desc'      => 'Edit gambar ('.$currentname->name.')'
                        ]);
                        return redirect()->route('Table_Gift')->with('success', alertTranslate('Update image successfull'));
                }
                else
                {
                    return redirect()->route('Table_Gift')->with('alert', alertTranslate("Your image source size height is more than 319 px and width is more than 384"));
                    // echo 'Ukuran file terlalu besar';
                }
            else:
                $translatealertimage = str_replace('{1}', '320 px', alertTranslate("L_HEIGHT_IMAGE"));
                return back()->with('alert', $translatealertimage);
            endif;
        }
        else
        {
            return redirect()->route('Table_Gift')->with('alert', alertTranslate("format must be png and pictorial"));
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }


    public function update(Request $request)
    {
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $currentname = Gift::where('id', '=', $pk)->first();

        Gift::where('id', '=', $pk)->update([
          $name => $value
        ]);
        
    
        $timenow = Carbon::now('GMT+7');

        switch ($name) {
              case "name":
              $name = "Nama";
              $curerrentvalue = $currentname->name;
              break;
          case "price":
              $name = "Harga Chip";
              $curerrentvalue = $currentname->price;
              break;
          case "category_id":
                $name = "Category";
                $curerrentvalue = $currentname->category_id;
                if($value == 1 || $curerrentvalue == 1):
                    $value          = 'makanan';
                elseif($value == 2 || $curerrentvalue == 2):
                    $value          = 'minuman';
                elseif($value == 3 || $curerrentvalue == 3):
                    $value          = 'item';
                else:
                    $value          = 'aksi';
                endif;
                
                if($curerrentvalue == 1):
                    $curerrentvalue = 'makanan';
                elseif($curerrentvalue == 2):
                    $curerrentvalue = 'minuman';
                elseif($curerrentvalue == 3):
                    $curerrentvalue = 'item';
                else:
                    $curerrentvalue = 'aksi';
                endif;
                
              break;
          case "status":
                $name           = "Status";
                $curerrentvalue = $currentname->status;
                if($value == 0):
                    $value          = 'disabled';
                else:
                    $value          = 'enabled';
                endif;
                if($curerrentvalue == 0):
                    $curerrentvalue = 'disabled';
                else:
                    $curerrentvalue = 'enabled';
                endif;
              break;
          default:
            "";
      }

      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '11',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' ('.$currentname->name.') '.$curerrentvalue .' => '. $value
      ]);
    }

    
    public function destroy(Request $request)
    {
        $id = $request->id;
        $gifts = Gift::select('id')
                 ->where('id', '=', $id)
                 ->first();
                 
        $currentname = Gift::where('id', '=', $id)->first();

        $pathS3 = 'unity-asset/gift/' . $id .'.png';
        
        if($id != '')
        { 
            Gift::where('id', '=', $id)->delete();
            $path = '../../asta-api/gift/'.$gifts->id.'.png';
            // File::delete($path);
            Storage::disk('s3')->delete($pathS3);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '11',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data ('.$currentname->name.')'
            ]);
            return redirect()->route('Table_Gift')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Table_Gift')->with('alert', alertTranslate('Something wrong'));
    }


    public function deleteAllSelected(Request $request)
    {
        $ids        =   $request->userIdAll;
        $imageid    =   $request->imageid;
        $currentname =  $request->usernameAll;
        
        //DELETE
        Storage::disk('s3')->delete(explode(",", $imageid));
        DB::table('asta_db.gift')->whereIn('id', explode(",", $ids))->delete();
        
        //RECORD LOG
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '11',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus data ('.$currentname.')'
        ]);
        return redirect()->route('Table_Gift')->with('succes', alertTranslate('Data deleted'));
    }
}


