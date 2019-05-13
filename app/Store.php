<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';
    protected $guarded = [];

    public $timestamps = false;


    public function bank(){

      return $this->belongsTo(Bank::class);

    }
}
