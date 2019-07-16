<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BgtRound extends Model
{
    protected $table = 'asta_db.bgt_round';
    protected $guarded = [];
    
    public $timestamps = false;
}
