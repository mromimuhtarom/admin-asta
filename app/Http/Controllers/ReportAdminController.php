<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogOnline;
use App\Action;
use DB;
use Carbon\Carbon;
use  Validator;

class ReportAdminController extends Controller
{
    
    public function index()
    {
        $action = Action::select(
                    'id', 
                    'action'
                  )
                  ->where('id', '=', 7)
                  ->orwhere('id', '=', 8)
                  ->get();
        $datenow = Carbon::now('GMT+7');
        return view('pages.admin.report_admin', compact('action', 'datenow'));
    }

    public function search(Request $request)
    {
        $player    = $request->inputPlayer;
        $minDate   = $request->inputMinDate;
        $maxDate   = $request->inputMaxDate;
        $logtype   = $request->logType;
        $datenow   = Carbon::now('GMT+7');
        $action    = Action::select(
                      'id', 
                      'action'
                     )
                     ->where('id', '=', 7)
                     ->orwhere('id', '=', 8)
                     ->get();

        $logOnline = LogOnline::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'log_online.user_id')
                     ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id')
                     ->select(
                        'asta_db.action.action',
                        'asta_db.operator.username',
                        'asta_db.log_online.datetime',
                        'asta_db.log_online.ip'
                     );
        
        if($maxDate < $minDate){
            return back()->with('alert','End Date can\'t be less than start date');
        }

        if($player != NULL && $minDate != NULL && $maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($player != NULL && $minDate != NULL && $logtype != NULL )
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.log_type', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($player != NULL && $maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($player != NULL && $logtype != NULL) 
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if ($minDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        }
        else if($player != NULL && $minDate != NULL && $maxDate != NULL)
        {
            
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 1)
                         ->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if ($minDate != NULL && $maxDate != NULL)
        {
            
            $log_login = $logOnline->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();
        
            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($player != NULL && $minDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if ($player != NULL && $maxDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($minDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($maxDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();

            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if ($logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();
            
            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else if($player != NULL)
        {
            $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();
            
            return view('pages.admin.report_admin_detail', compact('log_login', 'datenow', 'action'));
        } else {
            return redirect()->route('Report_Players');
        }

    }
}
