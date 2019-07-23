<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGuest extends Model
{
    protected $table = 'asta_db.user_guest';
    protected $guarded = [];
    public $timestamps = false;
}
