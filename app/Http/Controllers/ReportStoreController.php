<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\ConfigText;
use App\StoreTransactionHist;

class ReportStoreController extends Controller
{
    public function index()
    {   
        $itemType= ConfigText::select(
            'name',
            'value'
        )
        ->where('id', '=', 5)
        ->first();

        $valueItem = str_replace(':', ',', $itemType->value);
        $type      = explode(",", $valueItem);
        $datenow = Carbon::now('GMT+7');

        return view('pages.store.report_store', compact('datenow', 'type'));
    }

    public function search(Request $request)
    {
        $username   = $request->username;
        $minDate    = $request->dari;
        $maxDate    = $request->sampai;
        $choosedate = $request->choosedate;
        $chooseitem = $request->chooseitem;
        $data       = $request->all();
        
        $itemType= ConfigText::select(
            'name',
            'value'
        )
        ->where('id', '=', 5)
        ->first();

        $valueItem = str_replace(':', ',', $itemType->value);
        $type      = explode(",", $valueItem);
        

        $validate = [
            'dari'       => 'required|date',
            'sampai'     => 'required|date',
            'choosedate' => 'required',
        ];
  
        $validator = Validator::make($data,$validate);
  
        if($validator->fails())
        {  
          return back()->withInput()->with('alert', $validator->errors()->first());
        } else 
        {
            if($minDate > $maxDate)
            {
                return back()->with('alert','End Date can\'t be less than start date');
            } else
            {
                $storeHistory = StoreTransactionHist::JOIN('asta_db.user', 'asta_db.store_transaction_hist.user_id', '=', 'asta_db.user.user_id')
                                ->select(
				    'asta_db.store_transaction_hist.id',
                                    'asta_db.store_transaction_hist.user_id', 
                                    'asta_db.store_transaction_hist.item_name', 
                                    'asta_db.store_transaction_hist.quantity', 
                                    'asta_db.store_transaction_hist.item_price', 
                                    'asta_db.store_transaction_hist.datetime',
                                    'asta_db.user.username',
                                    'asta_db.store_transaction_hist.item_type',
                                    'asta_db.store_transaction_hist.action_date',
                                    'asta_db.store_transaction_hist.description',
                                    'asta_db.store_transaction_hist.status'
                                )
                                ->where('asta_db.store_transaction_hist.shop_type', '=', 1);
                if($choosedate == 'request') {
		        if($username != NULL  && $chooseitem != NULL && $minDate != NULL && $maxDate != NULL) 
		    {
                        if(is_numeric($username) !== true):
                            $transactions = $storeHistory->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                            ->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
					    ->where('asta_db.store_transaction_hist.item_type', '=', $chooseitem)
                                            ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                            ->get();
                        else:
                            $transactions = $storeHistory->where('asta_db.store_transaction_hist.user_id', '=', $username)
                                            ->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
					    ->where('asta_db.store_transaction_hist.item_type', '=', $chooseitem)
                                            ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                            ->get();
                        endif;


                        return view('pages.store.report_store', compact('transactions', 'type', 'minDate', 'maxDate', 'chooseitem', 'choosedate'));

		    }
                        else if($minDate != NULL && $maxDate != NULL && $chooseitem != NULL)
                    { 
                        $transactions = $storeHistory->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate. ' 23:59:59'])
                                        ->where('asta_db.store_transaction_hist.item_type', '=', $chooseitem)
                                        ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                        ->get();
                       
                        return view('pages.store.report_store', compact('transactions', 'type', 'minDate', 'maxDate', 'chooseitem', 'choosedate'));

                    } else if($username != NULL && $minDate != NULL && $maxDate != NULL) {
                        if(is_numeric($username) !== true):
                            $transactions = $storeHistory->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                            ->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                            ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                            ->get();
                        else:
                            $transactions = $storeHistory->where('asta_db.store_transaction_hist.user_id', '=', $username)
                                            ->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                            ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                            ->get();
                        endif;


                        return view('pages.store.report_store', compact('transactions', 'type', 'minDate', 'maxDate', 'chooseitem', 'choosedate'));
                    } else if($minDate != NULL && $maxDate != NULL) {
                        $transactions = $storeHistory->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                        ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                        ->get();
                     
                        return view('pages.store.report_store', compact('transactions', 'type', 'minDate', 'maxDate', 'chooseitem', 'choosedate'));
                    }

                } else if($choosedate == 'approvedecline') {
		        if($username != NULL  && $chooseitem != NULL && $minDate != NULL && $maxDate != NULL) 
		    {
                        if(is_numeric($username) !== true):
                            $transactions = $storeHistory->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                            ->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
					    ->where('asta_db.store_transaction_hist.item_type', '=', $chooseitem)
                                            ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                            ->get();
                        else:
                            $transactions = $storeHistory->where('asta_db.store_transaction_hist.user_id', '=', $username)
                                            ->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
					    ->where('asta_db.store_transaction_hist.item_type', '=', $chooseitem)
                                            ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                            ->get();
                        endif;


                        return view('pages.store.report_store', compact('transactions', 'type', 'minDate', 'maxDate', 'chooseitem', 'choosedate'));

		    }

                    else if($minDate != NULL && $maxDate != NULL && $chooseitem != NULL)
                    { 
                        $transactions = $storeHistory->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                        ->where('asta_db.store_transaction_hist.item_type', '=', $chooseitem)
                                        ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                        ->get();
                   
                        return view('pages.store.report_store', compact('transactions', 'minDate', 'maxDate', 'type', 'chooseitem', 'choosedate'));
                    }  

            	    else if($username != NULL && $minDate != NULL && $maxDate != NULL) {
                        if(is_numeric($username) !== true):
                            $transactions = $storeHistory->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                            ->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                            ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                            ->get();
                        else:
                            $transactions = $storeHistory->where('asta_db.store_transaction_hist.user_id', '=', $username)
                                            ->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                            ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                            ->get();
                        endif;

                        
                        return view('pages.store.report_store', compact('transactions', 'type', 'minDate', 'maxDate', 'chooseitem', 'choosedate'));
                    }
                    else if($minDate != NULL && $maxDate != NULL)
                    {
                        $transactions = $storeHistory->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                        ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                        ->get();

			
                        return view('pages.store.report_store', compact('transactions', 'minDate', 'maxDate', 'type', 'chooseitem', 'choosedate'));
                    }
                }
            }
        }
    }
}
