<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TpkTable;

class AstaPokerMonitoringTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table      = TpkTable::where('room_id', '=', 2)->get();
        $tpkPlayers = TpkTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                      ->where('room_id', '=', 2)
                      ->get();
        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.novice', compact('table', 'tpkPlayers'));
    }

    public function IntermadiateIndex()
    {
        $table      = TpkTable::where('room_id', '=', 4)->get();
        $tpkPlayers = TpkTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                      ->where('room_id', '=', 4)
                      ->get();
        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.intermediate', compact('table', 'tpkPlayers'));        
    }

    public function ProIndex()
    {
        $table      = TpkTable::where('room_id', '=', 4)->get();
        $tpkPlayers = TpkTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                      ->where('room_id', '=', 4)
                      ->get();
        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.pro', compact('table', 'tpkPlayers'));                
    }


    public function Game(Request $request)
    {
        $idtable    = $request->id_table;
        $name_table = $request->name_table;

        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.game_asta_poker', compact('idtable', 'name_table'));
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
    public function update(Request $request, $id)
    {
        //
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
