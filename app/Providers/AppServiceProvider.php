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
        $transaction_report_read = DB::table('report_problem')
                                   ->select(DB::raw('COUNT(*) as hitung'))
                                   ->where('isread', '=', 0)
                                   ->first();
        $array_menu = [
            "Dasboard" => "Dasbor", 
            "Admin" =>  'Admin',
            'User_Admin'    =>  'Pengguna Admin',
            ''
        ];
        
        view::share('adm_menu', $adm_menu);
        view::share('menuname', $menuname);
        view::share('transaction_report_read', $transaction_report_read);
    }
}
