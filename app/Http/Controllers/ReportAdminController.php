<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogOnline;
use App\Action;
use DB;
use Carbon\Carbon;
use  Validator;
use App\ConfigText;

class ReportAdminController extends Controller
{
    
    public function index()
    {
        $datenow = Carbon::now('GMT+7');
        $config_text = ConfigText::select(
                        'value'
                       )
                       ->where('id', '=', 13)
                       ->first();
        $replace = str_replace(':', ',', $config_text->value);
        $logonlinetype = explode(",", $replace);
        return view('pages.admin.report_admin', compact('datenow', 'logonlinetype'));
    }

    public function search(Request $request)
    {
        $player    = $request->inputPlayer;
        $minDate   = $request->inputMinDate;
        $maxDate   = $request->inputMaxDate;
        $logtype   = $request->logType;

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

        $logOnline = LogOnline::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'log_online.user_id')
                     ->select(
                        'asta_db.operator.username',
                        'action_id',
                        'asta_db.log_online.datetime',
                        'asta_db.log_online.ip',
                        'asta_db.log_online.user_id'
                     );
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
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.action_id', '=', $logtype)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.action_id', '=', $logtype)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                             ->get();
            endif;


            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $minDate != NULL && $logtype != NULL )
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.log_type', '=', $logtype)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '>=', $minDate)
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.log_type', '=', $logtype)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '>=', $minDate)
                             ->get();
            endif;


            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $maxDate != NULL && $logtype != NULL)
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.action_id', '=', $logtype)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '<=', $maxDate)
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.action_id', '=', $logtype)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '<=', $maxDate)
                             ->get();
            endif;

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $logtype != NULL) 
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.action_id', '=', $logtype)
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_user.user_id', '=', $player)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.action_id', '=', $logtype)
                             ->get();
            endif;

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if ($minDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($maxDate != NULL && $logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->where('asta_db.log_online.action_id', '=', $logtype)
                         ->get();

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        }
        else if($player != NULL && $minDate != NULL && $maxDate != NULL)
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.type', '=', 1)
                             ->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                             ->get();
            endif;

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if ($minDate != NULL && $maxDate != NULL)
        {
            
            $log_login = $logOnline->whereBetween('asta_db.log_online.datetime' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();
        
            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL && $minDate != NULL)
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '>=', $minDate)
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '>=', $minDate)
                             ->get();
            endif;

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if ($player != NULL && $maxDate != NULL)
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '<=', $maxDate)
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->where('asta_db.log_online.datetime', '<=', $maxDate)
                             ->get();
            endif;

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($minDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '>=', $minDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($maxDate != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.datetime', '<=', $maxDate)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();

            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if ($logtype != NULL)
        {
            $log_login = $logOnline->where('asta_db.log_online.action_id', '=', $logtype)
                         ->where('asta_db.log_online.type', '=', 1)
                         ->get();
            
            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else if($player != NULL)
        {
            if(is_numeric($player) !== TRUE):
                $log_login = $logOnline->where('asta_db.operator.username', 'Like', '%'.$player.'%')
                             ->where('asta_db.log_online.type', '=', 1)
                             ->get();
            else:
                $log_login = $logOnline->where('asta_db.log_online.user_id', '=', $player)
                             ->where('asta_db.log_online.type', '=', 1)
                             ->get();
            endif;
            
            return view('pages.admin.report_admin', compact('log_login', 'minDate', 'maxDate', 'action_report_admin', 'logonlinetype'));
        } else {
            return redirect()->route('Report_Players');
        }

    }
}
