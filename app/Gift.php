<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $table = 'gift';
    public $category = array('1'=> 'Makanan','2'=>'Minuman','3'=>'Item');
    protected $guarded = [];
    public $timestamps = false;

    public function strCategory() {

        return $this->category[$this->category_id];
    }
}
