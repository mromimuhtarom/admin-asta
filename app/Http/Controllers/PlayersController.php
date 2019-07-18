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
use App\UserGuest;
use App\Device;
use Validator;
use App\Country;
use App\PlayerActive;
use App\UserRandom;
use App\ConfigText;

class PlayersController extends Controller
{
//****************************************** Menu Player Active ******************************************//
  // ----------- Index Active Player ----------- //
    public function indexActive()
    {
        $online = PlayerActive::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_active.user_id')
                  ->join('asta_db.game', 'asta_db.game.id', '=', 'asta_db.user_active.game_id')
                  ->join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user_active.user_id')
                  ->select(
                    'asta_db.user.username', 
                    'asta_db.user_stat.rank_id', 
                    'asta_db.user_stat.chip', 
                    'asta_db.user_stat.gold',
                    'asta_db.user.user_type',
                    'asta_db.game.name as game_name', 
                    'asta_db.user_active.date_login'
                  )
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
                  ->join('asta_db.country', 'asta_db.user.country_code', '=', 'asta_db.country.code')
                   ->select(
                     DB::raw("sum(chip) / count(*) As avgBank"),
                     'asta_db.user_stat.chip',
                     'asta_db.user.username',
                     'asta_db.country.name',
                     'asta_db.user_stat.gold'
                   )
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
                  ->join('asta_db.country', 'asta_db.user.country_code', '=', 'asta_db.country.code')
                  ->select(
                    'asta_db.user_stat.chip',
                    'asta_db.user.username',
                    'asta_db.country.name',
                    'asta_db.user_stat.gold'
                  )
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
        $player_status = ConfigText::where('id', '=', 8)
                         ->select(
                            'name', 
                            'value'
                         )
                         ->first();
        $converttocomma = str_replace(':', ',', $player_status->value);
        $plyr_status = explode(",", $converttocomma);

        return view('pages.players.registered_player', compact('registered', 'plyr_status'));
    }
  // ----------- End Index Registered Player ----------- //



