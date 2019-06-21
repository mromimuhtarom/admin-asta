<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'asta_db.operator';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'userpass', 'role_id', 'fullname', 'op_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'userpass', 'remember_token',
    ];

    public function getAuthPassword()
    {

        return $this->userpass;

    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
