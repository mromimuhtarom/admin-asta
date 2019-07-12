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
        $admin = User::join('asta_db.adm_role', 'asta_db.adm_role.role_id', '=', 'asta_db.operator.role_id')
                 ->select(
                     'asta_db.operator.op_id',
                     'asta_db.operator.username',
                     'asta_db.operator.fullname',
                     'asta_db.operator.role_id',
                     'asta_db.adm_role.name'
                 )
                 ->get();
        $role  = DB::table('asta_db.adm_role')
                 ->select(
                     'role_id',
                     'name'
                 )
                 ->get();
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
            'role_id'  => $request->role,
            'userpass' => bcrypt(Session::get('dealerId').$request->username),
            'fullname' => $request->fullname
          ]);
  
          Log::create([
              'op_id'     => Session::get('userId'),
              'action_id' => '3',
              'datetime'  => Carbon::now('GMT+7'),
              'desc'      => 'Create new in menu User Admin with Username '. $user->username
          ]);
          return redirect()->route('User_Admin')->with('success','Data Insert Successfull');
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

      User::where('op_id', '=', $pk)->update([
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
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu User Admin with UserId '.$pk.' to '. $value
      ]);
    }
    public function updatepassword(Request $request) 
    {
        $pk = $request->userid;
        $password = $request->password;
        
        if($password != '') {
        User::where('op_id', '=', $pk)->update([
          'userpass' => bcrypt($password)
        ]);
        
  
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '1',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit password in menu User Admin with UserId '.$pk.' to '. $password
        ]);
        return redirect()->route('User_Admin')->with('success','Reset Password Successfully');
        }
        return redirect()->route('User_Admin')->with('alert','Password is Null');
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
            DB::table('asta_db.operator')->where('op_id', '=', $userid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu User Admin with user ID '.$userid
            ]);
            return redirect()->route('User_Admin')->with('success','Data Deleted');
        }
        return redirect()->route('User_Admin')->with('success','Somethong wrong');                
    }
}
