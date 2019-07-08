<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreTransaction extends Model
{
    protected $table = 'asta_db.store_transaction';
    protected $guarded = [];


    public $timestamps = false;
}
