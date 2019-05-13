<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    protected $table = 'user';
    // const CREATED_AT = NULL;
    // const UPDATED_AT = NULL;
    public $timestamps = false;


    public function stat(){
      return $this->belongsTo(Stat::class);
    }

    public function bank(){
      return $this->belongsTo(Bank::class);
    }

    public function device(){
      return $this->belongsTo(Device::class);
    }
}
