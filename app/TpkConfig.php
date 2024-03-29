<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TpkConfig extends Model
{
    protected $table     = "asta_db.tpk_config";
    protected $guarded   = [];
    public    $timestamps = false;

    public function strname()
    {
        $name = str_replace('_', ' ', $this->name);
        $capitalletters = ucwords($name);

        return $capitalletters;
    }
}
