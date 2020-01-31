<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BigTwoTable;

class BigTwoMonitoringTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table      = BigTwoTable::where('room_id', '=', 1)->get();
        $tpkPlayers = BigTwoTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                      ->where('room_id', '=', 1)
                      ->get();
        return view('pages.game_asta.big_two.monitoring_table_asta_poker.novice', compact('table', 'tpkPlayers'));
    }

    public function IntermadiateIndex()
    {
        $table      = BigTwoTable::where('room_id', '=', 2)->get();
        $tpkPlayers = BigTwoTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                      ->where('room_id', '=', 2)
                      ->get();
        return view('pages.game_asta.big_two.monitoring_table_asta_poker.intermediate', compact('table', 'tpkPlayers'));        
    }

    public function ProIndex()
    {
        $table      = BigTwoTable::where('room_id', '=', 3)->get();
        $tpkPlayers = BigTwoTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                      ->where('room_id', '=', 3)
                      ->get();
        return view('pages.game_asta.big_two.monitoring_table_asta_poker.pro', compact('table', 'tpkPlayers'));                
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
