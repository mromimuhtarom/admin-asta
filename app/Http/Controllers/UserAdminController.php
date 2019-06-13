<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Datatables;
// use Yajra\Datatables\Facades\Datatables;
use DB;
use App\User;
use App\Log;
use Session;
use Carbon\Carbon;
use App\Classes\MenucLass;
use Validator;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu  = MenuClass::menuName('User Admin');
        $admin = DB::table('operator')->join('adm_role', 'adm_role.role_id', '=', 'operator.role_id')->get();
        $role  = DB::table('adm_role')->get();
        return view('pages.admin.user_admin', compact('admin', 'role', 'menu'));
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
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'role'     => 'required|integer',
            'fullname' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $user = User::create([
            'username' => $request->username,
            'role_id' => $request->role,
            'password' => bcrypt(Session::get('dealerId').$request->username),
            'fullname' => $request->fullname
          ]);
  
          Log::create([
              'operator_id' => Session::get('userId'),
              'menu_id'     => '42',
              'action_id'   => '3',
              'date'        => Carbon::now('GMT+7'),
              'description' => 'Create new User with Username '. $user->username
          ]);
          return redirect()->route('UserAdmin-view')->with('success','Data Insert Successfull');
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
          case "firstName":
              $name = "First Name";
              break;
          case "lastName":
              $name = "Last Name";
              break;
          case "roleId":
              $name = "Role";
              break;
          default:
            "";
      }


      Log::create([
        'operator_id' => Session::get('userId'),
        'menu_id'     => '42',
        'action_id'   => '2',
        'date'        => Carbon::now('GMT+7'),
        'description' => 'Edit '.$name.' UserId '.$pk.' to '. $value
      ]);
    }
    public function updatepassword(Request $request) 
    {
        $pk = $request->userid;
        $password = $request->password;
        
        if($password != '') {
        User::where('operator_id', '=', $pk)->update([
          'password' => bcrypt($password)
        ]);
        
  
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '42',
          'action_id'   => '1',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit password UserId '.$pk.' to '. $password
        ]);
        return redirect()->route('UserAdmin-view')->with('success','Reset Password Successfully');
        }
        return redirect()->route('UserAdmin-view')->with('alert','Password is Null');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $userid = $request->userid;
        if($userid != '')
        {
            DB::table('operator')->where('operator_id', '=', $userid)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '42',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete user with user ID '.$userid
            ]);
            return redirect()->route('UserAdmin-view')->with('success','Data Deleted');
        }
        return redirect()->route('UserAdmin-view')->with('success','Somethong wrong');                
    }
}
