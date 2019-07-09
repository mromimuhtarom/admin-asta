<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'asta_db.payment';
    protected $guarded = [];
    public $timestamps = false;
}
