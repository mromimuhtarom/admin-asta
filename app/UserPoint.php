<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    protected $table = 'asta_db.user_point';
    protected $guarded = [];
    protected $primaryKey = 'id';
    
    public $timestamps = false;
}
