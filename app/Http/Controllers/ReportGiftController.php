<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Carbon\Carbon;


class ReportGiftController extends Controller
{
    public function index()
    {
        $datenow = Carbon::now('GMT+7');
        $game = Game::select('id', 'desc')->get();
        // $category = 
        return view('pages.item.reportgift', compact('game', 'datenow'));
    }

    public function search()
    {
        $datenow = Carbon::now('GMT+7');
        $game = Game::select('id', 'desc')->get();
        return view('pages.item.reportgift_detail', compact('datenow', 'game'));
    }
}
