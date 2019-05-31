<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RolesClass {
    public static function RoleType2($menu)
    {
      $menus1 = DB::table('adm_menu')
                ->join('adm_access','adm_menu.menu_id', '=', 'adm_access.menu_id')
                ->where('role_id', Session::get('roleId'))
                ->where('name', '=', $menu)
                ->where('adm_menu.webid', '=', '1')
                ->where('type', '=', '2')
                ->first();
      return $menus1;
    }

    public static function RoleType1($menu)
    {
      $menus1 = DB::table('adm_menu')
                ->join('adm_access','adm_menu.menu_id', '=', 'adm_access.menu_id')
                ->where('role_id', Session::get('roleId'))
                ->where('name', '=', $menu)
                ->where('adm_menu.webid', '=', '1')
                ->where('type', '=', '1')
                ->first();
      return $menus1;
    }

    public static function RoleType0($menu)
    {
      $type0 = DB::table('adm_menu')
                      ->join('adm_access','adm_menu.menu_id', '=', 'adm_access.menu_id')
                      ->where('role_id', Session::get('roleId'))
                      ->where('name', '=', $menu)
                      ->where('adm_menu.webid', '=', '1')
                      ->where('type', '=', '0')
                      ->first();
      return $type0;

    }
}

?>
