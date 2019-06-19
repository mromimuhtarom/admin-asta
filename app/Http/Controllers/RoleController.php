<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;
use App\Role;
use Session;
use Carbon\Carbon;
use Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu  = MenuClass::menuName('Role Admin');
        $roles = Role::all();
        return view('pages.admin.role_admin', compact('roles', 'menu'));
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
              $lastValue = DB::table('adm_role')->orderBy('role_id', 'desc')->first();
              $menu      = DB::table('adm_menu')->select('menu_id')->where('webid', '=', '1')->orderby('menu_id', 'desc')->first();
              $menuarray = DB::select('SELECT menu_id from adm_menu where webid = 1');
              $menufirst = DB::table('adm_menu')->select('menu_id')->where('webid', '=', '1')->first();

              for ($i=$menufirst->menu_id; $i <= $menu->menu_id; $i++) {
                $menuId[] = [
                  'role_id' => $lastValue->role_id,
                  'menu_id' => $i,
                  'type'    => '2'
                ];
              }
      
              DB::table('adm_access')->insert($menuId);
              Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '43',
                'action_id'   => '3',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Create new Role with Role Name '.$role
              ]);
              return redirect()->route('Role_Admin')->with('success','Data Insert Successfull');  
        }
        return redirect()->route('Role_Admin')->with('alert','Role Name is Null');
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

    public function menu(Role $role)
    {
        $roles = DB::table('adm_access')->join('adm_menu', 'adm_menu.menu_id', '=', 'adm_access.menu_id')->where('adm_access.role_id', '=', $role->role_id)->get();
        $roles = $roles->toArray();

        return view('pages.admin.role_edit', compact('roles', 'role'));
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
          'operator_id' => Session::get('userId'),
          'menu_id'     => '43',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' with Role Id'.$pk.' to '. $value
        ]);
    }


    public function menuupdate(Request $request, Role $role)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;


        DB::table('adm_access')->where('menu_id', $pk)->where('role_id', '=', $role->role_id)->update([
          $name => $value
        ]);

        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '43',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit menu with menu Id'.$pk.' to '. $value
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
            DB::table('adm_role')->where('role_id', '=', $userid)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '43',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Role ID '.$id
            ]);
            return redirect()->route('Role_Admin')->with('success','Data Deleted');
        }
        return redirect()->route('Role_Admin')->with('alert','Something wrong'); 
    }
}
