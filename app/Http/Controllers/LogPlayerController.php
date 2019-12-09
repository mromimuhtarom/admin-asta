<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use Carbon\Carbon;
use App\LogUser;
use Validator;
use Illuminate\Support\Facades\Input;

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
        $sorting     = $request->sorting;
        $namecolumn  = $request->namecolumn;

        $datenow     = Carbon::now('GMT+7');

        $action =   Action::select('action', 'id')
                    ->whereBetween('id', [19, 22])
                    ->get();

        $loguser =  LogUser::select(
                        'asta_db.user.username',
                        'asta_db.action.action',
                        'asta_db.log_user.description',
                        'asta_db.log_user.datetime',
                        'asta_db.log_user.user_id'
                    )
                    ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_user.user_id')
                    ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_user.action_id');

        $validator = Validator::make($request->all(),[
            'dari'   => 'required|date',
            'sampai' => 'required|date',
        ]);

        //if sorting variable is null
        if($sorting == NULL):
            $sorting = 'desc';
        endif;

        if($namecolumn == NULL):
            $namecolumn = 'asta_db.log_user.datetime';
        endif;

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;

        $getMindate  = Input::get('dari');
        $getMaxdate  = Input::get('sampai');
        $getusername = Input::get('inputPlayer');
        $getAction   = Input::get('action');
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($maxDate < $minDate){
            return back()->with('alert','End Date can\'t be less than start date');
        }

        if($searchUser != NULL && $inputAction != NULL && $minDate != NULL && $maxDate != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));

        } else if($searchUser != NULL && $inputAction != NULL && $minDate != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->where('asta_db.log_user.datetime', '>=', $minDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->where('asta_db.log_user.datetime', '>=', $minDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));

        } else if($searchUser != NULL && $inputAction != NULL && $maxDate != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));

        } else if($searchUser != NULL && $inputAction != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->where('asta_db.log_user.action_id', '=', $inputAction )
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        
        } else if($searchUser != NULL &&  $minDate != NULL && $maxDate != NULL)
        {
            if(is_numeric($searchUser) !== TRUE ):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        
        } else if($searchUser != NULL && $maxDate != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($searchUser != NULL && $minDate != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->where('asta_db.log_user.datetime', '>=', $minDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->where('asta_db.log_user.datetime', '>=', $minDate)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($inputAction != NULL && $minDate != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($inputAction != NULL && $minDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '>=', $minDate)
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($inputAction != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->where('asta_db.log_user.datetime', '<=', $maxDate)
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($minDate != NULL && $maxDate != NULL)
        {
            $logplayer =    $loguser->wherebetween('asta_db.log_user.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($searchUser != NULL)
        {
            if(is_numeric($searchUser) !== TRUE):
                $logplayer =    $loguser->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            else:
                $logplayer =    $loguser->where('asta_db.log_user.user_id', '=', $searchUser)
                                ->orderby($namecolumn, $sorting)
                                ->paginate(20);
            endif;

            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($inputAction != NULL )
        {
            $logplayer =    $loguser->where('asta_db.log_user.action_id', '=', $inputAction )
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));
        } else if($minDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.datetime', '>=', $minDate)
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction'));            
        } else if($maxDate != NULL)
        {
            $logplayer =    $loguser->where('asta_db.log_user.datetime', '<=', $maxDate)
                                    ->orderby($namecolumn, $sorting)
                                    ->paginate(20);
            $logplayer->appends($request->all());
            return view('pages.players.log_player', compact('logplayer', 'action', 'datenow', 'sortingorder', 'getMaxdate', 'getMindate', 'getusername', 'getAction')); 
        }
    }
}
