<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Classes\MenuClass;

class PlayReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = DB::table('game')->get();
        return view('pages.players.playreport', compact('game'));
    }




    public function search(Request $request)
    {

      $inputName    = $request->inputPlayer;
      $inputMinDate = $request->inputMinDate;
      $inputGame    = $request->inputGame;
      $inputMaxDate = $request->inputMaxDate;

      $menus1 = MenuClass::menuName('Report');
      $game = DB::table('game')->get();
      if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->get();
        } else if($inputGame == 'Domino susun') {
        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->get();
        } else if($inputGame == 'Texas Poker') {
        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->get();
        } else if ($inputGame == 'Big Two') {
        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        }

        return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
    } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
              ->get();
        } else if($inputGame == 'Domino susun') {

        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->get();
        } else if($inputGame == 'Texas Poker') {

        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->get();
        } else if($inputGame == 'Big Two') {

        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->get();
        }
       return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
     } else if($inputName != NULL && $inputMinDate != NULL ) {
        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
    } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {

        if($inputGame == 'Domino QQ') {
        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
              ->get();
        } else if($inputGame == 'Domino susun') {

        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->get();
        } else if($inputGame == 'Texas Poker') {

        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->get();
        }

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game'));
    } else if($inputName != NULL && $inputMaxDate != NULL) {
        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game'));
    } else if($inputName != NULL && $inputGame != NULL) {


        if($inputGame == 'Domino QQ') {
        $player_history = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->get();
        } else if($inputGame == 'Domino susun') {
        $player_history = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history  = DB::table('tpk_round')
                           ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
                           ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
                           ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
                           ->select('tpk_round.gameplay_log',
                                    'tpk_round.date',
                                    'tpk_table.name AS tablename',
                                    'tpk_round_player.bet',
                                    'tpk_round_player.win_lose',
                                    'tpk_round_player.status',
                                    'tpk_round_player.hand_card',
                                    'tpk_round_player.seatid',
                                    'user.username',
                                    DB::raw("'Texas Poker' AS gamename")
                                   )
                           ->where('user.username', 'LIKE', '%'.$inputName.'%')
                           ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        }

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game'));
    } else if($inputName != NULL) {

        $dmq = DB::table('dmq_round')
               ->join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
               ->join('user', 'user.user_id', '=', 'dmq_round_player.user_id')
               ->join('dmq_table', 'dmq_table.tableid', '=', 'dmq_round.tableid')
               ->select('dmq_round.gameplay_log',
                        'dmq_round.date', 
                        'dmq_table.name as tablename', 
                        'dmq_round_player.bet', 
                        'dmq_round_player.win_lose', 
                        'dmq_round_player.status', 
                        'dmq_round_player.hand_card',
                        'dmq_round_player.seatid', 
                        'user.username',
                        DB::raw("'Domino QQ' AS gamename") 
                        )
              ->where('user.username', 'LIKE', '%'.$inputName.'%');

        $dms = DB::table('dms_round')
               ->join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
               ->join('user', 'user.user_id', '=', 'dms_round_player.user_id')
               ->join('dms_table', 'dms_table.tableid', '=', 'dms_round.tableid')
               ->select('dms_round.gameplay_log',
                        'dms_round.date',
                        'dms_table.name AS tablename',
                        'dms_round_player.bet',
                        'dms_round_player.win_lose',
                        'dms_round_player.status',
                        'dms_round_player.hand_card',
                        'dms_round_player.seatid',
                        'user.username',
                        DB::raw("'Domino susun' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%');

        $tpk = DB::table('tpk_round')
               ->join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
               ->join('user', 'user.user_id', '=', 'tpk_round_player.user_id')
               ->join('tpk_table', 'tpk_table.tableid', '=', 'tpk_round.tableid')
               ->select('tpk_round.gameplay_log',
                        'tpk_round.date',
                        'tpk_table.name AS tablename',
                        'tpk_round_player.bet',
                        'tpk_round_player.win_lose',
                        'tpk_round_player.status',
                        'tpk_round_player.hand_card',
                        'tpk_round_player.seatid',
                        'user.username',
                        DB::raw("'Texas Poker' AS gamename")
                       )
               ->where('user.username', 'LIKE', '%'.$inputName.'%');

        $player_history = DB::table('bgt_round')
                          ->join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
                          ->join('user', 'user.user_id', '=', 'bgt_round_player.user_id')
                          ->join('bgt_table', 'bgt_table.tableid', '=', 'bgt_round.tableid')
                          ->select('bgt_round.gameplay_log',
                                   'bgt_round.date',
                                   'bgt_table.name AS tablename',
                                   'bgt_round_player.bet',
                                   'bgt_round_player.win_lose',
                                   'bgt_round_player.status',
                                   'bgt_round_player.hand_card',
                                   'bgt_round_player.seatid',
                                   'user.username',
                                   DB:: raw("'Big Two' AS gamename")
                                  )
                          ->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game'));
    } 

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
