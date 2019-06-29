<?php

namespace App\Http\Controllers;

use App\BalanceChip;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Classes\MenuClass;

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
        return view('pages.players.chip_player', compact('datenow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $searchPlayer = $request->inputPlayer;
        $startDate    = $request->inputMinDate;
        $endDate      = $request->inputMaxDate;
        $menus1       = MenuClass::menuName('Balance Chip');
        $datenow      = Carbon::now('GMT+7');

        if ($searchPlayer != NULL && $startDate != NULL && $endDate != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));
        }else if ($searchPlayer != NULL && $startDate != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));

        }else if ($searchPlayer != NULL && $endDate != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                            ->orderBy('timestamp', 'desc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));

        }else if ($startDate != NULL && $endDate != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));

        }else if ($searchPlayer != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));

        }else if ($startDate != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                            ->orderBy('timestamp', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));

        }else if ($endDate != NULL){

          $balancedetails = BalanceChip::select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                            ->orderBy('timestamp', 'desc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow'));


        }

    }


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
