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

    public function DominoQPlayer() {
        return $this->hasMany(DominoQPlayer::class, 'table_id', 'table_id')->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dmq_player.user_id');
    }
}
