<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class MenuClass {

    public static function menuName($menuName) {
        $menus1 = RolesClass::RoleType2($menuName);
        return $menus1;
    }

    public static function DBMenuStatus($dbmenuname)
    {
        $menu = DB::table('asta_db.adm_menu')
                ->where('name', '=', $dbmenuname)
                ->where('status', '=', 0)
                ->first();
        return $menu;
    }

}
?>
