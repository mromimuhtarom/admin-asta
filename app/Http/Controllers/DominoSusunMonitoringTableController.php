<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DominoSusunTable;

class DominoSusunMonitoringTableController extends Controller
{
    
    public function index()
    {
        $table              =   DominoSusunTable::where('room_id', '=', 1)->get();
        $dmsPlayerNovice    =   DominoSusunTable::join('asta_db.dms_player', 'asta_db.dms_player.table_id', '=', 'asta_db.dms_table.table_id')
                                ->where('room_id', '=', 1)
                                ->get();

        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusun', compact('table', 'dmsPlayerNovice'));
    }

    public function Game(Request $request)
    {
        $idtable    =   $request->id_table;
        $name_table =   $request->name_table;

        $username   =   Session::get('username');
        $operator   =   DB::table('operator')->where('op_id', '=', Session::get('userId'))->first();
        $password   =   $operator->userpass;

        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.game_dominosusun', compact('idtable', 'name_table', 'username', 'password'));
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
