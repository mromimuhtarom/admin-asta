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
        $menu     = MenuClass::menuName('User Admin');
        $mainmenu = MenuClass::menuName('Admin');
        $admin    = User::join('asta_db.adm_role', 'asta_db.adm_role.role_id', '=', 'asta_db.operator.role_id')
                    ->select(
                     'asta_db.operator.op_id',
                     'asta_db.operator.username',
                     'asta_db.operator.fullname',
                     'asta_db.operator.role_id',
                     'asta_db.adm_role.name'
                    )
                    ->get();
        $role   = DB::table('asta_db.adm_role')
                  ->select(
                     'role_id',
                     'name'
                  )
                  ->get();
        return view('pages.admin.user_admin', compact('admin', 'role', 'menu', 'mainmenu'));
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
            'username' => 'required|regex:/^\S*$/u',
            'role'     => 'required|integer',
            'fullname' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $user = User::create([
            'username' => strtolower($request->username),
            'role_id'  => $request->role,
            'userpass' => bcrypt(Session::get('dealerId').$request->username),
            'fullname' => $request->fullname
          ]);
  
          Log::create([
              'op_id'     => Session::get('userId'),
              'action_id' => '3',
              'datetime'  => Carbon::now('GMT+7'),
              'desc'      => 'Menambahkan data di menu Pengguna Admin dengan Nama pengguna '. $user->username
          ]);
          return redirect()->route('User_Admin')->with('success', alertTranslate('insert data successful'));
    }
    
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
        'desc'      => 'Edit '.$name.' di menu Pengguna Admin dengan PenggunaId '.$pk.' menjadi '. $value
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
                'desc'      => 'Edit kata sandi di menu Pengguna Admin dengan PenggunaId '.$pk.' menjadi '. $password
            ]);
            return redirect()->route('User_Admin')->with('success', alertTranslate('Reset Password Successfully'));
        }
        return redirect()->route('User_Admin')->with('alert', alertTranslate('Password is Null'));
    }

   
    public function destroy(Request $request)
    {
        $userid = $request->userid;
        $adminself = Session::get('userId');
        if($userid != $adminself)
        {
            if($userid != '')
            {
                DB::table('asta_db.operator')->where('op_id', '=', $userid)->delete();
    
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '4',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Hapus di menu Pengguna Admin dengan PenggunaID '.$userid
                ]);
                return redirect()->route('User_Admin')->with('success','Data Deleted');
            }
            return redirect()->route('User_Admin')->with('success', alertTranslate('Somethong wrong'));
        }
        return back()->with('alert', alertTranslate("You didn't allow to delete your account"));
                        
    }

    public function deleteAll(Request $request)
    {
        $ids =   $request->userIdAll;
        DB::table('asta_db.operator')->whereIn('op_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Pengguna Admin dengan PenggunaID '.$ids
        ]);
        return redirect()->route('User_Admin')->with('success', alertTranslate("Data deleted"));
    }
}
