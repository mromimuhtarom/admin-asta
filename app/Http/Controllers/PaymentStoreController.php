<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\Log;
use App\Payment;
use Session;
use Carbon\Carbon;
use Validator;
use App\ConfigText;

class PaymentStoreController extends Controller
{

    public function index()
    {
        $menu        = MenuClass::menuName('Payment Store');
        $mainmenu    = MenuClass::menuName('Store');
        $getPayments = Payment::join('asta_db.payment_type', 'asta_db.payment_type.id', '=', 'asta_db.payment.type')
                       ->select(
                        'asta_db.payment.id', 
                        'asta_db.payment.name as PaymentName', 
                        'asta_db.payment_type.name as PaymentType',
                        'asta_db.payment.type as IdType',  
                        'asta_db.payment.status',
                        'asta_db.payment.desc'
                       )
                       ->orderBy('asta_db.payment.id', 'desc')
                       ->get();
        $active      = ConfigText::select(
                        'name', 
                        'value'
                       )
                       ->where('id', '=', 4)
                       ->first();
        $value       = str_replace(':', ',', $active->value);
        $endis       = explode(",", $value);
        $paymenttype = DB::table('payment_type')
                       ->select(
                           'id',
                           'name'
                       )
                       ->get();

        return view('pages.store.payment_store', compact('menu', 'getPayments', 'endis', 'mainmenu', 'paymenttype'));
    }

 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'             => 'required',
            'transactionType'   => 'required|integer|between:1,8'
            
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $payment = Payment::create([
            'name' => $request->title,
            'type' => $request->transactionType,
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu Toko Pembayaran dengan Nama '. $request->title
        ]);

        return redirect()->route('Payment_Store')->with('success', alertTranslate('Data Added'));
    }


    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        Payment::where('id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "name":
                $name = "Nama";
                break;
            case "type":
                $name  = "Tipe Transaksi";
                $value = strTypeTransaction($value);
                break;
            case "desc":
                $name = "Deskripsi";
                break;
            case "status":
                $name = "Status";
                if($value == 0):
                    $value = 'Disabled';
                else: 
                    $value = 'Enabled';
                endif;
                break;
            default:
            "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' di menu Toko Pembayaran dengan ID '.$pk.' menjadi '. $value
        ]);
    }


    public function destroy(Request $request)
    {
        $getPaymentId = $request->userid;
        if($getPaymentId != '')
        {
            Payment::where('id', '=', $getPaymentId)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Toko Pembayaran dengan ID '.$getPaymentId
            ]);
            return redirect()->route('Payment_Store')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Payment_Store')->with('success', alertTranslate('Something wrong'));  
    }

    public function deleteAllSelectedpayment(Request $request)
    {
        $ids    =   $request->userIdAll;
        DB::table('asta_db.payment')->whereIn('id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Toko Pembayaran dengan ID '.$ids
        ]);
        return redirect()->route('Payment_Store')->with('succes', alertTranslate('Data deleted'));
    }
}
