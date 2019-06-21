<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RolesClass {
    public static function RoleType2($menu)
    {
      $menus1 = DB::table('asta_db.adm_menu')
                ->join('asta_db.adm_access','asta_db.adm_menu.menu_id', '=', 'asta_db.adm_access.menu_id')
                ->where('role_id', Session::get('roleId'))
                ->where('name', '=', $menu)
                ->where('type', '=', '2')
                ->first();
      return $menus1;
    }

    public static function RoleType1($menu)
    {
      $menus1 = DB::table('asta_db.adm_menu')
                ->join('asta_db.adm_access','asta_db.adm_menu.menu_id', '=', 'asta_db.adm_access.menu_id')
                ->where('role_id', Session::get('roleId'))
                ->where('name', '=', $menu)
                ->where('type', '=', '1')
                ->first();
      return $menus1;
    }

    public static function RoleType0($menu)
    {
      $type0 = DB::table('asta_db.adm_menu')
                      ->join('asta_db.adm_access','asta_db.adm_menu.menu_id', '=', 'asta_db.adm_access.menu_id')
                      ->where('role_id', Session::get('roleId'))
                      ->where('name', '=', $menu)
                      ->where('type', '=', '0')
                      ->first();
      return $type0;

    }
}

?>
