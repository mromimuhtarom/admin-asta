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

    public function TpkPlayer() {
        return $this->hasMany(TpkPlayer::class, 'table_id', 'table_id')->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_player.user_id')->select('username');
    } 

}
