<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\LogOnline;
use Carbon\Carbon;
use App\OperatorActive;
use App\User;
use Session;
use Cache;
use DB;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed 
     */
    public function handle($request, Closure $next)
    {
        $op_idcache = Cache::get('op_key');
        $session_id = Cache::get('session_id');
        $logout     = OperatorActive::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.operator_active.op_id')
                      ->where('asta_db.operator_active.session_id', '=', $session_id)
                      ->first();
        if(Session::get('login1')) {
            $op              = Session::get('userId');
            $operator_active = OperatorActive::where('op_id', '=', $op)->first();
            if ($operator_active)
            {
                OperatorActive::where('op_id', '=', $op)->update([
                    'op_id'       => $op,
                    'session_id'  => $session_id,
                    'date_update' => Carbon::now('GMT+7'),
                    'ip'          => request()->ip()
                ]);
            } else {
                OperatorActive::create([
                    'op_id'       => $op,
                    'session_id'  => $session_id,
                    'date_login'  => Carbon::now('GMT+7'),
                    'date_update' => Carbon::now('GMT+7'),
                    'ip'          => request()->ip()
                ]);
            }
            Cache::put('op_key', $op);
            Cache::put('session_id', $session_id);
            return $next($request);
        } 


        if($logout)
        {
            LogOnline::create([
                'user_id'   =>  $logout->op_id,
                'action_id' =>  8,
                'desc'      =>  'user '.$logout->username.' Logout in web Admin',
                'datetime'  => Carbon::now('GMT+7'),
                'ip'        => request()->ip(),
                'type'      => 1
            ]);
        }
        OperatorActive::where('session_id', '=', $session_id)->where('op_id', '=', $op_idcache)->delete();
        Cache::flush();
        return redirect()->route('logout')->with('alert','Please Login First');
    }
}
