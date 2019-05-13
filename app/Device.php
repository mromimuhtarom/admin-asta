<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'user_device';
    protected $guarded = [];

    public $timestamps = false;

    public function player(){
      return $this->belongsTo(Player::class);
    }

    public function guest(){
      return $this->belongsTo(Device::class);
    }
}
