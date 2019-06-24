<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogOnline extends Model
{
    protected $table = 'asta_db.log_online';
    protected $guarded = [];
    const CREATED_AT = 'datetime';
    const UPDATED_AT = 'datetime';

    public $user_types = [
        '0' => 'Player',
        '1' => 'Operator'
    ];

    public function strUser_type() {
        return $this->user_types[$this->type];
    }

}
