<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsGold;
use Illuminate\Support\Facades\DB;
use App\Classes\MenuClass;
use App\Log;
use Carbon\Carbon;
use Session;
use Validator;

class GoldStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu  = MenuClass::menuName('Gold Store');        
        $getGolds = DB::table('items_cash')->where('shop_type', '=', 1)->orderBy('id', 'desc')->get();

        return view('pages.store.gold_store', compact('menu', 'getGolds'));
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
            'title'    => 'required',
            'goldAwarded'    => 'required|integer',
            'priceCash' => 'required|integer',
            'googleKey' =>  'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $gold = DB::table('items_cash')->insert([
            'name'          => $title,
            'goldAwarded'   => $goldAwarded,
            'price'         => $priceCash,
            'google_key'    => $googleKey,
        ]);

        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '57',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Gold Store with title '. $gold->name
        ]);

        return redirect()->route('GoldStore-view')->with('success','Data Added');
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
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        DB::table('items_cash')->where('id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "name":
                $name = "Name";
                break;
            case "goldAwarded":
                $name = "Gold Awarded";
                break;
            case "price":
                $name = "Price";
                break;
            case "shop_type":
                $name = "Shop Type";
                break;
            case "google_key":
                $name = "Google Key";
                break;
            case "active":
                $name = "Active";
                break;
            default:
            "";
        }

        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '57',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' gameID '.$pk.' to '. $value
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
        $getGoldId = $request->userid;
        if($getGoldId != '')
        {
            DB::table('items_cash')->where('id', '=', $getGoldId)->delete();
            return redirect()->route('GoldStore-view')->with('success','Data Deleted');
        }
        return redirect()->route('GoldStore-view')->with('success','Something wrong');  
    }
}
