<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TpkConfig;
use App\BgtConfig;
use App\DmqConfig;
use App\DmsConfig;
use App\Log;
use Carbon\Carbon;
use Session;

class GameSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ****Asta Poker ***//
        $tpk   = TpkConfig::all();
        // $betpointtpk = TpkConfig::wheere('id', '=', 2)->first();
        // ****End Asta Poker ****//
        // ****Big Two ****//
        $bgt   = BgtConfig::all();
        // $betpointbgt = BgtConfig::wheere('id', '=', 2)->first();
        // ****End Big Two ****//
        // ****Domino Susun ****//
        $dms   = DmsConfig::all();
        // $betpointdms = DmsConfig::wheere('id', '=', 2)->first();
        // ****End Domino Susun ****//
        // ****Domino QQ ****//
        $dmq   = DmqConfig::all();
        // $betpointdmq = DmqConfig::wheere('id', '=', 2)->first();
        // ****End Domino QQ ****//
        return view('pages.game_asta.game_setting', compact('tpk', 'bgt', 'dms', 'dmq'));
    }

    public function updateTpk(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        TpkConfig::where('id', '=', $pk)->update([
            $name => $value
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => 2,
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit Asta Poker of Setting in menu Game Setting with ID '.$pk.' to '. $value
        ]);

    }

    public function updateBgt(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        BgtConfig::where('id', '=', $pk)->update([
            $name   =>  $value
        ]);

        Log::create([
            'op_id' =>  Session::get('userId'),
            'action_id' =>  2,
            'datetime'  => Carbon::now('GMT+7'),
            'desc'  =>  'Edit Asta Big Two of setting in menu Game Setting with ID '.$pk.' to '.$value  
        ]);
    }

    public function updateDms(Request $request)
    {
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        DmsConfig::where('id', '=', $pk)->update([
            $name => $value
        ]);

        Log::create([
            'op_id' =>  Session::get('userId'),
            'action_id' =>  2,
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit Domino Susun of Setting in menu Game Setting with ID '.$pk.' to '.$value
        ]);
    }

    public function updateDmq(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        DmqConfig::where('id', '=', $pk)->update([
            $name   =>  $value
        ]);

        Log::create([
            'op_id' =>  Session::get('userId'),
            'action_id' =>  2,
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit Domino QQ of Setting in menu Game Setting with ID '.$pk.' to '.$value
        ]);
    }
}
