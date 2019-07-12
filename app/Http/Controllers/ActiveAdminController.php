<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OperatorActive;
use Carbon\Carbon;
use DateTime;
class ActiveAdminController extends Controller
{
    public function index()
    {
        $date = Carbon::now('GMT+7');
        $date->modify('-2 minutes');

        $active = OperatorActive::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.operator_active.op_id')
                  ->select('asta_db.operator.username', 
                           'asta_db.operator_active.date_login', 
                           'asta_db.operator_active.ip'
                    )
                  ->where('session_id', '!=', '')  
                  ->where('date_update', '>=', $date)
                  ->get();

        return view('pages.admin.active_admin', compact('active'));
    }
}
