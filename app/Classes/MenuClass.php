<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class MenuClass {

    public static function menuName($menuName) {
        $menus1 = RolesClass::RoleType2($menuName);
        return $menus1;
    }

    public static function DBMenuName($dbmenuname)
    {
        $menu = DB::table('asta_db.adm_menu')->where('parent_id', '=', $dbmenuname)->select('name')->first();
        return $menu;
    }

}
?>
