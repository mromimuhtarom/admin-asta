<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DominoSusunTable;
use Session;
use App\DominoSPlayer;

class DominoSusunMonitoringTableController extends Controller
{
    
    public function index(Request $request)
    {
        $checked            =   $request->checkauto;
        
        //room Novice
        $onlinenovice       =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                ->where('room_id', '=', 1)
                                ->get();

        $dmsPlayersNovice    =   DominoSusunTable::where('room_id', '=', 1)
                                ->paginate(20);

        $dmsPlayersNovice->appends($request->all());

        //room intermediate
        $onlineintermediate =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                ->where('room_id', '=', 2)
                                ->get();

        $onlinepro          =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                ->where('room_id', '=', 3)
                                ->get();
        
        $dmsPlayersPro      =   DominoSusunTable::where('room_id', '=', 3)
                                ->paginate(20);

        $dmsPlayersPro->appends($request->all());
        
        //all online
        $onlinedms  =   DominoSPlayer::all();

        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusun', compact('checked', 'dmsPlayersNovice', 'onlinenovice', 'onlineintermediate', 'onlinepro', 'onlinedms'));
    }

    public function indexIntermediate(Request $request)
    {
        $checked                =   $request->checkauto;

        //room Novice
        $onlinenovice           =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                ->where('room_id', '=', 1)
                                ->get();

        $onlineintermediate     =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                ->where('room_id', '=', 2)
                                ->get();
        
        $dmsPlayersintermediate =   DominoSusunTable::where('room_id', '=', 2)
                                    ->paginate(20);

        $dmsPlayersintermediate->appends($request->all());

        //room Pro
        $onlinepro              =   DominoSPlayer::all();

        //all online
        $onlinedms              =   DominoSPlayer::all();

        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusun', compact('checked', 'dmsPlayersintermediate', 'onlinenovice', 'onlineintermediate', 'onlinepro', 'onlinedms'));
    }

    public function indexPro(Request $request)
    {
        $checked            =   $request->checkauto;

        //room Novice
        $onlinenovice       =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                            ->where('room_id', '=', 1)
                                            ->get();

        //room Intermediate
        $onlineintermediate =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_player.table_id')
                                                ->where('room_id', '=', 2)
                                                ->get();

        //room Pro
        $onlinepro          =   DominoSPlayer::join('dms_table', 'dms_table.table_id', '=', 'dms_table.table_id')
                                ->where('room_id', '=', 3)
                                ->paginate(20);
    
        $dmsPlayersPro      =   DominoSusunTable::where('room_id', '=', 3)
                                ->paginate(20);

        $dmsPlayersPro->appends($request->all());

        //all online
        $onlinedms          =   DominoSPlayer::all();

        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusun', compact('checked', 'dmsPlayersPro', 'onlinenovice', 'onlineintermediate', 'onlinepro', 'onlinedms'));
    }

    public function Game(Request $request)
    {
        $idtable    =   $request->id_table;

        $username   =   Session::get('username');
        $operator   =   DB::table('operator')->where('op_id', '=', Session::get('userId'))->first();
        $password   =   $operator->userpass;

        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.game_dominosusun', compact('idtable', 'username', 'password'));
    }

}
