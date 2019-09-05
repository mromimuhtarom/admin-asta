<?php

namespace App\Providers;
use View;
use DB;
use App\MenuName;
use App\Classes\RolesClass;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $adm_menu = MenuName::select(
                        'name', 
                        'route', 
                        'icon',
                        'menu_id'
                    )
                    ->where('status', '=', 1)
                    ->where('parent_id', '=', 0)
                    ->get();
        $menuname = new RolesClass;
        view::share('adm_menu', $adm_menu);
        view::share('menuname', $menuname);
    }
}
