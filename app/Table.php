<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{

    public $tableSpeeds = array(10=> 'Normal',15=>'Fast');
    public $tableTypes = array('s'=> 'Cash Game','t'=>'Sit & Go','m'=>'Multi-Table Tournament');

    const CREATED_AT = 'ts';
    const UPDATED_AT = NULL;

    protected $table = 'poker';
    protected $guarded = [];
    protected $primaryKey = 'gameID';

    public function tournament(){
      return $this->belongsTo(Tournament::class);
    }

    public function dealer(){
        return $this->belongsTo(Dealer::class);
    }

    public function strTableSpeed() {

			return $this->tableSpeeds[$this->speed];

		}

    public function strTableType() {

			return $this->tableTypes[$this->tabletype];
		}

}
