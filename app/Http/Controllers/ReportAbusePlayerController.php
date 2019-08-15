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

        if($reportplayer != NULL && $reportedplayer != NULL && $mindate != NULL && $maxdate != NULL)
        {
            $problemplayer = AbusePlayer::where('report', '=', DB::raw('(select user_id from asta_db.user where username LIKE "%'.$reportplayer.'%" and user_id = asta_db.abuse_report.report)'))
                             ->where('reported', '=', DB::raw('(Select user_id from asta_db.user where username LIKE "%'.$reportedplayer.'%" and user_id = asta_db.abuse_report.reported)'))
                             ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer', 'abuseplayer'));                
        } else if($reportedplayer != NULL && $mindate != NULL && $maxdate != NULL)
        {
            $problemplayer = AbusePlayer::where('reported', '=', DB::raw('(Select user_id from asta_db.user where username LIKE "%'.$reportedplayer.'%" and user_id = asta_db.abuse_report.reported)'))
                             ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer', 'abuseplayer'));    
        } else if($reportplayer!= NULL && $mindate != NULL && $maxdate != NULL)
        {
            $problemplayer = AbusePlayer::where('report', '=', DB::raw('(select user_id from asta_db.user where username LIKE "%'.$reportplayer.'%" and user_id = asta_db.abuse_report.report)'))
                             ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer', 'abuseplayer'));    
        } else if($mindate != NULL && $maxdate != NULL)
        {
           $problemplayer = AbusePlayer::whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer', 'abuseplayer'));    
        } else if($mindate != NULL)
        {
            $problemplayer = AbusePlayer::where('date', '>=', $mindate)
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer'));
        } else if($maxdate != NULL) 
        {
            $problemplayer = AbusePlayer::where('date', '<=', $maxdate)
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer'));
        } else if($mindate == NULL && $maxdate == NULL) 
        {
            $validator = Validator::make($request->all(),[
                'inputMinDate'    => 'required|date',
                'inputMaxDate'    => 'required|date',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            
        }else {
            self::index();
        }
    }
}
