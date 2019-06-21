<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use App\Log;
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
            Log::create([
                'op_id'     => $login->op_id,
                'action_id' => 7,
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Login with username '.$username
            ]);
  
            return redirect(route('Dashboard'));
  
         } else {
            return redirect('/')->with('alert','Username or Password are wrong!!');
        }
  
    }
  
    public function logout()
    {
        Session::flush();
        return redirect('/')->with('alert','You are already Log Out');
    }
}
