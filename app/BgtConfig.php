<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BgtConfig extends Model
{
    protected $table     = "asta_db.bgt_config";
    protected $guarded   = [];
    public    $timestamps = false;
}
