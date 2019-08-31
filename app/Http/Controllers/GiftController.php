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

        // ---- untuk enabled disabled ------//
        $active = ConfigText::select(
                    'name', 
                    'value'
                  )
                  ->where('id', '=', 4)
                  ->first();
        $value = str_replace(':', ',', $active->value);
        $endis = explode(",", $value);

        return view('pages.item.tablegift', compact('gifts', 'menu', 'dbgift', 'category', 'endis', 'mainmenu'));
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
        $id_new                 = $id_last + 1;
        $file                   = $request->file('file');
        $ekstensi_diperbolehkan = array('jpg');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        // $acak                   = rand(1,99);
        $nama_file_unik         = $id_new.'.'.$ekstensi;
        list($width, $height)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {
                if ($file->move(public_path('../public/upload/gifts'), $nama_file_unik))
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
                    return redirect()->route('Table_Gift')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
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
        $ekstensi_diperbolehkan = array('png');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $filename               = $id->id;
        $nama_file_unik         = $filename.'.'.$ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {

            if($ukuran < 1044070)
            {
                if ($file->move(public_path('../public/upload/gifts'), $nama_file_unik))
                {
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/gifts/";
                    $thumbnail = $folder."wtm_".$nama_file_unik;
                    $actual = $folder.$nama_file_unik;
                    $namagbr="wtm_".$nama_file_unik;

                    // Memuat gambar utama
                    $uploadgambar=$folder.$nama_file_unik;
                    $source = imagecreatefrompng($uploadgambar);

                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng('../public/upload/gifts/33.png');

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width = imagesx($source);
                    $main_height = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    $dime_x = 5;
                    $dime_y = 5;
                    // menyalin kedua gambar
                    // imagecopy($source, $watermark, $dime_x, $dime_y, 0, 0, $water_width, $water_height);
                    imagecopy($source, $watermark, imagesx($source) - $main_width - $dime_x, imagesy($source) - $water_height - $dime_y, 0, 0, imagesx($watermark), imagesy($watermark));
                    // imagecopymerge(
                    //     $source,
                    //     $watermark,
                    //     $dime_x, 
                    //     $dime_y,
                    //     0,
                    //     0,
                    //     $water_width,
                    //     $water_height
                    // );

                    // pemrosesan akhir, Membuat gambar baru dengan nama file baru
                    $black = imagecolorallocate($source, 0, 0, 0);
                    imagecolortransparent($source, $black);
                    imagepng($source, $thumbnail);
                    Gift::where('id', '=', $pk)->update([
                        'img_ver' =>  $imageversion 
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
                    return redirect()->route('Table_Gift')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
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
            $path = '../public/upload/gifts/'.$gifts->id.'.jpg';
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
