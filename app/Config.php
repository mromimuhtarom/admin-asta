<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'asta_db.config';
    protected $guarded = [];
    
    public $timestamps = false;
}
