<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $guarded =[] ;
    
    protected $table = 'asta_db.user_stat';
    // const CREATED_AT = 'ts';
    // const UPDATED_AT = NULL;
    public $timestamps = false;

    public function player(){
      return $this->belongsTo(Player::class);
    }
}
