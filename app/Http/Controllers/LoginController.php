<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            Session::put('userId', Auth::user()->operator_id);
            Session::put('dealerId', '1');
            Session::put('username',Auth::user()->username);
            Session::put('fullname',Auth::user()->fullname);
            Session::put('roleId',Auth::user()->role_id);
            Session::put('login',TRUE);
  
            return redirect(route('home'));
  
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
