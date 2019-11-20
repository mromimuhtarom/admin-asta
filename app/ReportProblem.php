<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportProblem extends Model
{
    protected $guarded = [];
    protected $table = 'asta_db.report_problem';

    public $timestamps = false;
}
