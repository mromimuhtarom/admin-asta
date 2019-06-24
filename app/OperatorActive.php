<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatorActive extends Model
{
    protected $guarded = [];
    protected $table = 'asta_db.operator_active';

    public $timestamps = false;
}
