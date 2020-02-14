<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $table = 'asta_db.gift';
    public $category = array('1'=> 'L_FOOD','2'=>'L_DRINK','3'=>'L_ITEM','4'=>'L_ACTION');
    protected $guarded = [];
    public $timestamps = false;

    public function strCategory() {

        return $this->category[$this->category_id];
    }
}
