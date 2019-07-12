<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'asta_db.country';
    protected $guarded = [];
    public $timestamps = false;
}
