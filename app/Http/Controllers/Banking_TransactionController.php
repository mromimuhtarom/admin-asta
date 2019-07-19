<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionDay;
use Carbon\Carbon;
use DB;

class Banking_TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        return view('pages.transaction.banking_transaction', compact('datenow'));
    }

    public function search(Request $request)
    {
        $time    = $request->time;
        $minDate = $request->inputMinDate;
        $maxDate = $request->inputMaxDate;
        $datenow = Carbon::now('GMT+7')->toDateString();

        $transaction_day = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                           ->join('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                           ->select(
                               'asta_db.transaction_day.date_created',
                               DB::raw('sum(asta_db.transaction_day.win) As totalWin'),
                               DB::raw('sum(asta_db.transaction_day.lose) As totalLose'),
                               DB::raw('sum(asta_db.transaction_day.fee) As totalFee'),
                               DB::raw('sum(asta_db.transaction_day.turnover) As totalTurnover')
                           );
        $Transaction = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                           ->join('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                           ->select(
                               'asta_db.game.desc',
                               'asta_db.user.username',
                               'asta_db.transaction_day.date_created',
                               'asta_db.transaction_day.win',
                               'asta_db.transaction_day.lose',
                               'asta_db.transaction_day.turnover',
                               'asta_db.transaction_day.fee'
                           );


        if($time == "today")
        {
            $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                       ->get();
            
            return view('pages.transaction.banking_transaction_detail', compact('history', 'datenow'));
        } else if($time == "week")
        {
            $history = $transaction_day->selectRaw(' YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek, max(date(asta_db.transaction_day.date_created)) As maxDate, min(date(asta_db.transaction_day.date_created)) As minDate')
                       ->groupBy('yearperweek', DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                       ->get();
 
            return view('pages.transaction.banking_transaction_detail_group', compact('history', 'datenow'));

        } else if($time == "month")
        {
            $history = $transaction_day->selectRaw(' month(asta_db.transaction_day.date_created) As month, YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek, max(date(asta_db.transaction_day.date_created)) As maxDate, min(date(asta_db.transaction_day.date_created)) As minDate')
                       ->groupBy('month', DB::raw("WEEK('asta_db.transaction_day.date_created')"))
                       ->get();
 
            return view('pages.transaction.banking_transaction_detail_group', compact('history', 'datenow'));
        } else if($time == "all time")
        {

            if($minDate != NULL && $maxDate != NULL)
            {
                $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->get();
     
                return view('pages.transaction.banking_transaction_detail', compact('history', 'datenow'));
            } else if($minDate != NULL)
            {
                $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
                           ->get();
     
                return view('pages.transaction.banking_transaction_detail', compact('history', 'datenow'));
            } else if($maxDate != NULL)
            {
                $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
                           ->get();
     
                return view('pages.transaction.banking_transaction_detail', compact('history', 'datenow'));
            }
        }

    }

    public function detail($mindate, $maxdate)
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        $history = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
                   ->join('asta_db.game', 'asta_db.game.id', '=', 'asta_db.transaction_day.game_id')
                   ->select(
                    'asta_db.game.desc',
                    'asta_db.user.username',
                    'asta_db.transaction_day.date_created',
                    'asta_db.transaction_day.win',
                    'asta_db.transaction_day.lose',
                    'asta_db.transaction_day.turnover',
                    'asta_db.transaction_day.fee'
                   )
                   ->wherebetween('asta_db.transaction_day.date_created', [$mindate." 00:00:00", $maxdate." 23:59:59"])
                   ->get();

        return view('pages.transaction.banking_transaction_detail', compact('history', 'datenow'));
    }

    
}
