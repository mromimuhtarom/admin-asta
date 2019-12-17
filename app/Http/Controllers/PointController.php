<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BalancePoint;
use App\Game;
use Carbon\Carbon;
use Validator;
use App\ConfigText;
use DB;
use App\Classes\MenuClass;
use Illuminate\Support\Facades\Input;

class PointController extends Controller
{
    public function index()
    {
        $game    = Game::all();
        $datenow = Carbon::now('GMT+7');
        return view('pages.players.point_player', compact('game', 'game', 'datenow'));
    }

    public function registerplayerpoint(Request $request)
    {
        $searchUser = $request->inputPlayer;
        $sorting    = $request->sorting;
        $namecolumn = $request->namecolumn;
        $datenow    = Carbon::now('GMT+7');
        $game       = Game::all();
        $action     = ConfigText::select(
                        'name',
                        'value'
                       ) 
                       ->where('id', '=', 11)
                       ->first();
        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
          $actionbalance[0]  => $actionbalance[1],
          $actionbalance[2]  => $actionbalance[3],
          $actionbalance[4]  => $actionbalance[5],
          $actionbalance[6]  => $actionbalance[7],
          $actionbalance[8]  => $actionbalance[9],
          $actionbalance[10] => $actionbalance[11],
          $actionbalance[12] => $actionbalance[13],
          $actionbalance[14] => $actionbalance[15],
          $actionbalance[16] => $actionbalance[17],
          $actionbalance[18] => $actionbalance[19]
        ];

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;
        if($sorting == NULL):
            $sorting = 'desc';
        endif;

        if($namecolumn == NULL):
            $namecolumn = 'asta_db.balance_point.datetime';
        endif;

        $getMindate  = Input::get('inputMinDate');
        $getMaxdate  = Input::get('inputMaxDate');
        $getUsername = Input::get('inputPlayer');
        $getGame     = Input::get('inputGame');
        $balancedetails = BalancePoint::JOIN('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.balance_point.user_id')
                        ->leftJOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_point.game_id')
                        ->select(
                            'asta_db.user.username', 
                            'asta_db.balance_point.action_id', 
                            'asta_db.game.name as gamename', 
                            'asta_db.balance_point.debit',
                            'asta_db.balance_point.credit',
                            'asta_db.balance_point.balance',
                            'asta_db.balance_point.datetime',
                            'asta_db.balance_point.user_id'
                        )
                        ->where('asta_db.balance_point.user_id', '=', $searchUser)
                        ->orderby($namecolumn, $sorting)
                        ->paginate(20);

            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails','datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'sortingorder', 'getMaxdate', 'getMindate', 'getUsername', 'getGame'));

    }

    public function search(Request $request)
    {
        $searchUser   = $request->inputPlayer;
        $gameName     = $request->inputGame;
        $minDate      = $request->inputMinDate;
        $maxDate      = $request->inputMaxDate;
        $sorting      = $request->sorting;
        $namecolumn   = $request->namecolumn;

        $datenow      = Carbon::now('GMT+7');
        $game         = Game::all();
        $balancePoint = BalancePoint::JOIN('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.balance_point.user_id')
                        ->leftJOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_point.game_id')
                        ->select(
                            'asta_db.user.username', 
                            'asta_db.balance_point.action_id', 
                            'asta_db.game.name as gamename', 
                            'asta_db.balance_point.debit',
                            'asta_db.balance_point.credit',
                            'asta_db.balance_point.balance',
                            'asta_db.balance_point.datetime',
                            'asta_db.balance_point.user_id'
                        );
        
        $validator = Validator::make($request->all(),[
            'inputMinDate'   => 'required',
            'inputMaxDate'   => 'required',
        ]);

        $action      = ConfigText::select(
                        'name',
                        'value'
                       ) 
                       ->where('id', '=', 11)
                       ->first();
        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
          $actionbalance[0]  => $actionbalance[1],
          $actionbalance[2]  => $actionbalance[3],
          $actionbalance[4]  => $actionbalance[5],
          $actionbalance[6]  => $actionbalance[7],
          $actionbalance[8]  => $actionbalance[9],
          $actionbalance[10] => $actionbalance[11],
          $actionbalance[12] => $actionbalance[13],
          $actionbalance[14] => $actionbalance[15],
          $actionbalance[16] => $actionbalance[17],
          $actionbalance[18] => $actionbalance[19]
        ];

        // if sorting variable is null
        if($sorting == NULL):
            $sorting = 'desc';
        endif;

        if($namecolumn == NULL):
            $namecolumn = 'asta_db.balance_point.datetime';
        endif;

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;

        $getMindate  = Input::get('inputMinDate');
        $getMaxdate  = Input::get('inputMaxDate');
        $getUsername = Input::get('inputPlayer');
        $getGame     = Input::get('inputGame');
            

        if($searchUser != NULL && $gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            if(is_numeric($searchUser) !== true):
                $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                  ->where('asta_db.balance_point.game_id', '=', $gameName)
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby($namecolumn, $sorting)
                                  ->paginate(20);
            else:
                $balancedetails = $balancePoint->where('asta_db.balance_point.user_id', '=', $searchUser)
                                  ->where('asta_db.balance_point.game_id', '=', $gameName)
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby($namecolumn, $sorting)
                                  ->paginate(20);
            endif;

            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails','datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'sortingorder', 'getMaxdate', 'getMindate', 'getUsername', 'getGame'));
        } else if($searchUser != NULL && $minDate != NULL && $maxDate != NULL) {
            if(is_numeric($searchUser) !== true):
                $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby($namecolumn, $sorting)
                                  ->paginate(20);
            else:
                $balancedetails = $balancePoint->where('asta_db.balance_point.user_id', '=', $searchUser)
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby($namecolumn, $sorting)
                                  ->paginate(20);
            endif;

            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'sortingorder', 'getMaxdate', 'getMindate', 'getUsername', 'getGame'));
        } else if($gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.balance_point.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby($namecolumn, $sorting)
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'sortingorder', 'getMaxdate', 'getMindate', 'getUsername', 'getGame'));
        } else if($minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby($namecolumn, $sorting)
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'sortingorder', 'getMaxdate', 'getMindate', 'getUsername', 'getGame'));
        } else {
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
        
            if($maxDate < $minDate){
                return back()->with('alert','End Date can\'t be less than start date');
            }          
        }
    }
}
