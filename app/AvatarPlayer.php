<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvatarPlayer extends Model
{
    public $timestamps      =   false;

    protected $table        =   'asta_db.avatar';
    protected $guarded      =   [];
    protected $primaryKey   =   'id';
}
