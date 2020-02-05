<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DominoQTable;

class DominoQQMonitoringTableController extends Controller
{
    
    public function index()
    {
        $table                  = DominoQTable::where('room_id', '=', 1)->get();
        $dominoQPlayerNovice    = DominoQTable::join('asta_db.dmq_player', 'asta_db.dmq_player.table_id', '=', 'asta_db.dmq_table.table_id')
                                    ->where('room_id', '=', 1)
                                    ->get();

        return view('pages.game_asta.domino_qq.monitoring_table_dominoqq.dominoqqtable', compact('table', 'dominoQPlayerNovice'));
    }

    public function Game(Request $request)
    {
        $idtable    =   $request->id_table;
        $name_table =   $request->name_table;

        $username   =   Session::get('username');
        $operator   =   DB::table('operator')->where('op_id', '=', Session::get('userId'))->first();
        $password   =   $operator->userpass;

        return view('pages.game_asta.domino_qq.monitoring_table_dominoqq.dominoqqtable', compact('idtable', 'name_table', 'username', 'password'));
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
