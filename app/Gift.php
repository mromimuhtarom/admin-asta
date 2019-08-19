<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $table = 'asta_db.gift';
    public $category = array('1'=> 'Food','2'=>'Drink','3'=>'Item');
    protected $guarded = [];
    public $timestamps = false;

    public function strCategory() {

        return $this->category[$this->category_id];
    }
}
