<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpkPlayer extends Model
{
    protected $table = 'asta_db.tpk_player';
    protected $guarded = [];
    protected $primaryKey = 'user_id';
    
    public $timestamps = false;

    public function TpkTable() {
        return $this->belongsTo(TpkTable::class, 'table_id');
    } 
}
