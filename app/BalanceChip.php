<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class BalanceChip extends Model
{
    use Sortable;
    protected $table = 'asta_db.balance_chip';

    public $sortable = [
        'debit',
        'credit',
        'balance',
        'datetime',
        'user_id',
        'action_id',
    ];


}
