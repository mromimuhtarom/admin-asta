<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerLevel extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.user_level';
    protected $guarded      = [];
    protected $primaryKey   = 'level';
}
