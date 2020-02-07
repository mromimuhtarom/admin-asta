<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DominoQPlayer extends Model
{
    protected $table        =   'asta_db.dmq_player';
    protected $guarded      =   [];
    protected $primaryKey   =   'user_id';

    public $timestamps      =   false;

}
