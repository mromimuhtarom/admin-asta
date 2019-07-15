<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoSusunRoom extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.dms_room';
    protected $guarded      = [];
    protected $primaryKey   = 'room_id';

    public function tables(){
        return $this->hasMany(DominoSusunTable::class);
    }
}
