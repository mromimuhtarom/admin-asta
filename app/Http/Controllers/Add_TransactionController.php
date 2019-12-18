<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Add_TransactionController extends Controller
{
    public function index()
    {
        return view('pages.transaction.add_transaction');
    }
}
