<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreTransaction;
use App\ItemPoint;
use App\Classes\MenucLass;
use App\Log;
use Session;
use Carbon\Carbon;
use App\StoreTransactionHist;
use App\BalancePoint;
use App\Stat;
use App\StoreDelivery;


class RewardTransactionController extends Controller
{
    public function index()
    {
        $menu          = MenuClass::menuName('L_REWARD_TRANSACTION');
        $mainmenu      = MenuClass::menuName('L_TRANSACTION');
        $transaction = StoreTransaction::where('shop_type', '=', 1)
                       ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.store_transaction.user_id')
                       ->join('asta_db.item_point', 'asta_db.item_point.item_id', '=', 'asta_db.store_transaction.item_id')
                       ->join('asta_db.store_delivery', 'asta_db.store_delivery.transaction_id', '=', 'asta_db.store_transaction.id')
                       ->select(
                           'asta_db.store_delivery.address',
                           'asta_db.store_delivery.zip_code',
                           'asta_db.store_delivery.phone',
                           'asta_db.store_transaction.user_id',
                           'username',
                           'asta_db.store_transaction.item_id',
                           'asta_db.store_transaction.status',
                           'asta_db.item_point.name as item_name',
                           'description',
                           'quantity',
                           'payment_id',
                           'datetime',
                           'shop_type',
                           'item_type',
                           'item_price',
                           'asta_db.store_transaction.id as strtrnsid',
                           'asta_db.store_transaction.id'
                       )
                       ->where('item_type', '=', 3)
                       ->where('asta_db.store_transaction.status', '=', 0)
                       ->get();

        return view('pages.transaction.reward_transaction', compact('transaction', 'menu', 'mainmenu'));
    }

    public function approve(Request $request)
    {
        $user_id     = $request->user_id;
        $item_name   = $request->item_name;
        $description = $request->description;
        $quantity    = $request->quantity;
        $payment_id  = $request->payment_id;
        $datetime    = $request->datetime;
        $shop_type   = $request->shop_type;
        $price       = $request->price;
        $approveid   = $request->approveId;

        StoreTransaction::where('id', '=', $approveid)->update([
            'description'   =>  $description
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menerima permintaan ('. $user_id.')'
        ]);

        return back()->with('success', alertTranslate("Receiving request Transaction has been successful"));
    }

    public function decline(Request $request)
    {
        $user_id     = $request->user_id;
        $item_name   = $request->item_name;
        $description = $request->description;
        $quantity    = $request->quantity;
        $payment_id  = $request->payment_id;
        $datetime    = $request->datetime;
        $shop_type   = $request->shop_type;
        $price       = $request->price;
        $declineid   = $request->declineId;


        StoreTransactionHist::create([
            'user_id'     => $user_id,
            'item_name'   => $item_name,
            'status'      => 2,
            'description' => $description,
            'quantity'    => $quantity,
            'payment_id'  => $payment_id,
            'datetime'    => $datetime,
            'shop_type'   => $shop_type,
            'item_type'   => 3,
            'item_price'  => $price,
            'action_date' => Carbon::now('GMT+7')
        ]);

        $user_stat  = Stat::where('user_id', '=', $user_id)->first();
        $totalPoint = $user_stat->point + $price;

        Stat::where('user_id', '=', $user_id)->update([
            'point' =>  $totalPoint
        ]);


        BalancePoint::create([
            'user_id'   =>  $user_id,
            'game_id'   =>  0,
            'action_id' =>  10,
            'debit'     =>  $price,
            'credit'    =>  0.00,
            'balance'   =>  $totalPoint,
            'datetime'  =>  Carbon::now('GMT+7')
        ]);

        StoreTransaction::where('user_id', '=', $user_id)->where('id', '=', $declineid)->delete();

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menolak permintaan ('. $user_id.')'
        ]);

        return back()->with('success', alertTranslate('Reject request Transaction has been successful'));
    }

    public function DeliveryProgress(Request $request)
    {
        $iddelivery = $request->idstore;
        StoreDelivery::create([
            'id'             => $iddelivery,
            // 'transaction_id' => 
        ]);
    }
}
