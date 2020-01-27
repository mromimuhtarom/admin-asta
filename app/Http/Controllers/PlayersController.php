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
use File;
use Storage;
use Response;
use App\Game;
use App\LogUser;
use Illuminate\Support\Facades\Input;

class PlayersController extends Controller
{
//****************************************** Menu Player Active ******************************************//
  // ----------- Index Active Player ----------- //
    public function indexActive()
    {
      $player_type = ConfigText::select(
                        'value'
                     )
                     ->where('id', '=', 1)
                     ->first();
      $replacetype = str_replace(':', ',', $player_type->value);
      $explodetype = explode(',', $replacetype);
      $game        = Game::select('id', 'desc')->get();


  
        // $online = DB::select('select * from user_active join user on user.user_id = user_active.user_id join game on game.id = user_active.game_id join user_stat on user_stat.user_id = user_active.user_id where user.user_type != 3 and user_active.table_id != 0');

        return view('pages.players.active_player', compact('explodetype', 'game'));
    }

    public function searchactive(Request $request) {
      $inputPlayer  = $request->inputPlayer;
      $registerType = $request->inputRegisterType;
      $inputGame    = $request->inputGame;

      $player_type = ConfigText::select(
                        'value'
                     )
                     ->where('id', '=', 1)
                     ->first();
      $replacetype = str_replace(':', ',', $player_type->value);
      $explodetype = explode(',', $replacetype);
      $game        = Game::select('id', 'desc')->get();

      $online = PlayerActive::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_active.user_id')
                ->join('asta_db.game', 'asta_db.game.id', '=', 'asta_db.user_active.game_id')
                ->join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user_active.user_id')
                ->join('asta_db.user_level', 'asta_db.user_level.level', '=', 'asta_db.user_stat.level_id')
                ->select(
                  'asta_db.user.username', 
                  'asta_db.user_level.level as rank_name', 
                  'asta_db.user_active.user_id',
                  'asta_db.user_stat.chip', 
                  'asta_db.user_stat.gold',
                  'asta_db.user.user_type',
                  'asta_db.game.name as game_name', 
                  'asta_db.user_active.date_login',
                  'asta_db.user_active.game_id',
                  'asta_db.user_active.table_id'
                )
                ->where('asta_db.user_active.table_id', '!=', 0)
                ->where('asta_db.user_active.game_id', '!=', 0);


      if($inputPlayer != NULL && $registerType != NULL && $inputGame != NULL):
        if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user.username', 'LIKE', '%'.$inputPlayer.'%')
                          ->where('asta_db.user.user_type', '=', $registerType)
                          ->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user_active.user_id', '=', $inputPlayer)
                          ->where('asta_db.user.user_type', '=', $registerType)
                          ->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        endif;
      elseif($inputPlayer != NULL && $registerType != NULL):
        if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user.username', 'LIKE', '%'.$inputPlayer.'%')
                          ->where('asta_db.user.user_type', '=', $registerType)
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user_active.user_id', '=', $inputPlayer)
                          ->where('asta_db.user.user_type', '=', $registerType)
                          ->get();
        endif;
      elseif($inputPlayer != NULL && $inputGame != NULL):
        if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user.username', 'LIKE', '%'.$inputPlayer.'%')
                          ->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user_active.user_id', '=', $inputPlayer)
                          ->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        endif;
      elseif($registerType != NULL && $inputGame != NULL):
                if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user.user_type', '=', $registerType)
                          ->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user.user_type', '=', $registerType)
                          ->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        endif;
      elseif($inputGame != NULL):
                if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user_active.game_id', '=', $inputGame)
                          ->get();
        endif;
      elseif($registerType != NULL):
        if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user.user_type', '=', $registerType)
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user.user_type', '=', $registerType)
                          ->get();
        endif;
      elseif($inputPlayer != NULL):
        if(!is_numeric($inputPlayer)):
          $activePlayer = $online->where('asta_db.user.username', 'LIKE', '%'.$inputPlayer.'%')
                          ->get();
        else:
          $activePlayer = $online->where('asta_db.user_active.user_id', '=', $inputPlayer)
                          ->get();
        endif;
      else:
        $activePlayer = $online->get();
      endif;
      return view('pages.players.active_player', compact('activePlayer', 'explodetype', 'game', 'inputPlayer', 'registerType', 'inputGame'));


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
                   ->orderBy('asta_db.user_stat.chip', 'desc')
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
                   ->where('asta_db.user.user_type', '=', '1')
                   ->orWhere('asta_db.user.user_type', '=', '2')
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

        $player_type = ConfigText::where('id', '=', 1)
                       ->select(
                              'name',
                              'value'
                       )
                       ->first();
        $typeconverttocomma = str_replace(':', ',', $player_type->value);
        $plyr_type        = explode(",", $typeconverttocomma); 
       
        return view('pages.players.registered_player', compact('plyr_status', 'plyr_type'));
    }
  // ----------- End Index Registered Player ----------- //



