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
    protected $primaryKey   = 'asta_db.user.user_id';

    public $statusUser = [
        '1' => 'L_Approve',
        '2' => 'L_Banned',
        '3' => 'L_Problem',
    ];

    public function strStatus() {
        return $this->statusUser[$this->status];
    }

    public function stat(){
      return $this->belongsTo(Stat::class);
    }

    public function device(){
      return $this->belongsTo(Device::class);
    }
    public function loguser() {
        return $this->hasMany(LogUser::class);
    } 
}
