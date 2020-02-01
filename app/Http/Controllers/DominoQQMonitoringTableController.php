<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DominoQTable;

class DominoQQMonitoringTableController extends Controller
{
    
    public function index()
    {
        $table = DominoQTable::where('room_id', '=', 1)->get();
        return view('pages.game_asta.domino_qq.monitoring_table_dominoQ.dominoQQNovice', compact('table'));
    }

    public function indexIntermediate()
    {
        $table = DominoQTable::where('room_id', '=', 2)->get();
        return view('pages.game_asta.domino_qq.monitoring_table_dominoQ.dominoQQIntermediate', compact('table'));
    }

    public function indexPro()
    {
        $table = DominoQTable::where('room_id', '=', 3)->get();
        return view('pages.game_asta.domino_qq.monitoring_table_dominoQ.dominoQQPro', compact('table'));
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
