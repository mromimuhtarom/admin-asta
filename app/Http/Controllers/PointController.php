<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BalancePoint;
use App\Game;
use Carbon\Carbon;
use Validator;

class PointController extends Controller
{
    public function index()
    {
        $game    = Game::all();
        $datenow = Carbon::now('GMT+7');
        return view('pages.players.point_player', compact('game', 'game', 'datenow'));
    }

    public function search(Request $request)
    {
        $username     = $request->inputPlayer;
        $gameName     = $request->inputGame;
        $minDate      = $request->inputMinDate;
        $maxDate      = $request->inputMaxDate;
        $datenow      = Carbon::now('GMT+7');
        $game         = Game::all();
        $balancePoint = BalancePoint::JOIN('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.balance_point.user_id')
                        ->join('asta_db.action', 'asta_db.action.id', '=', 'asta_db.balance_point.action_id')
                        ->JOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_point.game_id')
                        ->select('asta_db.user.username', 'asta_db.action.action as actionname', 'asta_db.game.name as gamename', 'asta_db.balance_point.*');
        
        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required',
            'inputMaxDate'    => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        
        if($maxDate < $minDate){
            return back()->with('alert','End Date can\'t be less than start date');
        }

        if($username != NULL && $gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                              ->where('asta_db.balance_point.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->get();
            
            return view('pages.players.point_playerdetail', compact('balancedetails', 'datenow', 'game'));
        } else if($username != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->get();
            
            return view('pages.players.point_playerdetail', compact('balancedetails', 'datenow', 'game'));
        } else if($gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.balance_point.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->get();
            
            return view('pages.players.point_playerdetail', compact('balancedetails', 'datenow', 'game'));
        } else if($minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->get();
            
            return view('pages.players.point_playerdetail', compact('balancedetails', 'datenow', 'game'));
        } else {
            return self::index();            
        }
    }
}
