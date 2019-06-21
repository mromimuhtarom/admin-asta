<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $guarded = [];
    protected $table = 'asta_db.log_operator';

    public $timestamps = false;
}
