<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpkTable extends Model
{

    public $timestamps = false;

    protected $table = 'asta_db.tpk_table';
    protected $guarded = [];
    protected $primaryKey = 'tableid';

    public function room(){
        return $this->belongsTo(Room::class);
    }

}
