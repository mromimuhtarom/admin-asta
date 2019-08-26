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
        '1' => 'Chip',
        '2' => 'Gold',
        '3' => 'Goods'
    ];

    public $shopType = [
        '1' =>  'User',
        '2' =>  'Reseller'
    ];

    public function strItemType()
    {
        return $this->itemTypes[$this->item_type];
    }

    public function strShopType()
    {
        return $this->shopType[$this->shop_type];
    }

    
}
