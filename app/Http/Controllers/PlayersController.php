<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActive()
    {
        $online = DB::table('user_active')->join('user', 'user.user_id', '=', 'user_active.user_id')->join('user_device', 'user_active.user_id', '=', 'user_device.user_id')->join('game', 'game.id', '=', 'user_active.game_id')->join('user_stat', 'user_stat.user_id', '=', 'user_active.user_id')->select('user_device.name as devicename', 'user.*', 'user_stat.*', 'game.name as game_name', 'user_active.*')->get();
        $offline = DB::table('user')->leftJoin('user_active', 'user_active.user_id', '=', 'user.user_id')->join('user_stat', 'user_stat.user_id', '=', 'user.user_id')->join('user_device', 'user_device.device_id', '=', 'user.device_id')->whereNull('user_active.user_id')->get();
        return view('pages.players.active_player', compact('online', 'offline'));
    }
    public function indexHighRoller()
    {
        // $activeUsers = DB::select("SELECT user_active.user_id, user.username FROM user_active JOIN user ON user.user_id = user_active.user_id WHERE user_active.game_id != ''");


        $avgBank = 0;
        $player1 = DB::table('user')
                   ->join('user_stat', 'user.user_id', '=', 'user_stat.user_id')
                  ->join('country', 'user.country_code', '=', 'country.code')
                   ->select(DB::raw("sum(chip) / count(*) As avgBank"))
                   ->where('user_type', '=', '1')
                   ->where('user_type', '=', '2')
                   ->get();

        if($player1 !== FALSE) {
            foreach($player1 as $player) {
            $avgBank = $player->avgBank;
            }
        }

        if($avgBank == "")

        $avgBank = 0;
        $player  = DB::table('user')
                  ->join('user_stat', 'user_stat.user_id', '=', 'user.user_id')
                  ->join('country', 'user.country_code', '=', 'country.code')
                  ->where('chip', '>', $avgBank)->orderBy('chip', 'DESC')
                  ->limit('100')
                  ->get();
        return view('pages.players.high_roller', compact('player'));
    }

    public function indexRegisteredPlayer() {
        $registered = DB::table('user_device')
                    ->join('user', 'user.user_id', '=', 'user_device.user_id')
                    ->join('country', 'user.country_code', '=', 'country.code')
                    ->select('user_device.name as devicename', 'user_device.join_date', 'user.*', 'country.name as countryname')
                    ->where('user_device.join_date', '!=', '')
                    ->get();
        return view('pages.players.registered_player', compact('registered'));
    }


    public function indexGuest() {
        $guests = DB::table('user_guest')
                  ->join('user', 'user.user_id', '=', 'user_guest.user_id')
                  ->get();
        return view('pages.players.guest', compact('guests'));
    }

    public function indexBots()
    {
        $bots = DB::table('user_stat')
                ->join('user', 'user.user_id', '=', 'user_stat.user_id')
                ->join('country', 'country.code', '=', 'user.country_code')
                ->where('user.user_type', '=', '3')
                ->get();
        return view('pages.players.bots', compact('bots'));
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
