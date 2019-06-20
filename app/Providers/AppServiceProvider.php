<?php

namespace App\Providers;
use View;
use DB;
use App\MenuName;
use App\Classes\MenuClass;

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
        $adm_menu = DB::table('asta_db.adm_menu')->where('status', '=', 1)->where('parent_id', '=', 0)->get();
        view::share('adm_menu', $adm_menu);
    }
}
