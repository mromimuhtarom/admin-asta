<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\AbusePlayer;
use Validator;

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

        if($reportplayer != NULL && $reportedplayer != NULL && $mindate != NULL && $maxdate != NULL)
        {
            $problemplayer = AbusePlayer::where('report', 'LIKE', '%'.$reportplayer.'%')
                             ->where('reported', 'LIKE', '%'.$reportedplayer.'%')
                             ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer'));                
        } else if($reportedplayer != NULL && $mindate != NULL && $maxdate != NULL)
        {
            $problemplayer = AbusePlayer::where('reported', 'LIKE', '%'.$reportedplayer.'%')
                             ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer'));    
        } else if($reportplayer!= NULL && $mindate != NULL && $maxdate != NULL)
        {
            $problemplayer = AbusePlayer::where('report', 'LIKE', '%'.$reportplayer.'%')
                             ->whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer'));    
        } else if($mindate != NULL && $maxdate != NULL)
        {
           $problemplayer = AbusePlayer::whereBetween('date', [$mindate.' 00:00:00', $maxdate.' 23:59:59'])
                             ->get();
            return view('pages.feedback.report_abuse_player', compact('datenow', 'problemplayer'));    
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
                return self::index()->withErrors($validator->errors());
            }
            
        }else {
            self::index();
        }
    }
}
