<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\ItemGoods;
use App\Log;
use Session;
use DB;
use File;
use Carbon\Carbon;
use Validator;
use App\ConfigText;

class GoodsStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('Gold Store');
        $itemGood = ItemGoods::where('shop_type', '=', 1)->get();
        $active   = ConfigText::where('id', '=', 4)->first();
        $value    = str_replace(':', ',', $active->value);
        $endis    = explode(",", $value);
        return view('pages.store.goods_store', compact('menu', 'itemGood', 'endis'));
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
        $id = ItemGoods::where('shop_type', '=', '1')->orderBy('id', 'desc')->first();



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
                if ($file->move(public_path('../public/upload/Goods'), $nama_file_unik))
                {
                    if($request->title== NULL){
                        return redirect()->route('Goods_Store')->with('alert','Title can\'t be NULL ');
                    } else if($request->transaction_type == NULL) {
                        return redirect()->route('Goods_Store')->with('alert','Transaction Type can\'t be NULL ');
                    } else if ($request->price == NULL) {
                        return redirect()->route('Goods_Store')->with('alert','Price can\'t be NULL ');
                    } else if($request->google_key == NULL) {
                        return redirect()->route('Goods_Store')->with('alert','Google Key can\'t be NULL ');
                    } else if($request->qty == NULL) {
                        return redirect()->route('Goods_Store')->with('alert','Quantity can\'t be NULL ');
                    } else {

                        $validator = Validator::make($request->all(),[
                            'title'            => 'required',
                            'transaction_type' => 'required|integer|between:1,8',
                            'price'            => 'required|integer',
                            'google_key'       => 'required',
                            'qty'              => 'required',
                        ]);
                    
                        if ($validator->fails()) {
                            return back()->withErrors($validator->errors());
                        }

                        $goods = ItemGoods::create([
                            'id'               => $id_new,
                            'name'             => $request->title,
                            'transaction_type' => $request->transaction_type,
                            'storeId'          => '1',
                            'price'            => $request->price,
                            'active'           => '1',
                            'shop_type'        => '1',
                            'google_key'       => $request->google_key,
                            'image'            => $nama_file_unik,
                            'qty'              => $request->qty
                        ]);
            
                        Log::create([
                            'op_id'     => Session::get('userId'),
                            'action_id' => '3',
                            'datetime'  => Carbon::now('GMT+7'),
                            'desc'      => 'Create new in menu Goods Store with name '. $goods->name
                        ]);
                        return redirect()->route('Goods_Store')->with('success','Insert Data successfull');
                    }
                }
                else
                {
                    return redirect()->route('Goods_Store')->with('alert','Gagal Upload File');
                    // echo "Gagal Upload File";
                }
            }
            else
            {       
                return redirect()->route('Goods_Store')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            return redirect()->route('Goods_Store')->with('alert','Ekstensi file tidak di perbolehkan');
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

        ItemGoods::where('id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case 'name':
                $name = 'Name';
                break;
            case 'price':
                $name = 'Price';
                break;
            case 'qty':
                $name = 'Quantity';
                break;
            case 'transaction_type':
                $name = 'Transaction Type';
                break;
            case 'google_key':
                $name = 'Google Key';
                break;
            case 'active':
                $name = 'Active';
                break;
            
            default:
                "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.'in menu Goods Store with ID '.$pk.' to '.$value
        ]);
    }

    public function updateimage(Request $request)
    {
        $pk =   $request->pk;
        $id =   ItemGoods::where('id', '=', $pk)->where('shop_type', '=', 1)->first();
        $file = $request->file('file');
        $ekstensi_diperbolehkan = array('png', 'jpg', 'PNG', 'JPG');
        $nama = $_FILES['file']['name'];
        $x  = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $filename = $id->id;
        $nama_file_unik = $filename.'.'.$ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {
                if($file->move(public_path('../public/upload/Goods'), $nama_file_unik))
                {
                    ItemGoods::where('id', '=', $pk)->update([
                        'image' =>  $nama_file_unik
                    ]);
    
                    Log::create([
                        'op_id'     => Session::get('userId'),
                        'action_id' => '2',
                        'datetime'  => Carbon::now('GMT+7'),
                        'desc'      => 'Edit Image in menu Goods Store with ID '.$pk.' to '.$nama_file_unik
                    ]);
                    return redirect()->route('Goods_Store')->with('success','Update Image successfull');
                }
                else 
                {
                    return redirect()->route('Goods_Store')->with('alert','Gagal Upload File');
                }

            }
            else 
            {
                return redirect()->route('Goods_Store')->with('alert','Ukuran file terlalu besar');
            }
        }
        else 
        {
            return redirect()->route('Goods_Store')->with('alert','Ekstensi file tidak di perbolehkan');
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
        $goods = ItemGoods::where('id', '=', $id)->first();
        if($id != '')
        {
            ItemGoods::where('id', '=', $id)->delete();
            $path = '../public/upload/Goods/'.$goods->image;
            File::delete($path);            
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Goods Store with ID '.$id
            ]);

            return redirect()->route('Goods_Store')->with('success','Data Deleted');
        }
        return redirect()->route('Goods_Store')->with('success','Something wrong');  
    }
}
