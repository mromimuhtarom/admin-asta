<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class ReportGiftController extends Controller
{
    public function index()
    {
        $game = Game::select('id', 'desc')->get();
        // $category = 
        return view('pages.item.reportgift', compact('game'));
    }

    public function search()
    {
        $game = Game::select('id', 'desc')->get();
        return view('pages.item.reportgift_detail');
    }
}
