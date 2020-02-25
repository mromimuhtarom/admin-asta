<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\DmqRound;
use App\DmsRound;
use App\TpkRound;
use App\BgtRound;
use App\Game;
use App\Player;
use App\Classes\MenuClass;
use Validator;
use Illuminate\Support\Facades\Input;

class PlayReportController extends Controller
{
    
    public function index()
    {
        $game = Game::all();
        $datenow = Carbon::now('GMT+7');
        return view('pages.players.playreport', compact('game', 'datenow'));
    }

    public function search(Request $request)
    {

      $inputName    = $request->inputPlayer;
      $inputMinDate = $request->inputMinDate;
      $inputGame    = $request->inputGame;
      $inputMaxDate = $request->inputMaxDate;
      $inputRoundID = $request->inputRoundID;
      $sorting      = $request->sorting;
      $namecolumn   = $request->namecolumn;
      $menus1       = MenuClass::menuName('Report');
      $game         = Game::all();
      
       $validator = Validator::make($request->all(),[
              'inputMinDate' => 'required|date',
              'inputMaxDate' => 'required|date',
              'inputGame'    => 'required',
       ]);

       if ($validator->fails()) {
              return back()->withErrors($validator->errors());
       }

      if($inputMaxDate < $inputMinDate){
       return back()->with('alert', alertTranslate("end date can't be less than start date"));
      }
        // if sorting variable is null
        if($sorting == NULL):
          $sorting = 'desc';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;
        
        $getMindate  = Input::get('inputMinDate');
        $getMaxdate  = Input::get('inputMaxDate');
        $getusername = Input::get('inputPlayer');
        $getgame     = Input::get('inputGame');
        $getroundid  = Input::get('inputRoundID');


      $player_username = Player::select('user_id', 'username')->get();

      
      $tbdmq = DmqRound::join('asta_db.dmq_round_player', 'asta_db.dmq_round_player.round_id', '=', 'asta_db.dmq_round.round_id')
               ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dmq_round_player.user_id')
               ->join('asta_db.dmq_table', 'asta_db.dmq_table.table_id', '=', 'asta_db.dmq_round.table_id')
               ->select(
                         'asta_db.dmq_round.gameplay_log AS gameplay_log',
                         'asta_db.dmq_round.date as datetimeround',
                         'asta_db.dmq_table.name AS tablename',
                         'asta_db.dmq_round_player.bet AS bet',
                         'asta_db.dmq_round_player.round_id as round_id',
                         'asta_db.dmq_round_player.win_lose as win_lose',
                         'asta_db.dmq_round_player.status as status',
                         'asta_db.dmq_round_player.hand_card as hand_card_round',
                         'asta_db.dmq_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                        DB::raw("'Domino QQ' AS gamename") 
                       );
       $tbdms = DmsRound::join('asta_db.dms_round_player', 'asta_db.dms_round.round_id', '=', 'asta_db.dms_round_player.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dms_round_player.user_id')
                ->join('asta_db.dms_table', 'asta_db.dms_table.table_id', '=', 'asta_db.dms_round.table_id')
                ->select(
                         'asta_db.dms_round.gameplay_log as gameplay_log',
                         'asta_db.dms_round.date As datetimeround',
                         'asta_db.dms_table.name AS tablename',
                         'asta_db.dms_round_player.bet as bet',
                         'asta_db.dms_round_player.round_id as round_id',
                         'asta_db.dms_round_player.win_lose as win_lose',
                         'asta_db.dms_round_player.status as status',
                         'asta_db.dms_round_player.hand_card as hand_card_round',
                         'asta_db.dms_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Domino Susun' AS gamename")
                     );
       $tbbgt = BgtRound::join('asta_db.bgt_round_player', 'asta_db.bgt_round_player.round_id', '=', 'asta_db.bgt_round.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.bgt_round_player.user_id')
                ->join('asta_db.bgt_table', 'asta_db.bgt_table.table_id', '=', 'asta_db.bgt_round.table_id')
                ->select(
                         'asta_db.bgt_round.gameplay_log as gameplay_log',
                         'asta_db.bgt_round.date As datetimeround',
                         'asta_db.bgt_table.name AS tablename',
                         'asta_db.bgt_round_player.bet as bet',
                         'asta_db.bgt_round_player.round_id as round_id',
                         'asta_db.bgt_round_player.win_lose as win_lose',
                         'asta_db.bgt_round_player.status as status',
                         'asta_db.bgt_round_player.hand_card as hand_card_round',
                         'asta_db.bgt_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Big Two' AS gamename")
                        );
       $tbtpk = TpkRound::join('asta_db.tpk_round_player', 'asta_db.tpk_round.round_id', '=', 'asta_db.tpk_round_player.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_round_player.user_id')
                ->join('asta_db.tpk_table', 'asta_db.tpk_table.table_id', '=', 'asta_db.tpk_round.table_id')
                ->select(
                         'asta_db.tpk_round.gameplay_log as gameplay_log',
                         'asta_db.tpk_round.date As datetimeround',
                         'asta_db.tpk_table.name AS tablename',
                         'asta_db.tpk_round_player.bet as bet',
                         'asta_db.tpk_round_player.round_id as round_id',
                         'asta_db.tpk_round_player.win_lose as win_lose',
                         'asta_db.tpk_round_player.status as status',
                         'asta_db.tpk_round_player.hand_card as hand_card_round',
                         'asta_db.tpk_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Texas Poker' AS gamename")
                        );
                        
       if($inputGame == 'Domino QQ'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.dmq_round.date';
              endif;
              $gettableroundplayer = 'dmq_round_player';
       elseif($inputGame == 'Domino Susun'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.dms_round.date';
              endif;
              $gettableroundplayer = 'dms_round_player';
       elseif($inputGame == 'Texas Poker'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.tpk_round.date';
              endif;
              $gettableroundplayer = 'tpk_round_player';
       elseif($inputGame == 'Big Two'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.bgt_round.date';
              endif;
              $gettableroundplayer = 'bgt_round_player';
       endif;

       
      if($inputName != NULL && $inputRoundID != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
              
       } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;

       } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);  
              endif;
       } else if ($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
      } else if($inputRoundID != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        
        if($inputGame == 'Domino QQ'):
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        elseif($inputGame == 'Domino Susun'):
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        elseif($inputGame == 'Texas Poker'):
        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        elseif($inputGame == 'Big Two'):
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        endif;
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
      } 
      else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if ($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
       $player_history->appends($request->all());
       return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));

      } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;

        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
    } else if($inputName != NULL && $inputGame != NULL) {

        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history  = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history  = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
    } else if($inputGame != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
       if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->orderby($namecolumn, $sorting)
                          ->paginate(20);
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->orderby($namecolumn, $sorting)
                          ->paginate(20);
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                           ->orderby($namecolumn, $sorting)
                           ->paginate(20);
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 13:39:00"])
                          ->orderby($namecolumn, $sorting)
                          ->paginate(20);
        }
        $player_history->appends($request->all());

       
       
        return view('pages.players.playreport', compact('player_history', 'player_username','inputMaxDate', 'inputMinDate', 'inputGame', 'menus1', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
    }
    
  }
}
