<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;
use App\Stat;
use Session;
use Carbon\Carbon;
use App\Player;
use App\Device;
use Validator;
use App\PlayerActive;

class PlayersController extends Controller
{
//****************************************** Menu Player Active ******************************************//
  // ----------- Index Active Player ----------- //
    public function indexActive()
    {
        $online = PlayerActive::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_active.user_id')
                  ->join('game', 'game.id', '=', 'asta_db.user_active.game_id')
                  ->join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user_active.user_id')
                  ->select('asta_db.user.*', 'asta_db.user_stat.*', 'game.name as game_name', 'asta_db.user_active.*')
                  ->where('asta_db.user.user_type', '!=', '3')
                  ->get();
        return view('pages.players.active_player', compact('online'));
    }
  // ----------- End Active Player ----------- //
//****************************************** End Menu Player Active ******************************************//


//****************************************** Menu High Rollers ******************************************//
  // ----------- Index High Roller ----------- //
    public function indexHighRoller()
    {
        $avgBank = 0;
        $player1 = Player::join('asta_db.user_stat', 'asta_db.user.user_id', '=', 'asta_db.user_stat.user_id')
                  ->join('country', 'asta_db.user.country_code', '=', 'country.code')
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
        $player  = Player::join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                  ->join('country', 'asta_db.user.country_code', '=', 'country.code')
                  ->where('chip', '>', $avgBank)->orderBy('chip', 'DESC')
                  ->limit('100')
                  ->get();
        return view('pages.players.high_roller', compact('player'));
    }
  // ----------- End High Roller ----------- //
//****************************************** End Menu High Rollers ******************************************//



//****************************************** Menu Registered Player ******************************************//
  // ----------- Index Registered Player ----------- //
    public function indexRegisteredPlayer() {
        $registered = Player::join('country', 'asta_db.user.country_code', '=', 'country.code')
                      ->join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                      ->select('asta_db.user.*', 'country.name as countryname', 'asta_db.user_stat.chip as chip', 'asta_db.user_stat.point as point', 'asta_db.user_stat.gold as gold')                      
                      ->where('user_type', '=', 1)
                      ->get();

              
        return view('pages.players.registered_player', compact('registered'));
    }
  // ----------- End Index Registered Player ----------- //



  // ----------- Detail Registered Player ----------- //
    public function detailRegistered($userId)
    {
      $device = Device::where('user_id', '=', $userId)->get();
      $username = Player::join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                  ->where('asta_db.user.user_id', '=', $userId)
                  ->first();
      $country = DB::table('country')
                 ->where('iso_code_2', '=', $username->country_code)
                 ->first();
      $datenow = Carbon::now('GMT+7');
                
      return view('pages.players.register_player_detail', compact('device', 'username', 'country', 'datenow'));
    }
 // ----------- End Detail Registered Player ----------- //


 // ----------- Update Registered Player ----------- //
    public function updateRegisteredPlayer(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        Stat::where('user_id', '=', $pk)->update([
          $name => $value
        ]);

        switch ($name) {
          case "chip":
              $name = "Chip";
              break;
          case "point":
              $name = "Point";
              break;
          case "gold":
              $name = "Gold";
              break;
          default:
            "";
        }


        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' in menu Registered Player with ID '.$pk.' to '. $value
        ]);
    }
  // ----------- End Update Registered Player ----------- //
//****************************************** End Menu Registered Player ******************************************//



//****************************************** Menu Guest ******************************************//
  // ----------- Index Guest ----------- //
    public function indexGuest() {
        $guests = DB::table('user_guest')
                  ->join('asta_db.user', 'asta_db.user.user_id', '=', 'user_guest.user_id')
                  ->get();
        return view('pages.players.guest', compact('guests'));
    }
  // ----------- End Index Guest ----------- //
//****************************************** End Menu Guest ******************************************//


//****************************************** Menu Bots ******************************************//
  // ----------- Index Bots ----------- //
    public function indexBots()
    {
        $menu  = MenuClass::menuName('Bots');
        $bots = Stat::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_stat.user_id')
                ->join('country', 'country.code', '=', 'asta_db.user.country_code')
                ->where('asta_db.user.user_type', '=', '3')
                ->get();
        return view('pages.players.bots', compact('bots', 'menu'));
    }
  // ----------- End Index Bots ----------- //


  // ----------- Insert Bots ----------- //
    public function storeBots(Request $request)
    {
        $botName   = $request->username;
        $botId     = DB::table('user_random')->where([['isused', 0],['user_type', '3']])->first();
        $username  = clean($botName);
        $deviceId  = "";
        $sql       = DB::table('country')->select('code')->get();
        $countries = $sql->toArray();
      //   $countries = array("Australia","Japan","Mexico","United States","Italia","Greece","France","Hungary","Estados Unidos","Deutschland","United Kingdom");
        $country        = $countries[rand(1,count($countries) - 1)];
        $winpot         = 100000;
        $securePassword = 'NOACCESSS887722030201';
        $avatar         = 'avatar'.rand(1,12).'.jpg';
        $time           = Carbon::now('GMT+7');

        $validator = Validator::make($request->all(),[
          'username'    => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }


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

          DB::table('asta_db.user_random')->where('user_id', $botId->user_id)->update([
            'isused' => '1'
          ]);
        }

        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '3',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Create new in menu Bot with username '. $username
        ]);

        return redirect()->route('Bots')->with('success','Data Added');
    }
  // ----------- End Insert Bots ----------- //


  // ----------- Update Bots ----------- //
    public function updateBot(Request $request, Stat $stat)
    {
      $pk    = $request->pk;
      $name  = $request->name;
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
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu Bots with ID '.$pk.' to '. $value
      ]);

    }
  // ----------- End Update Bots ----------- //


  // ----------- Delete Bots ----------- //
    public function destroyBots(Request $request)
    {
      $userid = $request->userid;
      if($userid != '')
      {
          DB::table('asta_db.user')->where('user_id', '=', $userid)->delete();
          DB::table('asta_db.user_stat')->where('user_id', '=', $userid)->delete();

          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Delete in menu Bots with ID '.$userid
          ]);
          return redirect()->route('Bots')->with('success','Data Deleted');
      }
      return redirect()->route('Bots')->with('success','Something wrong');   
    }
  // ----------- End Delete Bots ----------- //
//****************************************** End Menu Bots ******************************************//  

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

    public function avatar($avatar)
    {

      // //
      $path = public_path().'\\upload\\avatars\\'.$avatar;
      // return Image::make($path)->response();
        return response()->file($path);
    }
}
