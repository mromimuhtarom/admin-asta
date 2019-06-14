<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use App\Log;
use Carbon\Carbon;

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
        $profile = User::where('operator_id', '=', $user)
                   ->join('adm_role', 'adm_role.role_id', '=', 'operator.role_id')
                   ->select('adm_role.name as rolename', 'operator.*')
                   ->first();

        return view('pages.profile.user_profile', compact('profile'));
    }


    public function password(Request $request)
    {
        $pk = $request->userid;
        $password = $request->password;
        $user = Session::get('userId');

        $validator = Validator::make($request->all(),[
            'password'       => 'required'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        if($password != '') {
        User::where('operator_id', '=', $pk)->update([
          'password' => bcrypt($password)
        ]);
        
  
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '78',
          'action_id'   => '1',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit password UserId '.$user.' to '. $password
        ]);
        return redirect()->route('profile-view')->with('success','Reset Password Successfully');
        }
        return redirect()->route('profile-view')->with('alert','Password is Null');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
  
        User::where('operator_id', '=', $pk)->update([
          $name => $value
        ]);
  
        switch ($name) {
            case "fullname":
                $name = "Full Name";
                break;
            default:
              "";
        }
  
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '78',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' UserId '.$pk.' to '. $value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
