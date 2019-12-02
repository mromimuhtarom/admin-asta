<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;
use App\Role;
use App\MenuName;
use Session;
use Carbon\Carbon;
use Validator;
use App\ConfigText;
use App\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu     = MenuClass::menuName('Role Admin');
        $mainmenu = MenuClass::menuName('Admin');
        $roles    = Role::select('role_id', 'name')->get();
        return view('pages.admin.role_admin', compact('roles', 'menu', 'mainmenu'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $request->rolename;
        if($role != ''){

            $validator = Validator::make($request->all(),[
                'rolename' => 'required',
            ]);
        
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
  

            $user = Role::create([
                'name' => $role
              ]);
              $lastValue = Role::orderBy('role_id', 'desc')->first();
              $menu      = MenuName::select('menu_id')->orderby('menu_id', 'desc')->first();
              $menuarray = DB::select('SELECT menu_id from asta_db.adm_menu ');
              $menufirst = MenuName::select('menu_id')->first();

              for ($i=$menufirst->menu_id; $i <= $menu->menu_id; $i++) {
                $menuId[] = [
                  'role_id' => $lastValue->role_id,
                  'menu_id' => $i,
                  'type'    => '2'
                ];
              }
      
              DB::table('asta_db.adm_access')->insert($menuId);
              Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '3',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Create new Role in Menu Role Admin with Role Name '.$role
              ]);
              return redirect()->route('Role_Admin')->with('success','Data Insert Successfull');  
        }
        return redirect()->route('Role_Admin')->with('alert','Role Name is Null');
    }

    public function menu($role)
    {
        $roles    = DB::table('asta_db.adm_access')
                    ->join('asta_db.adm_menu', 'asta_db.adm_menu.menu_id', '=', 'asta_db.adm_access.menu_id')
                    ->select(
                      'asta_db.adm_menu.name',
                      'asta_db.adm_access.type',
                      'asta_db.adm_access.menu_id',
                      'asta_db.adm_access.role_id'
                    )
                    ->where('asta_db.adm_access.role_id', '=', $role)
                    ->get();
        $mainmenu = MenuName::where('parent_id', '=', 0)
                    ->join('asta_db.adm_access', 'asta_db.adm_access.menu_id', '=', 'asta_db.adm_menu.menu_id')
                    ->where('status', '=', 1)
                    ->where('parent_id', '=', 0)
                    ->where('asta_db.adm_access.role_id', '=', $role)
                    ->where('asta_db.adm_menu.menu_id', '!=', 86)
                    ->get();
        $op_id   = Session::get('userId');
        $role_op = User::where('op_id', '=', $op_id)->first();
        $roles          = $roles->toArray();
        $menu           = MenuClass::menuName('Role Admin');
        $mainmenuaccess = MenuClass::menuName('Admin');
        $roletype       = ConfigText::select('name', 'value')->where('id', '=', 6)->first();
        $value          = str_replace(':', ',', $roletype->value);
        $type           = explode(",", $value);

        return view('pages.admin.role_edit', compact('roles', 'role', 'menu', 'type','mainmenu', 'mainmenuaccess', 'role_op'));
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
  
    
        Role::where('role_id', '=', $pk)->update([
          $name => $value
        ]);      
  
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' in Menu Role Admin with Role Id'.$pk.' to '. $value
        ]);
    }


    public function menuupdate(Request $request, Role $role)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;


        DB::table('asta_db.adm_access')->where('menu_id', $pk)->where('role_id', '=', $role->role_id)->update([
          $name => $value
        ]);

        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit Type Of Role Access in menu Role Admin with menu Id'.$pk.' to '. $value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $userid = $request->id;
        if($userid != '')
        {
            DB::table('asta_db.adm_role')->where('role_id', '=', $userid)->delete();
            DB::table('asta_db.adm_access')->where('role_id', '=', $userid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Role Admin with Role ID '.$userid
            ]);
            return redirect()->route('Role_Admin')->with('success','Data Deleted');
        }
        return redirect()->route('Role_Admin')->with('alert','Something wrong'); 
    }

    //DELETE ALL SELECTED 
    public function deleteAllSelected(Request $request)
    {
      $ids  = $request->userIdAll;
      
      DB::table('asta_db.adm_role')->whereIn('role_id', explode(",", $ids))->delete();
      DB::table('asta_db.adm_access')->whereIn('role_id', explode(",", $ids))->delete();

      return redirect()->route('Role_Admin')->with('success', 'Data deleted');
    }

}
