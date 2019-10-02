<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\ItemPoint;
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
        $mainmenu = MenuClass::menuName('Store');
        $itemGood = ItemPoint::select(
                        'item_id',
                        'name',
                        'price',
                        'qty',
                        'trans_type',
                        'status',
                        'order'
                    )
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
        return view('pages.store.goods_store', compact('menu', 'itemGood', 'endis', 'mainmenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = ItemPoint::select('item_id')
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
        $ekstensi_diperbolehkan = array('png');
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

                        $validator = Validator::make($request->all(),[
                            'title'            => 'required',
                            // 'transaction_type' => 'required|integer|between:1,8',
                            'price'            => 'required|integer',
                            'qty'              => 'required',
                            'order'            => 'required|integer|unique:item_point,order'
                        ]);
                    
                        if ($validator->fails()) {
                            return back()->withErrors($validator->errors());
                        }

                        $goods = ItemPoint::create([
                            'item_id'         => $id_new,
                            'name'       => $request->title,
                            // 'trans_type' => $request->transaction_type,
                            'price'      => $request->price,
                            'status'     => '1',
                            'qty'        => $request->qty
                        ]);
            
                        Log::create([
                            'op_id'     => Session::get('userId'),
                            'action_id' => '3',
                            'datetime'  => Carbon::now('GMT+7'),
                            'desc'      => 'Create new in menu Goods Store with name '. $goods->name
                        ]);
                        return redirect()->route('Goods_Store')->with('success','Insert Data successfull');
                    
                }
                else
                {
                    return redirect()->route('Goods_Store')->with('alert','Upload Image Failed');
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
            return redirect()->route('Goods_Store')->with('alert','Image must be in png');
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

        ItemPoint::where('item_id', '=', $pk)->update([
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
            case 'trans_type':
                $name = 'Transaction Type';
                break;
            case 'status':
                $name = 'Status';
                break;
            case 'order':
                $name = 'Order';
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
        $pk                     = $request->pk;
        $file                   = $request->file('file');
        $ekstensi_diperbolehkan = array('png');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $pk.'.'.$ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {
                if($file->move(public_path('../public/upload/Goods'), $nama_file_unik))
                {
    
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
            return redirect()->route('Goods_Store')->with('alert', 'Image Must Be png Format');
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
        $id    = $request->id;
        $goods = ItemPoint::where('item_id', '=', $id)->first();
        if($id != '')
        {
            ItemPoint::where('item_id', '=', $id)->delete();
            $path = '../public/upload/Goods/'.$goods->item_id.'.png';
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
