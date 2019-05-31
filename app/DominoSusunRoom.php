<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoSusunRoom extends Model
{
    public $timestamps      = false;

    protected $table        = 'dms_room';
    protected $guarded      = [];
    protected $primaryKey   = 'roomid';

    public function tables(){
        return $this->hasMany(DominoSusunTable::class);
    }
}
