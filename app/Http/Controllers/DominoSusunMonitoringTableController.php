<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DominoSusunMonitoringTableController extends Controller
{
    
    public function index()
    {
        return view('pages.games_asta.dominoSusunNovice');
    }

    public function indexIntermediate()
    {
        return view('pages.games_asta.dominoSusunIntermediate');
    }

    public function indexPro()
    {
        return view('pages.games_asta.dominoSusunPro');
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
