<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use App\LogOnline;
use Carbon\Carbon;
use App\OperatorActive;
use App\User;
use Cache;

class LoginController extends Controller
{
    public function loginbefore()
    {
        // $op_idcache = Cache::get('op_key');
        // if($op_idcache)
        // {
        //     $login = OperatorActive::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.operator_active.op_id')
        //              ->where('asta_db.operator_active.op_id', '=', $op_idcache)
        //              ->first();
        //     OperatorActive::where('op_id', '=', $login->op_id)->delete();
        // }
        // Session::flush();
        // Cache::flush();
        return view('login');
    }

    
    public function login(Request $request)
    {
        // dd($request->all());
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            Session::put('userId', Auth::user()->op_id);
            Session::put('dealerId', '1');
            Session::put('username',Auth::user()->username);
            Session::put('fullname',Auth::user()->fullname);
            Session::put('roleId',Auth::user()->role_id);
            Session::put('login1',TRUE);
            $username = $request->username;
            $password = $request->password;
            $login = DB::table('asta_db.operator')->where('username', '=', $username)->first();
            $session_id = session()->getId();
            Cache::put('op_key', $login->op_id);
            Cache::put('session_id', $session_id);
            LogOnline::create([
                'user_id'   =>  $login->op_id,
                'action_id' =>  7,
                'desc'      =>  'user '.$login->username.' Login in web Admin',
                'datetime'  => Carbon::now('GMT+7'),
                'ip'        => request()->ip(),
                'type'      => 1
            ]);
            $operator_active = OperatorActive::where('op_id', '=', $login->op_id)->first();
            
            if ($operator_active)
            {
                OperatorActive::where('op_id', '=', $operator_active->op_id)->delete();
                OperatorActive::create([
                    'op_id'       => $login->op_id,
                    'session_id'  => session()->getId(),
                    'op_key'      => 5,
                    'date_login'  => Carbon::now('GMT+7'),
                    'date_update' => Carbon::now('GMT+7'),
                    'ip'          => request()->ip()
                ]);
            } else {
                OperatorActive::create([
                    'op_id'       => $login->op_id,
                    'session_id'  => session()->getId(),
                    'op_key'      => 5,
                    'date_login'  => Carbon::now('GMT+7'),
                    'date_update' => Carbon::now('GMT+7'),
                    'ip'          => request()->ip()
                ]);
            }

  
            return redirect(route('Dashboard'));
  
         } else {
            return redirect('/')->with('alert','Username or Password are wrong!!');
        }
  
    }
   
    public function logout()
    {
        $op_idcache = Cache::get('op_key');
        $session_id = Cache::get('session_id');
        $op_idsession = Session::get('userId');
        // dd($session_id);
        $adminactive = OperatorActive::where('session_id', '=', $session_id)->first();

        if($adminactive)
        {
            if($session_id)
            {
                $login = OperatorActive::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.operator_active.op_id')
                         ->where('asta_db.operator_active.session_id', '=', $session_id)
                         ->first();
                OperatorActive::where('session_id', '=', $session_id)->delete();
                LogOnline::create([
                    'user_id'   =>  $login->op_id,
                    'action_id' =>  8,
                    'desc'      =>  'user '.$login->username.' Logout in web Admin',
                    'datetime'  => Carbon::now('GMT+7'),
                    'ip'        => request()->ip(),
                    'type'      => 1
                ]);

            } 

        }
        Session::flush();
        Cache::flush();
        return redirect('/')->with('alert','You are already Log Out');
    }
}
