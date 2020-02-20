<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\UserPoint;
use Illuminate\Support\Facades\Input;
use DB;

class TransactionPointController extends Controller
{
    public function index()
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        return view('pages.transaction.transaction_point', compact('datenow'));
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
  
          if(Input::get('sorting') === 'asc' || Input::get('sorting') === NULL):
            $sortingorder = 'desc';
          else:
            $sortingorder = 'asc';
          endif;
  
          if($namecolumn == NULL):
            $namecolumn = 'asta_db.user_point.date';
          endif;

        if($time == "Day"){ 

            $Transaction = UserPoint::select(
			                'asta_db.user_point.date as date_created',
                            DB::raw('sum(asta_db.user_point.point) As point'),
                            DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
                            DB::raw('sum(asta_db.user_point.point_expired) As expired'),
                            DB::raw('max(date(asta_db.user_point.date)) As maxDate'),
                            DB::raw('min(date(asta_db.user_point.date)) As minDate'),
                            DB::raw(' YEARWEEK(asta_db.user_point.date) As yearperweek')
                           );      
            if($minDate != NULL && $maxDate != NULL):
		    
                    $history = $Transaction->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
				                        ->groupBy(DB::raw('DATE(asta_db.user_point.date)'))
				                        ->orderBy($namecolumn, $sortingorder)
                                ->paginate(20);
              
            elseif($minDate != NULL):

                $history = $Transaction->where('asta_db.user_point.date', '>=', $minDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('DATE(asta_db.user_point.date)'))
                            ->paginate(20);
            
            elseif($maxDate != NULL):

                $history = $Transaction->where('asta_db.user_point.date', '<=', $maxDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('DATE(asta_db.user_point.date)'))
                            ->paginate(20);
	          else:

                $history = $Transaction->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('DATE(asta_db.user_point.date)'))
                            ->paginate(20);

            endif;

            $lang_id = 'Harian';
            $history->appends($request->all());

            return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));

        }
        else if($time == "Week"){


            $Transaction = SUserPoint::select(
				                'asta_db.user_point.date as date_created',
                                DB::raw('sum(asta_db.user_point.point) As point'),
                                DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
                                DB::raw('sum(asta_db.user_point.point_expired) As expired'),
                                DB::raw('max(date(asta_db.user_point.date)) As maxDate'),
                                DB::raw('min(date(asta_db.user_point.date)) As minDate'),
                                DB::raw(' YEARWEEK(asta_db.user_point.date) As yearperweek')

                                );

            if($minDate != NULL && $maxDate != NULL):

                $history = $Transaction->wherebetween('asta_db.user_point.date ', [$minDate, $maxDate])
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"))
                            ->paginate(20);

            elseif($minDate != NULL):

                $history = $Transaction->where('asta_db.user_point.date', '>=', $minDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date )'), DB::raw("asta_db.user_point.date')"))
                            ->paginate(20);
            
            elseif($maxDate != NULL):

                $history = $Transaction->where('asta_db.user_point.date ', '<=', $maxDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date )'), DB::raw("WEEK('asta_db.user_point.date')"))
                            ->paginate(20);
	    else :

                $history = $Transaction->orderBy($namecolumn, $sortingorder)
                            ->groupBy(DB::raw('YEARWEEK(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"))
                            ->paginate(20);

            endif;

            $lang_id = 'Mingguan';
            $history->appends($request->all());

            return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            
        }
        else if($time == "Month"){

            $Transaction = UserPoint::select(
                                            'asta_db.user_point.date as date_created',
                                            DB::raw('sum(asta_db.user_point.point) As point'),
                                            DB::raw('sum(asta_db.user_point.point_spend) As point_spend'),
                                            DB::raw('sum(asta_db.user_point.point_expired) As expired'),
                                            DB::raw('max(date(asta_db.user_point.date)) As maxDate'),
                                            DB::raw('min(date(asta_db.user_point.date)) As minDate'),
                                            DB::raw(' YEARWEEK(asta_db.user_point.date) As yearperweek'),
                                            DB::raw('MONTHNAME(asta_db.user_point.date) As groupdate'), 
                                            DB::raw('YEAR(asta_db.user_point.date) AS year')

                                        );

                if($minDate != NULL && $maxDate != NULL):

                $history = $Transaction->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"))
                        ->paginate(20);
                elseif($minDate != NULL):

                $history = $Transaction->where('asta_db.user_point.date', '>=', $minDate)
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"))
                        ->paginate(20);

                elseif($maxDate != NULL):

                $history = $Transaction->where('asta_db.user_point.date', '<=', $maxDate)
                        ->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"))
                        ->paginate(20);
		            else:

                $history = $Transaction->orderBy($namecolumn, $sortingorder)
                        ->groupBy(DB::raw('month(asta_db.user_point.date)'), DB::raw("WEEK('asta_db.user_point.date')"))
                        ->paginate(20);

                endif;

                $lang_id = 'Bulanan';
                $history->appends($request->all());

                return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
        }
        else if($time  == "All time"){


            $transactionDay = UserPoint::leftJoin('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_point.user_id')
                          ->select(
                              'user_point.id',
                              'user_point.user_id',
                              'user.username',
                              'asta_db.user_point.date as date_created',
                              'asta_db.user_point.point as point',
                              'asta_db.user_point.point_spend as point_spend',
                              'asta_db.user_point.point_expired as expired'
                          );
            
            $lang_id = '';
            if($minDate != NULL && $maxDate != NULL){

                $history = $transactionDay->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            else if($minDate != NULL){


                $history = $transactionDay->where('asta_db.user_point.date', '>=', $minDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            else if($maxDate != NULL){

                $history = $transactionDay->where('asta_db.user_point.date', '<=', $maxDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
            }
            else{

                $history = $transactionDay->orderBy($namecolumn, $sortingorder)
                           ->paginate(20);

                $history->appends($request->all());
                return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));

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
          $namecolumn = 'asta_db.user_point.date';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;


        $history = UserPoint::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.user_point.user_id')
                    ->select(
                        'user_point.id',
                        'user_point.user_id',
                        'user.username',
                        'asta_db.user_point.date as date_created',
                        'asta_db.user_point.point as point',
                        'asta_db.user_point.point_spend as point_spend',
                        'asta_db.user_point.point_expired as expired'
                    )
                    ->wherebetween('asta_db.user_point.date', [$minDate, $maxDate])
                    ->orderBy($namecolumn, $sortingorder)
                    ->paginate(20);
     
        $time      = "Detail";
        $lang_id   = '';
        $minDate   = Input::get('minDate');
        $maxDate   = Input::get('maxDate');
        $history->appends($request->all());

        return view('pages.transaction.transaction_point', compact('history', 'datenow', 'time', 'lang_id', 'minDate', 'maxDate', 'namecolumn', 'sortingorder'));
    }
}
