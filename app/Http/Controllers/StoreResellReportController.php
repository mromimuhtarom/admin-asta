<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reseller;
use Session;
use App\Log;
use Carbon\Carbon;
use Validator;
use App\ItemsCash;
use App\ItemsGold;
use App\ItemPoint;
use App\Classes\MenuClass;
use Illuminate\Support\Facades\Input;

class StoreResellReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datenow    = Carbon::now('GMT+7');
        $item_gold  =   ItemsGold::select(
                        'item_id',
                        'name'
                        )
                        ->get();

        $item_cash  =   ItemsCash::select(
                        'item_id',
                        'name'
                        )
                        ->get();

        $item_point =   ItemPoint::select(
                        'item_id',
                        'name'
                        )
                        ->get();

        $menu       =   MenuClass::menuName('L_REQUEST_TRANSACTION');
        $submenu    =   MenuClass::menuName('L_RESELLER_TRANSACTION');
        $mainmenu   =   MenuClass::menuName('L_RESELLER');


        return view('pages.reseller.Store_reseller.Store_reseller_report', compact('item_gold', 'item_cash', 'item_point', 'menu', 'mainmenu', 'submenu', 'datenow'));
    }

    public function searchStoreReseller(Request $request)
    {
        $usernameReseller = $request->inputUsernameReseller;
        $minDate          = $request->inputMinDate;
        $maxDate          = $request->inputMaxDate;
        $datenow          = Carbon::now('GMT+7');
        $sorting          = $request->sorting;
        $namecolumn       = $request->namecolumn;


        $item_gold  =   ItemsGold::select(
                        'item_id',
                        'name'
                        )
                        ->get();

        $item_cash  =   ItemsCash::select(
                        'item_id',
                        'name'
                        )
                        ->get();

        $item_point =   ItemPoint::select(
                        'item_id',
                        'name'
                        )
                        ->get();

        $menu       =   MenuClass::menuName('L_REQUEST_TRANSACTION');
        $submenu    =   MenuClass::menuName('L_RESELLER_TRANSACTION');
        $mainmenu   =   MenuClass::menuName('L_RESELLER');

        if($namecolumn == NULL):
            $namecolumn = 'transaction_date';
        endif;

        if(Input::get('sorting') === 'asc' || $sorting == NULL):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;

        $validator = Validator::make($request->all(),[
            'inputMinDate'   => 'required',
            'inputMaxDate'   => 'required',
        ]);

        if ($validator->fails()):
            return back()->withErrors($validator->errors());
        endif;

        $buy   =   DB::table('asta_db.store_transaction_hist')
                    ->JOIN('asta_db.reseller', 'asta_db.store_transaction_hist.user_id', '=', 'asta_db.reseller.reseller_id')
                    ->LeftJoin('asta_db.payment', 'asta_db.payment.id', '=', 'asta_db.store_transaction_hist.payment_id')
                    ->select(
                        'asta_db.store_transaction_hist.id as order_id',
                        'asta_db.store_transaction_hist.user_id as reseller_id',
                        'asta_db.reseller.username as reseller_username',
                        'asta_db.store_transaction_hist.quantity as quantity',
                        'asta_db.store_transaction_hist.action_date as transaction_date',
                        DB::raw("'Asta Game' as transaction_status")                                 
                    )
                    ->where('asta_db.store_transaction_hist.shop_type', '=', 2);
        
        $sale = DB::table('reseller_transaction')
                    ->join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction.reseller_id')
                    ->join('user', 'user.user_id', '=', 'reseller_transaction.user_id')
                    ->select(
                    'reseller_transaction.id as order_id',
                    'reseller_transaction.reseller_id as reseller_id',
                    'reseller.username as reseller_username',
                    'reseller_transaction.amount as quantity',
                    'reseller_transaction.datetime as transaction_date',
                    DB::raw("'players' as transaction_status")
                    );

        if($usernameReseller != NULL && $minDate != NULL &&  $maxDate != NULL):
            if(is_numeric($usernameReseller) !== true):
                $buyers = $buy->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                          ->where('asta_db.reseller.username', 'LIKE', '%'.$usernameReseller.'%');

                $sales  = $sale->whereBetween('reseller_transaction.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                          ->where('reseller.username', 'LIKE', '%'.$usernameReseller.'%');

                $transactions = $sales->union($buyers)
                                ->orderBy('transaction_date', 'desc')
                                ->paginate(10);
            else:
                $buyers = $buy->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                          ->where('asta_db.reseller.username', 'LIKE', '%'.$usernameReseller.'%');

                $sales  = $sale->whereBetween('reseller_transaction.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                          ->where('reseller.username', 'LIKE', '%'.$usernameReseller.'%');

                $transactions = $sales->union($buyers)
                                ->orderBy('transaction_date', 'desc')
                                ->paginate(10);
            endif;

                                          
            $transactions->appends($request->all());
            return view('pages.reseller.Store_reseller.Store_reseller_report', compact('item_gold', 'item_cash', 'item_point', 'transactions', 'menu', 'mainmenu', 'submenu', 'usernameReseller', 'minDate', 'maxDate'));
        elseif($minDate != NULL &&  $maxDate != NULL):
            $buyers = $buy->whereBetween('asta_db.store_transaction_hist.action_date', [$minDate.' 00:00:00', $maxDate.' 23:59:59']);

            $sales  = $sale->whereBetween('reseller_transaction.datetime', [$minDate.' 00:00:00', $maxDate.' 23:59:59']);

            $transactions = $sales->union($buyers)
                            ->orderBy('transaction_date', 'desc')
                            ->paginate(10);

            $transactions->appends($request->all());
            return view('pages.reseller.Store_reseller.Store_reseller_report', compact('item_gold', 'item_cash', 'item_point', 'transactions', 'menu', 'mainmenu', 'submenu', 'usernameReseller', 'minDate', 'maxDate'));
        endif;
    }
}
