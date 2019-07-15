<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigTwoRoom extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.bgt_room';
    protected $guarded      = [];
    protected $primaryKey   = 'room_id';

    public function tables(){
        return $this->hasMany(BigTwoTable::class);
    }
}
