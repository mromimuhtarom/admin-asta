<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SlideBanner;
use App\Log;
use Session;
use File;
use Carbon\Carbon;
use App\Classes\MenuClass;
use Validator;
use App\ConfigText;

class SlideBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu         = MenuClass::menuName('Slide Banner');
        $slide_banner = SlideBanner::all();
        $active       = ConfigText::select('name', 'value')->where('id', '=', 4)->first();
        $value        = str_replace(':', ',', $active->value);
        $endis        = explode(",", $value);
        return view('pages.slide_banner.slide_banner', compact('menu', 'slide_banner', 'endis'));
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
        $id = DB::table('slide_banner')
              ->select('id')
              ->orderBy('id', 'desc')
              ->first();



        if($id === NULL)
        {
            $id_lst = 0;
        } else {
            $id_lst = $id->id;
        }
        
        $id_new                 = $id_lst + 1;
        $file                   = $request->file('file');
        $ekstensi_diperbolehkan = array('png','jpg','PNG','JPG');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $id_new.'.'.$ekstensi;
        // list($width, $height)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {           
                if ($file->move(public_path('../public/upload/SlideBanner'), $nama_file_unik))
                {
                    if($request->caption== NULL){
                        return redirect()->route('Slide_Banner')->with('alert','Caption can\'t be NULL ');
                    } else if($request->url == NULL) {
                        return redirect()->route('Slide_Banner')->with('alert','Url can\'t be NULL ');
                    } else {
                        $validator = Validator::make($request->all(),[
                            'caption' => 'required',
                            'url'   =>  'required',
                        ]);
                    
                        if ($validator->fails()) {
                            return back()->withErrors($validator->errors());
                        }
                        $slide_banner = SlideBanner::create([
                            'id'      => $id_new,
                            'caption' => $request->caption,
                            'url'     => $request->url,
                            'active'  => '1',
                            'image'   => $nama_file_unik
                        ]);
            
                        Log::create([
                            'operator_id' => Session::get('userId'),
                            'menu_id'     => '55',
                            'action_id'   => '3',
                            'date'        => Carbon::now('GMT+7'),
                            'description' => 'Create new Slide Banner with caption '. $slide_banner->caption
                        ]);
                        return redirect()->route('Slide_Banner')->with('success','Insert Data successfull');
                    }
                }
                else
                {
                    return redirect()->route('Slide_Banner')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {       
                return redirect()->route('Slide_Banner')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            return redirect()->route('Slide_Banner')->with('alert','Ekstensi file tidak di perbolehkan');
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
    public function update(Request $request)
    {
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        SlideBanner::where('id', '=', $pk)->update([
            $name => $value
        ]);
        switch ($name) {
            case 'caption':
                $name = 'Caption';
                break;
            case 'url':
                $name = 'Url';
                break;
            case 'active':
                $name = 'Active';
                break;            
            default:
                "";
        }

        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '55',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' Slide Banner Id '.$pk.' to '. $value
        ]);

        

    }

    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $id                     = SlideBanner::select('id')
                                  ->where('id', '=', $pk)
                                  ->first();

        $file                   = $request->file('file');
        $bcrypt                 = bcrypt($request->password);
        $ekstensi_diperbolehkan = array('png','jpg','PNG','JPG');
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
                if ($file->move(public_path('../public/upload/SlideBanner'), $nama_file_unik))
                {
                    SlideBanner::where('id', '=', $pk)->update([
                        'image' => $nama_file_unik
                    ]);

                    Log::create([
                        'op_id'     => Session::get('userId'),
                        'action_id' => '2',
                        'datetime'  => Carbon::now('GMT+7'),
                        'desc'      => 'Edit image in menu Slide Banner with ID '.$pk.' to '. $nama_file_unik
                    ]);
                    return redirect()->route('Slide_Banner')->with('success','Update Image successfull');
            
                }
                else
                {
                    return redirect()->route('Slide_Banner')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {   
                return redirect()->route('Slide_Banner')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {   
            return redirect()->route('Slide_Banner')->with('alert','Ekstensi file tidak di perbolehkan');
            // echo 'Ekstensi file tidak di perbolehkan';
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
        $slide_banner = SlideBanner::select('image')
                        ->where('id', '=', $id)
                        ->first();
        if($id != NULL)
        {
            DB::table('slide_banner')->where('id', '=', $id)->delete();
            $path = '../public/upload/SlideBanner/'.$slide_banner->image;
            File::delete($path);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Slide Banner with ID'.$id
            ]);
            return redirect()->route('Slide_Banner')->with('success','Data Deleted');
        }
        return redirect()->route('Slide_Banner')->with('success','Something wrong');
    }
}
