<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDay;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;

class TransactionPlayersController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        return view('pages.players.TransactionPlayers', compact('datenow'));
    }

    public function search(Request $request)
    {
        $time       = $request->choose_time;
        $minDate    = $request->inputMinDate;
        $maxDate    = $request->inputMaxDate;
        $namecolumn = $request->namecolumn;
        $datenow    = Carbon::now('GMT+7')->toDateString();


    // if sorting variabel null

        if($namecolumn == NULL):
          $namecolumn = 'asta_db.transaction_day.date_created';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

        

        $transaction_day = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id');
        
        $Transaction = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                           ->select(
                               'asta_db.user.username',
                               'asta_db.transaction_day.date_created',
                               'asta_db.transaction_day.win as wintransaction',
                               'asta_db.transaction_day.lose as losetransaction',
                               'asta_db.transaction_day.turnover as turnovertransaction',
                               'asta_db.transaction_day.fee as feetransaction',
                               'asta_db.transaction_day.prize as prizetransaction',
                               DB::raw('asta_db.transaction_day.win + asta_db.transaction_day.fee - asta_db.transaction_day.lose - asta_db.transaction_day.prize as totalWinLose')
                           );


        if($time == "today")
        {
            $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                ->orderBy($namecolumn, $sortingorder)       
                ->paginate(20);
                $lang_id ='Hari ini';

            $history->appends($request->all());
            return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));

        } 
        else if($time == "week")
        {
            $history = $transaction_day->select(
                            'asta_db.transaction_day.date_created',
                            DB::raw('sum(asta_db.transaction_day.win) As wintransaction'),
                            DB::raw('sum(asta_db.transaction_day.lose) As losetransaction'),
                            DB::raw('sum(asta_db.transaction_day.fee) As feetransaction'),
                            DB::raw('sum(asta_db.transaction_day.turnover) As turnovertransaction'),
                            DB::raw('sum(asta_db.transaction_day.prize) As prizetransaction'),
                            DB::raw('sum(asta_db.transaction_day.win) + sum(asta_db.transaction_day.fee) - sum(asta_db.transaction_day.lose) - sum(asta_db.transaction_day.prize) as totalWinLose '),
                            DB::raw(' YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek'), 
                            DB::raw('max(date(asta_db.transaction_day.date_created)) As maxDate'), 
                            DB::raw('min(date(asta_db.transaction_day.date_created)) As minDate')
                            )
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy( DB::raw(' YEARWEEK(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                        ->paginate(20);
                        $lang_id   = 'pekan ini';
                
            $history->appends($request->all());
            return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));

        } else if($time == "month")
        {
            $history = $transaction_day->select(
                            'asta_db.transaction_day.date_created',
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
                            )
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.transaction_day.date_created)'), DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                        ->paginate(20);
                        $lang_id = 'Bulan ini';
                      
            $history->appends($request->all());
            return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        } else if($time == "all time")
        {
            $lang_id = '';
            if($minDate != NULL && $maxDate != NULL)
            {
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                        ->orderBy($namecolumn, $sortingorder)   
                        ->paginate(20);
                        
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            } else if($minDate != NULL)
            {
                $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
                        ->orderBy($namecolumn, $sortingorder)
                        ->paginate(20);
     
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            } else if($maxDate != NULL)
            {
                $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
                        ->orderBy($namecolumn, $sortingorder)
                        ->paginate(20);
     
                $history->appends($request->all());
                return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            } else if($minDate == NULL && $maxDate == NULL)
            {
                return back()->with('alert', 'Min Date And Max Date Must be Filled In');
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
        $datenow = Carbon::now('GMT+7')->toDateString();
        $namecolumn = $request->namecolumn;
        $mindate = $request->minDate;
        $maxdate = $request->maxDate;
        // if sorting variabel null
        if($namecolumn == NULL):
          $namecolumn = 'asta_db.transaction_day.date_created';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

        $history = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                   ->select(
                    'asta_db.user.username',
                    'asta_db.transaction_day.date_created',
                    'asta_db.transaction_day.win as wintransaction',
                    'asta_db.transaction_day.lose as losetransaction',
                    'asta_db.transaction_day.turnover as turnovertransaction',
                    'asta_db.transaction_day.fee as feetransaction'
                   )
                   ->wherebetween('asta_db.transaction_day.date_created', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                   ->orderBy($namecolumn, $sortingorder)
                   ->paginate(20);
                   
        $time      = "detail";
        $lang_id   = '';
        $minDate   = Input::get('minDate');
        $maxDate   = Input::get('maxDate');;
        $history->appends($request->all());

        return view('pages.players.TransactionPlayers', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
    }
}
