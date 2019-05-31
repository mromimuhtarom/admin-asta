<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoQTable extends Model
{
    public $timestamps      = false;

    protected $table        = 'dmq_table';
    protected $guarded      = [];
    protected $primaryKey   = 'tableid';

    public function room() {
        return $this->belongsTo(DominoQRoom::class);
    }
}
