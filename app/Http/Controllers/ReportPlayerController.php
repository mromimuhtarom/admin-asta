<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.players.report_player');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $player = $request->inputPlayer;
        $minDate = $request->inputMinDate;
        $maxDate = $request->inputMaxDate;


        if($player != NULL && $minDate != NULL && $maxDate != NULL)
        {
            $log_login = DB::table('log_user_login')
                         ->join('user', 'user.user_id', '=', 'log_user_login.user_id')
                         ->where('user.username', 'Like', '%'.$player.'%')
                         ->whereBetween('log_user_login' ,[$minDate."00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login'));
        } else if($player != NULL && $minDate != NULL)
        {
            $log_login = DB::table('log_user_login')
                         ->join('user', 'user.user_id', '=', 'log_user_login.user_id')
                         ->where('user.username', 'Like', '%'.$player.'%')
                         ->where('log_user_login.', '>=', $minDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login'));
        } else if ($player != NULL && $maxDate != NULL)
        {
            $log_login = DB::table('log_user_login')
                         ->join('user', 'user.user_id', '=', 'log_user_login.user_id')
                         ->where('user.username', 'Like', '%'.$player.'%')
                         ->where('log_user_login.', '<=', $maxDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login'));
        } else if($minDate != NULL)
        {
            $log_login = DB::table('log_user_login')
                         ->join('user', 'user.user_id', '=', 'log_user_login.user_id')
                         ->where('log_user_login.', '>=', $minDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login'));
        } else if($maxDate != NULL)
        {
            $log_login = DB::table('log_user_login')
                         ->join('user', 'user.user_id', '=', 'log_user_login.user_id')
                         ->where('log_user_login.', '<=', $maxDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login'));
        } else if($player != NULL)
        {
            $log_login = DB::table('log_user_login')
                         ->join('user', 'user.user_id', '=', 'log_user_login.user_id')
                         ->where('user.username', 'Like', '%'.$player.'%')
                         ->get();
            
            return view('pages.players.report_player_detail', compact('log_login'));
        } else {
            return redirect()->route('ReportPlayer-view')->with('alert','Data Not Found');   
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
