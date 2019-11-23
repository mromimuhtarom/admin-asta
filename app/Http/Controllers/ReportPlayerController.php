<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\LogOnline;
use Carbon\Carbon;
use App\ConfigText;
Use App\Action;
use Validator;


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
        $action = Action::select(
                    'id', 
                    'action'
                  )
                  ->where('id', '=', 23)
                  ->orwhere('id', '=', 24)
                  ->get();
        $config_text = ConfigText::select(
                        'value'
                       )
                       ->where('id', '=', 13)
                       ->first();
        $replace = str_replace(':', ',', $config_text->value);
        $logonlinetype = explode(",", $replace);

                  
        return view('pages.players.report_player', compact('datenow', 'logonlinetype'));
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
        $action  = Action::select(
                    'id', 
                    'action'
                   )
                   ->where('id', '=', 23)
                   ->orwhere('id', '=', 24)
                   ->get();
        $logOnline = LogOnline::join('asta_db.user', 'asta_db.user.user_id', '=', 'log_online.user_id')
                     ->select(
                         'asta_db.user.username',
                         'asta_db.log_online.action_id',
                         'asta_db.log_online.datetime',
                         'asta_db.log_online.ip'
                     );
        $config_text = ConfigText::select(
                        'value'
                       )
                       ->where('id', '=', 13)
                       ->first();
        $replace = str_replace(':', ',', $config_text->value);
        $logonlinetype = explode(",", $replace);

        $action_report_admin = [
            $logonlinetype[0]   =>  $logonlinetype[1],
            $logonlinetype[2]   =>  $logonlinetype[3]
        ];

        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required|date',
            'inputMaxDate'    => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return self::index()->withErrors($validator->errors());
        }


        if($maxDate < $minDate){
            return back()->with('alert','End Date can\'t be less than start date');
        }
        if($player != NULL && $minDate != NULL && $maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate."00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $minDate != NULL && $logtype != NULL )
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.log_type', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $logtype != NULL) 
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if ($minDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        }
        else if($player != NULL && $minDate != NULL && $maxDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate."00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if ($minDate != NULL && $maxDate != NULL)
        {
            $log_login = $logOnline->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $minDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if ($player != NULL && $maxDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($minDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($maxDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();

            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if ($logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();
            
            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL)
        {
            $log_login = $logOnline->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 0)
                         ->get();
            
            return view('pages.players.report_player', compact('log_login', 'datenow', 'action', 'action_report_admin', 'logonlinetype'));
        } else {
            return redirect()->route('Report_Players');
        }
    }
}
