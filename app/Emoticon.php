<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emoticon extends Model
{
    public $timestamps      = false;

    protected $table        = 'asta_db.emoticon';
    protected $guarded      = [];
    protected $primaryKey   = 'id';

    public function strCategory() {

        return $this->category[$this->category_id];
    }
}
