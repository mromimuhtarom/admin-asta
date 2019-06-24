<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogOnline;
use App\Action;
use  Validator;

class LogOnlineOfflineController extends Controller
{
    
    public function LogOnlineOffline()
    {
        $action = Action::where('id', '=', 7)
                  ->orwhere('id', '=', 8)
                  ->get();
        return view('pages.online_offline.log_online_offline', compact('action'));
    }

    public function search(Request $request)
    {
        $inputUser     = $request->username;
        $inputMinDate  = $request->dari;
        $inputMaxDate  = $request->sampai;
        $inputAction   = $request->action;
        $inputUserType = $request->usertype;

        $action = Action::where('id', '=', 7)
                  ->orwhere('id', '=', 8)
                  ->get();
        $validator = Validator::make($request->all(),[
            'usertype'            => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $parentlog = LogOnline::join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.log_online.action_id');
        if($inputUser != NULL) 
        {
            if($inputUserType == 1)
            {
                $usertyp =    $parentlog->join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.log_online.user_id')
                                        ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%');
            } else if($inputUserType == 0)
            {
                $usertyp =    $parentlog->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id')
                                        ->where('asta_db.user.username', 'LIKE', '%'.$inputUser.'%');
            }
        } else 
        {
            if($inputUserType == 1)
            {
                $usertyp =    $parentlog->join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.log_online.user_id');
            } else if($inputUserType == 0)
            {
                $usertyp =    $parentlog->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.log_online.user_id');
            } 
        }
 


        if($inputUser != NULL && $inputAction != NULL && $inputUserType != NULL && $inputMinDate != NULL && $inputMaxDate != NULL)
        {
                $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                        ->where('asta_db.log_online.action_id', '=', $inputAction)
                                        ->wherebetween('asta_db.log_online.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                        ->orderBy('asta_db.log_online.datetime', 'desc')
                                        ->get();
            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if($inputUser != NULL && $inputAction != NULL && $inputUserType != NULL && $inputMinDate != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.action_id', '=', $inputAction)
                                    ->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.datetime', '>=', $inputMinDate)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if($inputUser != NULL && $inputAction != NULL && $inputUserType != NULL && $inputMaxDate != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.action_id', '=', $inputAction)
                                    ->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.datetime', '<=', $inputMaxDate)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if($inputUser != NULL && $inputUserType != NULL && $inputMinDate != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.datetime', '>=', $inputMinDate)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if ($inputUser != NULL && $inputUserType != NULL && $inputMaxDate != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.datetime', '<=', $inputMaxDate)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if($inputUserType != NULL && $inputMinDate != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.datetime', '>=', $inputMinDate)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if($inputUserType != NULL && $inputMaxDate != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.datetime', '<=', $inputMaxDate)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        }  else if($inputUser != NULL && $inputUserType != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        }else if($inputAction != NULL && $inputUserType != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();

            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if($inputMinDate != NULL && $inputMaxDate != NULL && $inputAction != NULL)
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->wherebetween('asta_db.log_online.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();
            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        } else if( $inputAction != NULL && $inputUserType != NULL && $inputMinDate != NULL && $inputMaxDate != NULL )
        {
            $logonline =    $usertyp->where('asta_db.log_online.type', '=', $inputUserType)
                                    ->where('asta_db.log_online.action_id', '=', $inputAction)
                                    ->wherebetween('asta_db.log_online.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                                    ->orderBy('asta_db.log_online.datetime', 'desc')
                                    ->get();
            
            return view('pages.online_offline.log_online_offline_detail', compact('logonline', 'action'));
        }

    }
}
