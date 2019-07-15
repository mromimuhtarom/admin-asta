<?php

namespace App\Http\Controllers;

use App\BalanceChip;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Game;
use App\Classes\MenuClass;
use Validator;

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
      $game = Game::all();
        return view('pages.players.chip_player', compact('datenow', 'game'));
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
        $gameName     = $request->inputGame;
        $menus1       = MenuClass::menuName('Balance Chip');
        $game         = Game::all();
        $datenow      = Carbon::now('GMT+7');
        $balanceChip  = BalanceChip::select(
                          'asta_db.balance_chip.debit',
                          'asta_db.balance_chip.credit',
                          'asta_db.balance_chip.balance',
                          'asta_db.balance_chip.datetime', 
                          'asta_db.user.username', 
                          'asta_db.game.name as gamename', 
                          'asta_db.action.action as actionname'
                        )
                        ->JOIN('asta_db.user', 'asta_db.balance_chip.user_id', '=', 'asta_db.user.user_id')
                        ->JOIN('asta_db.action', 'asta_db.action.id', '=', 'asta_db.balance_chip.action_id')
                        ->JOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_chip.game_id');

        if($endDate < $startDate){
          return back()->with('alert','End Date can\'t be less than start date');
        }
        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required|date',
            'inputMaxDate'    => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return self::index()->withErrors($validator->errors());
        }

        if($searchPlayer != NULL && $gameName != NULL && $startDate != NULL && $endDate != NULL){
          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->wherebetween('asta_db.balance_chip.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if($searchPlayer != NULL && $gameName != NULL && $startDate != NULL){
          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->WHERE('asta_db.balance_chip.datetime', '>=', $startDate." 00:00:00")
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if($searchPlayer != NULL && $gameName != NULL && $endDate != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->WHERE('asta_db.balance_chip.datetime', '<=', $endDate." 23:59:59")
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if($searchPlayer != NULL && $gameName != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if($gameName != NULL && $startDate != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '>=', $startDate." 00:00:00")
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if($gameName != NULL && $endDate != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '<=', $endDate." 23:59:59")
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if ($searchPlayer != NULL && $startDate != NULL && $endDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->wherebetween('asta_db.balance_chip.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        }else if ($searchPlayer != NULL && $startDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->WHERE('asta_db.balance_chip.datetime', '>=', $startDate." 00:00:00")
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow','game'));

        }else if ($searchPlayer != NULL && $endDate != NULL){

          $balancedetails = $balanceChip->WHERE('user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->WHERE('asta_db.balance_chip.datetime', '<=', $endDate." 23:59:59")
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow','game'));

        }else if ($startDate != NULL && $endDate != NULL){

          $balancedetails = $balanceChip->wherebetween('asta_db.balance_chip.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow','game'));

        }else if ($searchPlayer != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchPlayer.'%' )
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow','game'));

        } else if($gameName != NULL) {
          $balancedetails = $balanceChip->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow', 'game'));
        } else if ($startDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '>=', $startDate." 00:00:00")
                            ->orderBy('asta_db.balance_chip.datetime', 'asc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow','game'));

        }else if ($endDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '<=', $endDate." 23:59:59")
                            ->orderBy('asta_db.balance_chip.datetime', 'desc')
                            ->get();

          return view('pages.players.chip_playerdetail', compact('balancedetails', 'menus1', 'datenow','game'));


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
