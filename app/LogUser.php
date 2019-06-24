<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{
    protected $guarded = [];
    protected $table = 'asta_db.log_user';

    public $timestamps = false;
}
