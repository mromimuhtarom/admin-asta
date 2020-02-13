<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reseller;
use Session;
use App\Log;
use Carbon;
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
        $transactions   =   DB::table('asta_db.store_transaction_hist')
                            ->join('asta_db.reseller', 'asta_db.reseller.reseller_id', '=', 'asta_db.store_transaction_hist.user_id')
                            ->select(
                                'asta_db.reseller.reseller_id',
                                'asta_db.reseller.username',
                                'asta_db.store_transaction_hist.item_name',
                                'asta_db.store_transaction_hist.datetime',
                                'asta_db.store_transaction_hist.quantity',
                                'asta_db.store_transaction_hist.item_price',
                                'asta_db.store_transaction_hist.description',
                                'asta_db.store_transaction_hist.id',
                                'asta_db.store_transaction_hist.item_type'
                            )
                            ->where('asta_db.store_transaction_hist.shop_type', '=', 2)
                            ->orderBy('asta_db.store_transaction_hist.datetime', 'ASC')
                            ->get();

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

        $menu       =   MenuClass::menuName('Request Transaction');
        $submenu    =   MenuClass::menuName('Reseller Transaction');
        $mainmenu   =   MenuClass::menuName('Reseller');


        return view('pages.reseller.Store_reseller.Store_reseller_report', compact('item_gold', 'item_cash', 'item_point', 'transactions', 'menu', 'mainmenu', 'submenu'));
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
