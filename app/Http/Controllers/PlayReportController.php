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

class PlayReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
      $datenow      = Carbon::now('GMT+7');
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
       return back()->with('alert','End Date can\'t be less than start date');
      }

      $player_username = Player::select('user_id', 'username')->get();

      
      $tbdmq = DmqRound::join('asta_db.dmq_round_player', 'asta_db.dmq_round_player.round_id', '=', 'asta_db.dmq_round.round_id')
               ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dmq_round_player.user_id')
               ->join('asta_db.dmq_table', 'asta_db.dmq_table.table_id', '=', 'asta_db.dmq_round.table_id')
               ->select(
                         'asta_db.dmq_round.gameplay_log',
                         'asta_db.dmq_round.date',
                         'asta_db.dmq_table.name AS tablename',
                         'asta_db.dmq_round_player.bet',
                         'asta_db.dmq_round_player.round_id',
                         'asta_db.dmq_round_player.win_lose',
                         'asta_db.dmq_round_player.status',
                         'asta_db.dmq_round_player.hand_card',
                         'asta_db.dmq_round_player.seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                        DB::raw("'Domino QQ' AS gamename") 
                       );
       $tbdms = DmsRound::join('asta_db.dms_round_player', 'asta_db.dms_round.round_id', '=', 'asta_db.dms_round_player.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dms_round_player.user_id')
                ->join('asta_db.dms_table', 'asta_db.dms_table.table_id', '=', 'asta_db.dms_round.table_id')
                ->select(
                         'asta_db.dms_round.gameplay_log',
                         'asta_db.dms_round.date',
                         'asta_db.dms_table.name AS tablename',
                         'asta_db.dms_round_player.bet',
                         'asta_db.dms_round_player.round_id',
                         'asta_db.dms_round_player.win_lose',
                         'asta_db.dms_round_player.status',
                         'asta_db.dms_round_player.hand_card',
                         'asta_db.dms_round_player.seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Domino Susun' AS gamename")
                     );
       $tbbgt = BgtRound::join('asta_db.bgt_round_player', 'asta_db.bgt_round_player.round_id', '=', 'asta_db.bgt_round.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.bgt_round_player.user_id')
                ->join('asta_db.bgt_table', 'asta_db.bgt_table.table_id', '=', 'asta_db.bgt_round.table_id')
                ->select(
                         'asta_db.bgt_round.gameplay_log',
                         'asta_db.bgt_round.date',
                         'asta_db.bgt_table.name AS tablename',
                         'asta_db.bgt_round_player.bet',
                         'asta_db.bgt_round_player.round_id',
                         'asta_db.bgt_round_player.win_lose',
                         'asta_db.bgt_round_player.status',
                         'asta_db.bgt_round_player.hand_card',
                         'asta_db.bgt_round_player.seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Big Two' AS gamename")
                        );
       $tbtpk = TpkRound::join('asta_db.tpk_round_player', 'asta_db.tpk_round.round_id', '=', 'asta_db.tpk_round_player.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_round_player.user_id')
                ->join('asta_db.tpk_table', 'asta_db.tpk_table.table_id', '=', 'asta_db.tpk_round.table_id')
                ->select(
                         'asta_db.tpk_round.gameplay_log',
                         'asta_db.tpk_round.date',
                         'asta_db.tpk_table.name AS tablename',
                         'asta_db.tpk_round_player.bet',
                         'asta_db.tpk_round_player.round_id',
                         'asta_db.tpk_round_player.win_lose',
                         'asta_db.tpk_round_player.status',
                         'asta_db.tpk_round_player.hand_card',
                         'asta_db.tpk_round_player.seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Texas Poker' AS gamename")
                        );

      if($inputName != NULL && $inputRoundID != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       if($inputGame == 'Domino QQ') {
       $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
              ->paginate(20);
       } else if($inputGame == 'Domino Susun') {
       $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
              ->paginate(20);
       } else if($inputGame == 'Texas Poker') {
       $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
              ->paginate(20);
       } else if ($inputGame == 'Big Two') {
       $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
              ->paginate(20);
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
      } else if($inputRoundID != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ'):
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
              ->paginate(20);
        elseif($inputGame == 'Dmino Susun'):
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
              ->paginate(20);
       //  elseif():
        endif;
      } 
      else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->paginate(20);
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->paginate(20);
        } else if($inputGame == 'Texas Poker') {
        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->paginate(20);
        } else if ($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->paginate(20);
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
              ->paginate(20);
        } else if($inputGame == 'Domino Susun') {

        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->paginate(20);
        } else if($inputGame == 'Texas Poker') {

        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->paginate(20);
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->paginate(20);
        }
       $player_history->appends($request->all());
       return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
     } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
              ->paginate(20);
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->paginate(20);
        } else if($inputGame == 'Texas Poker') {
        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->paginate(20);
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->paginate(20);
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL && $inputGame != NULL) {

        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->paginate(20);
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->paginate(20);
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                           ->paginate(20);
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->paginate(20);
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'game', 'datenow'));
    } else if($inputGame != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
       if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->paginate(20);
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->paginate(20);
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                           ->paginate(20);
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 13:39:00"])
                          ->paginate(20);
        }
        $player_history->appends($request->all());

       
       
        return view('pages.players.playreport', compact('player_history', 'player_username', 'bgt_round_gamplay_log','inputMaxDate', 'inputMinDate', 'inputGame', 'menus1', 'game', 'datenow'));
    }
    
  }
}
