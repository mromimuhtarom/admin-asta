<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\BalanceGold;
use App\Classes\MenuClass;
use App\ConfigText;
use Validator;
use Illuminate\Support\Facades\Input;

class GoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datenow = Carbon::now('GMT+7');
      return view('pages.players.gold_player', compact('datenow'));
    }

    public function search(Request $request) 
    {
        $searchUser  = $request->inputPlayer;
        $minDate     = $request->inputMinDate;
        $maxDate     = $request->inputMaxDate;
        $sorting     = $request->sorting;
        $namecolumn  = $request->namecolumn;

        $menus1      = MenuClass::menuName('Balance Gold');
        $datenow     = Carbon::now('GMT+7');
        $balanceGold = BalanceGold::select(
                          'asta_db.balance_gold.debit',
                          'asta_db.balance_gold.credit',
                          'asta_db.balance_gold.balance',
                          'asta_db.balance_gold.datetime', 
                          'asta_db.user.username', 
                          'asta_db.balance_gold.user_id',
                          'asta_db.balance_gold.action_id'
                        )
                        ->JOIN('asta_db.user', 'asta_db.balance_gold.user_id', '=', 'asta_db.user.user_id');
        
        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required|date',
            'inputMaxDate'    => 'required|date',
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
        
        if($maxDate< $minDate){
          return back()->with('alert','End Date can\'t be less than start date');
        }

        // if sorting variable is null
        if($sorting == NULL):
          $sorting = 'desc';
        endif;

        if($namecolumn == NULL):
          $namecolumn = 'asta_db.balance_gold.datetime';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;
        
        $getMindate = Input::get('inputMinDate');
        $getMaxdate = Input::get('inputMaxDate');

        if(Input::get('sorting') === 'desc'):
          if(Input::get('namecolumn') === 'asta_db.balance_gold.user_id'):
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
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.action_id'):
            $action_id = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $user_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.debit'):
            $debit = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $user_id    = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.credit'):
            $credit = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $user_id    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.balance'):
            $balance = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.datetime'):
            $datetime = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $user_id  = 'fa fa-sort';
          endif; 
        elseif(Input::get('sorting') === 'asc'):
          if(Input::get('namecolumn') === 'asta_db.balance_gold.user_id'): 
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
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.action_id'): 
            $action_id = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $user_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.debit'): 
            $debit = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $user_id    = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.credit'): 
            $credit = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $user_id    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.balance'): 
            $balance = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
          elseif(Input::get('namecolumn') === 'asta_db.balance_gold.datetime'): 
            $datetime = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $user_id  = 'fa fa-sort';
          endif; 
        else:
         
            $user_id   = 'fa fa-sort';
            $username  = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';
        endif;

        if ($searchUser != NULL && $minDate != NULL && $maxDate!= NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->wherebetween('asta_db.balance_gold.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser )
                              ->wherebetween('asta_db.balance_gold.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy('asta_db.balance_gold.datetime', 'asc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1','datenow','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($searchUser != NULL && $minDate != NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                              ->WHERE('asta_db.balance_gold.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy('asta_db.balance_gold.datetime', 'asc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser)
                              ->WHERE('asta_db.balance_gold.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy('asta_db.balance_gold.datetime', 'asc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($searchUser != NULL && $maxDate!= NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                              ->WHERE('asta_db.balance_gold.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy('asta_db.balance_gold.datetime', 'desc')
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser)
                              ->WHERE('asta_db.balance_gold.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy('asta_db.balance_gold.datetime', 'desc')
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($minDate != NULL && $maxDate!= NULL){

          $balancedetails = $balanceGold->wherebetween('asta_db.balance_gold.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($searchUser != NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($minDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.datetime', '>=', $minDate." 00:00:00")
                            ->orderBy('asta_db.balance_gold.datetime', 'asc')
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($maxDate!= NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.datetime', '<=', $maxDate." 23:59:59")
                            ->orderBy('asta_db.balance_gold.datetime', 'desc')
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'action_id', 'debit', 'credit', 'balance', 'datetime'));


        }
    }
    
}
