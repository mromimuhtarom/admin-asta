<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoSusunTable extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.dms_table';
    protected $guarded      = [];
    protected $primaryKey   = 'table_id';

    public function room() {
        return $this->belongsTo(DominoSusunRoom::class);
    }
}
