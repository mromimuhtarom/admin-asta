<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gift;
use App\Log;
use Session;
use Carbon\Carbon;
use DB;
use File;
use App\Classes\MenuClass;
use Validator;

class GiftStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::all();
        $menu  = MenuClass::menuName('Gift');
        return view('pages.store.Gift', compact('gifts', 'menu', 'dbgift'));
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
        $id                     = DB::table('gift')->orderBy('id', 'desc')->first();
        // $id_last                = $id->id;
        if($id === NULL )
        {
            $id_last = 0;
        } else {
            $id_last = $id->id;
        }
        $id_new                 = $id_last + 1;
        $file                   = $request->file('file');
        $ekstensi_diperbolehkan = array('png','jpg','PNG','JPG');
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
                if ($file->move(public_path('../public/images/gifts'), $nama_file_unik))
                {
                    if($request->title == NULL){
                        return redirect()->route('GiftStore-view')->with('alert','Name can\'t be NULL ');
                    } else if($request->price == NULL) {
                        return redirect()->route('GiftStore-view')->with('alert','Price can\'t be NULL ');
                    } else if($request->category == NULL) {
                        return redirect()->route('GiftStore-view')->with('alert','Category can\'t be NULL ');
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
                            'image_url'   => $nama_file_unik
                        ]);
            
                        Log::create([
                            'operator_id' => Session::get('userId'),
                            'menu_id'     => '69',
                            'action_id'   => '3',
                            'date'        => Carbon::now('GMT+7'),
                            'description' => 'Create new Gift Store with title '. $gift->subject
                        ]);
                        return redirect()->route('GiftStore-view')->with('success','Insert Data successfull');
                    }
                }
                else
                {
                    return redirect()->route('GiftStore-view')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {       
                return redirect()->route('GiftStore-view')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            return redirect()->route('GiftStore-view')->with('alert','Ekstensi file tidak di perbolehkan');
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


    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $id                     = DB::table('gifts')->where('id', '=', $pk)->first();
        $file                   = $request->file('file');
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
                if ($file->move(public_path('../public/images/gifts'), $nama_file_unik))
                {
                    Gift::where('id', '=', $pk)->update([
                        'image_url' => $nama_file_unik
                    ]);

                    Log::create([
                        'operator_id' => Session::get('userId'),
                        'menu_id'     => '69',
                        'action_id'   => '2',
                        'date'        => Carbon::now('GMT+7'),
                        'description' => 'Edit image_url Gift Store ID '.$pk.' to '. $nama_file_unik
                    ]);
                    return redirect()->route('GiftStore-view')->with('success','Update Image successfull');
            
                }
                else
                {
                    return redirect()->route('GiftStore-view')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {   
                return redirect()->route('GiftStore-view')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {   
            return redirect()->route('GiftStore-view')->with('alert','Ekstensi file tidak di perbolehkan');
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
        'operator_id' => Session::get('userId'),
        'menu_id'     => '69',
        'action_id'   => '2',
        'date'        => Carbon::now('GMT+7'),
        'description' => 'Edit '.$name.' Gift Store Id '.$pk.' to '. $value
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
        $gifts = Gift::where('id', '=', $id)->first();
        if($id != '')
        {
            DB::table('gift')->where('id', '=', $id)->delete();
            $path = '../public/images/gifts/'.$gifts->image_url;
            File::delete($path);            
            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '69',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Gift Store ID '.$id
            ]);

            return redirect()->route('GiftStore-view')->with('success','Data Deleted');
        }
        return redirect()->route('GiftStore-view')->with('success','Something wrong');   
    }
}
