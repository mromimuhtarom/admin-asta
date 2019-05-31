<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoQRoom extends Model
{
    public $timestamps      = false;

    protected $table        = 'dmq_room';
    protected $guarded      = [];
    protected $primaryKey   = 'roomid';

    public function tables(){
        return $this->hasMany(DominoQTable::class);
    }
}
