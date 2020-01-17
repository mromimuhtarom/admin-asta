<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{
    protected $guarded    = [];
    protected $table      = 'asta_db.log_user';
    protected $primaryKey = 'asta_db.log_user.user_id';

    public $timestamps = false;
}
