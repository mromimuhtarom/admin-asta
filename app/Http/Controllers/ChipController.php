<?php

namespace App\Http\Controllers;

use App\BalanceChip;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Game;
use App\Classes\MenuClass;
use Validator;
use App\ConfigText;

class ChipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datenow = Carbon::now('GMT+7');
      $game    = Game::all();
      return view('pages.players.chip_player', compact('datenow', 'game'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $searchUser = $request->inputPlayer;
        $minDate    = $request->inputMinDate;
        $maxDate      = $request->inputMaxDate;
        $gameName     = $request->inputGame;
        $menus1       = MenuClass::menuName('Balance Chip');
        $game         = Game::all();
        $datenow      = Carbon::now('GMT+7');
        $action       = ConfigText::select(
                          'name',
                          'value'
                        ) 
                        ->where('id', '=', 11)
                        ->first();
        $balanceChip  = BalanceChip::select(
                          'asta_db.balance_chip.debit',
                          'asta_db.balance_chip.credit',
                          'asta_db.balance_chip.balance',
                          'asta_db.balance_chip.datetime', 
                          'asta_db.user.username', 
                          'asta_db.balance_chip.user_id',
                          'asta_db.game.name as gamename', 
                          'asta_db.balance_chip.action_id'
                        )
                        ->JOIN('asta_db.user', 'asta_db.balance_chip.user_id', '=', 'asta_db.user.user_id')
                        ->JOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_chip.game_id');
        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
          $actionbalance[0]  => $actionbalance[1] ,
          $actionbalance[2]  => $actionbalance[3] ,
          $actionbalance[4]  => $actionbalance[5] ,
          $actionbalance[6]  => $actionbalance[7] ,
          $actionbalance[8]  => $actionbalance[9] 
        ];
        if($maxDate < $minDate){
          return back()->with('alert','End Date can\'t be less than start date');
        }
        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required|date',
            'inputMaxDate'    => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($searchUser != NULL && $gameName != NULL && $minDate != NULL && $maxDate != NULL){
          if(is_numeri($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if($searchUser != NULL && $gameName != NULL && $minDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if($searchUser != NULL && $gameName != NULL && $maxDate != NULL) {
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser)
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if($searchUser != NULL && $gameName != NULL) {
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if($gameName != NULL && $minDate != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->paginate(20);

          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if($gameName != NULL && $maxDate != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->get();
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if ($searchUser != NULL && $minDate != NULL && $maxDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        }else if ($searchUser != NULL && $minDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);  
          else:  
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow','game','actblnc'));

        }else if ($searchUser != NULL && $maxDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy('asta_db.balance_chip.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow','game','actblnc'));

        }else if ($minDate != NULL && $maxDate != NULL){
          $balancedetails = $balanceChip->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow','game','actblnc'));

        }else if ($searchUser != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow','game','actblnc'));

        } else if($gameName != NULL) {
          $balancedetails = $balanceChip->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc'));
        } else if ($minDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow','game','actblnc'));

        }else if ($maxDate != NULL){
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow','game','actblnc'));


        }

    }
}
