<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $guarded = [];
    protected $table = 'asta_db.action';

    public $timestamps = false;
}
