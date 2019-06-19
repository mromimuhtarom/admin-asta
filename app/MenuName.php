<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuName extends Model
{
  
      protected $table = 'asta_db.adm_menu';
      // protected $guarded = [];
      
      protected $fillable = array('parent_id', 'name', 'route', 'icon');
      public $timestamps = false;

      public function parent()
      {
            return $this->belongsTo('App\MenuName', 'parent_id');
      }

      public function children()
      {
            return $this->hasMany('App\MenuName', 'parent_id');
      }
}
