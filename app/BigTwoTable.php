<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigTwoTable extends Model
{
    public $timestamps      = false;

    protected $table        = 'bgt_table';
    protected $guarded      = [];
    protected $primaryKey   = 'tableid';

    public function room() {
        return $this->belongsTo(BigTwoRoom::class);
    }
}