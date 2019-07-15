<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoQRoom extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.dmq_room';
    protected $guarded      = [];
    protected $primaryKey   = 'room_id';

    public function tables(){
        return $this->hasMany(DominoQTable::class);
    }
}
