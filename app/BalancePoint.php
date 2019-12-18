<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalancePoint extends Model
{
    protected $table = 'asta_db.balance_point';
    
    protected $guarded = [];
    protected $primaryKey = 'id';
    
    public $timestamps = false;
}
