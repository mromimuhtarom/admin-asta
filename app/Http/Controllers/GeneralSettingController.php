<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use Session;
use Carbon\Carbon;
use App\Config;
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
        $menu  = MenuClass::menuName('General Setting');
        // system settings
        $getMaintenance     = Config::where('id', '=', '101')->first();
        $getPointExpired    = Config::where('id', '=', '102')->first();

        // Bank Settings
        $getBank            = Config::where('id', '=', '201')->first();

        // Info Settings
        $getPrivacyPolicy   = Config::where('id', '=', '2')->first();
        $getTermOfService   = Config::where('id', '=', '3')->first();
        $getAbout           = Config::where('id', '=', '4')->first();
        $getPokerWeb        = Config::where('id', '=', '5')->first();

        // CS & Legal Settings
        $getFb              = Config::where('id', '=', '901')->first();
        $getTwitter         = Config::where('id', '=', '902')->first();
        $getIg              = Config::where('id', '=', '903')->first();

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

        Config::where('id', '=', $pk)->update([
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
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' in menu General Setting with Config Id '.$pk.' to '. $value
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
