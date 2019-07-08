<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerTransactionDay extends Model
{
    protected $table = 'asta_db.reseller_transaction_day';
    protected $guarded = [];

    public $timestamps = false;
}
