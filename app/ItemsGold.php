<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsGold extends Model
{
    protected $table = 'asta_db.item_gold';
    protected $guarded = [];
    public $timestamps = false;

    public $item_types = [
        '1' => 'Chip',
    ];
    
    public function strItemType()
    {
        return $this->item_types[$this->item_type];
    }
}
