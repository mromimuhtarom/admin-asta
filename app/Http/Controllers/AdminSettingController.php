<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use App\User;
use Session;
use Carbon\Carbon;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select('SELECT * FROM operator');
        $roles = DB::table('adm_role')->get();
        return view('pages.settings.admin_setting', compact('users', 'roles'));
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
        
      $pk = $request->pk;
      $name = $request->name;
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
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' UserId '.$pk.' to '. $value
      ]);

    }

    public function updateUser(Request $request, User $users)
    {

        $pk     = $request->pk;
        $name   = $request->name;
        $value  = $request->value;
        $bcrypt = bcrypt($request->get('password'));

        DB::table('operator')->where('op_id', '=', $pk)->update([
            $name => $bcrypt
        ]);

        switch ($name) {
            case "password":
                $name = "Password";
                break;
            default:
              "";
        }


        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '3',
          'action_id'   => '1',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' UserId '.$pk.' from menu User'
        ]);

        return json_encode([
            "status"    =>  "Updated",
            "message"   =>  "Change Password Successfull"
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
