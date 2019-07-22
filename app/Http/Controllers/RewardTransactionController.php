<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardTransactionController extends Controller
{
    public function index()
    {
        return view('pages.transaction.reward_transaction');
    }
}
