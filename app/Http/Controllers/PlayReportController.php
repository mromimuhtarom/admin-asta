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
              return self::index()->withErrors($validator->errors());
       }

      if($inputMaxDate < $inputMinDate){
       return back()->with('alert','End Date can\'t be less than start date');
      }

      $tbdmq = DmqRound::join('dmq_round_player', 'dmq_round_player.roundid', '=', 'dmq_round.roundid')
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
                       );
       $tbdms = DmsRound::join('dms_round_player', 'dms_round_player.roundid', '=', 'dms_round.roundid')
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
                         DB::raw("'Domino Susun' AS gamename")
                     );
       $tbtpk = TpkRound::join('tpk_round_player', 'tpk_round_player.roundid', '=', 'tpk_round.roundid')
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
                        );

       $tbbgt = BgtRound::join('bgt_round_player', 'bgt_round_player.roundid', '=', 'bgt_round.roundid')
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
                        );

      if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
               ->get();
        } else if ($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        }

        return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
        $dmq = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $dms = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $tpk = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->wherebetween('tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
    } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
       dd($inputGame);
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
              ->get();
        } else if($inputGame == 'Domino Susun') {

        $player_history = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->get();
        } else if($inputGame == 'Texas Poker') {

        $player_history = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
               ->get();
        } else if($inputGame == 'Big Two') {

        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->get();
        }
       return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
     } else if($inputName != NULL && $inputMinDate != NULL ) {
        $dmq = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $dms = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $tpk = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00");

        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '>=', $inputMinDate." 00:00:00")
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'datenow'));
    } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
              ->get();
        } else if($inputGame == 'Domino Susun') {

        $player_history = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->get();
        } else if($inputGame == 'Texas Poker') {

        $player_history = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
               ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->get();
        }

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL && $inputMaxDate != NULL) {
        $dmq = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
              ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $dms = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $tpk = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
               ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59");

        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->where('dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

      return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL && $inputGame != NULL) {

       dd($inputGame);
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%')
                           ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->get();
        }

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputGame != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
        if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->wherebetween('dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->wherebetween('dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->wherebetween('tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                           ->get();
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->wherebetween('bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->get();
        }

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
    }
    else if ($inputMinDate != NULL && $inputMaxDate != NULL) {
        $dmq = $tbdmq->wherebetween('dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $dms = $tbdms->wherebetween('dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $tpk = $tbtpk->wherebetween('tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"]);

        $player_history = $tbbgt->wherebetween('bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();
       
          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
    } else if($inputName != NULL) {
        $dmq = $tbdmq->where('user.username', 'LIKE', '%'.$inputName.'%');

        $dms = $tbdms->where('user.username', 'LIKE', '%'.$inputName.'%');

        $tpk = $tbtpk->where('user.username', 'LIKE', '%'.$inputName.'%');

        $player_history = $tbbgt->where('user.username', 'LIKE', '%'.$inputName.'%')
                          ->union($dmq)
                          ->union($dms)
                          ->union($tpk)
                          ->get();

          return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
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

         return view('pages.players.playreport_detail', compact('player_history', 'menus1', 'game', 'datenow'));
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
