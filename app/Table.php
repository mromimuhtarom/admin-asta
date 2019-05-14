<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{

    public $timestamps = false;

    protected $table = 'tpk_table';
    protected $guarded = [];
    protected $primaryKey = 'tableid';

}
