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

        // Sorting table
  
          if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
          else:
            $sortingorder = 'asc';
          endif;
  
          if($namecolumn == NULL):
            $namecolumn = 'asta_db.store_transaction_day.date_created';
          endif;

        if($time == "Day"){

          //   $user_point = DB::table('user_point')->leftJoin('asta_db.store_transaction_day', 'asta_db.store_transaction_day.user_id', '=', 'asta_db.user_point.user_id')
          //                 ->select(
          //                   'asta_db.user_point.date as date_created',
			    // 'asta_db.user_point.date as date',
          //                   DB::raw('0 As debettransaction'),
          //                   DB::raw('0 As credittransaction'),
          //                   DB::raw('0 As gold_debettransaction'),
          //                   DB::raw('0 As gold_credittransaction'),
          //                   DB::raw('0 As chip_debettransaction'),
          //                   DB::raw('0 As chip_credittransaction'),
          //                   DB::raw('0 As reward_goldtransaction'),
          //                   DB::raw('0 As reward_pointtransaction'),
          //                   DB::raw('0 As reward_chiptransaction'),
          //                   DB::raw('0 As correction_gold'),
          //                   DB::raw('0 As correction_chip'),
          //                   DB::raw('0 As correction_point'),
          //                   DB::raw('sum(asta_db.user_point.point) As point'),
          //                   DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
          //                   DB::raw('sum(asta_db.user_point.point_expired) As expired'),
          //                   DB::raw('max(date(asta_db.user_point.date)) As maxDate'),
          //                   DB::raw('min(date(asta_db.user_point.date)) As minDate'),
          //                   DB::raw(' YEARWEEK(asta_db.user_point.date) As yearperweek')
          //                 ); 

            $Transaction = StoreTransactionDay::leftJoin('asta_db.user_point', 'asta_db.user_point.user_id', '=', 'asta_db.store_transaction_day.user_id')->select(
                            'asta_db.store_transaction_day.date_created',
			                      'asta_db.store_transaction_day.date as date',
                            DB::raw('sum(asta_db.store_transaction_day.debet) As debettransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.credit) As credittransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.gold_debet) As gold_debettransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.gold_credit) As gold_credittransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.chip_debet) As chip_debettransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.chip_credit) As chip_credittransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.reward_gold) As reward_goldtransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.reward_point) As reward_pointtransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.reward_chip) As reward_chiptransaction'),
                            DB::raw('sum(asta_db.store_transaction_day.correction_gold) As correction_gold'),
                            DB::raw('sum(asta_db.store_transaction_day.correction_chip) As correction_chip'),
                            DB::raw('sum(asta_db.store_transaction_day.correction_point) As correction_point'),
                            DB::raw('sum(asta_db.user_point.point) As point'),
                            DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
                            DB::raw('sum(asta_db.user_point.point_expired) As expired'),
                            DB::raw('max(date(asta_db.store_transaction_day.date)) As maxDate'),
                            DB::raw('min(date(asta_db.store_transaction_day.date)) As minDate'),
                            DB::raw(' YEARWEEK(asta_db.store_transaction_day.date) As yearperweek')
                           );      
            if($minDate != NULL && $maxDate != NULL):

		    // $userpointdate = $user_point->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
				//      ->orderBy($namecolumn, $sortingorder)
				//      ->groupBy(DB::raw('DATE(asta_db.user_point.date)'));
		    
                    $history = $Transaction->wherebetween('asta_db.store_transaction_day.date', [$minDate, $maxDate])
				                        ->groupBy(DB::raw('DATE(asta_db.store_transaction_day.date_created)'))
				                        ->orderBy($namecolumn, $sortingorder)
                                // ->union($userpointdate)
                                ->paginate(20);
              
            elseif($minDate != NULL):
		            // $userpointdate = $user_point->where('asta_db.user_point.date', '>=', $minDate)
                //                 ->orderBy($namecolumn, $sortingorder)
                //                 ->groupBy(DB::raw('DATE(asta_db.user_point.date)'));

                $history = $Transaction->where('asta_db.store_transaction_day.date_created', '>=', $minDate." 00:00:00")
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('DATE(asta_db.store_transaction_day.date_created)'))
			                      // ->union($userpointdate)
                            ->paginate(20);
            
            elseif($maxDate != NULL):
		            // $userpointdate = $user_point->where('asta_db.user_point.date', '<=', $maxDate)
                //                  ->orderBy($namecolumn, $sortingorder)
				        //                  ->groupBy(DB::raw('DATE(asta_db.user_point.date)'));

                $history = $Transaction->where('asta_db.store_transaction_day.date_created', '<=', $maxDate.' 23:59:59')
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('DATE(asta_db.store_transaction_day.date_created)'))
			                      // ->union($userpointdate)
                            ->paginate(20);
	          else:
		            // $userpointdate = $user_point->orderBy($namecolumn, $sortingorder)
				        //                  ->groupBy(DB::raw('DATE(asta_db.user_point.date)'));

                $history = $Transaction->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('DATE(asta_db.store_transaction_day.date_created)'))
			                      // ->union($userpointdate)
                            ->paginate(20);

            endif;

            $lang_id = 'Harian';
            $history->appends($request->all());

            return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));

        }
        else if($time == "Week"){


            // $user_point = DB::table('user_point')->leftJoin('asta_db.store_transaction_day', 'asta_db.store_transaction_day.user_id', '=', 'asta_db.user_point.user_id')
            //               ->select(
            //                 'asta_db.user_point.date as date_created',
			      //                 'asta_db.user_point.date as date',
            //                 DB::raw('0 As debettransaction'),
            //                 DB::raw('0 As credittransaction'),
            //                 DB::raw('0 As gold_debettransaction'),
            //                 DB::raw('0 As gold_credittransaction'),
            //                 DB::raw('0 As chip_debettransaction'),
            //                 DB::raw('0 As chip_credittransaction'),
            //                 DB::raw('0 As reward_goldtransaction'),
            //                 DB::raw('0 As reward_pointtransaction'),
            //                 DB::raw('0 As reward_chiptransaction'),
            //                 DB::raw('0 As correction_gold'),
            //                 DB::raw('0 As correction_chip'),
            //                 DB::raw('0 As correction_point'),
            //                 DB::raw('sum(asta_db.user_point.point) As point'),
            //                 DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
            //                 DB::raw('sum(asta_db.user_point.point_expired) As expired'),
            //                 DB::raw('max(date(asta_db.user_point.date)) As maxDate'),
            //                 DB::raw('min(date(asta_db.user_point.date)) As minDate'),
            //                 DB::raw(' YEARWEEK(asta_db.user_point.date) As yearperweek')
            //               ); 


            $Transaction = StoreTransactionDay::leftJoin('asta_db.user_point', 'asta_db.user_point.user_id', '=', 'asta_db.store_transaction_day.user_id')
			                     ->select(
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
                                DB::raw('sum(asta_db.store_transaction_day.correction_gold) As correction_gold'),
                                DB::raw('sum(asta_db.store_transaction_day.correction_chip) As correction_chip'),
                                DB::raw('sum(asta_db.store_transaction_day.correction_point) As correction_point'),
                                DB::raw('sum(asta_db.user_point.point) As point'),
                                DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
                                DB::raw('sum(asta_db.user_point.point_expired) As expired'),
                                DB::raw('max(date(asta_db.store_transaction_day.date_created)) As maxDate'),
                                DB::raw('min(date(asta_db.store_transaction_day.date_created)) As minDate'),
                                DB::raw(' YEARWEEK(asta_db.store_transaction_day.date_created) As yearperweek')

                                );

            if($minDate != NULL && $maxDate != NULL):
        //    	$userpointdate = $user_point->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
				//  ->orderBy($namecolumn, $sortingorder)
				//  ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->wherebetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
		                        // ->union($userpointdate)
                            ->paginate(20);

            elseif($minDate != NULL):
           	// $userpointdate = $user_point->where('asta_db.user_point.date', '>=', $minDate)
				    //                  ->orderBy($namecolumn, $sortingorder)
				    //                  ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->where('asta_db.store_transaction_day.date_created', '>=', $minDate." 00:00:00")
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                      // ->union($userpointdate)
                            ->paginate(20);
            
            elseif($maxDate != NULL):
           	// $userpointdate = $user_point->where('asta_db.user_point.date', '<=', $maxDate)
            //                  ->orderBy($namecolumn, $sortingorder)
            //                  ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->where('asta_db.store_transaction_day.date_created', '<=', $maxDate.' 23:59:59')
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                      // ->union($userpointdate)
                            ->paginate(20);
	    else :
           	// $userpointdate = $user_point->orderBy($namecolumn, $sortingorder)
				    //                  ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                      // ->union($userpointdate)
                            ->paginate(20);

            endif;

            $lang_id = 'Mingguan';
            $history->appends($request->all());

            return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            
        }
        else if($time == "Month"){

            // $user_point = DB::table('user_point')->leftJoin('asta_db.store_transaction_day', 'asta_db.store_transaction_day.user_id', '=', 'asta_db.user_point.user_id')
            //               ->select(
            //                 'asta_db.user_point.date as date_created',
			      //                 'asta_db.user_point.date as date',
            //                 DB::raw('0 As debettransaction'),
            //                 DB::raw('0 As credittransaction'),
            //                 DB::raw('0 As gold_debettransaction'),
            //                 DB::raw('0 As gold_credittransaction'),
            //                 DB::raw('0 As chip_debettransaction'),
            //                 DB::raw('0 As chip_credittransaction'),
            //                 DB::raw('0 As reward_goldtransaction'),
            //                 DB::raw('0 As reward_pointtransaction'),
            //                 DB::raw('0 As reward_chiptransaction'),
            //                 DB::raw('0 As correction_gold'),
            //                 DB::raw('0 As correction_chip'),
            //                 DB::raw('0 As correction_point'),
            //                 DB::raw('sum(asta_db.user_point.point) As point'),
            //                 DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
            //                 DB::raw('sum(asta_db.user_point.point_expired) As expired'),
            //                 DB::raw('max(date(asta_db.user_point.date)) As maxDate'),
            //                 DB::raw('min(date(asta_db.user_point.date)) As minDate'),
            //                 DB::raw(' YEARWEEK(asta_db.user_point.date) As yearperweek')
            //               ); 

            $Transaction = StoreTransactionDay::leftJoin('asta_db.user_point', 'asta_db.user_point.user_id', '=', 'asta_db.store_transaction_day.user_id')->select(
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
                                            DB::raw('sum(asta_db.store_transaction_day.correction_gold) As correction_gold'),
                                            DB::raw('sum(asta_db.store_transaction_day.correction_chip) As correction_chip'),
                                            DB::raw('sum(asta_db.store_transaction_day.correction_point) As correction_point'),
                                            DB::raw('sum(asta_db.user_point.point) As point'),
                                            DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
                                            DB::raw('sum(asta_db.user_point.point_expired) As expired'),
                                            DB::raw('max(date(asta_db.store_transaction_day.date_created)) As maxDate'),
                                            DB::raw('min(date(asta_db.store_transaction_day.date_created)) As minDate'),
                                            DB::raw(' YEARWEEK(asta_db.store_transaction_day.date_created) As yearperweek')

                                        );

                if($minDate != NULL && $maxDate != NULL):
           	    // $userpointdate = $user_point->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
				        //                  ->orderBy($namecolumn, $sortingorder)
				        //                  ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));


                $history = $Transaction->wherebetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                  // ->union($userpointdate)
                        ->paginate(20);
                elseif($minDate != NULL):

           	// $userpointdate = $user_point->where('asta_db.user_point.date', '>=', $minDate)
				    //                  ->orderBy($namecolumn, $sortingorder)
				    //                  ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->where('asta_db.store_transaction_day.date_created', '>=', $minDate." 00:00:00")
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                  // ->union($userpointdate)
                        ->paginate(20);

                elseif($maxDate != NULL):

           	// $userpointdate = $user_point->where('asta_db.user_point.date', '<=', $maxDate)
				    //                  ->orderBy($namecolumn, $sortingorder)
				    //                  ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->where('asta_db.store_transaction_day.date_created', '<=', $maxDate.' 23:59:59')
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                  // ->union($userpointdate)
                        ->paginate(20);
		            else:
                // $userpointdate = $user_point->orderBy($namecolumn, $sortingorder)
				        //                  ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"));

                $history = $Transaction->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.store_transaction_day.date_created)'), DB::raw("WEEK('asta_db.store_transaction_day.date_created')"))
			                  // ->union($userpointdate)
                        ->paginate(20);

                endif;

                $lang_id = 'Bulanan';
                $history->appends($request->all());

                return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        }
        else if($time  == "All time"){

            // $user_point = DB::table('user_point')->leftJoin('asta_db.store_transaction_day', 'asta_db.store_transaction_day.user_id', '=', 'asta_db.user_point.user_id')
			      //               ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_point.user_id')
            //               ->select(
            //                 'store_transaction_day.id',
            //                 'user_point.user_id',
            //                 'user.username',
            //                 'asta_db.user_point.date as date_created',
			      //                 'asta_db.user_point.date as date',
            //                 DB::raw('0 As debettransaction'),
            //                 DB::raw('0 As credittransaction'),
            //                 DB::raw('0 As gold_debettransaction'),
            //                 DB::raw('0 As gold_credittransaction'),
            //                 DB::raw('0 As chip_debettransaction'),
            //                 DB::raw('0 As chip_credittransaction'),
            //                 DB::raw('0 As reward_goldtransaction'),
            //                 DB::raw('0 As reward_pointtransaction'),
            //                 DB::raw('0 As reward_chiptransaction'),
            //                 DB::raw('0 As correction_gold'),
            //                 DB::raw('0 As correction_chip'),
            //                 DB::raw('0 As correction_point'),
            //                 DB::raw('asta_db.user_point.point As point'),
            //                 DB::raw('asta_db.user_point.point_spend As point_spend'),
            //                 DB::raw('asta_db.user_point.point_expired As expired')
            //               ); 


            $transactionDay = StoreTransactionDay::leftJoin('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.store_transaction_day.user_id')
                          ->join('asta_db.user_point', 'asta_db.user_point.user_id', '=', 'asta_db.store_transaction_day.user_id')
                          ->select(
                              'store_transaction_day.id',
                              'store_transaction_day.user_id',
                              'user.username',
                              'asta_db.store_transaction_day.date as date_created',
			                        'asta_db.user_point.date as date',
                              'store_transaction_day.debet as debettransaction',
                              'store_transaction_day.credit as credittransaction',
                              'store_transaction_day.gold_debet as gold_debettransaction',
                              'store_transaction_day.gold_credit as gold_credittransaction',
                              'store_transaction_day.chip_debet as chip_debettransaction',
                              'store_transaction_day.chip_credit as chip_credit',
                              'store_transaction_day.reward_gold as reward_goldtransaction',
                              'store_transaction_day.reward_point as reward_pointtransaction',
                              'store_transaction_day.reward_chip as rewatd_chiptransaction',
                              'store_transaction_day.correction_gold as correction_gold',
                              'store_transaction_day.correction_chip as chip_correction',
                              'store_transaction_day.correction_point as correction_point',
                              'user_point.point as point',
                              'user_point.point_spend as point_spend',
                              'user_point.point_expired as point_expired'
                          );
            
            $lang_id = '';
            if($minDate != NULL && $maxDate != NULL){
           	// $userpointdate = $user_point->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
				    //                   ->orderBy($namecolumn, $sortingorder);

                $history = $transactionDay->wherebetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                            ->orderBy($namecolumn, $sortingorder)
			                      // ->union($userpointdate)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            else if($minDate != NULL){

           	// $userpointdate = $user_point->where('asta_db.user_point.date', '>=', $minDate)
				    //                  ->orderBy($namecolumn, $sortingorder);

                $history = $transactionDay->where('asta_db.store_transaction_day.date_created', '>=', $minDate." 00:00:00")
                            ->orderBy($namecolumn, $sortingorder)
			                      // ->union($userpointdate)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            else if($maxDate != NULL){
           	// $userpointdate = $user_point->where('asta_db.user_point.date', '<=', $maxDate)
				    //                  ->orderBy($namecolumn, $sortingorder);

                $history = $transactionDay->where('asta_db.store_transaction_day.date_created', '<=', $maxDate." 23:59:59")
                            ->orderBy($namecolumn, $sortingorder)
			                      // ->union($userpointdate)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            else{

                // $userpointdate = $user_point->orderBy($namecolumn, $sortingorder);

                $history = $transactionDay->orderBy($namecolumn, $sortingorder)
			                    //  ->union($userpointdate)
                           ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));

            }
            $lang_id = 'sepanjang waktu';
        } else{
        
            $validator = Validator::make($request->all(),[
                'choose_time'           => 'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            return view('pages.transaction.transaction_day', compact('transactionDay', 'history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        }        
    }
    

    public function detail(Request $request)
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        $minDate = $request->minDate;
        $maxDate = $request->maxDate;
        $namecolumn = $request->namecolumn;

        // if sorting variabel null
        if($namecolumn == NULL):
          $namecolumn = 'asta_db.store_transaction_day.date_created';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

          // $user_point = DB::table('user_point')->leftJoin('asta_db.store_transaction_day', 'asta_db.store_transaction_day.user_id', '=', 'asta_db.user_point.user_id')
		      //           	  ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_point.user_id')
          //               ->select(
          //                   'store_transaction_day.id',
          //                   'store_transaction_day.user_id',
          //                   'user.username',
          //                   'asta_db.user_point.date as date_created',
			    //                   'asta_db.user_point.date as date',
          //                   DB::raw('0 As debettransaction'),
          //                   DB::raw('0 As credittransaction'),
          //                   DB::raw('0 As gold_debettransaction'),
          //                   DB::raw('0 As gold_credittransaction'),
          //                   DB::raw('0 As chip_debettransaction'),
          //                   DB::raw('0 As chip_credittransaction'),
          //                   DB::raw('0 As reward_goldtransaction'),
          //                   DB::raw('0 As reward_pointtransaction'),
          //                   DB::raw('0 As reward_chiptransaction'),
          //                   DB::raw('0 As correction_gold'),
          //                   DB::raw('0 As correction_chip'),
          //                   DB::raw('0 As correction_point'),
          //                   DB::raw('asta_db.user_point.point As point'),
          //                   DB::raw('asta_db.user_point.point_spend As point_spend'),
          //                   DB::raw('asta_db.user_point.point_expired As expired')
          //               )
          //               ->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
          //               ->orderBy($namecolumn, $sortingorder); 


        $history = StoreTransactionDay::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.store_transaction_day.user_id')
                    ->leftjoin('asta_db.user_point', 'asta_db.user_point.user_id', '=', 'asta_db.store_transaction_day.user_id')
                    ->select(
                        'store_transaction_day.id',
                        'store_transaction_day.user_id',
                        'user.username',
                        'asta_db.store_transaction_day.date as date_created',
                        'asta_db.user_point.date as date',
                        'store_transaction_day.debet as debettransaction',
                        'store_transaction_day.credit as credittransaction',
                        'store_transaction_day.gold_debet as gold_debettransaction',
                        'store_transaction_day.gold_credit as gold_credittransaction',
                        'store_transaction_day.chip_debet as chip_debettransaction',
                        'store_transaction_day.chip_credit as chip_credittransaction',
                        'store_transaction_day.reward_gold as reward_goldtransaction',
                        'store_transaction_day.reward_point as reward_pointtransaction',
                        'store_transaction_day.reward_chip as reward_chiptransaction',
                        'store_transaction_day.correction_gold as correction_gold',
                        'store_transaction_day.correction_chip as chip_correction',
                        'store_transaction_day.correction_point as point_correction',
                        'user_point.point as point',
                        'user_point.point_spend as point_spend',
                        'user_point.point_expired as point_expired'
                    )
                    ->wherebetween('asta_db.store_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                    ->orderBy($namecolumn, $sortingorder)
                    // ->union($user_point)
                    ->paginate(20);
     
        $time      = "Detail";
        $lang_id   = '';
        $minDate   = Input::get('minDate');
        $maxDate   = Input::get('maxDate');
        $history->appends($request->all());

        return view('pages.transaction.transaction_day', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
    }
}
