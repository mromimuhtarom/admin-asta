<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TpkTable;
use App\TpkPlayer;
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
        $checked = $request->checkauto;
        // dd($checked);

        // room Novice / Pemula
        $onlineinvoice = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                         ->where('room_id', '=', 2)
                         ->get();

        $tpkPlayersnovice = TpkTable::where('room_id', '=', 2)
                             ->paginate(20);
                             
        $tpkPlayersnovice->appends($request->all());

        //  room untuk Intermedite / Menengah
        $onlineintermediate = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                              ->where('room_id', '=', 4)
                              ->get();

        //  room untuk Pro / Ahli
        $onlinepro = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                              ->where('room_id', '=', 6)
                              ->get();

        $tpkPlayersPro = TpkTable::where('room_id', '=', 6)
                         ->paginate(20);

        $tpkPlayersPro->appends($request->all());

        // all online
        $onlinetpk = TpkPlayer::all();


        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.astatable', compact('checked', 'tpkPlayersnovice', 'onlineinvoice', 'onlineintermediate', 'onlinepro', 'onlinetpk'));
    }

    public function indexIntermediate(Request $request)
    {

        $checked = $request->checkauto;


        // room Novice / Pemula
        $onlineinvoice = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                         ->where('room_id', '=', 2)
                         ->get();

        //  room untuk Intermedite / Menengah
        $onlineintermediate = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                              ->where('room_id', '=', 4)
                              ->get();

        $tpkPlayersintermediate = TpkTable::where('room_id', '=', 4)
                                  ->paginate(20);

        $tpkPlayersintermediate->appends($request->all());

        //  room untuk Pro / Ahli
        $onlinepro = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                              ->where('room_id', '=', 6)
                              ->get();


        // all online
        $onlinetpk = TpkPlayer::all();


        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.astatable', compact('checked', 'tpkPlayersintermediate', 'onlineinvoice', 'onlineintermediate', 'onlinepro', 'onlinetpk'));
    }

    public function indexPro(Request $request)
    {
        $checked = $request->checkauto;
      

        // room Novice / Pemula
        $onlineinvoice = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                         ->where('room_id', '=', 2)
                         ->get();

        //  room untuk Intermedite / Menengah
        $onlineintermediate = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                              ->where('room_id', '=', 4)
                              ->get();

        //  room untuk Pro / Ahli
        $onlinepro = TpkPlayer::join('tpk_table', 'tpk_table.table_id', '=', 'tpk_player.table_id')
                              ->where('room_id', '=', 6)
                              ->get();
        
        $tpkPlayersPro = TpkTable::where('room_id', '=', 6)
                         ->paginate(20);

        $tpkPlayersPro->appends($request->all());


        // all online
        $onlinetpk = TpkPlayer::all();


        return view('pages.game_asta.asta_poker.monitoring_table_asta_poker.astatable', compact('checked', 'tpkPlayersPro', 'onlineinvoice', 'onlineintermediate', 'onlinepro', 'onlinetpk'));
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
