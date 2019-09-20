<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;

class BestOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('Best Offer');
        $mainmenu = MenuClass::menuName('Store');
        return view('pages.store.best_offer', compact('menu', 'mainmenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id                     = nanti;
        if($id === NULL )
        {
            $id_last = 0;
        } else {
            $id_last = $id->id;
        }
        $id_new                      = $id_last + 1;
        $file                        = $request->file('file');
        $file                        = $request->file('file');
        $ekstensi_diperbolehkan      = array('jpg');
        $nama                        = $_FILES['file']['name'];
        $x                           = explode('.', $nama);
        $ekstensi                    = strtolower(end($x));
        $ukuran                      = $_FILES['file']['size'];
        $nama_file_unik              = $id_new.'.'.$ekstensi;
        list($width, $height)        = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {

            if($ukuran < 1044070)
            {
                if ($file->move(public_path('../public/upload/gifts'), $nama_file_unik))
                {
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/gifts/";
                    $thumbnail = $folder."wtm_2".$nama_file_unik;
                    $actual = $folder.$nama_file_unik;
                    $namagbr="wtm_".$nama_file_unik;

                    // Memuat gambar utama
                    $uploadgambar=$folder.$nama_file_unik;

                    // Memuat gambar utama
                    $source = imagecreatefrompng($uploadgambar);

                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng('../public/upload/gifts/diskon1.png');

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width = imagesx($source);
                    $main_height = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    $dime_x = -180;
                    $dime_y = 200;
                    // menyalin kedua gambar
                    imagecopy($source, $watermark, imagesx($source) - $main_width - $dime_x, imagesy($source) - $water_height - $dime_y, 0, 0, imagesx($watermark), imagesy($watermark));


                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 

                    imagepng($source, $thumbnail);
                    imagedestroy($source);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
