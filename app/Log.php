<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $guarded = [];
    protected $table = 'admin_log';

    public $timestamps = false;
}
