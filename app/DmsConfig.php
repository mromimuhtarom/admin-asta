<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmsConfig extends Model
{
    protected $table     = "asta_db.dms_config";
    protected $guarded   = [];
    public    $timestamps = false;
}
