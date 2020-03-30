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
    public function index(Request $request)
    {
        $sortingorder = $request->sorting;
        $namecolumn   = $request->namecolumn;

        if($sortingorder == 'asc'):
            $sortingorder = 'desc';
        elseif($sortingorder == NULL || $sortingorder == 'desc'):
            $sortingorder = 'asc';
        endif;

        if($namecolumn == NULL):
            $namecolumn = 'username';
        endif;

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
                    ->orderBy($namecolumn, $sortingorder)
                    ->paginate(20);
        $role   = DB::table('asta_db.adm_role')
                  ->select(
                     'role_id',
                     'name'
                  )
                  ->get();
        return view('pages.admin.user_admin', compact('admin', 'role', 'menu', 'mainmenu', 'sortingorder', 'namecolumn'));
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
              'action_id' => '1',
              'datetime'  => Carbon::now('GMT+7'),
              'desc'      => 'Menambahkan data ('.$user->username.')'
          ]);
          return redirect()->route('User_Admin')->with('success', alertTranslate('L_INSERT_DATA_SUCCESS'));
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
              $name_column       = translate_MenuContentAdmin("L_FULLNAME");
              $beforevaluecolumn = $user->fullname;
              break;
          case "role_id":
              $name_column       = translate_MenuContentAdmin("L_ROLE_TYPE");
              $role = Role::where('role_id', '=', $user->role_id)->first();
              $beforevaluecolumn = $role->name;
              $role              = Role::where('role_id', '=', $value)->first();
              $value             = $role->name;
              break;
          default:
            "";
      }

    //   $logdescnamecolumn = str_replace('{1}', $name_column, TranslateLogDesc('L_COMMON_DESC'));
    //   $menuname          = str_replace('{2}', translate_menu('L_USER_ADMIN'), $logdescnamecolumn);
    //   $firstcolomnname   = str_replace('{3}', translate_MenuContentAdmin('L_USERNAME'), $menuname);
    //   $firstcolumnvalue  = str_replace('{4}', $user->username, $firstcolomnname);
    //   $namecolumnforedit = str_replace('{5}', $name_column, $firstcolumnvalue);
    //   $valuebeforeedit   = str_replace('{6}', $beforevaluecolumn, $namecolumnforedit);
    //   $valueafteredit    = str_replace('{7}', $value, $valuebeforeedit);
        // Edit {1} di menu {2} dengan {3} {4} , dari {5} {6} menjadi {7}

      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '1',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => "Edit ".$name_column." (".$user->username.") ".$beforevaluecolumn." => ".$value
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
                // $replaceuseradmin = str_replace('{1}', $operator->username, TranslateLogDesc('L_PASSWORD'));
                
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '1',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit kata sandi ('.$operator->username.')'
                ]);
                
                $useredit = DB::table('operator')->where('op_id', '=', $pk)->first();
                if($username === $useredit->username):
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
                    'action_id' => '1',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Hapus data ('.$operator->username.')'
                ]);
                return redirect()->route('User_Admin')->with('success', alertTranslate('L_DATA_DELETED'));
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
            'action_id' => '1',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus data ('.$username.')'
        ]);
        return redirect()->route('User_Admin')->with('success', alertTranslate("L_DATA_DELETED"));
    }
}
