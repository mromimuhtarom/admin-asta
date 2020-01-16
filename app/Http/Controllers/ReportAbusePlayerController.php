<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\AbusePlayer;
use Validator;
use App\Player;
use DB;

class ReportAbusePlayerController extends Controller
{
    public function index()
    {
        $datenow = Carbon::now('GMT+7');
        return view('pages.feedback.report_abuse_player', compact('datenow'));
    }

    public function search(Request $request)
    {
        $reportplayer   = $request->inputReportPlayer;
        $reportedplayer = $request->inputReportedPlayer;
        $mindate        = $request->inputMinDate;
        $maxdate        = $request->inputMaxDate;
        $datenow        = Carbon::now('GMT+7');
        $abuseplayer    = Player::select('username', 'user_id')->get();

        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required|date',
            'inputMaxDate'    => 'required|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($reportplayer != NULL && $reportedplayer != NULL && $mindate != NULL && $maxdate != NULL)
        {
            if(is_numeric($reportedplayer) !== true && is_numeric($reportedplayer) !== true):
                $problemplayer = AbusePlayer::where('user_sender', '=', DB::raw('(select user_id from asta_db.user where username LIKE "%'.$reportplayer.'%" and user_id = asta_db.report_abuse.user_sender)'))
                                 ->where('reported_user', '=', DB::raw('(Select user_id from asta_db.user where username LIKE "%'.$reportedplayer.'%" and user_id = asta_db.report_abuse.reported_user)'))
                                 ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                                 ->get();
            else:
                $problemplayer = AbusePlayer::where('user_sender', '=', DB::raw('(select user_id from asta_db.user where user_id  = '.$reportplayer.' and user_id = asta_db.report_abuse.user_sender)'))
                                 ->where('reported_user', '=', DB::raw('(Select user_id from asta_db.user where user_id = '.$reportedplayer.' and user_id = asta_db.report_abuse.reported_user)'))
                                 ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                                 ->get();
            endif;

            return view('pages.feedback.report_abuse_player', compact('mindate', 'maxdate', 'problemplayer', 'abuseplayer'));                
        } else if($reportedplayer != NULL && $mindate != NULL && $maxdate != NULL)
        {
            if(is_numeric($reportedplayer) !== true):
                $problemplayer = AbusePlayer::where('reported_user', '=', DB::raw('(Select user_id from asta_db.user where username LIKE "%'.$reportedplayer.'%" and user_id = asta_db.report_abuse.reported_user)'))
                                 ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                                 ->get();
            else:
                $problemplayer = AbusePlayer::where('reported_user', '=', DB::raw('(Select user_id from asta_db.user where user_id = '.$reportedplayer.' and user_id = asta_db.report_abuse.reported_user)'))
                                 ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                                 ->get();
            endif;

            return view('pages.feedback.report_abuse_player', compact('mindate', 'maxdate', 'problemplayer', 'abuseplayer'));    
        } else if($reportplayer!= NULL && $mindate != NULL && $maxdate != NULL)
        {
            if(is_numeric($reportplayer) !== true):
                $problemplayer = AbusePlayer::where('user_sender', '=', DB::raw('(select user_id from asta_db.user where username LIKE "%'.$reportplayer.'%" and user_id = asta_db.report_abuse.user_sender)'))
                                 ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                                 ->get();
            else:
                $problemplayer = AbusePlayer::where('user_sender', '=', DB::raw('(select user_id from asta_db.user where user_id = '.$reportplayer.' and user_id = asta_db.report_abuse.user_sender)'))
                                 ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                                 ->get();
            endif;

            return view('pages.feedback.report_abuse_player', compact('mindate', 'maxdate', 'problemplayer', 'abuseplayer'));    
        } else if($mindate != NULL && $maxdate != NULL)
        {
           $problemplayer = AbusePlayer::whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                            ->get();
            return view('pages.feedback.report_abuse_player', compact('mindate', 'maxdate', 'problemplayer', 'abuseplayer'));    
        } else if($mindate == NULL && $maxdate == NULL) 
        {
            $validator = Validator::make($request->all(),[
                'inputMinDate'    => 'required|date',
                'inputMaxDate'    => 'required|date',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            
        }else
        {
            $validator = Validator::make($request->all(),[
                'inputMinDate'    => 'required|date',
                'inputMaxDate'    => 'required|date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
        } 
    }
}
