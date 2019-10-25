<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use Carbon\Carbon;
use App\LogUser;
use Validator;

class LogPlayerController extends Controller
{
    public function index()
    {
        $action =   Action::select('action', 'id')
                    ->whereBetween('id', [19, 22])
                    ->get();
        $datenow = Carbon::now('GMT+7');
        return view('pages.players.log_player', compact('action', 'datenow'));
    }

    public function search(Request $request)
    {
        $searchUser  = $request->username;
        $minDate     = $request->dari;
        $maxDate     = $request->sampai;
        $inputAction = $request->action;
        $datenow     = Carbon::now('GMT+7');

        $action =   Action::select('action', 'id')
                    ->whereBetween('id', [19, 22])
                    ->get();

        $loguser =  LogUser::select(
                        'asta_db.user.username',
                        'asta_db.action.action',
                        'asta_db.log_user.desc',
                        'asta_db.log_user.datetime'
                    )
                    ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_user.user_id')
                    ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_user.action_id');

        $validator = Validator::make($request->all(),[
            'dari'   => 'required|date',
            'sampai' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($maxDate < $minDate){
            return back()->with('alert','End Date can\'t be less than start date');
        }

        if($searchUser != NULL && $inputAction != NULL && $minDate != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL && $inputAction != NULL && $minDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '>=', $minDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL && $inputAction != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL && $inputAction != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL &&  $minDate != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL && $minDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->where('asta_db.log_user.datetime', '>=', $minDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($inputAction != NULL && $minDate != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($inputAction != NULL && $minDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '>=', $minDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($inputAction != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($minDate != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($searchUser != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action'));
        } else if($inputAction != NULL )
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));
        } else if($minDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.datetime', '>=', $minDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow'));            
        } else if($maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.datetime', '<=', $maxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow')); 
        }
    }
}