  // ----------- Detail Registered Player ----------- //
    public function detailRegistered($userId)
    {
      $device  = Device::where('user_id', '=', $userId)->get();
      $profile = Player::join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                  ->leftjoin('asta_db.country', 'asta_db.country.code', '=', 'asta_db.user.country_code')
                  ->select(
                    'asta_db.user.username',
                    'asta_db.user.email',
                    'asta_db.user.country_code',
                    'asta_db.user_stat.chip',
                    'asta_db.user_stat.point',
                    'asta_db.user_stat.gold',
                    'asta_db.user.user_type',
                    'asta_db.user.user_id',
                    'asta_db.country.name',
                    'asta_db.user.join_date'
                  )
                  ->where('asta_db.user.user_id', '=', $userId)
                  ->first(); 
    
      return view('pages.players.register_player_profile', compact('device', 'profile'));
    }
 // ----------- End Detail Registered Player ----------- //

 //  ---------- Profile Image --------- //
    public function ImageProfilePlayer($user_id)
    {
      $rootpath = '../../asta-api/profile_player';
      $client = Storage::createLocalDriver(['root' => $rootpath]);
      // $file = Storage::exists($client->get($user_id.'.jpg'));
      $file_exists = $client->exists($user_id.'.jpg');      
      

      if($file_exists === false)
      {  
        
        $rootpath_empty = '../public/images/profile';
        $client_empty   = Storage::createLocalDriver(['root' => $rootpath_empty]);
        $file_empty     = $client_empty->get('empty_profile.png');
        $type_empty     = $client_empty->mimeType('empty_profile.png');

        $response_empty = Response::make($file_empty, 200);
        $response_empty->header("Content-Type", $type_empty);
        return $response_empty;

      } else if($file_exists === true){
        $file     = $client->get($user_id.'.jpg');
        $type     = $client->mimeType($user_id.'.jpg');
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

      }
      
    }
 //  ---------- End Profile Image --------- // 


//  ----------- Search Registered Player ----------//
    public function SearchRegisteredPlayer(Request $request)
    {
        $searchUser    = $request->inputPlayer;
        $status        = $request->status;
        $typeUser      = $request->type_user;
        $minDate       = $request->inputMinDate;
        $maxDate       = $request->inputMaxDate;
        $sorting       = $request->sorting;
        $namecolumn    = $request->namecolumn;

        $player_type = ConfigText::where('id', '=', 1)
                       ->select(
                              'name',
                              'value'
                       )
                       ->first();
        $typeconverttocomma = str_replace(':', ',', $player_type->value);
        $plyr_type        = explode(",", $typeconverttocomma); 

        $menu          = MenuClass::menuName('Registered Players');
        $mainmenu      = MenuClass::menuName('Players');
        $player_status = ConfigText::where('id', '=', 8)
                         ->select(
                            'name', 
                            'value'
                         )
                         ->first();
        $converttocomma = str_replace(':', ',', $player_status->value);
        $plyr_status    = explode(",", $converttocomma);

        if($minDate != NULL && $maxDate != NULL)
        {
          if($maxDate < $minDate){
            return back()->with('alert', alertTranlsate("end date can't be less than start date"));
          }
        }
        $register = Player::leftjoin('asta_db.country', 'asta_db.user.country_code', '=', 'asta_db.country.code')
                    ->join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                    ->join('asta_db.user_level', 'asta_db.user_level.level', '=', 'asta_db.user_stat.level_id')
                    ->select(
                      'asta_db.user.username', 
                      'asta_db.user.user_id',
                      'asta_db.user.status',
                      'asta_db.user_level.level',
                      'asta_db.user.join_date',
                      'asta_db.user.user_type',
                      'asta_db.country.name as countryname', 
                      'asta_db.user_stat.chip as chip', 
                      'asta_db.user_stat.point as point', 
                      'asta_db.user_stat.gold as gold'
                    )
                    ->whereBetween('user_type', [1, 2]);
        
        // if sorting variabel null
        if($sorting == NULL):
          $sorting = 'desc';
        endif;

        if($namecolumn == NULL):
          $namecolumn = 'asta_db.user.join_date';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

        $getMindate  = Input::get('inputMinDate');
        $getMaxdate  = Input::get('inputMaxDate');
        $getUsername = Input::get('inputPlayer');
        $getStatus   = Input::get('status');
        $getTypeUser = Input::get('type_user');


          
        if($typeUser != NULL && $searchUser != NULL && $status != NULL && $minDate != NULL && $maxDate != NULL)
        {

          $registerPlayer = $register->where('asta_db.user.username', ' LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.user_type', '=', $typeUser)
                            ->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));

        
        }elseif($typeUser != NULL && $searchUser != NULL && $status != NULL)
        {
   
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.user_type', '=', $typeUser)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));   
        
        
        }elseif($typeUser != NULL && $searchUser != NULL)
        {
 
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.user_type', '=', $typeUser)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        
        
        }elseif($typeUser != NULL && $status != NULL)
        {
       
          $registerPlayer = $register->where('asta_db.user.user_type', '=', $typeUser)
                                     ->where('asta_db.user.status', '=', $status)
                                     ->orderby($namecolumn, $sorting)
                                     ->paginate(20);
          
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        
        
        }elseif($typeUser != NULL)
        {
         
          $registerPlayer = $register->where('asta_db.user.user_type', '=', $typeUser)
                                     ->orderby($namecolumn, $sorting)
                                     ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        
        
        }elseif($searchUser != NULL && $status != NULL && $minDate != NULL && $maxDate != NULL)
        {
    
          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->where('asta_db.user.status', '=', $status)
                            ->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        
        
        } else if($searchUser != NULL && $status != NULL && $minDate != NULL)
        {

          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '>=', $minDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '>=', $minDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;                  
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type','sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        
        
        } else if($searchUser != NULL && $status != NULL && $maxDate != NULL)
        {
 
          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '<=', $maxDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '<=', $maxDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));

        } else if($searchUser != NULL && $status != NULL)
        {
          
          if(is_numeric($searchUser) !== true):
          $registerPlayer =  $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                             ->where('asta_db.user.status', '=', $status)
                             ->orderby($namecolumn, $sorting)
                             ->paginate(20);
          else:
          $registerPlayer =  $register->where('asta_db.user.user_id', '=', $searchUser)
                             ->where('asta_db.user.status', '=', $status)
                             ->orderby($namecolumn, $sorting)
                             ->paginate(20);
          endif;
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($status != NULL && $minDate != NULL && $maxDate != NULL)
        {
  
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($status != NULL && $minDate != NULL)
        {
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '>=', $minDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
                            
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($status != NULL && $maxDate != NULL)
        {
    
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->where('asta_db.user.join_date', '<=', $maxDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($searchUser != NULL  && $minDate != NULL && $maxDate != NULL)
        {
    
          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($searchUser != NULL  && $minDate != NULL)
        {
    
          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.join_date', '>=', $minDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->where('asta_db.user.join_date', '>=', $minDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($searchUser != NULL  && $maxDate != NULL)
        {
    
          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->where('asta_db.user.join_date', '<=', $maxdate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->where('asta_db.user.join_date', '<=', $maxdate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($minDate != NULL && $maxDate != NULL)
        { 
     
          $registerPlayer = $register->wherebetween('asta_db.user.join_date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);

            $registerPlayer->appends($request->all());
            return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } 
        else if($searchUser != NULL)
        {
         
          if(is_numeric($searchUser) !== true):
          $registerPlayer = $register->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          else:
          $registerPlayer = $register->where('asta_db.user.user_id', '=', $searchUser)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          endif;
          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($status != NULL)
        {
        
          $registerPlayer = $register->where('asta_db.user.status', '=', $status)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } 
        else if($minDate != NULL)
        {
      
          $registerPlayer = $register->where('asta_db.user.join_date', '>=', $minDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else if($maxDate != NULL)
        {
       
          $registerPlayer =  $register->where('asta_db.user.join_date', '<=', $maxDate)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        } else {
         
          $registerPlayer =  $register->orderby($namecolumn, $sorting)
                            ->paginate(20);

          $registerPlayer->appends($request->all());
          return view('pages.players.registered_player', compact('registerPlayer', 'menu', 'plyr_status', 'mainmenu', 'plyr_type', 'sortingorder', 'getMindate', 'getMaxdate', 'getUsername', 'getStatus', 'getTypeUser', 'request'));
        }
    }

// ------------ End search Registered Player -----------//


 // ----------- Update Registered Player ----------- //
    public function updateBannedAccount(Request $request)
    {
        $plyr_id     = $request->player_id;
        $description = $request->description;
        $sts_plyr    = $request->status_player;

        $validator = Validator::make($request->all(),[
          'description' => 'required'
          
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        Player::where('user_id', '=', $plyr_id)->update([
          'status' => $sts_plyr
        ]);

        $validator = Validator::make($request->all(),[
          'description' => 'required'

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        switch($sts_plyr):
          case '1':
            $sts_plyr = 25;
            break;
          case '2':
            $sts_plyr = 26;
            break;
          case '3':
            $sts_plyr = 27;
            break;
        endswitch;

        

        LogUser::create([  
          'user_id'     => $plyr_id,
          'action_id'   => $sts_plyr,
          'datetime'    => Carbon::now('GMT+7'),
          'description' => $description
        ]);
        
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit Status di menu Pemain terdaftar dengan Pengguna ID '.$plyr_id.' menjadi Dilarang'
        ]);

        return back()->with('success', alertTranslate('Update status successfull'));
    }
  // ----------- End Update Registered Player ----------- //
//****************************************** End Menu Registered Player ******************************************//



//****************************************** Menu Guest ******************************************//
  // ----------- Index Guest ----------- //
    public function indexGuest() {
        $datenow   = Carbon::now('GMT+7');
        $available = UserGuest::select(DB::raw('count(guest_id) as totalguest'))->wherenull('user_id')->first();
        $used      = UserGuest::select(DB::raw('count(guest_id) as totalguest'))->wherenotnull('user_id')->first();
        return view('pages.players.guest', compact('available', 'used', 'datenow'));
    }
  // ----------- End Index Guest ----------- //

  // -----------Insert Guest ------------//
  public function storeGuest(Request $request)
  {
    $number   = $request->inputcount;
    $data     = $request->all();
    $validate = [
        'inputcount' => 'required|integer',
    ];

    $validator = Validator::make($data,$validate);

    if($validator->fails())
    {  
      return back()->withInput()->with('alert', $validator->errors()->first());
    }

      if($number)
      {
        for ($i=1; $i <= $number; $i++) {
            $a = UserRandom::where('user_type', '=', 2)->where('isused', '=', 0)->first();
            $guestId[] = [
              'guest_id'   => $a->user_id,
            ];
            $b = UserRandom::where('user_id', '=', $a->user_id)->update(['isused' => 1]);
        }
        UserGuest::insert($guestId);
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data pengguna tamu dengan ID  '.$number
        ]);

        return back()->with('success', 'Input Data Successfull with '.$number.' Record');
      }
    return back()->with('alert', alertTranslate("Number of inputs filled in Player ID can't be NULL"));
  }
  // -----------End Insert Guest ---------------//

  // -----------Search Guest -------------- //
  public function searchGuest(Request $request)
  {
    $username = $request->inputPlayer;
    $status   = $request->inputStatus;
    $minDate  = $request->inputMinDate;
    $maxDate  = $request->inputMaxDate;
    $datenow  = Carbon::now('GMT+7');
    $menu     = MenuClass::menuName('Guest');
    $mainmenu = MenuClass::menuName('Players');
  
    if($status == 'nonused')
    {
        $guests   = UserGuest::select(
                      'asta_db.user_guest.device_key',
                      'asta_db.user_guest.guest_id', 
                      'asta_db.user_guest.expired_date',
                      'asta_db.user_guest.user_id',
                      DB::raw("'tidak digunakan' AS status")
                    )
                    ->whereNull('user_id')
                    ->get();   
      return view('pages.players.guest', compact('guests', 'status', 'datenow', 'menu', 'mainmenu', 'username'));
    } else if($username != NULL && $status == 'used')
    {
        $guests   =   UserGuest::join('asta_db.user', 'asta_db.user.user_id', 'asta_db.user_guest.user_id')
                      ->select(
                        'asta_db.user.username', 
                        'asta_db.user_guest.guest_id',
                        'asta_db.user_guest.device_key', 
                        'asta_db.user_guest.expired_date',
                        'asta_db.user_guest.user_id',
                        DB::raw("'digunakan' AS status")
                      )
                      ->where('username', 'LIKE', '%'.$username.'%')
                      ->whereNotNull('asta_db.user_guest.user_id')
                      ->get();
        return view('pages.players.guest', compact('guests', 'status', 'datenow', 'menu', 'mainmenu', 'username'));
    } else if($status == 'used')
    {
        $guests   =   UserGuest::join('asta_db.user', 'asta_db.user.user_id', 'asta_db.user_guest.user_id')
                      ->select(
                        'asta_db.user.username', 
                        'asta_db.user_guest.guest_id',
                        'asta_db.user_guest.device_key', 
                        'asta_db.user_guest.expired_date',
                        'asta_db.user_guest.user_id',
                        DB::raw("'digunakan' AS status")
                      )
                      ->whereNotNull('asta_db.user_guest.user_id')
                      ->get();
        return view('pages.players.guest', compact('guests', 'status', 'datenow', 'menu', 'mainmenu', 'username'));
    } else if($minDate == NULL || $maxDate == NULL || $minDate == NULL && $maxDate == NULL)
    {
      return self::indexGuest()->with('alert', alertTranslate("You must to Choose Status"));
    }


  }
  // -----------End Search Guest -----------------//
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
        if($botId == NULL)
        {
          return back()->with('alert','Bot ID is Null you must Add Id or In menu Register Player ID');
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
          'desc'      => 'Menambahkan data di menu Bot dengan username '. $username
        ]);

        return redirect()->route('Bots')->with('success', alertTranslate('Data added'));
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
        'desc'      => 'Edit '.$name.' di menu Bot dengan ID '.$pk.' menjadi '. $value
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
          return redirect()->route('Bots')->with('success', alertTranslate('Data deleted'));
      }
      return redirect()->route('Bots')->with('alert', alertTranslate('Something wrong'));   
    }
  // ----------- End Delete Bots ----------- //
//****************************************** End Menu Bots ******************************************//  



    public function avatar(Request $request)
    {

        $all   = $request->all();
        $image = $request->base64Image;
        $id    = $request->userId;

        $image_decode = base64_decode($image);
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $image_decode, FILEINFO_MIME_TYPE);
        $imageName = $id.'.'.'jpg';

        $rootpath   = 'unity-asset/profile_player/' .$id.'.jpg';
        $image_main = Storage::disk('s3');

        if($image_main->put($rootpath, $image_decode ))
        {
          echo 'Successful';
        } else 
        {
          echo 'Failed';
        }
    }
  
    public function avatarplayer(Request $request)
    {
      $avatarname = $request->avatar_name;
      $avatar = public_path().'/upload/avatars/'.$avatarname.'.jpg';
      
      return response()->file($avatar);
    }
}
