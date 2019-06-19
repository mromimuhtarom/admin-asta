<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuName extends Model
{
  
      protected $table = 'asta_db.adm_menu';
      protected $guarded = [];
  
      public $timestamps = false;
}
