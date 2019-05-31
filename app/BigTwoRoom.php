<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigTwoRoom extends Model
{
    public $timestamps      = false;

    protected $table        = 'bgt_room';
    protected $guarded      = [];
    protected $primaryKey   = 'roomid';

    public function bigTwoTable(){
        return $this->belongsTo(BigTwoTable::class);
    }
}
