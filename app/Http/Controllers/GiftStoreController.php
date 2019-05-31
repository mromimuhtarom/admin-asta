<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gift;
use App\Log;
use Session;
use Carbon\Carbon;
use DB;
use App\Classes\MenuClass;

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
        return view('pages.store.Gift', compact('gifts', 'menu'));
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
        //
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
        $pk = $request->pk;
        $id = DB::table('gifts')->where('id', '=', $pk)->first();
        $file = $request->file('file');
        $bcrypt = bcrypt($request->password);
        $ekstensi_diperbolehkan = array('png','jpg','PNG','JPG');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $filename           = $id->id;
        $nama_file_unik = $filename.'.'.$ekstensi; 

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {           
                if ($file->move(public_path('../public/images/gifts'), $nama_file_unik))
                {
                    Gift::where('id', '=', $pk)->update([
                        'imageUrl' => $nama_file_unik
                    ]);
                    return redirect()->route('GiftStore-view')->with('success','Update Image successfull');
            
                }
                else
                {
                    echo "Gagal Upload File";
                }
            }
            else
            {       
                echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            echo 'Ekstensi file tidak di perbolehkan';
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
        'menu_id'     => '19',
        'action_id'   => '2',
        'date'        => Carbon::now('GMT+7'),
        'description' => 'Edit '.$name.' Gift Id '.$pk.' to '. $value
      ]);
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
