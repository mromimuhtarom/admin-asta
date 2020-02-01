<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigTwoPlayer extends Model
{
    protected $table = 'asta_db.bgt_player';
    protected $guarded = [];
    protected $primaryKey = 'user_id';
    
    public $timestamps = false;

    public function BgtTable() {
        return $this->belongsTo(BigTwoTable::class, 'table_id');
    } 
}
