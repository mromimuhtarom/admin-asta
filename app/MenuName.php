<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuName extends Model
{
  
      protected $table = 'asta_db.adm_menu';
      
      protected $fillable = array('parent_id', 'name', 'route', 'icon');
      public $timestamps = false;

      public function parent() {

            return $this->hasOne(MenuName::class, 'menu_id');
            
      }
    
      public function children() {

            return $this->hasMany(MenuName::class, 'parent_id', 'menu_id')->where('status', '=', 1);

      } 

      public function access() {

            return $this->hasMany(Adm_Access::class, 'menu_id', 'menu_id')->where('status', '=', 1)->where('type', '=', 1)->orwhere('type', '=', 2);

      } 

}
