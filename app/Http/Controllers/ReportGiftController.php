<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportGiftController extends Controller
{
    public function index()
    {
        return view('pages.item.reportgift');
    }

    public function search()
    {
        return view('pages.item.reportgift_detail');
    }
}
