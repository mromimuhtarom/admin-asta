<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmsRound extends Model
{
    protected $table = 'asta_db.dms_round';
    protected $guarded = [];
    
    public $timestamps = false;
}
