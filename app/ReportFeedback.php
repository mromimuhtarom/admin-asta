<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportFeedback extends Model
{
    protected $table = "asta_db.report_feedback";
    protected $guarded = [];

    public $timestamps = false;

    public $ratings = [
        1 => 'Terrible',
        2 => 'Bad',
        3 => 'OK',
        4 => 'Good',
        5 => 'Great'
    ];

    public function strRating()
    {
        return $this->ratings[$this->rating];
    }
    
}
