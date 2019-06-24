<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OperatorActive;

class ActiveAdminController extends Controller
{
    public function index()
    {
        $active = OperatorActive::all();
    }
}
