<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreTransactionHist extends Model
{
    protected $table = 'asta_db.store_transaction_hist';
    protected $guarded = [];

    public $timestamps = false;
    
    public $statusApdec = [
        '0' =>  'Decline',
        '1' =>  'Request',
        '2' =>  'Decline'
    ];

    public function strStatus()
    {
        return $this->statusApdec[$this->status];
    }
}
