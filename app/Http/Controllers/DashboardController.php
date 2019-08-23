<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Game;
use App\DominoQTable;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gameName =     Game::all();
        $rooms    =     DominoQTable::join('asta_db.dmq_room', 'dmq_room.room_id', '=', 'dmq_table.room_id')
                        ->select(DB::raw('count("asta_db.dmq_table.room_id") as room_id'), 'asta_db.dmq_room.name as harga')
                        ->groupBy('asta_db.dmq_table.room_id')->get();
                    
        return view('pages.dashboard.home', compact('gameName', 'rooms'));
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
