<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DominoQTable;
use Session;
use App\DominoQPlayer;


class DominoQQMonitoringTableController extends Controller
{
    
    public function index(Request $request)
    {
        $checked                =   $request->checkauto;

        // $table                  = DominoQTable::where('room_id', '=', 1)->get();
        //room Novice / Pemula
        $onlinenovice    = DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                    ->where('room_id', '=', 1)
                                    ->get();

        $dmqPlayersNovice = DominoQTable::where('room_id', '=', 1)
                            ->paginate(20);
                

        $dmqPlayersNovice->appends($request->all());

        //room Intermediate / Menengah
        $onlineintermediate =   DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                ->where('room_id', '=', 2)
                                ->get();

        //room Pro / Ahli
        $onlinepro  =   DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                        ->where('room_id', '=', 3)
                        ->get();
        
        $dmqPlayersPro  =   DominoQTable::where('room_id', '=', 3)
                            ->paginate(20);
        $dmqPlayersPro->appends($request->all());

        //all online
        $onlinedmq  =   DominoQPlayer::all();
        
        return view('pages.game_asta.domino_qq.monitoring_table_dominoqq.dominoqqtable', compact('checked', 'dmqPlayersNovice', 'onlinenovice', 'onlineintermediate', 'onlinepro', 'onlinedmq'));
    }

    public function indexIntermediate(Request $request)
    {
        $checked    =   $request->checkauto;

        //room Novice / Pemula
        $onlinenovice   =   DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                            ->where('room_id', '=', 1)
                            ->get();

        //room Intermediate / Menengah
        $onlineintermediate =   DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                ->where('room_id', '=', 2)
                                ->get();
        
        $dmqPlayersintermediate =   DominoQTable::where('room_id', '=', 2)
                                    ->paginate(20);

        $dmqPlayersintermediate->appends($request->all());

        //room Pro
        $onlinepro = DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                    ->where('room_id', '=', 3)
                                    ->get();

        // all online
        $onlinedmq  =   DominoQPlayer::all();

        return view('pages.game_asta.domino_qq.monitoring_table_dominoqq.dominoqqtable', compact('checked', 'table', 'dmqPlayersintermediate', 'onlinenovice', 'onlineintermediate', 'onlinepro', 'onlinedmq'));
    }

    public function indexPro(Request $request)
    {
        $checked = $request->checkauto;

        //room Novice
        $onlinenovice = DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                        ->where('room_id', '=', 1)
                                        ->get();
        //room Intermediate
        $onlineintermediate = DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                                ->where('room_id', '=', 2)
                                                ->get();

        //room Pro
        $onlinepro  =   DominoQPlayer::join('dmq_table', 'dmq_table.table_id', '=', 'dmq_player.table_id')
                                        ->where('room_id', '=', 3)
                                        ->get();

        $dmqPlayersPro  =   DominoQTable::where('room_id', '=', 3)
                            ->paginate(20);

        $dmqPlayersPro->appends($request->all());

        //all online
        $onlinedmq  =   DominoQPlayer::all();

        return view('pages.game_asta.domino_qq.monitoring_table_dominoqq.dominoqqtable', compact('checked', 'table', 'dmqPlayersPro', 'onlinenovice', 'onlineintermediate', 'onlinepro', 'onlinedmq'));
    }

    public function Game(Request $request)
    {
        $idtable    =   $request->id_table;

        $username   =   Session::get('username');
        $operator   =   DB::table('operator')->where('op_id', '=', Session::get('userId'))->first();
        $password   =   $operator->userpass;

        return view('pages.game_asta.domino_qq.monitoring_table_dominoqq.games_dominoqq', compact('idtable', 'username', 'password'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
