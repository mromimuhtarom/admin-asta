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

    public function DominoSPlayer() {
        return $this->hasMany(DominoSPlayer::class, 'table_id', 'table_id')->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dms_player.user_id');
    }
}
