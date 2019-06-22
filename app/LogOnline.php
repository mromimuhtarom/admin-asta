<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogOnline extends Model
{
    protected $table = 'asta_db.log_online';
    protected $guarded = [];
    const CREATED_AT = 'datetime';
    const UPDATED_AT = 'datetime';

}
