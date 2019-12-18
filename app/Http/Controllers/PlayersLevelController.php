<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerLevel;
use App\PlayerRank;

class PlayersLevelController extends Controller
{
    public function index()
    {
        $playerslevel = PlayerLevel::all();
        $playersrank = PlayerRank::all();
        return view('pages.players.players_level', compact('playerslevel', 'playersrank'));
    }
}
