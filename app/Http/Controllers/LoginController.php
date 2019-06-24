<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use App\Log;
use App\LogOnline;
use Carbon\Carbon;

use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
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
            LogOnline::create([
                'user_id'   =>  $login->op_id,
                'action_id' =>  7,
                'desc'      =>  'user '.$login->username.' Login in web Admin',
                'datetime'  => Carbon::now('GMT+7'),
                'ip'        => request()->ip(),
                'type'      => 1
            ]);
  
            return redirect(route('Dashboard'));
  
         } else {
            return redirect('/')->with('alert','Username or Password are wrong!!');
        }
  
    }
  
    public function logout()
    {
        $op_id = Session::get('userId');
        $login = DB::table('asta_db.operator')->where('op_id', '=', $op_id)->first();
        Session::flush();
        LogOnline::create([
            'user_id'   =>  $login->op_id,
            'action_id' =>  8,
            'desc'      =>  'user '.$login->username.' Logout in web Admin',
            'datetime'  => Carbon::now('GMT+7'),
            'ip'        => request()->ip(),
            'type'      => 1
        ]);
        return redirect('/')->with('alert','You are already Log Out');
    }
}
