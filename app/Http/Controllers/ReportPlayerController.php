<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class ReportPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datenow = Carbon::now('GMT+7');
        return view('pages.players.report_player', compact('datenow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $player  = $request->inputPlayer;
        $minDate = $request->inputMinDate;
        $maxDate = $request->inputMaxDate;
        $logtype = $request->logType;
        $datenow = Carbon::now('GMT+7');

        if($player != NULL && $minDate != NULL && $maxDate != NULL && $logtype != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate."00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($player != NULL && $minDate != NULL && $logtype != NULL )
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.log_type', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($player != NULL && $maxDate != NULL && $logtype != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($player != NULL && $logtype != NULL) 
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if ($minDate != NULL && $logtype != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($maxDate != NULL && $logtype != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        }
        else if($player != NULL && $minDate != NULL && $maxDate != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate."00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if ($minDate != NULL && $maxDate != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate."00:00:00", $maxDate." 23:59:59"])
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($player != NULL && $minDate != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if ($player != NULL && $maxDate != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($minDate != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($maxDate != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();

            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if ($logtype != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();
            
            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else if($player != NULL)
        {
            $log_login = DB::table('asta_db.log_online')
                         ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                         ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                         ->where('asta_db.user.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();
            
            return view('pages.players.report_player_detail', compact('log_login', 'datenow'));
        } else {
            return redirect()->route('Report_Players');
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
