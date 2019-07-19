<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDay extends Model
{
    public $timestamps = false;

    protected $table = 'asta_db.transaction_day';
    protected $guarded = [];
}