  // ----------- Detail Registered Player ----------- //
    public function detailRegistered($userId)
    {
      $device = Device::where('user_id', '=', $userId)->get();
      $profile = Player::join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                  ->join('asta_db.country', 'asta_db.country.code', '=', 'asta_db.user.country_code')
                  ->select(
                    'asta_db.user.avatar',
                    'asta_db.user.username',
                    'asta_db.user.email',
                    'asta_db.user.country_code',
                    'asta_db.user_stat.gold',
                    'asta_db.user_stat.chip',
                    'asta_db.user_stat.point',
                    'asta_db.country.name',
                    'asta_db.user.join_date'
                  )
                  ->where('asta_db.user.user_id', '=', $userId)
                  ->first();
      // $country = Country::select()
      //           ->where('code', '=', $username->country_code)
      //            ->first();
                
      return view('pages.players.register_player_profile', compact('device', 'profile'));
    }
 // ----------- End Detail Registered Player ----------- //


//  ----------- Search Registered Player ----------//
    public function SearchRegisteredPlayer(Request $request)
    {
        $username      = $request->inputPlayer;
        $status        = $request->status;
        $mindate       = $request->inputMinDate;
        $maxdate       = $request->inputMaxDate;
        $menu          = MenuClass::menuName('Registered Player');
        $mainmenu      = MenuClass::menuName('Players');
        $player_status = ConfigText::where('id', '=', 8)
                         ->select(
                            'name', 
                            'value'
                         )
                         ->first();
        $converttocomma = str_replace(':', ',', $player_status->value);
        $plyr_status    = explode(",", $converttocomma);

        if($mindate != NULL && $maxdate != NULL)
        {
          if($maxdate < $mindate){
            return back()->with('alert','End Date can\'t be less than start date');
          }
        }
        $register = Player::join('asta_db.country', 'asta_db.user.country_code', '=', 'asta_db.country.code')
                    ->join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                    ->select(
                      'asta_db.user.username', 
                      'asta_db.user.user_id',
                      'asta_db.user.status',
                      'asta_db.user.join_date',
                      'asta_db.user.user_type',
                      'asta_db.country.name as countryname', 
                      'asta_db.user_stat.chip as chip', 
                      'asta_db.user_stat.point as point', 
                      'asta_db.user_stat.gold as gold'
                    )
                    ->where('user_type', '=', 1);                      
                            

        if($username != NULL && $status != NULL && $mindate != NULL && $maxdate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->wherebetween('asta_db.user.join_date', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($username != NULL && $status != NULL && $mindate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '>=', $mindate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($username != NULL && $status != NULL && $maxdate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '<=', $maxdate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));

        } else if($username != NULL && $status != NULL)
        {
          $registerPlayer =  $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($status != NULL && $mindate != NULL && $maxdate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->wherebetween('asta_db.user.join_date', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($status != NULL && $mindate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '>=', $mindate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($status != NULL && $maxdate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '<=', $maxdate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($username != NULL  && $mindate != NULL && $maxdate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->wherebetween('asta_db.user.join_date', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($username != NULL  && $mindate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->where('asta_db.user.join_date', '>=', $mindate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($username != NULL  && $maxdate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->where('asta_db.user.join_date', '<=', $maxdate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($username != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($status != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        }else if($mindate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.join_date', '>=', $mindate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else if($maxdate != NULL)
        {
          $registerPlayer =  $register->where('asta_db.user.join_date', '<=', $maxdate)
                            ->get();

          // $registerPlayer->appends($request->all());
          return view('pages.players.registered_player_detail', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu'));
        } else {
          return $this->indexRegisteredPlayer();
        }
    }

// ------------ End search Registered Player -----------//


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

    public function updateRegistered(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        
        Player::where('user_id', '=', $pk)->update([
          $name => $value
        ]);

        switch ($name) {
          case "chip":
              $name = "Status";
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
        $guests = UserGuest::join('asta_db.user', 'asta_db.user.user_id', '=', 'user_guest.user_id')
                  ->select(
                    'asta_db.user.username',
                    'user_guest.device_id'
                  )
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
        $mainmenu = MenuClass::menuName('Players');
        $bots = Player::join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                ->join('asta_db.country', 'asta_db.country.code', '=', 'asta_db.user.country_code')
                ->select(
                  'asta_db.user.username',
                  'asta_db.user.user_id',
                  'asta_db.user_stat.chip',
                  'asta_db.user_stat.rank_id',
                  'asta_db.user_stat.gold',
                  'asta_db.country.name'
                )
                ->where('asta_db.user.user_type', '=', '3')
                ->get();
        return view('pages.players.bots', compact('bots', 'menu', 'mainmenu'));
    }
  // ----------- End Index Bots ----------- //


  // ----------- Insert Bots ----------- //
    public function storeBots(Request $request)
    {
        $botName   = $request->username;
        $botId     = UserRandom::select('user_id')
                     ->where([
                       ['isused', 0],
                       ['user_type', '3']
                     ])
                     ->first();
        $username  = clean($botName);
        $deviceId  = "";
        $sql       = Country::select('code')->get();
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
            'avatar'          => $avatar,
            'device_id'       => $deviceId,
            'country_code'    => $country['code'],
            'userpass'        => md5($securePassword)
        ]);

        if($createbot){
          Stat::create([
            'user_id'   => $botId->user_id,
            'chip'      => $winpot,
            'point'     => '0.00',
            'gold'      => '0',
            'rank_id'   => '0',
            'tpk_round' => '0',
            'bgt_round' => '0',
            'dmq_round' => '0',
            'dms_round' => '0',
            'exp'       => '0'
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

          UserRandom::where('user_id', $botId->user_id)->update([
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
          Player::where('user_id', '=', $userid)->delete();
          Stat::where('user_id', '=', $userid)->delete();

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
