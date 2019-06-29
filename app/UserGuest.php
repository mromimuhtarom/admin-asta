<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGuest extends Model
{
    protected $table = 'user_guest';
    protected $guarded = [];
    public $timestamps = false;
}
