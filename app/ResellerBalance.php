<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerBalance extends Model
{
    protected $table = 'asta_db.reseller_balance';
    protected $guarded =[];

    public $timestamps = false;
}
