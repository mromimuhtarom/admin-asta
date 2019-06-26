<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Cache;
use Carbon\Carbon;
use App\OperatorActive;

class Home
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
        if(Session::get('login1')) {

            return redirect(route('Dashboard'));
    
        }else{
    
            return $next($request);
    
        }
    }
}
