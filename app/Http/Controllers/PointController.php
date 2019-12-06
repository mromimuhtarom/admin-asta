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

    public function search(Request $request)
    {
        $username     = $request->inputPlayer;
        $gameName     = $request->inputGame;
        $minDate      = $request->inputMinDate;
        $maxDate      = $request->inputMaxDate;
        $sorting      = $request->sorting;
        $namecolumn   = $request->namecolumn;

        $datenow      = Carbon::now('GMT+7');
        $game         = Game::all();
        $balancePoint = BalancePoint::JOIN('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.balance_point.user_id')
                        ->JOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_point.game_id')
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
          $actionbalance[0]  => $actionbalance[1] ,
          $actionbalance[2]  => $actionbalance[3] ,
          $actionbalance[4]  => $actionbalance[5] ,
          $actionbalance[6]  => $actionbalance[7] ,
          $actionbalance[8]  => $actionbalance[9] 
        ];

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        if($maxDate < $minDate){
            return back()->with('alert','End Date can\'t be less than start date');
        }

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

        $getMindate = Input::get('inputMinDate');
        $getMaxdate = Input::get('inputMaxDate');

        if(Input::get('sorting') === 'desc'):
            if(Input::get('namecolumn') === 'asta_db.balance_point.user_id'):
              $user_id = 'fa fa-sort-desc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.user.username'):
              $username = 'fa fa-sort-desc';
              $user_id  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.action_id'):
              $action_id = 'fa fa-sort-desc';
              $username  = 'fa fa-sort';
              $user_id   = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.debit'):
              $debit = 'fa fa-sort-desc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $user_id    = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.credit'):
              $credit = 'fa fa-sort-desc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $user_id    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.balance'):
              $balance = 'fa fa-sort-desc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $user_id   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.datetime'):
              $datetime = 'fa fa-sort-desc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $user_id  = 'fa fa-sort';
            endif; 
          elseif(Input::get('sorting') === 'asc'):
            if(Input::get('namecolumn') === 'asta_db.balance_point.user_id'): 
              $user_id = 'fa fa-sort-asc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.user.username'): 
              $username = 'fa fa-sort-asc';
              $user_id  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.action_id'): 
              $action_id = 'fa fa-sort-asc';
              $username  = 'fa fa-sort';
              $user_id   = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.debit'): 
              $debit = 'fa fa-sort-asc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $user_id    = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.credit'): 
              $credit = 'fa fa-sort-asc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $user_id    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.balance'): 
              $balance = 'fa fa-sort-asc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $user_id   = 'fa fa-sort';
              $datetime  = 'fa fa-sort';
            elseif(Input::get('namecolumn') === 'asta_db.balance_point.datetime'): 
              $datetime = 'fa fa-sort-asc';
              $username  = 'fa fa-sort';
              $action_id = 'fa fa-sort';
              $debit     = 'fa fa-sort';
              $credit    = 'fa fa-sort';
              $balance   = 'fa fa-sort';
              $user_id  = 'fa fa-sort';
            endif; 
          else:
            $datetime = 'fa fa-sort';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $user_id  = 'fa fa-sort';
          endif;
            

        if($username != NULL && $gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            if(is_numeric($username) !== true):
                $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                  ->where('asta_db.balance_point.game_id', '=', $gameName)
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby('asta_db.balance_point.datetime', 'desc')
                                  ->paginate(20);
            else:
                $balancedetails = $balancePoint->where('asta_db.balance_point.user_id', '=', $username)
                                  ->where('asta_db.balance_point.game_id', '=', $gameName)
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby('asta_db.balance_point.datetime', 'desc')
                                  ->paginate(20);
            endif;

            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails','datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        } else if($username != NULL && $minDate != NULL && $maxDate != NULL) {
            if(is_numeric($username) !== true):
                $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby('asta_db.balance_point.datetime', 'desc')
                                  ->paginate(20);
            else:
                $balancedetails = $balancePoint->where('asta_db.balance_point.user_id', '=', $username)
                                  ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                  ->orderby('asta_db.balance_point.datetime', 'desc')
                                  ->paginate(20);
            endif;

            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        } else if($gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.balance_point.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby('asta_db.balance_point.datetime', 'desc')
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        } else if($minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby('asta_db.balance_point.datetime', 'desc')
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        } else {
            return back();            
        }
    }
}
