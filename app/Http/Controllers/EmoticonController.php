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

class EmoticonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('pages.item.emoticon', compact('emoticon', 'menu', 'mainmenu', 'endis'));
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
        $id                     = Emoticon::select('id')
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
                if ($file->move(public_path('../public/upload/emoticon'), $nama_file_unik))
                {
                    if($request->title == NULL){
                        return redirect()->route('Emoticon')->with('alert','Name can\'t be NULL ');
                    } else if($request->price == NULL) {
                        return redirect()->route('Emoticon')->with('alert','Price can\'t be NULL ');
                    } 
                    // else if($request->category == NULL) {
                    //     return redirect()->route('Emoticon')->with('alert','Category can\'t be NULL ');
                    // } 
                    else {

                        $validator = Validator::make($request->all(),[
                            'title'    => 'required',
                            'price'    => 'required|integer',
                            // 'category' => 'required|integer|between:1,3',
                        ]);

                        if ($validator->fails()) {
                            return back()->withErrors($validator->errors());
                        }


                        $gift = Emoticon::create([
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
                            'desc'      => 'Create new in menu Emoticon with title '. $gift->subject
                        ]);
                        return redirect()->route('Emoticon')->with('success','Insert Data successfull');
                    }
                }
                else
                {
                    return redirect()->route('Emoticon')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {
                return redirect()->route('Emoticon')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Emoticon')->with('alert','Ekstensi file tidak di perbolehkan');
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

    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $id                     = Emoticon::where('id', '=', $pk)
                                  ->first();
        $imageversion           = $id->img_ver + 1;
        $file                   = $request->file('file');
        $ekstensi_diperbolehkan = array('jpg');
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
                if ($file->move(public_path('../public/upload/emoticon'), $nama_file_unik))
                {
                    Emoticon::where('id', '=', $pk)->update([
                        'img_ver' =>  $imageversion 
                    ]);

                    Log::create([
                        'op_id'     => Session::get('userId'),
                        'action_id' => '2',
                        'datetime'  => Carbon::now('GMT+7'),
                        'desc'      => 'Edit image in menu Emoticon Store with ID '.$pk.' to '. $nama_file_unik
                    ]);
                    return redirect()->route('Emoticon')->with('success','Update Image successfull');

                }
                else
                {
                    return redirect()->route('Emoticon')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {
                return redirect()->route('Emoticon')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Emoticon')->with('alert','Ekstensi file tidak di perbolehkan');
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
              $name = "Name";
              break;
          case "price":
              $name = "Price";
              break;
          case "status":
              $name = "Status";
              break;
          default:
            "";
      }


      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu Emoticon with Id '.$pk.' to '. $value
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
        $gifts = Emoticon::select('id')
                 ->where('id', '=', $id)
                 ->first();
        if($id != '')
        {
            Emoticon::where('id', '=', $id)->delete();
            $path = '../public/upload/emoticon/'.$gifts->id.'.jpg';
            File::delete($path);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Emoticon with ID '.$id
            ]);

            return redirect()->route('Emoticon')->with('success','Data Deleted');
        }
        return redirect()->route('Emoticon')->with('success','Something wrong');
    }
}
