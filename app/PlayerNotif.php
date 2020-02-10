<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerNotif extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.user_notif';
    protected $guarded      = [];
    protected $primaryKey   = 'id';
}
