<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmqConfig extends Model
{
    protected $table     = "asta_db.dmq_config";
    protected $guarded   = [];
    public    $timestamps = false;

    public function strname()
    {
        $name = str_replace('_', ' ', $this->name);
        $capitalletters = ucwords($name);

        return $capitalletters;
    }
}
