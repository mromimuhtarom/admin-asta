<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $table = 'notifications';
    protected $guarded = [] ;
    public $timestamps = false;
}
