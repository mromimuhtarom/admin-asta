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
      $datenow      = Carbon::now('GMT+7');
      $menus1       = MenuClass::menuName('Report');
      $game         = Game::all();
      
       $validator = Validator::make($request->all(),[
              'inputMinDate' => 'required|date',
              'inputMaxDate' => 'required|date',
       ]);
    
       if ($validator->fails()) {
              return back()->withErrors($validator->errors());
       }

      if($inputMaxDate < $inputMinDate){
       return back()->with('alert','End Date can\'t be less than start date');
      }

      $tbdmq = DmqRound::join('asta_db.dmq_round_player', 'asta_db.dmq_round_player.round_id', '=', 'asta_db.dmq_round.round_id')
               ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dmq_round_player.user_id')
               ->join('asta_db.dmq_table', 'asta_db.dmq_table.table_id', '=', 'asta_db.dmq_round.table_id')
               ->select('asta_db.dmq_round.gameplay_log',
                        'asta_db.dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'asta_db.dmq_round_player.bet', 
                        'asta_db.dmq_round_player.win_lose',
                        'asta_db.dmq_round_player.round_id', 
                        'asta_db.dmq_round_player.status', 
                        'asta_db.dmq_round_player.hand_card',
                        'asta_db.dmq_round_player.seat_id', 
                        'asta_db.user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                       );
       $tbdms = DmsRound::join('asta_db.dms_round_player', 'asta_db.dms_round_player.round_id', '=', 'asta_db.dms_round.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dms_round_player.user_id')
                ->join('asta_db.dms_table', 'asta_db.dms_table.table_id', '=', 'asta_db.dms_round.table_id')
                ->select('asta_db.dms_round.gameplay_log',
                         'asta_db.dms_round.date',
                         'asta_db.dms_table.name AS tablename',
                         'asta_db.dms_round_player.bet',
                         'asta_db.dms_round_player.win_lose',
                         'asta_db.dms_round_player.round_id',
                         'asta_db.dms_round_player.status',
                         'asta_db.dms_round_player.hand_card',
                         'asta_db.dms_round_player.seat_id',
                         'asta_db.user.username',
                         DB::raw("'Domino Susun' AS gamename")
                     );
       $tbtpk = TpkRound::join('asta_db.tpk_round_player', 'asta_db.tpk_round_player.round_id', '=', 'asta_db.tpk_round.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_round_player.user_id')
                ->join('asta_db.tpk_table', 'asta_db.tpk_table.table_id', '=', 'asta_db.tpk_round.table_id')
                ->select('asta_db.tpk_round.gameplay_log',
                         'asta_db.tpk_round.date',
                         'asta_db.tpk_table.name AS tablename',
                         'asta_db.tpk_round_player.bet',
                         'asta_db.tpk_round_player.round_id',
                         'asta_db.tpk_round_player.win_lose',
                         'asta_db.tpk_round_player.status',
                         'asta_db.tpk_round_player.hand_card',
                         'asta_db.tpk_round_player.seat_id',
                         'asta_db.user.username',
                         DB::raw("'Texas Poker' AS gamename")
                        );

       $tbbgt = BgtRound::join('asta_db.bgt_round_player', 'asta_db.bgt_round_player.round_id', '=', 'asta_db.bgt_round.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.bgt_round_player.user_id')
                ->join('asta_db.bgt_table', 'asta_db.bgt_table.table_id', '=', 'asta_db.bgt_round.table_id')
                ->select('asta_db.bgt_round.gameplay_log',
                         'asta_db.bgt_round.date',
                         'asta_db.bgt_round_player.round_id',
                         'asta_db.bgt_table.name AS tablename',
                         'asta_db.bgt_round_player.bet',
                         'asta_db.bgt_round_player.win_lose',
                         'asta_db.bgt_round_player.status',
                         'asta_db.bgt_round_player.hand_card',
                         'asta_db.bgt_round_player.seat_id',
                         'asta_db.user.username',
                         DB:: raw("'Big Two' AS gamename")
                        );

      if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->get();
        } else if ($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        }

        return view('pages.players.playreport', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
        $dmq = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $dms = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $tpk = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
    } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
              ->get();
        } else if($inputGame == 'Domino Susun') {

        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->get();
        } else if($inputGame == 'Texas Poker') {

        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->get();
        } else if($inputGame == 'Big Two') {

        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->get();
        }
       return view('pages.players.playreport', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
     } else if($inputName != NULL && $inputMinDate != NULL ) {
        $dmq = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $dms = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $tpk = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
    } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
              ->get();
        } else if($inputGame == 'Domino Susun') {

        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->get();
        } else if($inputGame == 'Texas Poker') {

        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->get();
        }

          return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL && $inputMaxDate != NULL) {
        $dmq = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $dms = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $tpk = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
               ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL && $inputGame != NULL) {

        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                           ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        }

          return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputGame != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                           ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        }

          return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
    }
    else if ($inputMinDate != NULL && $inputMaxDate != NULL) {
        $dmq = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $dms = $tbdms->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $tpk = $tbtpk->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $player_history = $tbbgt->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();
       
          return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL) {
        $dmq = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%');

        $dms = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%');

        $tpk = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%');

        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

          return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->get();
        }

         return view('pages.players.playreport', compact('player_history', 'menus1', 'game', 'datenow'));
   } 

  }
}
