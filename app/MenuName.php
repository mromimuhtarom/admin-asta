<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuName extends Model
{
  
      protected $table = 'asta_db.adm_menu';
      // protected $guarded = [];
      
      protected $fillable = array('parent_id', 'name', 'route', 'icon');
      public $timestamps = false;


      // public function parent()
      // {
      //       return $this->belongsTo(MenuName::class, 'parent_id', 'menu_id');
      // }

      // public function children()
      // {
      //       return $this->hasMany(MenuName::class, 'menu_id', 'parent_id');
      // }

      public function parent() {

            return $this->hasOne(MenuName::class, 'menu_id');
            
      }
    
      public function children() {

            return $this->hasMany(MenuName::class, 'parent_id', 'menu_id');

      } 

}
