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

class PaymentStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu           = MenuClass::menuName('Payment Store');
        $getPayments    = Payment::orderBy('id', 'desc')->get();

        return view('pages.store.payment_store', compact('menu', 'getPayments'));
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
        $validator = Validator::make($request->all(),[
            'title'             => 'required',
            'paymentType'       => 'required',
            'transactionType'   => 'required|integer|between:1,8'
            
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $payment = Payment::create([
            'name'              => $request->title,
            'payment_type'      => $request->paymentType,
            'transaction_type'  => $request->transactionType,
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
            case "payment_type":
                $name = "Payment Type";
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
}
