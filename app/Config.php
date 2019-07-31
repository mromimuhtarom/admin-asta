<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'asta_db.config';
    protected $guarded = [];
    
    public $timestamps = false;
    public $maintenace_status = [
        '1' =>  'On',
        '2' =>  'Off'
    ];

    public function strmaintenance()
    {
        $maintenance = $this->where('id', '=', 101)->select('value');
        return $this->maintenance_status[$maintenance];
    }
}
