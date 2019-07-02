<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'asta_db.game';
    protected $guarded = [];
    public $timestamps = false;
}
