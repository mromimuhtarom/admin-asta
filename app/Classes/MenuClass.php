<?php
namespace App\Classes;

class MenuClass {

    public static function menuName($menuName) {
        $menus1 = RolesClass::RoleType2($menuName);
        return $menus1;
    }

}
?>
