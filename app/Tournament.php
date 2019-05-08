<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

    public $gameTypes = array('NL'=> 'No Limit','POT'=>'POT');
    public $statuses = array(0=> 'Announced',1=>'Registering',2=>'Starting',3=>'Playing',4=>'Finished',-1=>'Cancelled');

    protected $primaryKey = 'tournamentId';
    protected $guarded = [];

    const CREATED_AT = 'ts';
    const UPDATED_AT = NULL;

    public function table(){
      return $this->belongsTo(Table::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function getRouteKeyName()
    {
        return 'tournamentId';
    }

    public function strGameType() {

			return $this->gameTypes[$this->gameType];

		}

    // public function strStatus() {
    //
    // return $this->statuses[$this->status];
    //
    // }
}
