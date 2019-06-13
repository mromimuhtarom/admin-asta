<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
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
        $getPayments    = DB::table('payments')->orderBy('id', 'desc')->get();

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

        $payment = DB::table('payments')->insert([
            'name'              => $title,
            'payment_type'      => $pType,
            'transaction_type'  => $tType,
        ]);

        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '71',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Payment Store with Name '. $payment->name
        ]);

        return redirect()->route('PaymentStore-view')->with('success','Data Added');
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

        DB::table('payments')->where('id', '=', $pk)->update([
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
            'operator_id' => Session::get('userId'),
            'menu_id'     => '71',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' Payment Store ID '.$pk.' to '. $value
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
            DB::table('payments')->where('id', '=', $getPaymentId)->delete();
            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '71',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Payment Store ID '.$getPaymentId
            ]);
            return redirect()->route('PaymentStore-view')->with('success','Data Deleted');
        }
        return redirect()->route('PaymentStore-view')->with('success','Something wrong');  
    }
}
