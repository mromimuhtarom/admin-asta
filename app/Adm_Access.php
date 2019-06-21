<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_Access extends Model
{
    protected $table = 'asta_db.adm_access';
    // protected $guarded = [];
    
    protected $fillable = array('role_id', 'menu_id', 'type');
    public $timestamps = false;

    
}
