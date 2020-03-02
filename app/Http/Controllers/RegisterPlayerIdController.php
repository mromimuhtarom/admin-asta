<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\ConfigText;
use App\Log;
use Carbon\Carbon;
use App\UserRandom;
use Session;
use Validator;

class RegisterPlayerIdController extends Controller
{
    public function index()
    {
        $menu     = MenuClass::menuName('L_REGISTER_PLAYER_ID');
        $mainmenu = MenuClass::menuName('L_PLAYERS');
        $usertype = ConfigText::select(
                        'name', 
                        'value'
                    )
                    ->where('id', '=', 1)
                    ->first();
        $totalplayer   = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 1)->first();
        $totalguest    = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 2)->first();
        $totalbot      = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 3)->first();
        $playernotused = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 1)->where('isused', '=', 0)->first();
        $guestnotused  = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 2)->where('isused', '=', 0)->first();
        $botnotused    = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 3)->where('isused', '=', 0)->first();
        $playerused    = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 1)->where('isused', '=', 1)->first();
        $guestused     = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 2)->where('isused', '=', 1)->first();
        $botused       = UserRandom::select(DB::raw('count(user_id) as countuserid'))->where('user_type', '=', 3)->where('isused', '=', 1)->first();

        $value = str_replace(':', ',', $usertype->value);
        $type = explode(",", $value);

        
        return view('pages.players.registerplayerid', compact('type', 'menu', 'mainmenu', 'totalplayer', 'totalguest', 'totalbot', 'playernotused', 'guestnotused', 'botnotused', 'playerused', 'guestused', 'botused'));
    }

    public function store(Request $request)
    {
        $number   = $request->inputcount;
        $usertype = $request->usertype;
        $data     = $request->all();
        $validate = [
        //   'username' => 'unique:reseller,username',
        //   'phone'    => 'unique:reseller,phone',
        //   'email'    => 'unique:reseller,email',
        //   'idcard'   => 'unique:reseller,identify'
            'inputcount' => 'required|integer',
            'usertype'   => 'required'
        ];
  
        $validator = Validator::make($data,$validate);
  
        if($validator->fails())
        {  
          return back()->withInput()->with('alert', $validator->errors()->first());
        }            

        $last = UserRandom::select('user_id')
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
                'user_id'   => $i,
                'user_type' => $usertype,
                'isused'    => '0'
                ];
            }

            if($usertype == 1):
                $usertype = 'Player';
            elseif($usertype == 2):
                $usertype = 'Guest';
            else:
                $usertype = 'Bot';
            endif;

            UserRandom::insert($playerId);
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '8',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Menambahkan data sebanyak '.$number.' input untuk '.$usertype.' ID'
            ]);

            return back()->with('success', alertTranslate("Input Data successfull with ").$number.' Record');
        }
        return back()->with('alert', alertTranslate("Number of inputs filled in player ID can't be NULL"));
    }

    
}
