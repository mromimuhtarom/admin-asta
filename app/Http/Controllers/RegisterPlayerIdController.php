<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;
use Carbon\Carbon;
use Session;

class RegisterPlayerIdController extends Controller
{
    public function index()
    {
        $menu  = MenuClass::menuName('Register Player ID');
        return view('pages.players.registerplayerid');
    }

    public function store(Request $request)
    {
        $number = $request->inputcount;
        // $data = $request->all();
        //         $validate = [
        //   'username' => 'unique:reseller,username',
        //   'phone'    => 'unique:reseller,phone',
        //   'email'    => 'unique:reseller,email',
        // //   'idcard'   => 'unique:reseller,identify'
        // ];
  
        // $validator = Validator::make($data,$validate);
  
        // if($validator->fails())
        // {  
        //   return back()->withInput()->with('alert', $validator->errors()->first());
        // }
        $last = DB::table('asta_db.user_random')
                ->orderBy('user_id', 'desc')
                ->first();

        if($number)
        {
            if(empty($last->user_id))
            {
                $lastID = 1;
                $plus = 0;
                $count  = $number;
            } else {
                $lastID = $last->user_id+1;
                $count  = $last->user_id + $number;
            }


            for ($i=$lastID; $i <= $count; $i++) {
                $playerId[] = [
                'user_id' => $i,
                'isused'  => '0'
                ];
            }

            DB::table('asta_db.user_random')->insert($playerId);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '3',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Create new user Random with '.$number.' Record'
            ]);

            return back()->with('success', 'Input Data Successfull with '.$number.' Record');
        }
        return back()->with('alert', 'Number of inputs filled in Player ID can\'t be NULL ');
    }
}
