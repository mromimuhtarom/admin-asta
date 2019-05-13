<?php

namespace App\Http\Controllers;

use App\BalanceChip;
use Illuminate\Http\Request;
use DB;
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
        return view('pages.players.chip_player');
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

        if ($searchPlayer != NULL && $startDate != NULL && $endDate != NULL){

          $balancedetails = DB::table('balance_chip')
                            ->select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->paginate(12);

          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($searchPlayer != NULL && $startDate != NULL){

          $balancedetails = DB::table('balance_chip')
                            ->select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                            ->orderBy('timestamp', 'asc')
                            ->paginate(12);

          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($searchPlayer != NULL && $endDate != NULL){

          $balancedetails = DB::table('balance_chip')
                            ->select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                            ->orderBy('timestamp', 'desc')
                            ->paginate(12);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($startDate != NULL && $endDate != NULL){

          $balancedetails = DB::table('balance_chip')
                            ->select('balance_chip.*', 'user.username')
                            ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                            ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->paginate(12);

          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($searchPlayer != NULL){

          $balancedetails = DB::table('balance_chip')
                          ->select('balance_chip.*', 'user.username')
                          ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                          ->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                          ->paginate(12);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($startDate != NULL){

          $balancedetails = DB::table('balance_chip')
                          ->select('balance_chip.*', 'user.username')
                          ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                          ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                          ->orderBy('timestamp', 'asc')
                          ->paginate(12);

          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));

        }else if ($endDate != NULL){

          $balancedetails = DB::table('balance_chip')
                          ->select('balance_chip.*', 'user.username')
                          ->JOIN('user', 'balance_chip.playerId', '=', 'user.user_id')
                          ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                          ->orderBy('timestamp', 'desc')
                          ->paginate(12);

          $balancedetails->appends($request->all());
          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1'));
          // return view('pages.balancechip_detail', compact('balancedetails', 'menus1','searchPlayer', 'startDate', 'endDate'));


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
