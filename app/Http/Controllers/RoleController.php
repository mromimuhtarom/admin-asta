<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use App\Role;
use Session;
use Carbon\Carbon;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('pages.admin.role_admin', compact('roles'));
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
            $user = Role::create([
                'name' => $role
              ]);
      
              Log::create([
                  'operator_id' => Session::get('userId'),
                  'menu_id' => '3',
                  'action_id' => '3',
                  'date' => Carbon::now('GMT+7'),
                  'description' => 'Create new Role with Role Name '. $user->name
              ]);
              return redirect()->route('Role-view')->with('success','Data Insert Successfull');  
        }
        return redirect()->route('Role-view')->with('alert','Role Name is Null');
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
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;
  
    
        Role::where('role_id', '=', $pk)->update([
          $name => $value
        ]);
        
  
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '3',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit password UserId '.$pk.' to '. $value
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
            return redirect()->route('Role-view')->with('success','Data Deleted');
        }
        return redirect()->route('Role-view')->with('alert','Something wrong'); 
    }
}
