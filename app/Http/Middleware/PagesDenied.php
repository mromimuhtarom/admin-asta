<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Classes\RolesClass;
use App\Classes\MenuClass;

class PagesDenied
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $menuname)
    {
        $menus1 = RolesClass::RoleType0($menuname);
        $status = MenuClass::DBMenuStatus($menuname);


        if($menus1 || $status)
        {
            return new Response(view('pages_denied'));
            // abort(403, 'Mohon maaf halaman ini sedang di blok');
        }
        return $next($request);
    }
}
