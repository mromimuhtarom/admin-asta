<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoQTable extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.dmq_table';
    protected $guarded      = [];
    protected $primaryKey   = 'table_id';

    public function room() {
        return $this->belongsTo(DominoQRoom::class);
    }
}
