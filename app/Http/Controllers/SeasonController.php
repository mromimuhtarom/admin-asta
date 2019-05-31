<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta poker index
     */
    public function index()
    {
        // $menu  = MenuClass::menuName('Role Admin');
        $season = DB::table('seasons')->get();
        return view('pages.game_asta.season', compact('season'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big two index
     */
    public function BigTwoindex()
    {
        $season = 'This page under construction';
        return view('pages.game_asta.BigTwoSeason', compact('season'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seasonName = $request->seasonName;
        $startTime = $request->startTime;
        $finishTime = $request->finishTime;

        DB::table('seasons')->insert([
            'title'         => $seasonName,
            'startTime'     => strtotime($startTime),
            'finishTime'    => strtotime($finishTime),
        ]);
        return redirect()->route('Season-view')->with('success','Data Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
        DB::table('seasons')->where('seasonId', '=', $pk)->update([
            $name => $value 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $seasonId = $request->seasonId;
        if($seasonId != '')
        {
            DB::table('seasons')->where('seasonId', '=', $seasonId)->delete();
            return redirect()->route('Season-view')->with('success','Data Deleted');
        }
        return redirect()->route('Season-view')->with('success','Something wrong');  
    }
}
