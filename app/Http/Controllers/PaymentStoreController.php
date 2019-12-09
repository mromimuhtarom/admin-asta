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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu        = MenuClass::menuName('Payment Store');
        $mainmenu    = MenuClass::menuName('Store');
        $getPayments = Payment::select(
                        'id', 
                        'name', 
                        'type',  
                        'status',
                        'desc'
                       )
                       ->orderBy('id', 'desc')
                       ->get();
        $active      = ConfigText::select(
                        'name', 
                        'value'
                       )
                       ->where('id', '=', 4)
                       ->first();
        $value       = str_replace(':', ',', $active->value);
        $endis       = explode(",", $value);

        return view('pages.store.payment_store', compact('menu', 'getPayments', 'endis', 'mainmenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'desc'      => 'Create new in menu Payment Store with Name '. $request->title
        ]);

        return redirect()->route('Payment_Store')->with('success','Data Added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                $name = "Name";
                break;
            case "transaction_type":
                $name = "Transaction Type";
                break;
            case "image":
                $name = "Image";
                break;
            case "status":
                $name = "Status";
                break;
            default:
            "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' in menu Payment Store with ID '.$pk.' to '. $value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                'desc'      => 'Delete in menu Payment Store with ID '.$getPaymentId
            ]);
            return redirect()->route('Payment_Store')->with('success','Data Deleted');
        }
        return redirect()->route('Payment_Store')->with('success','Something wrong');  
    }

    public function deleteAllSelectedpayment(Request $request)
    {
        $ids    =   $request->userIdAll;
        DB::table('asta_db.payment')->whereIn('id', explode(",", $ids))->delete();
        return redirect()->route('Payment_Store')->with('succes', 'Data deleted');
    }
}
