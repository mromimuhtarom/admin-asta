<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\BalanceGold;
use App\Classes\MenuClass;

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
        $balanceGold  = BalanceGold::select('balance_gold.*', 'user.username')
                        ->JOIN('user', 'balance_gold.playerId', '=', 'user.user_id');
        if ($searchPlayer != NULL && $startDate != NULL && $endDate != NULL){

          $balancedetails = $balanceGold->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1','datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($searchPlayer != NULL && $startDate != NULL){

          $balancedetails = $balanceGold->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%')
                            ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($searchPlayer != NULL && $endDate != NULL){

          $balancedetails = $balanceGold->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%')
                            ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                            ->orderBy('timestamp', 'desc')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($startDate != NULL && $endDate != NULL){

          $balancedetails = $balanceGold->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($searchPlayer != NULL){

          $balancedetails = $balanceGold->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($startDate != NULL){

          $balancedetails = $balanceGold->WHERE('timestamp', '>=', $startDate." 00:00:00")
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($endDate != NULL){

          $balancedetails = $balanceGold->WHERE('timestamp', '<=', $endDate." 23:59:59")
                            ->orderBy('timestamp', 'desc')
                            ->get();

          return view('pages.players.gold_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
          // return view('pages.balancegold_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));


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
