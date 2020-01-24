<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreTransactionDay extends Model
{
    protected $table = 'asta_db.store_transaction_day';
    protected $guarded = [];


    public $timestamps = false;
}
