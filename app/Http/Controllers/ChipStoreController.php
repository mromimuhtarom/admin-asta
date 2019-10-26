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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('Chip Store');
        $mainmenu = MenuClass::menuName('Store');
        $items    = ItemsGold::select(
                        'item_id',
                        'name',
                        'item_type',
                        'price',
                        'item_get',
                        'status',
                        'order'
                    )
                    ->where('item_type', '=', 1)
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
        return view('pages.store.chip_store', compact('items', 'menu', 'endis', 'mainmenu', 'timenow'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
          $ekstensi_diperbolehkan = array('png');
          $nama                   = $_FILES['file']['name'];
          $nama_wtr               = $_FILES['file1']['name'];
          $x                      = explode('.', $nama);
          $x_wtr                  = explode('.', $nama_wtr);
          $ekstensi               = strtolower(end($x));
          $ekstensi_wtr           = strtolower(end($x_wtr));
          $ukuran                 = $_FILES['file']['size'];
          $nama_file_unik         = $id_new.'.'.$ekstensi;
          list($width, $height)  = getimagesize($file);
          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
          {
              if($ukuran < 5242880)
              {
                  if($file_wtr && in_array($ekstensi_wtr))
                  {
                    list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                        // watermark image
                            // Menetapkan nama thumbnail
                            $folder = "../public/upload/Chip/";
                            $thumbnail = $folder.$nama_file_unik;

                            // Memuat gambar utama
                            $rootpath_main = '../../asta-api/upload/Chip/image1/';
                            $upload_imagemain = '../../asta-api/upload/Chip/image1';
                            $mainimage = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                            $putfile_main = $mainimage->put($nama_file_unik, file_get_contents($file));
                            $source = imagecreatefrompng($rootpath_main.$nama_file_unik);

                            // Memuat gambar watermark
                            $rootpath_wtr = '../../asta-api/upload/Chip/image2/';
                            $upload_imagewtr = '../../asta-api/upload/Chip/image2';
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
                            $pos_x = $width - $width_watermark;
                            $pos_y = $height - $height_watermark;
                            imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                            imagealphablending($source, false);
                            imagesavealpha($source, true);
                            imagecolortransparent($source); 

                            imagepng($source, $thumbnail);
                            imagedestroy($source);
                        // end watermark image
                  } else 
                  {
                    $rootpath = '../../asta-api/upload/Chip';
                    $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main->put($nama_file_unik, file_get_contents($file));
                  }
                  $chip = ItemsGold::create([
                    'name'      => $request->title,
                    'item_type' => 1,
                    'price'     => $request->goldcost,
                    'item_get'  => $request->chipawarded,
                    'status'    => 0,
                    'order'     => $request->order
                ]);

                Log::create([
                    'op_id'     => Session::get('user_id'),
                    'action_id' => '3',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Create new in menu Chip Store with title '. $chip->name
                ]);

                return redirect()->route('Chip_Store')->with('success', 'Data Insert Successfull');
              } else {
                return redirect()->route('Chip_Store')->with('alert',"Size Image it's to Big");
              }
          } else {
            return redirect()->route('Chip_Store')->with('alert','Image must be in png');
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

        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        ItemsGold::where('item_id', '=', $pk)->update([
            $name =>$value
        ]);
  
        switch ($name) {
          case "name":
              $name = "Name Chip";
              break;
          case "item_get":
              $name = "Chip Awarded";
              break;
          case "price":
              $name = "Price";
              break;
          case "status":
              $name = "Status";
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
        'desc'      => 'Edit '.$name.' in menu Chip Store with Id '.$pk.' to '. $value
      ]);
    }


    public function updateImage(Request $request)
    {
        $validator = Validator::make($request->all(),[
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
                            $folder = "../../asta-api/upload/Chip/";
                            $thumbnail = $folder.$nama_file_unik;


                            // Memuat gambar utama
                            $rootpath_main = '../../asta-api/upload/Chip/image1/';
                            $upload_imagemain = '../../asta-api/upload/Chip/image1';
                            $mainimage = Storage::createLocalDriver(['root' => $upload_imagemain ]);
                            $putfile_main = $mainimage->put($nama_file_unik, file_get_contents($file));
                            $source = imagecreatefrompng($rootpath_main.$nama_file_unik);

                            // Memuat gambar watermark
                            $rootpath_wtr = '../../asta-api/upload/Chip/image2/';
                            $upload_imagewtr = '../../asta-api/upload/Chip/image2';
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
                    $rootpath = '../../asta-api/upload/Chip';
                    $image_main = Storage::createLocalDriver(['root' => $rootpath]);
                    $image_main->put($nama_file_unik, file_get_contents($file));

                    $path = '../../asta-api/upload/Chip/image1/'.$pk.'.png';
                    File::delete($path);
                    $path1 = '../../asta-api/upload/Chip/image2/'.$pk.'.png';
                    File::delete($path1);
                    // return redirect()->route('Chip_Store')->with('alert','Upload Image Failed');
                }
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '2',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit Image In menu Chip Store with ID '.$pk.' to '.$nama_file_unik
                ]);

                return redirect()->route('Chip_Store')->with('success','Update Image Successfull');
            } else  {
                return redirect()->route('Chip_Store')->with('alert','Size Image is to big');
            }
        } else  {
            return redirect()->route('Chip_Store')->with('alert','Image must be in png format');
        }
    }

    public function ImageItem($item_id)
    {
      $rootpath = '../../asta-api/upload/Chip';
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
        $id = $request->id;
        if($id != '')
        {
            ItemsGold::where('item_id', '=', $id)->delete(); 
            $path = '../../asta-api/upload/Chip/'.$id.'.png';
            File::delete($path);  
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Chip Store with ID '.$id
            ]);

            return redirect()->route('Chip_Store')->with('success','Data Deleted');
        }
        return redirect()->route('Chip_Store')->with('success','Something wrong');   
    }
}
