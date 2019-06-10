<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use Session;
use Carbon\Carbon;
use DB;

// Log Model
use App\Log;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu  = MenuClass::menuName('General Settings');
        // system settings
        $getMaintenance     = DB::table('config')->where('id', '=', '101')->first();
        $getPointExpired    = DB::table('config')->where('id', '=', '102')->first();

        // Bank Settings
        $getBank            = DB::table('config')->where('id', '=', '201')->first();

        // Info Settings
        $getPrivacyPolicy   = DB::table('config')->where('id', '=', '2')->first();
        $getTermOfService   = DB::table('config')->where('id', '=', '3')->first();
        $getAbout           = DB::table('config')->where('id', '=', '4')->first();
        $getPokerWeb        = DB::table('config')->where('id', '=', '5')->first();

        // CS & Legal Settings
        $getFb              = DB::table('config')->where('id', '=', '901')->first();
        $getTwitter         = DB::table('config')->where('id', '=', '902')->first();
        $getIg              = DB::table('config')->where('id', '=', '903')->first();

        return view('pages.settings.general_setting', compact('getMaintenance', 'getPointExpired', 'getFb', 
                                                                'getTwitter', 'getIg', 'getPrivacyPolicy', 'getTermOfService',
                                                                'getAbout', 'getPokerWeb', "getBank", 'menu'));
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
    public function update(Request $request)
    {
        $pk    = $request->pk; //get data-pk
        $name  = $request->name; //get data-name
        $value = $request->value; //get data-value

        DB::table('config')->where('id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "value":
                $name = "Value";
                break;
            default:
              "";
        }


        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '75',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' General Setting with Config Id '.$pk.' to '. $value
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
