<?php

namespace App\Http\Controllers;

use App\BalanceChip;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Game;
use App\Classes\MenuClass;
use Validator;
use App\ConfigText;
use Illuminate\Support\Facades\Input;

class ChipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datenow = Carbon::now('GMT+7');
      $game    = Game::all();
      return view('pages.players.chip_player', compact('datenow', 'game'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $searchUser   = $request->inputPlayer;
        $minDate      = $request->inputMinDate;
        $maxDate      = $request->inputMaxDate;
        $gameName     = $request->inputGame;
        $sorting      = $request->sorting;
        $namecolumn   = $request->namecolumn;
        
        // $user_id      = $request->user_id;
        // $username     = $request->username;
        // $action_id    = $request->action_id;
        // $debit        = $request->debit;
        // $credit       = $request->credit;
        // $balance      = $request->balance;
        // $datetime     = $request->datetime;

        $menus1       = MenuClass::menuName('Balance Chip');
        $game         = Game::all();
        $datenow      = Carbon::now('GMT+7');
        $action       = ConfigText::select(
                          'name',
                          'value'
                        ) 
                        ->where('id', '=', 11)
                        ->first();

        $balanceChip  = BalanceChip::select(
                          'asta_db.balance_chip.debit',
                          'asta_db.balance_chip.credit',
                          'asta_db.balance_chip.balance',
                          'asta_db.balance_chip.datetime', 
                          'asta_db.user.username', 
                          'asta_db.balance_chip.user_id',
                          'asta_db.game.name as gamename', 
                          'asta_db.balance_chip.action_id'
                        )
                        ->JOIN('asta_db.user', 'asta_db.balance_chip.user_id', '=', 'asta_db.user.user_id')
                        ->JOIN('asta_db.game', 'asta_db.game.id', '=', 'asta_db.balance_chip.game_id');
        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        
        $validator = Validator::make($request->all(),[
          'inputMinDate'    => 'required|date',
          'inputMaxDate'    => 'required|date',
        ]);

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

        //if sorting variable is null
        if($sorting == NULL): 
          $sorting = 'desc';
        endif;

        if($namecolumn == NULL):
          $namecolumn = 'asta_db.balance_chip.datetime';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;
        
        $getMindate = Input::get('inputMinDate');
        $getMaxdate = Input::get('inputMaxDate');

        if(Input::get('sorting') === 'desc'):
          if(Input::get('namecolumn') === 'asta_db.balance_chip.user_id'):
            $user_id   = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.user.username'):
            $username  = 'fa fa-sort-desc';
            $user_id   = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';


          elseif(Input::get('namecolumn') === 'asta_db.game.name' ):
            $gamesname = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.action_id'):
            $action_id = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.debit'):
            $debit     = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.credit'):
            $credit    = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.balance'):
            $balance   = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.datetime'):
            $datetime  = 'fa fa-sort-desc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
          endif;

        elseif(Input::get('sorting') === 'asc'):
          if(Input::get('namecolumn') === 'asta_db.balance_chip.user_id'): 
            $user_id   = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.user.username'): 
            $username  = 'fa fa-sort-asc';
            $user_id   = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.game.name' ):
            $gamesname = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';


          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.action_id'): 
            $action_id = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.debit'): 
            $debit     = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.credit'): 
            $credit    = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.balance'): 
            $balance   = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
            $datetime  = 'fa fa-sort';

          elseif(Input::get('namecolumn') === 'asta_db.balance_chip.datetime'): 
            $datetime  = 'fa fa-sort-asc';
            $username  = 'fa fa-sort';
            $gamesname = 'fa fa-sort';
            $action_id = 'fa fa-sort';
            $debit     = 'fa fa-sort';
            $credit    = 'fa fa-sort';
            $balance   = 'fa fa-sort';
            $user_id   = 'fa fa-sort';
          endif;

        else:
          $datetime  = 'fa fa-sort';
          $username  = 'fa fa-sort';
          $gamesname = 'fa fa-sort';
          $action_id = 'fa fa-sort';
          $debit     = 'fa fa-sort';
          $credit    = 'fa fa-sort';
          $balance   = 'fa fa-sort';
          $user_id   = 'fa fa-sort';
      endif; 
        
        if($searchUser != NULL && $gameName != NULL && $minDate != NULL && $maxDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if($searchUser != NULL && $gameName != NULL && $minDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;
          
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if($searchUser != NULL && $gameName != NULL && $maxDate != NULL) {

          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser)
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if($searchUser != NULL && $gameName != NULL) {
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->where('asta_db.balance_chip.game_id', '=', $gameName)
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if($gameName != NULL && $minDate != NULL) {
          
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if($gameName != NULL && $maxDate != NULL) {
          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                            ->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy($namecolumn, $sorting)
                            ->get();
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if ($searchUser != NULL && $minDate != NULL && $maxDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($sorting, $namecolumn)
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        }else if ($searchUser != NULL && $minDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);  
          else:  
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($searchUser != NULL && $maxDate != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                              ->orderBy($namecolumn, $sorting)
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($minDate != NULL && $maxDate != NULL){
         
          $balancedetails = $balanceChip->wherebetween('asta_db.balance_chip.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($searchUser != NULL){
          if(is_numeric($searchUser) !== true):
            $balancedetails = $balanceChip->WHERE('asta_db.user.username', 'LIKE', '%'.$searchUser.'%' )
                              ->paginate(20);
          else:
            $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.user_id', '=', $searchUser )
                              ->paginate(20);
          endif;

          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        } else if($gameName != NULL) {
          $balancedetails = $balanceChip->where('asta_db.balance_chip.game_id', '=', $gameName)
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));
        
        } else if ($minDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '>=', $minDate." 00:00:00")
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));

        }else if ($maxDate != NULL){

          $balancedetails = $balanceChip->WHERE('asta_db.balance_chip.datetime', '<=', $maxDate." 23:59:59")
                            ->orderBy($namecolumn, $sorting)
                            ->paginate(20);
          $balancedetails->appends($request->all());
          return view('pages.players.chip_player', compact('balancedetails', 'menus1', 'datenow', 'game','actblnc', 'sortingorder', 'getMaxdate', 'getMindate', 'user_id', 'username', 'gamesname', 'action_id', 'debit', 'credit', 'balance', 'datetime'));


        }

    }
}
