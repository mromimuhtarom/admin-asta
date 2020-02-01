<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoSPlayer extends Model
{
    protected $table        = 'asta_db.dms_player';
    protected $guarded      = [];
    protected $primaryKey   =  'user_id';

    public $timestamps      =   false;

    public function DominoSusunTable(){
        return $this->belongsTo(DominoSusunTable::class, 'table_id');
    }
}
