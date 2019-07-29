<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsCash extends Model
{
    protected $table = 'asta_db.item_cash';
    protected $guarded = [];
    public $timestamps = false;

    public $itemTypes = [
        '0' => 'None',
        '2' => 'Gold'
    ];

    public function strItemType()
    {
        return $this->itemTypes[$this->item_type];
    }
}
