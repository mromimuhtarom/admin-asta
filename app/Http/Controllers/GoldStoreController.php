<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsCash;
use Illuminate\Support\Facades\DB;
use App\Classes\MenuClass;
use App\Log;
use Carbon\Carbon;
use Session;
use Validator;
use App\ConfigText;

class GoldStoreController extends Controller
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
        $getGolds = ItemsCash::select(
                        'item_id',
                        'name',
                        'item_get',
                        'item_type',
                        'price',
                        'trans_type',
                        'google_key',
                        'status',
                        'shop_type'
                    )
                    ->where('shop_type', '=', 1)
                    ->orderBy('item_id', 'desc')
                    ->get();
        $active   = ConfigText::select(
                        'name', 
                        'value'
                    )
                    ->where('id', '=', 4)
                    ->first();
        $value    = str_replace(':', ',', $active->value);
        $endis    = explode(",", $value);


        return view('pages.store.gold_store', compact('menu', 'getGolds', 'endis', 'mainmenu'));
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
        $title          = $request->title;
        $goldAwarded    = $request->goldAwarded;
        $priceCash      = $request->priceCash;
        $googleKey      = $request->googleKey;

        $validator = Validator::make($request->all(),[
            'title'       => 'required',
            'goldAwarded' => 'required|integer',
            'priceCash'   => 'required|integer',
            'googleKey'   => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $gold = ItemsCash::create([
            'name'       => $title,
            'item_get'   => $goldAwarded,
            'price'      => $priceCash,
            'shop_type'  => 1,
            'item_type'  => 2,
            'status'     => 0,
            'google_key' => $googleKey,
        ]);

        Log::create([
            'op_id' => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Gold Store with title '. $gold->name
        ]);

        return redirect()->route('Gold_Store')->with('success','Data Added');
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
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        ItemsCash::where('item_id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "name":
                $name = "Name";
                break;
            case "item_get":
                $name = "Gold Awarded";
                break;
            case "price":
                $name = "Price Cash";
                break;
            case "shop_type":
                $name = "Shop Type";
                break;
            case "google_key":
                $name = "Google Key";
                break;
            case "status":
                $name = "Status";
                break;
            case "trans_type":
                $name = "Pay Transaction";
                break;
            default:
            "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' in menu Gold Store with ID '.$pk.' to '. $value
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
        $getGoldId    = $request->userid;
        $goldreseller = $request->id;
        if($getGoldId != '')
        {
            ItemsCash::where('item_id', '=', $getGoldId)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Gift Store with ID '.$getGoldId
            ]);
            return redirect()->route('Gold_Store')->with('success','Data Deleted');
        } else if($goldreseller != '') 
        {
            ItemsCash::where('item_id', '=', $goldreseller)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Gift Store Reseller with ID '.$goldreseller
            ]);
            return redirect()->route('Gold_Store_Reseller')->with('success','Data Deleted');
        } else if ($getGoldId == NULL)
        {
            return redirect()->route('Gold_Store')->with('alert','ID must be Fill');  
        } else if($goldreseller == NULL )
        {
            return redirect()->route('Gold_Store_Reseller')->with('alert','ID must be Fill'); 
        }
        
    }
}
