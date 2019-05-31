<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoSusunTable extends Model
{
    public $timestamps      = false;

    protected $table        = 'dms_table';
    protected $guarded      = [];
    protected $primaryKey   = 'tableid';

    public function room() {
        return $this->belongsTo(DominoSusunRoom::class);
    }
}
