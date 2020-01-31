<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DominoSusunTable;

class DominoSusunMonitoringTableController extends Controller
{
    
    public function index()
    {
        $table  =   DominoSusunTable::where('room_id', '=', 1)->get();   
        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusunNovice', compact('table'));
    }

    public function indexIntermediate()
    {
        $table =    DominoSusunTable::where('room_id', '=', 2)->get();
        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusunIntermediate');
    }

    public function indexPro()
    {
        return view('pages.game_asta.domino_susun.monitoring_table_domino_susun.dominoSusunPro');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
