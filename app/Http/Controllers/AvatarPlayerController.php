<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use DB;
use App\AvatarPlayer;
use App\Classes\MenuClass;
use Response;
use Validator;
use App\ConfigText;


class AvatarPlayerController extends Controller
{
    public function index()
    {
        $avatarPlayer   =   AvatarPlayer::select(
                                'id',
                                'name',
                                'path'
                            )
                            ->get();
        $menu           =   MenuClass::menuName('Avatar player');
        $mainmenu       =   MenuClass::menuName('Players');
        $timenow        =   Carbon::now('GMT+7');

        // --- Disabled Enabled --- //
        $active         =   ConfigText::select(
                                'name',
                                'value'
                            )
                            ->where('id', '=', 4)
                            ->first();
        $value          =   str_replace(':', ',', $active->value);
        $endis          =   explode(",", $value);
        
        
        return view('pages.players.avatar_player', compact('avatarPlayer', 'menu', 'endis', 'mainmenu', 'timenow'));
    }

    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
