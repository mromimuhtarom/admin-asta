<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\LogUser;

class LogPlayerController extends Controller
{
    public function index()
    {
        $action =   Action::select('action')
                    ->where('id', '!=', 7)
                    ->where('id', '!=', 8)
                    ->get();
        return view('pages.players.log_player', compact('action'));
    }

    public function search(Request $request)
    {
        $inputUser    = $request->username;
        $inputMinDate = $request->dari;
        $inputMaxDate = $request->sampai;
        $inputAction  = $request->action;

        $action =   Action::select('action')
                    ->where('id', '!=', 7)
                    ->where('id', '!=', 8)
                    ->get();

        $loguser =  LogUser::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_user.user_id')
                    ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_user.action_id');

        if($inputUser != NULL && $inputAction != NULL && $inputMinDate != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->wherebetween('asta_db.log_user.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();
            
            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL && $inputAction != NULL && $inputMinDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '>=', $inputMinDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL && $inputAction != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '<=', $inputMaxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL && $inputAction != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL &&  $inputMinDate != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->wherebetween('asta_db.log_user.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->where('asta_db.log_user.datetime', '<=', $inputMaxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL && $inputMinDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->where('asta_db.log_user.datetime', '>=', $inputMinDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputAction != NULL && $inputMinDate != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->wherebetween('asta_db.log_user.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();
            
            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputAction != NULL && $inputMinDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '>=', $inputMinDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputAction != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '<=', $inputMaxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputMinDate != NULL && $inputMaxDate != NULL)
        {
            $logplayer =    $loguser->wherebetween('asta_db.log_user.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputUser != NULL)
        {
            $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%')
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();
            
            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputAction != NULL )
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));
        } else if($inputMinDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.datetime', '>=', $inputMinDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action'));            
        } else if($inputMaxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.datetime', '<=', $inputMaxDate)
                                    ->orderby('asta_db.log_user.datetime', 'desc')
                                    ->get();

            return view('pages.players.log_player_detail', compact('logplayer', 'action')); 
        }
    }
}