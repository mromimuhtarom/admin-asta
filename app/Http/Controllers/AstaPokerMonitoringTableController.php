<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TpkTable;
use Session;
use Illuminate\Support\Facades\Input;

class AstaPokerMonitoringTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $sorting = $request->sorting;
        // if($sorting == NULL):
        //     $sorting = 'desc';
        // endif;
        $namecolumn   = $request->namecolumn;
        if($namecolumn == NULL):
            $namecolumn = 'playername';
        endif;

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;


        $table             = TpkTable::where('room_id', '=', 2)->get();
        $tpkPlayersinvoice = TpkTable::leftjoin('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                             ->leftjoin('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_player.user_id')
                             ->select(
                                 'asta_db.tpk_table.table_id as tableid',
                                 'asta_db.user.username as playername', 
                                 'asta_db.tpk_table.room_id as roomid',
                                 'asta_db.tpk_table.name as tablename',
                                 'asta_db.tpk_table.timer as timer',
                                 'asta_db.tpk_table.max_player as maxplayer',
                                 'asta_db.tpk_player.user_id as userid'
                             )
                             ->orderby($namecolumn, $sortingorder)
                             ->where('room_id', '=', 2)
                             ->paginate(20);
                             
        $tpkPlayersintermediate = TpkTable::join('asta_db.tpk_player', 'asta_db.tpk_player.table_id', '=', 'asta_db.tpk_table.table_id')
                                  ->where('room_id', '=', 2)
                                   ->get();
        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.astatable', compact('table', 'tpkPlayersinvoice', 'sortingorder'));
    }

    public function Game(Request $request)
    {
        $idtable    = $request->id_table;
        $name_table = $request->name_table;

        $username = Session::get('username');
        $operator = DB::table('operator')->where('op_id', '=', Session::get('userId'))->first();
        $password = $operator->userpass;
        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.game_asta_poker', compact('idtable', 'name_table', 'username', 'password'));
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
