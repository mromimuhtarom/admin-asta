<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpkRoom extends Model
{
    public $timestamps = false;

    protected $table = 'asta_db.tpk_room';
    protected $guarded = [];
    protected $primaryKey = 'room_id';

    public function tables(){
        return $this->hasMany(Table::class);
    }
}
