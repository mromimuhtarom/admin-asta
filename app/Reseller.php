<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = 'asta_db.reseller';
    protected $guarded = [];
    public $timestamps = false;

    public static function getAllData()
    {
      //return all data from Reseller Model / table reseller
      return self::all();
    }

    public static function insertData($data = [])
    {
      return self::create($data);
    }
}
