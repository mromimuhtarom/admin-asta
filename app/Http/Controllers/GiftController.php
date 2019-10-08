<?php

namespace App\Http\Controllers;

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
use Storage;

class GiftController extends Controller
{
    public function index()
    {
        $gifts        = Gift::select(
                            'id', 
                            'name', 
                            'price', 
                            'status', 
                            'category_id'
                        )
                        ->get();
        $menu     = MenuClass::menuName('Table Gift');
        $mainmenu = MenuClass::menuName('Item');
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

        $rootpath = '../../asta-api/gift';
        $client = Storage::createLocalDriver(['root' => $rootpath]);
        

        return view('pages.item.tablegift', compact('gifts', 'menu', 'dbgift', 'category', 'endis', 'mainmenu', 'timenow', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id                     = Gift::select('id')
                                  ->orderBy('id', 'desc')
                                  ->first();
        if($id === NULL )
        {
            $id_last = 0;
        } else {
            $id_last = $id->id;
        }
        $id_new                                   = $id_last + 1;
        $file                                     = $request->file('file');
        $file_wtr                                 = $request->file('file1');
        $ekstensi_diperbolehkan                   = array('png');
        $nama                                     = $_FILES['file']['name'];
        $nama_wtr                                 = $_FILES['file1']['name'];
        $x                                        = explode('.', $nama);
        $x_wtr                                    = explode('.', $nama_wtr);
        $ekstensi                                 = strtolower(end($x));
        $ekstensi_wtr                             = strtolower(end($x_wtr));
        $ukuran                                   = $_FILES['file']['size'];
        $nama_file_unik                           = $id_new.'.'.$ekstensi;
        list($width, $height)                     = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {
                    if($request->title == NULL){
                        return redirect()->route('Table_Gift')->with('alert','Name can\'t be NULL ');
                    } else if($request->price == NULL) {
                        return redirect()->route('Table_Gift')->with('alert','Price can\'t be NULL ');
                    } else if($request->category == NULL) {
                        return redirect()->route('Table_Gift')->with('alert','Category can\'t be NULL ');
                    } else {

                        $validator = Validator::make($request->all(),[
                            'title'    => 'required',
                            'price'    => 'required|integer',
                            'category' => 'required|integer|between:1,3',
                        ]);

                        if ($validator->fails()) {
                            return back()->withErrors($validator->errors());
                        }

                        if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                        {
                            list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                        // watermark image
                            // Menetapkan nama thumbnail
                            $folder = "../public/upload/gifts/";
                            $thumbnail = $folder.$nama_file_unik;


                            // Memuat gambar utama
                            $source = imagecreatefrompng($file->move(public_path('../public/upload/gifts/image1'), $nama_file_unik));

                            // Memuat gambar watermark
                            $watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/gifts/image2'), $nama_file_unik));

                            // mendapatkan lebar dan tinggi dari gambar watermark
                            $water_width = imagesx($watermark);
                            $water_height = imagesy($watermark);

                            // mendapatkan lebar dan tinggi dari gambar utama
                            $main_width = imagesx($source);
                            $main_height = imagesy($source);

                            // Menetapkan posisi gambar watermark
                            $pos_x = $width - $width_watermark;
                            $pos_y = $height - $height_watermark;
                            imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            imagecolortransparent($source); 

                            imagepng($source, $thumbnail);
                            imagedestroy($source);
                        // end watermark image
                        } else {
                            // $rootpath = '../../asta-api/gift';
                            // $client = Storage::createLocalDriver(['root' => $rootpath]);
                            // $client->put($nama_file_unik, file_get_contents($file));
                            $file->move(public_path('../public/upload/gifts'), $nama_file_unik);
                        }
                            
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
                            'action_id' => '3',
                            'datetime'  => Carbon::now('GMT+7'),
                            'desc'      => 'Create new in menu Gift Store with title '. $gift->subject
                        ]);
                        return redirect()->route('Table_Gift')->with('success','Insert Data successfull');
                    }
            }
            else
            {
                return redirect()->route('Table_Gift')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Table_Gift')->with('alert','Ekstensi file tidak di perbolehkan');
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


    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $id                     = Gift::where('id', '=', $pk)
                                  ->first();
        $imageversion           = $id->img_ver + 1;
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
        $filename               = $id->id;
        $nama_file_unik         = $filename.'.'.$ekstensi;
        list($width, $height)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {

            if($ukuran < 5242880)
            {            
                if($file_wtr  && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                {
                    list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/gifts/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $source = imagecreatefrompng($file->move(public_path('../public/upload/gifts/image1'), $nama_file_unik));

                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/gifts/image2'), $nama_file_unik));

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
                    // $rootpath = '../../asta-api/gift';
                    // $client = Storage::createLocalDriver(['root' => $rootpath]);
                    // $client->put($nama_file_unik, file_get_contents($file));
                    $file->move('../public/upload/gifts', $nama_file_unik);
                    $path = '../public/gifts/image1/'.$pk.'.png';
                    File::delete($path);
                    $path1 = '../public/gifts/image2/'.$pk.'.png';
                    File::delete($path1);
                }


                    Gift::where('id', '=', $pk)->update([
                        'img_ver' =>  $imageversion,
                        'width'   =>  $width,
                        'height'  =>  $height
                    ]);


                    Log::create([
                        'op_id'     => Session::get('userId'),
                        'action_id' => '2',
                        'datetime'  => Carbon::now('GMT+7'),
                        'desc'      => 'Edit image in menu Gift Store with ID '.$pk.' to '. $nama_file_unik
                    ]);
                    return redirect()->route('Table_Gift')->with('success','Update Image successfull');
            }
            else
            {
                return redirect()->route('Table_Gift')->with('alert','Your image source size height is more than 319 px and width is more than 384');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Table_Gift')->with('alert','format must be png and pictorial');
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }


    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;


        Gift::where('id', '=', $pk)->update([
          $name => $value
        ]);

        switch ($name) {
          case "name":
              $name = "Name";
              break;
          case "chipsPrice":
              $name = "Chips Price";
              break;
          case "diamondPrice":
              $name = "Diamond Price";
              break;
          case "expire":
              $name = "Expire";
              break;
          case "category":
              $name = "Category";
              break;
          case "permanent":
              $name = "Permanent";
              break;
          default:
            "";
      }


      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu Gift Store with Id '.$pk.' to '. $value
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $gifts = Gift::select('id')
                 ->where('id', '=', $id)
                 ->first();
        if($id != '')
        { 
            Gift::where('id', '=', $id)->delete();
            $path = '../public/upload/gifts/'.$gifts->id.'.png';
            File::delete($path);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Gift Store with ID '.$id
            ]);

            return redirect()->route('Table_Gift')->with('success','Data Deleted');
        }
        return redirect()->route('Table_Gift')->with('success','Something wrong');
    }
}
