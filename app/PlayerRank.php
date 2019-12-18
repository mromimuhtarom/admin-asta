<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerRank extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.user_rank';
    protected $guarded      = [];
    protected $primaryKey   = 'id';
}
