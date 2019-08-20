<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\BalanceGold;
use App\Classes\MenuClass;
use App\ConfigText;
use Validator;

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
        $searchPlayer = $request->inputPlayer;
        $startDate    = $request->inputMinDate;
        $endDate      = $request->inputMaxDate;
        $menus1       = MenuClass::menuName('Balance Gold');
        $datenow      = Carbon::now('GMT+7');
        $balanceGold  = BalanceGold::select(
                          'asta_db.balance_gold.debit',
                          'asta_db.balance_gold.credit',
                          'asta_db.balance_gold.balance',
                          'asta_db.balance_gold.datetime', 
                          'asta_db.user.username', 
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
        
        if($endDate < $startDate){
          return back()->with('alert','End Date can\'t be less than start date');
        }

        if ($searchPlayer != NULL && $startDate != NULL && $endDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->wherebetween('asta_db.balance_gold.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('asta_db.balance_gold.datetime', 'asc')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1','datenow','actblnc'));

        }else if ($searchPlayer != NULL && $startDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%')
                            ->WHERE('asta_db.balance_gold.datetime', '>=', $startDate." 00:00:00")
                            ->orderBy('asta_db.balance_gold.datetime', 'asc')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc'));

        }else if ($searchPlayer != NULL && $endDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%')
                            ->WHERE('asta_db.balance_gold.datetime', '<=', $endDate." 23:59:59")
                            ->orderBy('asta_db.balance_gold.datetime', 'desc')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc'));

        }else if ($startDate != NULL && $endDate != NULL){

          $balancedetails = $balanceGold->wherebetween('asta_db.balance_gold.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('asta_db.balance_gold.datetime', 'asc')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc'));

        }else if ($searchPlayer != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc'));

        }else if ($startDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.datetime', '>=', $startDate." 00:00:00")
                            ->orderBy('asta_db.balance_gold.datetime', 'asc')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc'));

        }else if ($endDate != NULL){

          $balancedetails = $balanceGold->WHERE('asta_db.balance_gold.datetime', '<=', $endDate." 23:59:59")
                            ->orderBy('asta_db.balance_gold.datetime', 'desc')
                            ->get();

          return view('pages.players.gold_player', compact('balancedetails', 'menus1', 'datenow','actblnc'));


        }
    }
    
}
