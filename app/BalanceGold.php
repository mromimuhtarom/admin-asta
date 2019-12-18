<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceGold extends Model
{
    protected $table = 'asta_db.balance_gold';

    protected $guarded = [];
    protected $primaryKey = 'id';
    
    public $timestamps = false;
}
