<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Classes\MenuClass;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = DB::table('game')->get();
        return view('pages.players.report', compact('game'));
    }




    public function search(Request $request)
    {

      $inputName    = $request->inputPlayer;
      $inputMinDate = $request->inputMinDate;
      $inputGame    = $request->inputGame;
      $inputMaxDate = $request->inputMaxDate;

      $menus1 = MenuClass::menuName('Report');
      $game = DB::table('game')->get();
      if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        $player_history = DB::table('player_history')
                            ->join('user', 'user.user_id', '=', 'player_history.player')
                            ->join('country', 'user.country_code', '=', 'country.code')
                            ->join('game', 'game.id', '=', 'player_history.gameId')
                            ->select(
                              'player_history.*',
                              'user.username',
                              'user.user_id',
                              'game.name as gamename',
                              'country.name as countryname'
                            )
                            ->where('username', 'LIKE', '%'.$inputName.'%')
                            ->where('game.id', '=', $inputGame)
                            ->wherebetween('player_history.ts' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderBy('player_history.ts', 'asc')
                            ->paginate(12);
        $player_history->appends($request->all());
        return view('pages.players.report_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
      $player_history = DB::table('player_history')
                          ->join('user', 'user.user_id', '=', 'player_history.player')
                          ->join('country', 'user.country_code', '=', 'country.code')
                          ->join('game', 'game.id', '=', 'player_history.gameId')
                          ->select(
                            'player_history.*',
                            'user.username',
                            'user.user_id',
                            'game.name as gamename',
                            'country.name as countryname'
                          )
                          ->where('username', 'LIKE', '%'.$inputName.'%')
                          ->wherebetween('player_history.ts' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->orderBy('player_history.ts', 'asc')
                          ->paginate(12);
      $player_history->appends($request->all());
      return view('pages.players.report_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
    } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
        $player_history = DB::table('player_history')
                           ->join('user', 'user.user_id', '=', 'player_history.player')
                           ->join('country', 'user.country_code', '=', 'country.code')
                           ->join('game', 'game.id', '=', 'player_history.gameId')
                           ->select(
                             'player_history.*',
                             'user.username',
                             'user.user_id',
                             'game.name as gamename',
                             'country.name as countryname'
                           )
                           ->where('username', $inputName)
                           ->where('game.id', '=', $inputGame)
                           ->WHERE('player_history.ts', '>=', $inputMinDate." 00:00:00")
                           ->orderBy('player_history.ts', 'asc')
                           ->paginate(12);
       $player_history->appends($request->all());
       return view('pages.players.report_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
     } else if($inputName != NULL && $inputMinDate != NULL ) {
       $player_history = DB::table('player_history')
                          ->join('user', 'user.user_id', '=', 'player_history.player')
                          ->join('country', 'user.country_code', '=', 'country.code')
                          ->join('game', 'game.id', '=', 'player_history.gameId')
                          ->select(
                            'player_history.*',
                            'user.username',
                            'user.user_id',
                            'game.name as gamename',
                            'country.name as countryname'
                          )
                          ->where('username', $inputName)
                          ->WHERE('player_history.ts', '>=', $inputMinDate." 00:00:00")
                          ->orderBy('player_history.ts', 'asc')
                          ->paginate(12);
      $player_history->appends($request->all());
      return view('pages.players.report_detail', compact('player_history', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game'));
    } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        $player_history = DB::table('player_history')
                              ->join('user', 'user.user_id', '=', 'player_history.player')
                              ->join('country', 'user.country_code', '=', 'country.code')
                              ->join('game', 'game.id', '=', 'player_history.gameId')
                              ->select(
                                'player_history.*',
                                'user.username',
                                'user.user_id',
                                'game.name as gamename',
                                'country.name as countryname'
                              )
                              ->where('username', 'LIKE', '%'.$inputName.'%')
                              ->where('game.id', '=', $inputGame)
                              ->where('player_history.ts', '<=', $inputMaxDate." 23:59:59")
                              ->orderBy('player_history.ts', 'desc')
                              ->paginate(12);
            $player_history->appends($request->all());
          return view('pages.players.report_detail', compact('player_history', 'menus1', 'game'));
    } else if($inputName != NULL && $inputMaxDate != NULL) {
    $player_history = DB::table('player_history')
                          ->join('user', 'user.user_id', '=', 'player_history.player')
                          ->join('country', 'user.country_code', '=', 'country.code')
                          ->join('game', 'game.id', '=', 'player_history.gameId')
                          ->select(
                            'player_history.*',
                            'user.username',
                            'user.user_id',
                            'game.name as gamename',
                            'country.name as countryname'
                          )
                          ->where('username', 'LIKE', '%'.$inputName.'%')
                          ->where('player_history.ts', '<=', $inputMaxDate." 23:59:59")
                          ->orderBy('player_history.ts', 'desc')
                          ->paginate(12);
        $player_history->appends($request->all());
      return view('pages.players.report_detail', compact('player_history', 'menus1', 'game'));
    } else if($inputName != NULL && $inputGame != NULL) {
        $player_history =  DB::table('player_history')
                          ->join('user', 'user.user_id', '=', 'player_history.player')
                          ->join('country', 'user.country_code', '=', 'country.code')
                          ->join('game', 'game.id', '=', 'player_history.gameId')
                          ->select(
                            'player_history.*',
                            'user.username',
                            'user.user_id',
                            'game.name as gamename',
                            'country.name as countryname'
                          )
                          ->where('username', 'LIKE', '%'.$inputName.'%')
                          ->where('game.id', '=', $inputGame)
                          ->orderBy('player_history.ts', 'asc')
                          ->paginate(12);
        $player_history->appends($request->all());
          return view('pages.players.report_detail', compact('player_history', 'menus1', 'game'));
    } else if($inputName != NULL) {
        $player_history =  DB::table('player_history')
                          ->join('user', 'user.user_id', '=', 'player_history.player')
                          ->join('country', 'user.country_code', '=', 'country.code')
                          ->join('game', 'game.id', '=', 'player_history.gameId')
                          ->select(
                            'player_history.*',
                            'user.username',
                            'user.user_id',
                            'game.name as gamename',
                            'country.name as countryname'
                          )
                          ->where('username', 'LIKE', '%'.$inputName.'%')
                          ->orderBy('player_history.ts', 'asc')
                          ->paginate(12);
        $player_history->appends($request->all());
          return view('pages.players.report_detail', compact('player_history', 'menus1', 'game'));
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
