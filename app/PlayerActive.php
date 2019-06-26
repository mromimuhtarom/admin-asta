<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerActive extends Model
{
    protected $table = 'asta_db.user_active';
    protected $guarded = [];

    public $timestamps = false;
}
