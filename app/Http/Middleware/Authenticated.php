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
use Artisan;

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
                      ->select(
                          'asta_db.operator_active.op_id',
                          'asta_db.operator.username'
                      )
                      ->where('asta_db.operator_active.session_id', '=', $session_id)
                      ->first();
        
        if(Session::get('login1')) {
            $op              = Session::get('userId');
            $operator_active = OperatorActive::where('op_id', '=', $op)->first();
            $cahce_op        = OperatorActive::where('op_id', '=', $op_idcache)->first();
            $operator        = User::where('op_id', '=', $op_idcache)->first();
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');

            
            // untuk delete jika date_update melebihi 15 menit
            $op_active = OperatorActive::where('date_update', '<', DB::raw('DATE_SUB(NOW(),INTERVAL 60 MINUTE)'))->first();
                if($op_active)
                {
                    OperatorActive::where('date_update', '<', DB::raw('NOW() + INTERVAL 60 MINUTE'))->delete();
                }
            //End untuk delete jika date_update melebihi 15 menit

            if ($operator_active)
            {
                OperatorActive::where('op_id', '=', $op)->update([
                    'op_id'       => $op,
                    'date_update' => Carbon::now('GMT+7'),
                    'ip'          => request()->ip()
                ]);
            } else {
                if($cahce_op)
                {
                    OperatorActive::update([
                        'op_id'       => $op,
                        'date_update' => Carbon::now('GMT+7'),
                        'ip'          => request()->ip()
                    ]);
                } else {
                    if($op_idcache)
                    {
                        LogOnline::create([
                            'user_id'   => $op_idcache,
                            'action_id' => 8,
                            'desc'      => 'user '.$operator->username.' Logout in web Admin',
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
