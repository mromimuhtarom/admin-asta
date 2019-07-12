<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRandom extends Model
{
    protected $table = 'asta_db.user_random';
    protected $guarded = [];
    public $timestamps = false;
}
