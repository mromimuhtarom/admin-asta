<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpkRound extends Model
{
    protected $table = 'asta_db.tpk_round';
    protected $guarded = [];
    protected $primaryKey = 'round_id';
    
    public $timestamps = false;
}
