<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDay;
use Carbon\Carbon;
use DB;
use Validator;
use App\Game;
use Illuminate\Support\Facades\Input;

class TransactionPlayersController extends Controller
{
        
    public function index()
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        $gamename = Game::select('id', 'desc')->get();
        return view('pages.players.TransactionPlayers', compact('datenow', 'gamename'));
    }

    public function search(Request $request)
    {
        $time       = $request->choose_time;
        $minDate    = $request->inputMinDate;
        $maxDate    = $request->inputMaxDate;
        $game       = $request->game_name;
        $namecolumn = $request->namecolumn;
        $datenow    = Carbon::now('GMT+7')->toDateString();
        $gamename   = Game::select('id', 'desc')->get();

    // if sorting variabel null

        if($namecolumn == NULL):
          $namecolumn = 'asta_db.transaction_day.date_created';
        endif;
        if(Input::get('sorting') === 'desc'):
          $sortingorder = 'asc';
        elseif(Input::get('sorting') == NULL):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'desc';
        endif;

        

        $transaction_day = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id');
        



        if($time == "day")
        {
            
            $Transaction = TransactionDay::leftJoin('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                           ->select(
                            'asta_db.transaction_day.date_created',
                            'asta_db.game.desc',
                            'asta_db.transaction_day.game_id',
                            DB::raw('sum(asta_db.transaction_day.win) As wintransaction'),
                            DB::raw('sum(asta_db.transaction_day.lose) As losetransaction'),
                            DB::raw('sum(asta_db.transaction_day.fee) As feetransaction'),
                            DB::raw('sum(asta_db.transaction_day.turnover) As turnovertransaction'),
                            DB::raw('sum(asta_db.transaction_day.prize) As prizetransaction'),
                            DB::raw('sum(asta_db.transaction_day.win) - sum(asta_db.transaction_day.lose) + sum(asta_db.transaction_day.prize) as totalWinLose '),
                            DB::raw(' YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek'), 
                            DB::raw('max(date(asta_db.transaction_day.date_created)) As maxDate'), 
                            DB::raw('min(date(asta_db.transaction_day.date_created)) As minDate')
                          );    
            
            if($game != NULL && $minDate != NULL && $maxDate != NULL):
                
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->where('asta_db.transaction_day.game_id', '=', $game)
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('DATE(asta_db.transaction_day.date_created)'))      
                           ->paginate(20);
            elseif($minDate != NULL && $maxDate != NULL):
         
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('DATE(asta_db.transaction_day.date_created)'))      
                           ->paginate(20);
            elseif($minDate != NULL):
                $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('DATE(asta_db.transaction_day.date_created)'))      
                           ->paginate(20); 

            elseif($maxDate != NULL):
                $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('DATE(asta_db.transaction_day.date_created)'))      
                           ->paginate(20);  
            endif;
            $lang_id ='Harian';
            $history->appends($request->all());
            return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));

        } 
        else if($time == "week")
        {
            $Transaction = $transaction_day->leftJoin('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                           ->select(
                            'asta_db.transaction_day.date_created',
                            'asta_db.game.desc',
                            'asta_db.transaction_day.game_id',
                            DB::raw('sum(asta_db.transaction_day.win) As wintransaction'),
                            DB::raw('sum(asta_db.transaction_day.lose) As losetransaction'),
                            DB::raw('sum(asta_db.transaction_day.fee) As feetransaction'),
                            DB::raw('sum(asta_db.transaction_day.turnover) As turnovertransaction'),
                            DB::raw('sum(asta_db.transaction_day.prize) As prizetransaction'),
                            DB::raw('sum(asta_db.transaction_day.win) - sum(asta_db.transaction_day.lose) + sum(asta_db.transaction_day.prize) as totalWinLose '),
                            DB::raw(' YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek'), 
                            DB::raw('max(date(asta_db.transaction_day.date_created)) As maxDate'), 
                            DB::raw('min(date(asta_db.transaction_day.date_created)) As minDate')
                      );
            // Search berdasarkan time, game, tnggal minimal tanggal maksimal
            if($game != NULL && $minDate != NULL && $maxDate != NULL):
                
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->where('asta_db.transaction_day.game_id', '=', $game)
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy( DB::raw(' YEARWEEK(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))                                     
                           ->paginate(20);
            elseif($minDate != NULL && $maxDate != NULL):
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->where('game_id', '=', $game)
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy( DB::raw(' YEARWEEK(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))     
                           ->paginate(20);
            // Search berdasarkan time, tanggal minimal tanggal maksimal
            elseif($minDate != NULL):
                $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy( DB::raw(' YEARWEEK(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))     
                           ->paginate(20);
            elseif($maxDate != NULL):
                $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy( DB::raw(' YEARWEEK(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))     
                           ->paginate(20);
            endif;
            $lang_id   = 'Mingguan';
                
            $history->appends($request->all());
            return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));

        } else if($time == "month")
        {
            $Transaction= $transaction_day->leftJoin('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                           ->select(
                            'asta_db.transaction_day.date_created',
                            'asta_db.game.desc',
                            'asta_db.transaction_day.game_id',
                            DB::raw('sum(asta_db.transaction_day.win) As wintransaction'),
                            DB::raw('sum(asta_db.transaction_day.lose) As losetransaction'),
                            DB::raw('sum(asta_db.transaction_day.fee) As feetransaction'),
                            DB::raw('sum(asta_db.transaction_day.turnover) As turnovertransaction'),
                            DB::raw('sum(asta_db.transaction_day.prize) As prizetransaction'),
                            DB::raw('sum(asta_db.transaction_day.win) + sum(asta_db.transaction_day.fee) - sum(asta_db.transaction_day.lose) - sum(asta_db.transaction_day.prize) as totalWinLose '),
                            DB::raw('month(asta_db.transaction_day.date_created) As month'), 
                            DB::raw('YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek'), 
                            DB::raw('max(date(asta_db.transaction_day.date_created)) As maxDate'), 
                            DB::raw('min(date(asta_db.transaction_day.date_created)) As minDate')
                            );
                        $lang_id = 'Bulanan';
                      
             // Search berdasarkan time, game, tnggal minimal tanggal maksimal
            if($game != NULL && $minDate != NULL && $maxDate != NULL):
                
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->where('asta_db.transaction_day.game_id', '=', $game)
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('month(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))                                                              
                           ->paginate(20);
            elseif($minDate != NULL && $maxDate != NULL):
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->where('game_id', '=', $game)
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('month(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                           ->paginate(20);
            // Search berdasarkan time, tanggal minimal tanggal maksimal
            elseif($minDate != NULL):
                $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('month(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                           ->paginate(20);
            elseif($maxDate != NULL):
                $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
                           ->orderBy($namecolumn, $sortingorder)
                           ->groupBy(DB::raw('month(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                           ->paginate(20);
            endif;
            
            $history->appends($request->all());
            return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));
        } else if($time == "all time")
        {
            $Transaction =  TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                            ->leftJoin('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                            ->select(
                                'asta_db.user.username',
                                'asta_db.game.desc',
                                'asta_db.transaction_day.game_id',
                                'asta_db.transaction_day.date_created',
                                'asta_db.transaction_day.win as wintransaction',
                                'asta_db.transaction_day.lose as losetransaction',
                                'asta_db.transaction_day.turnover as turnovertransaction',
                                'asta_db.transaction_day.fee as feetransaction',
                                'asta_db.transaction_day.prize as prizetransaction',
                                DB::raw('asta_db.transaction_day.win - asta_db.transaction_day.lose + asta_db.transaction_day.prize as totalWinLose')
                            );
            $lang_id = '';
            if($game != NULL && $minDate != NULL && $maxDate != NULL)
            {
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->where('asta_dn.transaction_day.game_id', '=', $game)
                           ->orderBy($namecolumn, $sortingorder)   
                           ->paginate(20);
                        
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));
            }
            if($minDate != NULL && $maxDate != NULL)
            {
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->orderBy($namecolumn, $sortingorder)   
                           ->paginate(20);
                        
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));
            } else if($minDate != NULL)
            {
                $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
                        ->orderBy($namecolumn, $sortingorder)
                        ->paginate(20);
     
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));
            } else if($maxDate != NULL)
            {
                $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
                        ->orderBy($namecolumn, $sortingorder)
                        ->paginate(20);
     
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));
            } else if($minDate == NULL && $maxDate == NULL)
            {
                return back()->with('alert', alertTranlsate("Min Date And Max Date Must be Filled In"));
            }
            $lang_id='Sepanjang waktu';
        } else {
            $validator = Validator::make($request->all(),[
                'time'   => 'required',
            ]);
        
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
        }

    }

    public function detail(Request $request)
    {
        $datenow    = Carbon::now('GMT+7')->toDateString();
        $namecolumn = $request->namecolumn;
        $mindate    = $request->minDate;
        $maxdate    = $request->maxDate;
        $game       = $request->game_name;
        $namecolumn = $request->namecolumn;
        $gamename   = Game::select('id', 'desc')->get();

        // if sorting variabel null
        if($namecolumn == NULL):
          $namecolumn = 'asta_db.transaction_day.date_created';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

        $transaction = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                       ->leftJoin('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                       ->select(
                        'asta_db.game.desc',
                        'asta_db.transaction_day.game_id',
                        'asta_db.user.username',
                        'asta_db.transaction_day.date_created',
                        'asta_db.transaction_day.win as wintransaction',
                        'asta_db.transaction_day.lose as losetransaction',
                        'asta_db.transaction_day.turnover as turnovertransaction',
                        'asta_db.transaction_day.fee as feetransaction',
                        'asta_db.transaction_day.prize as prizetransaction',
                        DB::raw('asta_db.transaction_day.win - asta_db.transaction_day.lose + asta_db.transaction_day.prize as totalWinLose')                        
                       );
    if($game):
        $history = $transaction->wherebetween('asta_db.transaction_day.date_created', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                   ->where('asta_db.transaction_day.game_id', '=', $game)
                   ->orderBy($namecolumn, $sortingorder)
                   ->paginate(20);
    else:
        $history = $transaction->wherebetween('asta_db.transaction_day.date_created', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                   ->orderBy($namecolumn, $sortingorder)
                   ->paginate(20);
    endif;

                   
        $time      = "detail";
        $lang_id   = '';
        $minDate   = Input::get('minDate');
        $maxDate   = Input::get('maxDate');;
        $history->appends($request->all());

        return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'gamename', 'game'));
    }
}
