<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbusePlayer extends Model
{
    protected $guarded = [];
    protected $table = 'asta_db.abuse_report';

    public $timestamps = false;

    public function report() {

        return $this->belongsTo(Player::class, 'user_id', 'report');

  } 
}
