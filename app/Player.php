<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    protected $table = 'asta_db.user';
    // const CREATED_AT = NULL;
    // const UPDATED_AT = NULL;
    public $timestamps = false;

    public $statusUser = [
        '1' => 'Approve',
        '2' => 'Banned',
        '3' => 'Problem',
    ];

    public function strStatus() {
        return $this->statusUser[$this->status];
    }

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
