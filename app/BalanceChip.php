<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceChip extends Model
{
    protected $table = 'asta_db.balance_chip';

    protected $guarded = [];
    protected $primaryKey = 'id';
    
    public $timestamps = false;

}
