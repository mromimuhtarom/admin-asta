<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    protected $table = 'asta_db.msg_notif';
    protected $guarded = [];

    public $timestamps = false;
}
