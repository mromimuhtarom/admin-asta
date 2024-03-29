<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\StoreTransactionHist;

class ReportStoreController extends Controller
{
    public function index()
    {
        $datenow = Carbon::now('GMT+7');
        return view('pages.store.report_store', compact('datenow'));
    }

    public function search(Request $request)
    {
        $username = $request->username;
        $minDate  = $request->dari;
        $maxDate  = $request->sampai;
        $data     = $request->all();
        $datenow  = Carbon::now('GMT+7');

        $validate = [
            'dari'   => 'required|date',
            'sampai' => 'required|date'
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
                                    'asta_db.store_transaction_hist.user_id', 
                                    'asta_db.store_transaction_hist.item_name', 
                                    'asta_db.store_transaction_hist.quantity', 
                                    'asta_db.store_transaction_hist.item_price', 
                                    'asta_db.user.username'
                                )
                                ->where('asta_db.store_transaction_hist.user_type', '=', 1);
                if($username != NULL && $minDate != NULL && $maxDate != NULL)
                {
                    $transactions = $storeHistory->where('asta_db.user.username', 'LIKE', '%'.$username.'%')
                                    ->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                    ->get();
                    
                    return view('pages.store.report_store', compact('transactions', 'datenow'));
                } else if($minDate != NULL && $maxDate != NULL)
                {
                    $transactions = $storeHistory->whereBetween('asta_db.store_transaction_hist.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                                    ->get();

                    return view('pages.store.report_store', compact('transactions', 'datenow'));
                } 
            }
        }

    }
}
