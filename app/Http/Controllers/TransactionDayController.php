<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreTransactionDay;
use Carbon\Carbon;
use DB;
use Validator;
use App\BalanceChip;
use App\BalanceGold;
use App\BalancePoint;
use Illuminate\Support\Facades\Input;

class TransactionDayController extends Controller
{
    
    public function index()
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        return view('pages.transaction.transaction_day', compact('datenow'));
    }

    public function search(Request $request)
    {
        // $searchUser = $request->inputPlayer;
        $time       = $request->choose_time;
        $minDate    = $request->inputMinDate;
        $maxDate    = $request->inputMaxDate;
        $namecolumn = $request->namecolumn;
        $datenow    = Carbon::now('GMT+7')->toDateString();

        $transactionDay = StoreTransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.store_transaction_day.user_id')
                          ->join('asta_db.user_point', 'asta_db.user_point.user_id', '=', 'asta_db.store_transaction_day.user_id')
                          ->select(
                              'store_transaction_day.id',
                              'store_transaction_day.user_id',
                              'user.username',
                              'store_transaction_day.debet',
                              'store_transaction_day.credit',
                              'store_transaction_day.gold_debet',
                              'store_transaction_day.gold_credit',
                              'store_transaction_day.chip_debet',
                              'store_transaction_day.chip_credit',
                              'store_transaction_day.reward_gold',
                              'store_transaction_day.reward_point',
                              'store_transaction_day.reward_chip',
                              'store_transaction_day.date_created',
                              'store_transaction_day.correction_gold',
                              'store_transaction_day.correction_chip',
                              'store_transaction_day.correction_point',
                              'user_point.point',
                              'user_point.point_spend',
                              'user_point.point_expired'
                          );

        // Sorting table
        if($namecolumn == NULL):
            $namecolumn = 'asta_db.store_transaction_day.date_created';
          endif;
  
          if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
          else:
            $sortingorder = 'asc';
          endif;
  
          if($namecolumn == NULL):
            $namecolumn = 'asta_db.store_transaction_day.date_created';
          endif;

        if($time == "today"){
            $history = $transactionDay->wherebetween('asta_db.store_transaction_day.date_created', [$minDate. ' 00:00:00', $maxDate. ' 23:59:59'])
                        ->orderBy($namecolumn, $sortingorder)
                        ->paginate(20);
                        $lang_id    =   'Hari ini';

            $history->appends($request->all());
            return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        }
        elseif($time == "week"){
            $history = $transactionDay->select(
                            'asta_db.store_transaction_day.datecreated',
                            DB::raw('sum(asta_db.store_transaction_day.debet) As debettransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.credit) As credittransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.gold_debet) As gold_debettransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.gold_credit) As gold_credittransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.chip_debet) As chip_debettransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.chip_credit) As chip_credittransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.reward_gold) As reward_goldtransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.reward_point) As reward_pointtransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.reward_chip) As reward_chiptransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.date_created) As maxDate'),
                            DB::raw('sum(asta_db.store_transaction_day.data_created) As minDate'),
                            DB::raw(' YEARWEEK(asta_db.store_transaction_day.data_created) As yearperweek')
                            )
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy( DB::raw(' YEARWEEK(asta_db.store_transaction_day.data_created)'), DB::raw("WEEK('asta_db.store_transaction_Day.date_created')"))
                        ->paginate(20);
                        $lang_id    =   'pekan ini';
            
            $history->appends($request->all());
            return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        }
        elseif($time == "month"){
            $history = $transactionDay->select(
                        'asta_db.store_transaction_day.date_created',
                        DB::raw('sum(asta_db.store_transaction_day.debet) As debettransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.credit) As credittransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.gold_debet) As gold_debettransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.gold_credit) As gold_credittransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.chip_debet) As chip_debettransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.chip_credit) As chip_credittransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.reward_gold) As reward_goldtransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.reward_point) As reward_pointtransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.reward_chip) As reward_chiptransaction'),
                        DB::raw('sum(asta_db.store_transaction_day.date_created) As maxDate'),
                        DB::raw('sum(asta_db.store_transaction_day.date_created) As minDate'),
                        DB::raw(' YEARWEEK(asta_db.store_transaction_day.data_created) As yearperweek')
                        )

                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy( DB::raw(' YEARWEEK(asta_db.store_transaction_day.date_created'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
                        ->paginate(20);
                        $lang_id    = 'Bulan ini';

            $history->appends($request->all());
            return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        }
        elseif($time  == "all time"){
            $lang_id = '';
            if($minDate != NULL && $maxDate != NULL){
                $history = $transactionDay->wherebetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transactions.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            elseif($minDate != NULL){
                $history = $transactionDay->where('asta_db.store_transaction_day.date_created', '>=', $minDate." 00:00:00")
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transactions.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            elseif($maxDate != NULL){
                $history = $transactionDay->where('asta_db.store_transaction_day.date_created', '<=', $maxDate." 23:59:59")
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transactions.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            elseif($minDate == NULL && $maxDate == NULL){
                return back()->with('alert', alertTranlsate("Min Date And Max Date Must be Filled In"));
            }
            $lang_id = 'sepanjang waktu';
        } else{
            $validator = Validator::make($request->all(),[
                'inputMinDate'   => 'required',
                'inputMaxDate'   => 'required',
                'time'           => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
        }

        
        // if($searchUser != NULL && $minDate != NULL && $maxDate != NULL):
        //     if(is_numeric($searchUser) !== TRUE):
        //         $transaction_day = $transactionDay->where('asta_db.user.username', 'LIKE', '%'.$searchUser.'%')
        //                            ->whereBetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
        //                            ->orderBy($namecolumn, $sortingorder)
        //                            ->paginate(20);
        //     else:
        //         $transaction_day = $transactionDay->where('asta_db.store_transaction_day.user_id', '=', $searchUser)
        //                            ->whereBetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
        //                             ->orderBy($namecolumn, $sortingorder)
        //                            ->paginate(20);
        //     endif;

        //     $transaction_day->appends($request->all());
            
        //     return view('pages.transaction.transaction_day', compact('transaction_day', 'datenow', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'searchUser'));
        
        // elseif($minDate != NULL && $maxDate != NULL):
        //     $transaction_day = $transactionDay->whereBetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
        //                        ->orderBy($namecolumn, $sortingorder)                   
        //                        ->paginate(20);

        //     $transaction_day->appends($request->all());
        //     return view('pages.transaction.transaction_day', compact('transaction_day', 'datenow', 'minDate', 'maxDate', 'namecolumn', 'sortingorder', 'searchUser'));
        // endif;
        
    }

        // $transaction_day = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
        //                    ->select(
        //                        'asta_db.transaction_day.date_created',
        //                        DB::raw('sum(asta_db.transaction_day.win) As totalWin'),
        //                        DB::raw('sum(asta_db.transaction_day.lose) As totalLose'),
        //                        DB::raw('sum(asta_db.transaction_day.fee) As totalFee'),
        //                        DB::raw('sum(asta_db.transaction_day.turnover) As totalTurnover')
        //                    );
                           
        // if($time == "today")
        // {
        //     $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
        //         ->orderBy('asta_db.transaction_day.date_created', 'desc')       
        //         ->get();
        //         $lang_id ='Hari ini';
            
        //     return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id'));

        // } 
        // else if($time == "week")
        // {
        //     $history = $transaction_day->selectRaw(' YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek, max(date(asta_db.transaction_day.date_created)) As maxDate, min(date(asta_db.transaction_day.date_created)) As minDate')
        //                 ->orderBy('asta_db.transaction_day.date_created', 'desc')
        //                 ->groupBy('yearperweek', DB::raw("WEEK('asta_db.transaction_day.date_created')"))
        //                 ->get();

        //                 $lang_id   = 'pekan ini';
 
        //     return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id'));

        // } else if($time == "month")
        // {
        //     $history = $transaction_day->selectRaw(' month(asta_db.transaction_day.date_created) As month, YEARWEEK(asta_db.transaction_day.date_created) AS yearperweek, max(date(asta_db.transaction_day.date_created)) As maxDate, min(date(asta_db.transaction_day.date_created)) As minDate')
        //                 ->orderBy('asta_db.transaction_day.date_created', 'desc')
        //                 ->groupBy('month', DB::raw("WEEK('asta_db.transaction_day.date_created')"))
        //                 ->get();

        //                 $lang_id = 'Bulan ini';
 
        //     return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id'));
        // } else if($time == "all time")
        // {
        //     if($minDate != NULL && $maxDate != NULL)
        //     {
        //         $history = $Transaction->wherebetween('asta_db.transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
        //                 ->orderBy('asta_db.transaction_day.date_created', 'desc')   
        //                 ->get();
                        
        //         return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id'));
        //     } else if($minDate != NULL)
        //     {
        //         $history = $Transaction->where('asta_db.transaction_day.date_created', '>=', $minDate." 00:00:00")
        //                 ->orderBy('asta_db.transaction_day.date_created', 'desc')
        //                 ->get();
     
        //         return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id'));
        //     } else if($maxDate != NULL)
        //     {
        //         $history = $Transaction->where('asta_db.transaction_day.date_created', '<=', $maxDate." 23:59:59")
        //                 ->orderBy('asta_db.transaction_day.date_created', 'desc')
        //                 ->get();
     
        //         return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id'));
        //     } else if($minDate == NULL && $maxDate == NULL)
        //     {
        //         return back()->with('alert', alertTranslate('Min Date And Max Date Must be Filled In'));
        //     }
        //     $lang_id='Sepanjang waktu';
        // } else {
        //     $validator = Validator::make($request->all(),[
        //         'time'   => 'required',
        //     ]);
        
        //     if ($validator->fails()) {
        //         return back()->withErrors($validator->errors());
        //     }
        // }
    

    // public function detail($mindate, $maxdate)
    // {
    //     $datenow = Carbon::now('GMT+7')->toDateString();
    //     $history = TransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.transaction_day.user_id')
    //                ->select(
    //                 'asta_db.user.username',
    //                 'asta_db.transaction_day.date_created',
    //                 'asta_db.transaction_day.win',
    //                 'asta_db.transaction_day.lose',
    //                 'asta_db.transaction_day.turnover',
    //                 'asta_db.transaction_day.fee'
    //                )
    //                ->wherebetween('asta_db.transaction_day.date_created', [$mindate." 00:00:00", $maxdate." 23:59:59"])
    //                ->get();
    //     $time      = "all time";
    //     $lang_id   = '';
    //     $minDate   = '';
    //     return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate'));
    // }
}
