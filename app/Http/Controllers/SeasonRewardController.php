<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeasonReward as SR;
use App\Classes\MenuClass;
use DB;

class SeasonRewardController extends Controller
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
        $reward = SR::all();
        return view('pages.game_asta.season_reward', compact('reward'));
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
        return view('pages.game_asta.BigTwoSeason_reward', compact('season'));
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
        $from       = $request->rewardFrom;
        $to         = $request->rewardTo;
        $rewardChip = $request->rewardchip;
        $rewardGold = $request->rewardgold;

        DB::table('season_reward')->insert([
            'positionFrom'  => $from,
            'positionTo'    => $to,
            'winpotReward'  => $rewardChip,
            'goldReward'    => $rewardGold
        ]);
        return redirect()->route('SeasonReward-view')->with('success','Data Added');
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
  
        SR::where('id', '=', $pk)->update([
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
        $sRewardId = $request->sRewardId;
        if($sRewardId != '')
        {
            DB::table('season_reward')->where('id', '=', $sRewardId)->delete();
            return redirect()->route('SeasonReward-view')->with('success','Data Deleted');
        }
        return redirect()->route('SeasonReward-view')->with('success','Something wrong');  
    }
}
