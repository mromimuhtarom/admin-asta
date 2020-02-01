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

    public function BgtPlayer() {
        return $this->hasMany(BigTwoPlayer::class, 'table_id', 'table_id')->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.bgt_player.user_id');
    } 
}
