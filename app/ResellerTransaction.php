<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerTransaction extends Model
{
    protected $table = 'asta_db.reseller_transaction';
    protected $guarded = [];

    public $timestamps = false;
}
