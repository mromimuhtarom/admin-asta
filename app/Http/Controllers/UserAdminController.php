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
use App\Role;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('L_USER_ADMIN');
        $mainmenu = MenuClass::menuName('L_ADMIN');
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
            'username' => 'required|unique:operator,username|regex:/^\S*$/u',
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
      $user  = User::where('op_id', '=', $pk)->first();

      User::where('op_id', '=', $pk)->update([
        $name => $value
      ]);

      switch ($name) {
          case "fullname":
              $name_column       = TranslateColumnName("L_FULLNAME");
              $beforevaluecolumn = $user->fullname;
              break;
          case "role_id":
              $name_column       = TranslateColumnName("L_ROLETYPE");
              $beforevaluecolumn = $user->firstname;
              $role              = Role::where('role_id', '=', $value)->first();
              $value             = $role->name;
              break;
          default:
            "";
      }


      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name_column.' di menu Pengguna Admin dengan Nama Pengguna '.$user->username.' dari '.$beforevaluecolumn.' menjadi '. $value
      ]);
    }
    
    public function updatepassword(Request $request) 
    {
        $pk           = $request->userid;
        $password     = $request->password;
        $passwordself = $request->passwordself;
        $op_id        = Session::get('userId'); 
        $username     = Session::get('username');

        if($password != '') {
            // untuk validasi password akun sendiri
            $retriveuser = DB::table('operator')->where('op_id', '=', $op_id)->first();

            if ($username === $retriveuser->username && password_verify($passwordself, $retriveuser->userpass)) :
                User::where('op_id', '=', $pk)->update([
                    'userpass' => bcrypt($password)
                ]);
                $operator = User::where('op_id', '=', $pk)->first();          
    
    
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '1',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit kata sandi di menu Pengguna Admin dengan Nama Pengguna '.$operator->username
                ]);

                if($username === $retriveuser->username):
                     return redirect()->route('logout')->with('alert', alertTranslate("L_LOGOUT_CHANGE_PASSWORD"));
                else:
                    return redirect()->route('User_Admin')->with('success', alertTranslate('L_RESET_PASSWORD_SUCCESS'));
                endif;
            else :
                return redirect()->route('User_Admin')->with('alert', alertTranslate('L_PASSWORD_FAILED'));
            endif;
        }
        return redirect()->route('User_Admin')->with('alert', alertTranslate('L_PASSWORD_NULL'));
    }

   
    public function destroy(Request $request)
    {
        $userid = $request->userid;
        $adminself = Session::get('userId');
        if($userid != $adminself)
        {
            if($userid != '')
            {
                $operator = User::where('op_id', '=', $userid)->first();
                DB::table('asta_db.operator')->where('op_id', '=', $userid)->delete();
    
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '4',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Hapus di menu Pengguna Admin dengan Nama Pengguna '.$operator->username
                ]);
                return redirect()->route('User_Admin')->with('success','Data Deleted');
            }
            return redirect()->route('User_Admin')->with('success', alertTranslate('Somethong wrong'));
        }
        return back()->with('alert', alertTranslate("You didn't allow to delete your account"));
                        
    }

    public function deleteAll(Request $request)
    {
        $ids      = $request->userIdAll;
        $username = $request->usernameAll;
        DB::table('asta_db.operator')->whereIn('op_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Pengguna Admin dengan nama pengguna '.$username
        ]);
        return redirect()->route('User_Admin')->with('success', alertTranslate("Data deleted"));
    }
}
