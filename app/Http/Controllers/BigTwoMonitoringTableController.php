<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BigTwoTable;
use App\BigTwoPlayer;
use Session;

class BigTwoMonitoringTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checked = $request->checkauto;
        // dd($checked);


        // room Novice / Pemula
        $onlineinvoice = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                         ->where('room_id', '=', 1)
                         ->get();

        $bgtPlayersnovice = BigTwoTable::where('room_id', '=', 1)
                             ->paginate(20);
                             
        $bgtPlayersnovice->appends($request->all());

        //  room untuk Intermedite / Menengah
        $onlineintermediate = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                              ->where('room_id', '=', 2)
                              ->get();

        //  room untuk Pro / Ahli
        $onlinepro = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                              ->where('room_id', '=', 3)
                              ->get();

        $bgtPlayersPro = BigTwoTable::where('room_id', '=', 3)
                         ->paginate(20);

        $bgtPlayersPro->appends($request->all());

        // all online
        $onlinebgt = BigTwoPlayer::all();


        return view('pages.game_asta.big_two.monitoring_table_big_two.bigtwotable', compact('checked', 'bgtPlayersnovice', 'onlineinvoice', 'onlineintermediate', 'onlinepro', 'onlinebgt'));
    }

    public function indexIntermediate(Request $request)
    {

        $checked = $request->checkauto;


        // room Novice / Pemula
        $onlineinvoice = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                         ->where('room_id', '=', 1)
                         ->get();

        //  room untuk Intermedite / Menengah
        $onlineintermediate = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                              ->where('room_id', '=', 2)
                              ->get();

        $bgtPlayersintermediate = BigTwoTable::where('room_id', '=', 2)
                                  ->paginate(20);

        $bgtPlayersintermediate->appends($request->all());

        //  room untuk Pro / Ahli
        $onlinepro = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                              ->where('room_id', '=', 3)
                              ->get();


        // all online
        $onlinebgt = BigTwoPlayer::all();


        return view('pages.game_asta.big_two.monitoring_table_big_two.bigtwotable', compact('checked', 'bgtPlayersintermediate', 'onlineinvoice', 'onlineintermediate', 'onlinepro', 'onlinebgt'));
    }

    public function indexPro(Request $request)
    {
        $checked = $request->checkauto;
      

        // room Novice / Pemula
        $onlineinvoice = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                         ->where('room_id', '=', 1)
                         ->get();

        //  room untuk Intermedite / Menengah
        $onlineintermediate = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                              ->where('room_id', '=', 2)
                              ->get();

        //  room untuk Pro / Ahli
        $onlinepro = BigTwoPlayer::join('bgt_table', 'bgt_table.table_id', '=', 'bgt_player.table_id')
                              ->where('room_id', '=', 3)
                              ->get();
        
        $bgtPlayersPro = BigTwoTable::where('room_id', '=', 3)
                         ->paginate(20);

        $bgtPlayersPro->appends($request->all());


        // all online
        $onlinebgt = BigTwoPlayer::all();


        return view('pages.game_asta.big_two.monitoring_table_big_two.bigtwotable', compact('checked', 'bgtPlayersPro', 'onlineinvoice', 'onlineintermediate', 'onlinepro', 'onlinebgt'));
    }

    public function Game(Request $request)
    {
        $idtable    =   $request->id_table;
        $name_table =   $request->name_tables;

        $username   =   Session::get('username');
        $operator   =   DB::table('operator')->where('op_id', '=', Session::get('userId'))->first();
        $password   =   $operator->userpass;

        return view('pages.game_asta.big_two.monitoring_table_big_two.game_bigtwo', compact('idtable', 'name_table', 'username', 'password'));        
    }
}
