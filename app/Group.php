<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];
    protected $table = 'groups';

    public $timestamps = false;

    public function percentGroupFee(){
      $fee = $this->fee * 100;
      return $fee;
    }
}
