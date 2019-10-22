<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmqRound extends Model
{
    protected $table = 'asta_db.dmq_round';
    protected $guarded = [];
    
    public $timestamps = false;
}
