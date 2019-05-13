<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use App\Stat;
use Session;
use Carbon\Carbon;
use App\Player;

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

    public function storeBots(Request $request)
    {
        $botName   = $request->username;
        $botId     = DB::table('user_random')->where([['isused', 0],['user_type', '3']])->first();
        $username   = clean($botName);
        $deviceId  = "";
        $sql       = DB::table('country')->select('code')->get();
        $countries = $sql->toArray();
      //   $countries = array("Australia","Japan","Mexico","United States","Italia","Greece","France","Hungary","Estados Unidos","Deutschland","United Kingdom");
        $country        = $countries[rand(1,count($countries) - 1)];
        $winpot         = 100000;
        $securePassword = 'NOACCESSS887722030201';
        $avatar         = 'avatar'.rand(1,12).'.jpg';
        $time           = Carbon::now('GMT+7');


        $createbot = Player::insert([
            'user_id'         => $botId->user_id,
            'status'          => '1',
            'user_type'       => '3',
            'username'        => $username,
            'email'           => $username."@na.com",
            'last_date'       => $time,
            'join_date'       => $time,
            'lang_code'       => 'en',
            'last_ip'         => '0',
            'timetag'         => '0',
            'last_move'       => '0',
            'avatar'          => $avatar,
            'device_id'       => $deviceId,
            'facebook_id'     => '',
            'country_code'    => $country->code,
            'userpass'        => md5($securePassword)
        ]);

        if($createbot){
          Stat::create([
            'user_id'     => $botId->user_id,
          //   'player' => $botName,
            'chip'        => $winpot,
            'point'       =>  '0.00',
            'gold'        =>  '0',
            'rank_id'     =>  '0',
            'poker_round' =>  '0',
            'experience'  =>  '0'
          ]);

          DB::table('tpk_stat')->insert([
              'user_id'             => $botId->user_id,
              'game_played'         =>  '0',
              'tournament_played'   =>  '0',
              'tournament_won'      =>  '0',
              'round_played'        =>  '0',
              'round_won'           =>  '0',
              'win_streak'          =>  '0',
              'best_hand'           =>  '0'

          ]);

          DB::table('user_random')->where('user_id', $botId->user_id)->update([
            'isused' => '1'
          ]);
        }

        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '8',
          'action_id'   => '3',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Create new Bot with username '. $username
        ]);

        return redirect()->route('Bots-view')->with('success','Data Added');
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

    public function updateBot(Request $request, Stat $stat)
    {
      $pk = $request->pk;
      $name = $request->name;
      $value = $request->value;

      Stat::where('user_id', $pk)->update([
        $name => $value
      ]);

      switch ($name) {
        case "chip":
            $name = "chip";
            break;
        default:
          "";
    }


    Log::create([
      'operator_id' => Session::get('userId'),
      'menu_id' => '8',
      'action_id' => '2',
      'date' => Carbon::now('GMT+7'),
      'description' => 'Edit '.$name.' ID '.$pk.' to '. $value
    ]);

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
