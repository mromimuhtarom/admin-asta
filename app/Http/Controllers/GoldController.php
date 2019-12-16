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

    public function registerplayergold(Request $request)
    {
        $searchUser  = $request->inputPlayer;
        $sorting     = $request->sorting;
        $namecolumn  = $request->namecolumn;

        $menus1      = MenuClass::menuName('Balance Gold');
        $datenow     = Carbon::now('GMT+7');

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
          $actionbalance[12] => $actionbalance[13]
        ];
        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

        if($namecolumn == NULL):
          $namecolumn = 'asta_db.balance_gold.datetime';
        endif;
        if($sorting == NULL):
          $sorting = 'desc';
        endif;
        
        $getMindate     = Input::get('inputMinDate');
        $getMaxdate     = Input::get('inputMaxDate');
        $getusername    = Input::get('inputPlayer');
        $balancedetails = BalanceGold::select(
                          'asta_db.balance_gold.debit',
                          'asta_db.balance_gold.credit',
                          'asta_db.balance_gold.balance',
                          'asta_db.balance_gold.datetime', 
                          'asta_db.user.username', 
                          'asta_db.balance_gold.user_id',
                          'asta_db.balance_gold.action_id'
                        )
                        ->JOIN('asta_db.user', 'asta_db.balance_gold.user_id', '=', 'asta_db.user.user_id')
                        ->WHERE('asta_db.balance_gold.user_id', '=', $searchUser )
                        ->orderBy($namecolumn, $sorting)
                        ->paginate(20);

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1','datenow','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername'));
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
        $getusername = Input::get('inputPlayer');

        if ($searchUser != NULL && $minDate != NULL && $maxDate!= NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->wherebetween('asta_db.balance_gold.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser )
                              ->wherebetween('asta_db.balance_gold.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1','datenow','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername'));

        }else if ($searchUser != NULL && $minDate != NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                              ->WHERE('asta_db.balance_gold.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser)
                              ->WHERE('asta_db.balance_gold.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername'));

        }else if ($searchUser != NULL && $maxDate!= NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                              ->WHERE('asta_db.balance_gold.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser)
                              ->WHERE('asta_db.balance_gold.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'getusername'));

        }else if ($minDate != NULL && $maxDate!= NULL){

          $balancedetails = $balanceGold->wherebetween('asta_db.balance_gold.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'getusername'));

        }else if ($searchUser != NULL){

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.user_id', '=', $searchUser)
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'getusername'));

        }else if ($minDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.datetime', '>=', $minDate." 00:00:00")
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'getusername'));

        }else if ($maxDate!= NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.datetime', '<=', $maxDate." 23:59:59")
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc','sortingorder', 'getMaxdate', 'getMindate', 'getusername'));


        }
    }
    
}
