<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreDelivery extends Model
{
    protected $table = 'asta_db.store_delivery';
    protected $guarded = [];
    protected $primaryKey = 'id';
    
    public $timestamps = false;
}
