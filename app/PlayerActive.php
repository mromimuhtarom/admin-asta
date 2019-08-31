<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerActive extends Model
{
    protected $table = 'asta_db.user_active';
    protected $guarded = [];

    public $timestamps = false;
    public $userType = [
        '1' =>  'Player',
        '2' =>  'Guest'
    ];

    public function strUser_type()
    {
        return $this->userType[$this->user_type];
    }

    public function tabledmq() {

        return $this->hasOne(DominoQTable::class, 'table_id', 'table_id');

    } 

    public function tabledms() {

        return $this->hasOne(DominoSusunTable::class, 'table_id', 'table_id');

    } 
    
    public function tabletpk() {

        return $this->hasOne(TpkTable::class, 'table_id', 'table_id');

    } 

    public function tableBigTwo() {

        return $this->hasOne(BigTwoTable::class, 'table_id', 'table_id');

    } 
}
