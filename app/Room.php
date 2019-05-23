<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;

    protected $table = 'tpk_room';
    protected $guarded = [];
    protected $primaryKey = 'roomid';

    public function table(){
        return $this->belongsTo(Table::class);
    }
}
