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
        '1' => 'L_CHIP',
        '2' => 'L_GOLD',
        '3' => 'L_GOODS'
    ];
    public $shopType = [
        '1' =>  'L_USER',
        '2' =>  'L_RESELLER'
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
