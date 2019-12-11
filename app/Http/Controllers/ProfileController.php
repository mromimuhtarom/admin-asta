<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use App\Log;
use Carbon\Carbon;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Session::get('userId');
        $profile = User::where('op_id', '=', $user)
                   ->join('asta_db.adm_role', 'asta_db.adm_role.role_id', '=', 'asta_db.operator.role_id')
                   ->select(
                       'asta_db.adm_role.name as rolename', 
                       'asta_db.operator.username',
                       'asta_db.operator.op_id',
                       'asta_db.operator.fullname'
                   )
                   ->first();

        return view('pages.profile.user_profile', compact('profile'));
    }


    public function password(Request $request)
    {
        $pk       = $request->userid;
        $password = $request->password;
        $user     = Session::get('userId');
        
        $validator = Validator::make($request->all(),[
            'password'       => 'required'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        if($password != NULL || $pk != NULL) {
        User::where('op_id', '=', $pk)->update([
          'userpass' => bcrypt($password)
        ]);
        
  
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '1',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit kata sandi dengan PenggunaId '.$user.' menjadi '. $password
        ]);
        return redirect()->route('profile-view')->with('success','Reset Password Successfully');
        }
        return redirect()->route('profile-view')->with('alert','Password is Null');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
        User::where('op_id', '=', $pk)->update([
          $name => $value
        ]);
  
        switch ($name) {
            case "fullname":
                $name = "Nama Lengkap";
                break;
            default:
              "";
        }
  
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' dengan PenggunaId '.$pk.' menjadi '. $value
        ]);
    }
}
