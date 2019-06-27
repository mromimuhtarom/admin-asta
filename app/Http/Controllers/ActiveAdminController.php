<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OperatorActive;

class ActiveAdminController extends Controller
{
    public function index()
    {
        $active = OperatorActive::join('asta_db.operator', 'asta_db.operator.op_id', '=', 'asta_db.operator_active.op_id')
                  ->where('session_id', '!=', '')  
                  ->get();
        return view('pages.admin.active_admin', compact('active'));
    }
}
