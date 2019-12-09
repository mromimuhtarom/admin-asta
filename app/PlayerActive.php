<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerActive extends Model
{
    protected $table = 'asta_db.user_active';
    protected $guarded = [];

    public $timestamps = false;
    public $userType = [
        '1' =>  'Player',
        '2' =>  'Guest'
    ];

    public function strUser_type()
    {
        return $this->userType[$this->user_type];
    }
}
