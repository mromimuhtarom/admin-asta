<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigTwoTable extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.bgt_table';
    protected $guarded      = [];
    protected $primaryKey   = 'table_id';

    public function room() {
        return $this->belongsTo(BigTwoRoom::class);
    }
}
