<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\StoreTransaction;
use App\StoreTransactionHist;
use App\Classes\MenucLass;
use App\ItemsGold;
use App\ItemsCash;
use App\ItemPoint;
use App\Log;
use Session;
use Carbon\Carbon;
use App\PlayerNotif;
use App\Stat;
use App\BalanceGold;

class User_Banking_TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu          = MenuClass::menuName('User Bank Transaction');
        $mainmenu      = MenuClass::menuName('Transaction');
        $transaction = StoreTransaction::where('shop_type', '=', 1)
                       ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.store_transaction.user_id')
                       ->join('asta_db.payment','asta_db.payment.id', '=', 'asta_db.store_transaction.payment_id')
                       ->select(
                           'asta_db.store_transaction.user_id',
                           'username',
                           'item_id',
                           'asta_db.payment.id',
                           'asta_db.payment.name as paymentname',
                           'asta_db.store_transaction.status',
                           'description',
                           'quantity',
                           'payment_id',
                           'datetime',
                           'shop_type',
                           'item_type',
                           'item_price',
                           'asta_db.store_transaction.id as strtrnsid'
                       )
                       ->where('asta_db.store_transaction.status', '=', 0)
                       ->where('item_type', '=', 2)
                       ->get();
        $item_gold = ItemsGold::select(
                        'item_id', 
                        'name'
                     )
                     ->get();

        $item_cash = ItemsCash::select(
                        'item_id', 
                        'name'
                     )
                     ->get();

        $item_point = ItemPoint::select(
                        'item_id', 
                        'name'
                     )
                     ->get();
                     
        return view('pages.transaction.user_bank_transaction', compact('transaction', 'menu', 'mainmenu', 'item_cash', 'item_gold', 'item_point'));
    }


    public function decline(Request $request)
    {
        $declineOrderId = $request->declineId;
        $goldAwarded    = $request->goldbuy;
        $amount         = $request->price;
        $user_id        = $request->user_id;
        $item_name      = $request->item_name;
        $desc           = $request->desc;
        $quantity       = $request->quantity;
        $payment_id     = $request->payment_id;
        $datetime       = $request->datetime;
        $shop_type      = $request->shop_type;
        $item_type      = $request->item_type;
        $description    = $request->description;
        $item_id        = $request->item_id;

        StoreTransactionHist::create([
            'user_id'       =>  $user_id,
            'item_name'     =>  $item_name,
            'status'        =>  2,
            'description'   =>  $description,
            'quantity'      =>  $quantity,
            'payment_id'    =>  $payment_id,
            'datetime'      =>  $datetime,
            'shop_type'     =>  $shop_type,
            'item_type'     =>  $item_type,
            'item_price'    =>  $amount,
            'action_date'   => Carbon::now('GMT+7')
        ]);

        StoreTransaction::where('user_id', '=', $user_id)->where('id', '=', $declineOrderId)->delete();
    
        $itemid = ItemsCash::where('item_id', '=', $item_id)->first();        

        PlayerNotif::create([
            'user_id'   =>  $user_id,
            'msg'       =>  $itemid->item_get,
            'date'      =>  Carbon::now('GMT+7'),
            'type'      =>  4
        ]);
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '6',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menolak permintaan transaksi dengan Penggunaid'. $user_id
        ]);
        return back()->with('success','Declined Succesful');
    }

    public function approve(Request $request)
    {
        $declineOrderId = $request->declineId;
        $goldAwarded    = $request->goldbuy;
        $amount         = $request->price;
        $user_id        = $request->user_id;
        $item_name      = $request->item_name;
        $desc           = $request->desc;
        $quantity       = $request->quantity;
        $payment_id     = $request->payment_id;
        $datetime       = $request->datetime;
        $shop_type      = $request->shop_type;
        $item_type      = $request->item_type;
        $description    = $request->description;
        $item_id        = $request->item_id;

        StoreTransactionHist::create([
            'user_id'       => $user_id,
            'item_name'     =>  $item_name,
            'status'        =>  1,
            'description'   =>  $description,
            'quantity'      =>  $quantity,
            'payment_id'    =>  $payment_id,
            'datetime'      =>  $datetime,
            'shop_type'     =>  $shop_type,
            'item_type'     =>  $item_type,
            'item_price'    =>  $amount,
            'action_date'   =>  Carbon::now('GMT+7')
        ]);
        $itemid     = ItemsCash::where('item_id', '=', $item_id)->first();
        $playergold = Stat::where('user_id', '=', $user_id )->first();
        $totalgold  = $playergold->gold + $itemid->item_get;

        Stat::where('user_id', '=', $user_id)->update([
            'gold'  =>  $totalgold
        ]);

        BalanceGold::create([
            'user_id'   =>  $user_id,
            'game_id'   =>  0,
            'action_id' =>  10,
            'debit'     =>  0,
            'credit'    =>  $itemid->item_get,
            'balance'   =>  $totalgold,
            'datetime'  =>  Carbon::now('GMT+7')
        ]);

        PlayerNotif::create([
            'user_id'   =>  $user_id,
            'msg'       =>  $itemid->item_get,
            'date'      =>  Carbon::now('GMT+7'),
            'type'      =>  2
        ]);
        


        StoreTransaction::where('user_id', '=', $user_id)->where('id', '=', $declineOrderId)->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '5',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menerima permintaan Transaksi dengan PenggunaID'. $user_id
        ]);


        return back()->with('success','Approve Succesful');
    }
}
