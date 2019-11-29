<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BalancePoint;
use App\Game;
use Carbon\Carbon;
use Validator;
use App\ConfigText;

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
                        ->JOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_point.game_id')
                        ->select(
                            'asta_db.user.username', 
                            'asta_db.balance_point.action_id', 
                            'asta_db.game.name as gamename', 
                            'asta_db.balance_point.debit',
                            'asta_db.balance_point.credit',
                            'asta_db.balance_point.balance',
                            'asta_db.balance_point.datetime'
                        );
        
        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required',
            'inputMaxDate'    => 'required',
        ]);

        $action      = ConfigText::select(
                        'name',
                        'value'
                       ) 
                       ->where('id', '=', 11)
                       ->first();
        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
          $actionbalance[0]  => $actionbalance[1] ,
          $actionbalance[2]  => $actionbalance[3] ,
          $actionbalance[4]  => $actionbalance[5] ,
          $actionbalance[6]  => $actionbalance[7] ,
          $actionbalance[8]  => $actionbalance[9] 
        ];

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
                              ->orderby('asta_db.balance_point.datetime', 'desc')
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc'));
        } else if($username != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby('asta_db.balance_point.datetime', 'desc')
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc'));
        } else if($gameName != NULL && $minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->where('asta_db.balance_point.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby('asta_db.balance_point.datetime', 'desc')
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc'));
        } else if($minDate != NULL && $maxDate != NULL) {
            $balancedetails = $balancePoint->wherebetween('asta_db.balance_point.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                              ->orderby('asta_db.balance_point.datetime', 'desc')
                              ->paginate(20);
            $balancedetails->appends($request->all());
            return view('pages.players.point_player', compact('balancedetails', 'datenow', 'game','actblnc'));
        } else {
            return back();            
        }
    }
}
