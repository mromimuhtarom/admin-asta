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
use App\Classes\MenuClass;

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
        // ****End Asta Poker ****//

        // ****Big Two ****//
        $bgt   = BgtConfig::all();
        // ****End Big Two ****//

        // ****Domino Susun ****//
        $dms   = DmsConfig::all();
        // ****End Domino Susun ****//

        // ****Domino QQ ****//
        $dmq   = DmqConfig::all();
        // ****End Domino QQ ****//
        
        $menu     = MenuClass::menuName('Game Setting');
        $mainmenu = MenuClass::menuName('Games');
        return view('pages.game_asta.game_setting', compact('tpk', 'bgt', 'dms', 'dmq', 'mainmenu', 'menu'));
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
            'desc'      => 'Edit Setting Asta Poker in menu Game Setting with ID '.$pk.' to '. $value
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
            'desc'  =>  'Edit Setting Asta Big Two in menu Game Setting with ID '.$pk.' to '.$value  
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
            'desc'      =>  'Edit Pengaturan Domino Susun di menu Pengaturan Game dengan ID '.$pk.' menjadi '.$value
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
            'desc'      =>  'Edit pengaturan Domino QQ di menu Pengaturan Game dengan ID '.$pk.' menjadi '.$value
        ]);
    }
}
