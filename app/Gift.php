<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $table = 'gift';
    protected $guarded = [];
    public $timestamps = false;
}
