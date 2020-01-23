<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emoticon;
use App\ConfigText;
use Session;
use Carbon\Carbon;
use App\Log;
use App\Classes\MenuClass;
use Validator;
use File;
use Storage;
use Response;
use DB;

class EmoticonController extends Controller
{
    
    public function index()
    {
        $emoticon = Emoticon::select(
                        'id',
                        'name',
                        'price',
                        'status'
                    )
                    ->get();
        $menu     = MenuClass::menuName('Emoticon');
        $mainmenu = MenuClass::menuName('Item');
        $active   = ConfigText::select(
                        'name', 
                        'value'
                    )
                    ->where('id', '=', 4)
                    ->first();
        $value    = str_replace(':', ',', $active->value);
        $endis    = explode(",", $value);
        $timenow  = Carbon::now('GMT+7');
        return view('pages.item.emoticon', compact('emoticon', 'menu', 'mainmenu', 'endis', 'timenow'));
    }

  
    public function store(Request $request)
    {
        $id                     = Emoticon::select('id')
                                  ->orderBy('id', 'desc')
                                  ->first();
        $validator = Validator::make($request->all(),[
            'title'    => 'required',
            'price'    => 'required|integer',
            'file'     => 'required',
            // 'category' => 'required|integer|between:1,3',
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
        $id_new                       = $id_last + 1;
        $file                         = $request->file('file');
        $file_wtr                     = $request->file('file1');
        $ekstensi_diperbolehkan       = array('png');
        $filename1                    = $file->getClientOriginalName();
        $filename2                    = $file->getClientOriginalName();
        $x                            = explode('.', $filename1);
        $x_wtr                        = explode('.', $filename2);
        $ekstensi                     = strtolower(end($x));
        $ekstensi_wtr                 = strtolower(end($x_wtr));
        $ukuran                       = $_FILES['file']['size'];
        $nama_file_unik               = $id_new.'.'.$ekstensi;
        list($width, $height)         = getimagesize($file);
        // $acak                   = rand(1,99);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {
                
                    if($request->title == NULL){
                        return redirect()->route('Emoticon')->with('alert', alertTranslate("Name can't be NULL") );
                    } else if($request->price == NULL) {
                        return redirect()->route('Emoticon')->with('alert', alertTranslate("Price can't be NULL"));
                    } 
                   
                    else {

                        if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                        {
                            list($width_wtr, $height_wtr) = getimagesize($file_wtr);
                        // watermark image
                            // Menetapkan nama thumbnail
                            $folder = "../public/upload/emoticon/";
                            $thumbnail = $folder."".$nama_file_unik;


                            // Memuat gambar utama
                            $rootpath_main    = '../public/upload/emoticon/image1/';
                            $upload_imagemain = '../public/upload/emoticon/image1';
                            $mainimage        = Storage::createLocalDriver(['root' => $upload_imagemain]);
                            $putfile_main     = $mainimage->put($nama_file_unik, file_get_contents($file));
                            $source           = imagecreatefrompng($rootpath_main.$nama_file_unik);

                            // Memuat gambar watermark
                            $rootpath_wtr      = '../public/upload/emoticon/image2/';
                            $upload_imagewtr   = '../public/upload/emoticon/image2';
                            $watermarkimage    = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                            $putfile_str       = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                            $watermark         = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                            // mendapatkan lebar dan tinggi dari gambar watermark
                            $water_width = imagesx($watermark);
                            $water_height = imagesy($watermark);

                            // mendapatkan lebar dan tinggi dari gambar utama
                            $main_width = imagesx($source);
                            $main_height = imagesy($source);

                            // Menetapkan posisi gambar watermark
                            $pos_x = $width - $width_wtr;
                            $pos_y = $height - $height_wtr;
                            imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_wtr, $height_wtr);
                    
                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            imagecolortransparent($source);
                            
                            $tery = image_data($source);

                            $awsPath = "unity-asset/emoticon/" . $nama_file_unik;

                            $merge = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_wtr, $height_wtr);

                            Storage::disk('s3')->put($awsPath, $tery);
                            $path = '../public/upload/emoticon/image1/'.$nama_file_unik;
                            File::delete($path);
                            $path1 = '../public/upload/emoticon/image2/'.$nama_file_unik;
                            File::delete($path1);
                            // imagedestroy($source);
                        // end watermark image
                        } else {
                            $rootpath   = 'unity-asset/emoticon/' . $nama_file_unik;
                            // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                            $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                        }

                        $emoticon = Emoticon::create([
                            'id'          => $id_new,
                            'name'        => $request->title,
                            'price'       => $request->price,
                            'category_id' => 1,
                            'img_ver'     => 0,
                            'status'      => 1
                        ]);

                        Log::create([
                            'op_id'     => Session::get('userId'),
                            'action_id' => '3',
                            'datetime'  => Carbon::now('GMT+7'),
                            'desc'      => 'Menambahkan data di menu Emotikon dengan judul '. $emoticon->subject
                        ]);
                        return redirect()->route('Emoticon')->with('success', alertTranslate('insert data successful'));
                    }
            
            }
            else
            {
                return redirect()->route('Emoticon')->with('alert', alertTranslate("Size Image it's too Big"));
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Emoticon')->with('alert', alertTranslate("File extensions are not allowed"));
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }

  

    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $id                     = Emoticon::where('id', '=', $pk)
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
        $nama_wtr               = $_FILES['file1']['name'];
        $x                      = explode('.', $nama);
        $x_wtr                  = explode('.', $nama_wtr);
        $ekstensi               = strtolower(end($x));
        $ekstensi_wtr           = strtolower(end($x_wtr));
        $ukuran                 = $_FILES['file']['size'];
        $filename               = $id->id;
        $nama_file_unik         = $filename.'.'.$ekstensi;
        list($width, $height)         = getimagesize($file);
        // list($width_wtr, $height_wtr) = getimagesize($file_wtr);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true )
        {

            if($ukuran < 5242880)
            {
                // if ($file->move(public_path('../public/upload/emoticon'), $nama_file_unik))
                // {
                    if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                    {

                        list($width_wtr, $height_wtr) = getimagesize($file_wtr);
                        // watermark image
                            // Menetapkan nama thumbnail
                            $folder = "../public/upload/emoticon/";
                            $thumbnail = $folder.$nama_file_unik;

                            // Memuat gambar utama
                            $rootpath_main = '../public/upload/emoticon/image1/';
                            $upload_imagemain = '../public/emoticon/image1';
                            $mainimage = Storage::createLocalDriver(['root' => $upload_imagemain]);
                            $putfile_main = $mainimage->put($nama_file_unik, file_get_contents($file));
                            $source = imagecreatefrompng($rootpath_main.$nama_file_unik);

                            // Memuat gambar watermark
                            $rootpath_wtr = '../public/upload/emoticon/image2/';
                            $upload_imagewtr = '../public/upload/emoticon/image2';
                            $watermarkimage = Storage::createLocalDriver(['root' => $upload_imagewtr]);
                            $putfile_str = $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                            $watermark = imagecreatefrompng($rootpath_wtr.$nama_file_unik);

                            // mendapatkan lebar dan tinggi dari gambar watermark
                            $water_width = imagesx($watermark);
                            $water_height = imagesy($watermark);

                            // mendapatkan lebar dan tinggi dari gambar utama
                            $main_width = imagesx($source);
                            $main_height = imagesy($source);

                            // Menetapkan posisi gambar watermark
                            $pos_x = $width - $width_wtr;
                            $pos_y = $height - $height_wtr;
                            imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_wtr, $height_wtr);
                    
                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            imagecolortransparent($source);
                            
                            $tery = image_data($source);
                            $awsPath = "unity-asset/emoticon/" . $nama_file_unik;
                            $merge = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_wtr, $height_wtr);
                            

                            $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                            $path = '../public/upload/emoticon/image1/'.$nama_file_unik;
                            File::delete($path);
                            $path1 = '../public/upload/emoticon/image2/'.$nama_file_unik;
                            File::delete($path1);

                            // imagepng($source, $thumbnail);
                            // imagedestroy($source);
                    } else {
                        $rootpath   = 'unity-asset/emoticon/' . $nama_file_unik;
                        // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                        $path = '../public/upload/emoticon/image1/'.$pk.'.png';
                        File::delete($path);
                        $path1 = '../public/upload/emoticon/image2/'.$pk.'.png';
                        File::delete($path1);
                    }
                        // end watermark image
                    Emoticon::where('id', '=', $pk)->update([
                        'img_ver' =>  $imageversion 
                    ]);

                    Log::create([
                        'op_id'     => Session::get('userId'),
                        'action_id' => '2',
                        'datetime'  => Carbon::now('GMT+7'),
                        'desc'      => 'Edit gambar di menu Emotikon dengan ID '.$pk
                    ]);
                    return redirect()->route('Emoticon')->with('success', alertTranslate('Update image successfull'));

                // }
                // else
                // {
                //     return redirect()->route('Emoticon')->with('alert','Gagal Upload File');
                //     // echo "Gagal Upload File";
                // }
            }
            else
            {
                return redirect()->route('Emoticon')->with('alert', alertTranslate("Size Image it's too Big"));
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Emoticon')->with('alert', alertTranslate("File extensions are not allowed"));
            // echo 'Ekstensi file tidak di perbolehkan';
        }
    }


    public function ImageEmoticon($item_id)
    { 
        $linkimage = 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/emoticon/'.$item_id.'.png';
        

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


    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        Emoticon::where('id', '=', $pk)->update([
          $name => $value
        ]);

        switch ($name) {
          case "name":
              $name = "Nama";
              break;
          case "price":
              $name = "Harga";
              break;
          case "status":
              $name = "Status";
              if($value == 0):
                $value = 'disabled';
              else:
                $value = 'enabled';
              endif;
            break;
          default:
            "";
      }


      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' di menu Emotikon dengan Id '.$pk.' menjadi '. $value
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
        $id     = $request->id;
        $gifts  = Emoticon::select('id')
                 ->where('id', '=', $id)
                 ->first();

        $pathS3 = 'unity-asset/emoticon/' . $id . '.png';

        if($id != '')
        {
            Emoticon::where('id', '=', $id)->delete();
            $path = '../../asta-api/emoticon/'.$gifts->id.'.png';
            // File::delete($path);
            Storage::disk('s3')->delete($pathS3);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Emotikon dengan ID '.$id
            ]);

            return redirect()->route('Emoticon')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Emoticon')->with('alert', alertTranslate('Something wrong'));
    }

    public function deleteAllSelected(Request $request)
    {
        $ids        =   $request->userIdAll;
        $imageid    =   $request->imageid;

        //DELETE
        Storage::disk('s3')->delete(explode(",", $imageid));
        DB::table('asta_db.emoticon')->whereIn('id', explode(",", $ids))->delete();

        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '4',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Menghapus data yang dipilih di menu emoticon dengan id '.$imageid
        ]);
        return redirect()->route('Emoticon')->with('success', alertTranslate('Data deleted'));
    }
}
