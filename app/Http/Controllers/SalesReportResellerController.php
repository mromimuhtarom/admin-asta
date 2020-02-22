<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ResellerTransaction;
use Illuminate\Support\Facades\Input;

class SalesReportResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datenow = Carbon::now('GMT+7');
        return view('pages.reseller.transaction.sales_report_reseller', compact('datenow'));
    }

    public function search(Request $request)
    {
        $searchUsernameReseller = $request->inputUsernameReseller;
        $searchUsernamePlayer   = $request->inputUsernamePlayer;
        $startDate              = $request->inputMinDate;
        $endDate                = $request->inputMaxDate;
        $sorting                = $request->sorting;
        $namecolumn             = $request->namecolumn;

        if(Input::get('sorting') === 'asc' || $sorting == NULL):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;
        

        if($namecolumn == NULL):
            $namecolumn = 'reseller_transaction.datetime';
        endif;

        $resellerTransaction = ResellerTransaction::join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction.reseller_id')
                               ->join('user', 'user.user_id', '=', 'reseller_transaction.user_id')
                               ->select(
                                  'reseller_transaction.reseller_id',
                                  'reseller.username as resellerUsername',
                                  'reseller_transaction.user_id',
                                  'user.username as playerUsername',
                                  'reseller_transaction.status',
                                  'reseller_transaction.amount',
                                  'reseller_transaction.datetime'
                               );


        if($searchUsernameReseller != NULL && $searchUsernamePlayer != NULL && $startDate != NULL && $endDate != NULL ):

            // ----- untuk mencari username Player dan Username Reseller  -----//
            if(is_numeric($searchUsernameReseller) !== TRUE && is_numeric($searchUsernamePlayer) !== TRUE):
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller.username', 'LIKE', '%'.$searchUsernameReseller.'%')
                               ->where('user.username', 'LIKE', '%'.$searchUsernamePlayer.'%')
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            // ----- untuk pencarian username player dan reseller ID  -----//
            elseif(is_numeric($searchUsernameReseller) !== TRUE && is_numeric($searchUsernamePlayer) === TRUE):
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller.username', 'LIKE', '%'.$searchUsernameReseller.'%')
                               ->where('reseller_transaction.user_id', '=', $searchUsernamePlayer)
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            // ----- untuk mencari Player ID dan  Reseller username  -----//
            elseif(is_numeric($searchUsernameReseller) === TRUE && is_numeric($searchUsernamePlayer) !== TRUE):
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller_trasaction.reseller_id', '=', $searchUsernameReseller)
                               ->where('user.username', 'LIKE', '%'.$searchUsernamePlayer.'%')
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            // ----- untuk mencari Player ID dan Reseller ID  -----//      
            elseif(is_numeric($searchUsernameReseller) === TRUE && is_numeric($searchUsernamePlayer) === TRUE):
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller_trasaction.reseller_id', '=', $searchUsernameReseller)
                               ->where('reseller_transaction.user_id', '=', $searchUsernamePlayer)
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);
            endif;

            $transaction->appends($request->all());
            return view('pages.reseller.transaction.sales_report_reseller', compact('transaction', 'startDate', 'endDate', 'sortingorder', 'namecolumn', 'searchUsernameReseller', 'searchUsernamePlayer'));

        elseif($searchUsernameReseller != NULL && $startDate != NULL && $endDate != NULL ):

            // ----- untuk mencari username  -----//
            if(is_numeric($searchUsernameReseller) !== TRUE):
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller.username', 'LIKE', '%'.$searchUsernameReseller.'%')
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            // ----- untuk mencari berdasarkan ResellerID  -----//
            else:
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller_transaction.reseller_id', '=', $searchUsernameReseller)
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            endif;

            $transaction->appends($request->all());
            return view('pages.reseller.transaction.sales_report_reseller', compact('transaction', 'startDate', 'endDate', 'sortingorder', 'namecolumn', 'searchUsernameReseller', 'searchUsernamePlayer'));

        elseif($searchUsernamePlayer != NULL && $startDate != NULL && $endDate != NULL ):
                        // ----- untuk mencari username  -----//
            if(is_numeric($searchUsernamePlayer) !== TRUE):
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('user.username', 'LIKE', '%'.$searchUsernameReseller.'%')
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            // ----- untuk mencari berdasarkan ResellerID  -----//
            else:
                $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->where('reseller_transaction.user_id', '=', $searchUsernameReseller)
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20);

            endif;

            $transaction->appends($request->all());
            return view('pages.reseller.transaction.sales_report_reseller', compact('transaction', 'startDate', 'endDate', 'sortingorder', 'namecolumn', 'searchUsernameReseller', 'searchUsernamePlayer'));
        elseif($startDate != NULL && $endDate != NULL): 

            $transaction = $resellerTransaction->whereBetween('reseller_transaction.datetime', [$startDate.' 00:00:00', $endDate.' 23:59:59'])
                               ->orderBy($namecolumn, $sortingorder)
                               ->paginate(20); 

            $transaction->appends($request->all());
            return view('pages.reseller.transaction.sales_report_reseller', compact('transaction', 'startDate', 'endDate', 'sortingorder', 'namecolumn', 'searchUsernameReseller', 'searchUsernamePlayer')); 
        endif;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
