<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reseller;
use Session;
use App\Log;
use Carbon\Carbon;
use Validator;
use App\Classes\MenuClass;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//****************************************** Menu List Reseller ******************************************//
    public function index()
    {
        $menu     = MenuClass::menuName('List Reseller');
        $reseller = Reseller::getAllData();
        return view('pages.reseller.listreseller', compact('menu', 'reseller'));
    }


    public function update(Request $request)
    {
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        Reseller::where('id', '=', $pk)->update([
            $name => $value
        ]);

        switch($name) {
            case "username":
                $name = 'Username';
                break;
            
            case "name":
                $name = "Name";
                break;
            
            case "phone":
                $name = "Phone";
                break;
            
            case "email":
                $name = "Email";
                break;

            case "gold":
                $name = "Gold";
                break;

            case "rank_id":
                $name = "Rank ID";
                break;
            
            default:
                "";
        }


        Log::create([
            'op_id' => Session::get('userId'),
            'action_id'   => '2',
            'datetime'        => Carbon::now('GMT+7'),
            'desc' => 'Edit'.$name.' in menu List Reseller with ID '.$pk.' To '.$value
        ]);
    }



    public function PasswordUpdate(Request $request)
    {
        $pk = $request->userid;
        $password = $request->password;
        
        if($password != '') {
            Reseller::where('id', '=', $pk)->update([
                'password' => bcrypt($password)
            ]);
        
  
  
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '1',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Edit password in menu List Reseller with ResellerId '.$pk.' to '. $password
            ]);

            return redirect()->route('List_Reseller')->with('success','Reset Password Successfully');
        }
        return redirect()->route('List_Reseller')->with('alert','Password is Null');
    }



    public function destroy(Request $request)
    {
        $userid = $request->id;
        if($userid != '')
        {
            DB::table('reseller')->where('id', '=', $userid)->delete();

            Log::create([
                'op_id' => Session::get('userId'),
                'action_id'   => '4',
                'datetime'        => Carbon::now('GMT+7'),
                'desc' => 'Deletein menu List Reseller with reseller ID '.$userid
            ]);
            return redirect()->route('List_Reseller')->with('success','Data Deleted');
        }
        return redirect()->route('List_Reseller')->with('success','Somethong wrong');                
    }
//****************************************** End Menu List Reseller ******************************************//


//****************************************** Menu Reseller Rank ******************************************//
    public function ResellerRank()
    {
        $rank = DB::table('reseller_rank')->get();
        $menu = MenuClass::menuName('Reseller Rank');
        return view('pages.reseller.reseller_rank', compact('rank', 'menu'));
    }


    public function storeRankReseller(Request $request)
    {
        $id   = $request->id;
        $rankname = $request->rankname;
        $validator = Validator::make($request->all(),[
            'id'    => 'required|integer',
            'rankname'    => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $rank = DB::table('reseller_rank')->insert([
            'order_id'        => $id,
            'name'            => $rankname,
            'accumulate_type' => '0',
            'bonus'           => '0'
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Reseller Rank with Rank Name '. $rankname
        ]);

        return redirect()->route('Reseller_Rank')->with('success','Data Added');
    }



    public function updateRank(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
    
        DB::table('reseller_rank')->where('order_id', '=', $pk)->update([
          $name => $value
        ]);
        
        switch($name) {
            case "order_id":
                $name = 'Order ID';
                break;
            
            case "name":
                $name = "Name";
                break;
            
            case "gold_group":
                $name = "Gold Group";
                break;
            
            case "accumulate_type":
                $name = "Accumulate Type";
                break;

            case "bonus":
                $name = "Bonus";
                break;
            
            default:
                "";
        }


        Log::create([
            'op_id' => Session::get('userId'),
            'action_id'   => '2',
            'datetime'        => Carbon::now('GMT+7'),
            'desc' => 'Edit'.$name.' in menu Reseller Rank with Order ID '.$pk.' To '.$value
        ]);
    }


    public function destroyRank(Request $request)
    {
        $id = $request->id;
        if($id != '')
        {
            DB::table('reseller_rank')->where('order_id', '=', $id)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Reseller Rank with reseller ID '.$id
            ]);
            return redirect()->route('Reseller_Rank')->with('success','Data Deleted');
        }
        return redirect()->route('Reseller_Rank')->with('success','Somethong wrong');  
    }
//****************************************** End Menu Reseller Rank ******************************************//



//****************************************** End Menu Reseller Transaction ******************************************//
    public function ResellerTransaction()
    {
        $transactions = DB::select('SELECT year(timestamp) as year, month(timestamp) as monthnumber,monthname(timestamp) as monthname, sum(gold) as totalgold FROM reseller_history GROUP BY year,monthname');
        return view('pages.reseller.reseller_transaction', compact('transactions'));
    }
///****************************************** End Menu Reseller Transaction ******************************************//
    public function BalanceReseller()
    {
        return view('pages.reseller.balance_reseller');
    }

    public function RegisterReseller()
    {
        $menu  = MenuClass::menuName('Register Reseller');
        return view('pages.reseller.register_reseller', compact('menu'));
    }

    public function ResellerBankTransaction()
    {
        $transactions = DB::select("SELECT reseller_transaction.*,  reseller.username, bank_info.bank_name, items_cash.goldAwarded, items_cash.name as item_name FROM reseller_transaction JOIN items_cash ON items_cash.id = reseller_transaction.item_id JOIN bank_info ON bank_info.paymentId = reseller_transaction.payment_id JOIN reseller ON reseller.id = reseller_transaction.reseller_id JOIN payments ON payments.id = reseller_transaction.payment_id WHERE payments.transaction_type = 7 AND reseller_transaction.status = 1 ORDER BY reseller_transaction.timestamp ASC");
        $menu         = MenuClass::menuName('Reseller Bank Transaction');
        return view('pages.reseller.reseller_bank_transaction', compact('transactions', 'menu'));
    }

    public function ResellerBankTransactionApprove(Request $request)
    {
        $approveOrderId = $request->approveId;
        $resellerId     = $request->resellerId;
        $goldAwarded    = $request->goldAwarded;
        $amount         = $request->price;

        DB::table('reseller_history')->insert([
            'reseller_id' => $resellerId,
            'price'       => $amount,
            'gold'        => $goldAwarded,
            'timestamp'   => Carbon::now('GMT+7')
          ]);
  
          $checkTotalGold = DB::table('reseller')->select('gold')->where('id', '=', $resellerId)->first();
  
          DB::table('balance_reseller')->insert([
            'reseller_id' => $resellerId,
            'action'      => 'Buy Gold',
            'debit'       => $goldAwarded,
            'credit'      => 0,
            'total'       => $checkTotalGold->gold,
            'timestamp'   => Carbon::now('GMT+7')
          ]);
  
          DB::table('reseller_transaction')->where('order_id', $approveOrderId)->update([
            'status' => '2',
            'timestamp' => Carbon::now('GMT+7')
          ]);

        //   Log::create([
        //     'op_id' => Session::get('userId'),
        //     'action_id'   => '3',
        //     'datetime'        => Carbon::now('GMT+7'),
        //     'desc' => 'Create new in menu Reseller Bank$ranknam Transaction with Rank Name '. $rankname
        //   ]);

          return back()->with('success','Approved Succesful');
    }


    public function ResellerBankTransactionDecline(Request $request)
    {
        $declineOrderId = $request->declineId;
        DB::table('reseller_transaction')->where('order_id', $declineOrderId)->update([
            'status'    => '0',
            'timestamp' => Carbon::now('GMT+7')
        ]);
        return back()->with('success','Declined Succesful');
    }



    public function searchBalance(Request $request)
    {
      $searchUsername      = $request->inputUsername;
      $startDate           = $request->inputMinDate;
      $endDate             = $request->inputMaxDate;
      $startDateComparison = Carbon::parse($startDate)->timestamp;
      $endDateComparison   = Carbon::parse($endDate)->timestamp;

      if($endDateComparison < $startDateComparison){
        return back()->with('alert','alert');
      }

      if ($searchUsername != NULL && $startDate != NULL && $endDate != NULL){

        $balancedetails = DB::table('balance_reseller')
                          ->select('balance_reseller.*', 'reseller.username')
                          ->JOIN('reseller', 'balance_reseller.reseller_id', '=', 'reseller.id')
                          ->WHERE('reseller.username', $searchUsername)
                          ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                          ->orderBy('timestamp', 'asc')
                          ->get();

        // $balancedetails->appends($request->all());
        return view('pages.reseller.balance_reseller_detail', compact('balancedetails'));

      }else if ($searchUsername != NULL && $startDate != NULL) {

        $balancedetails = DB::table('balance_reseller')
                          ->select('balance_reseller.*', 'reseller.username')
                          ->JOIN('reseller', 'balance_reseller.reseller_id', '=', 'reseller.id')
                          ->WHERE('reseller.username', $searchUsername)
                          ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                          ->orderBy('timestamp', 'asc')
                          ->get();

        // $balancedetails->appends($request->all());
        return view('pages.reseller.balance_reseller_detail', compact('balancedetails'));

      }else if ($searchUsername != NULL && $endDate != NULL) {
        $balancedetails = DB::table('balance_reseller')
                          ->select('balance_reseller.*', 'reseller.username')
                          ->JOIN('reseller', 'balance_reseller.reseller_id', '=', 'reseller.id')
                          ->WHERE('reseller.username', $searchUsername)
                          ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                          ->orderBy('timestamp', 'desc')
                          ->get();

        // $balancedetails->appends($request->all());
        return view('pages.reseller.balance_reseller_detail', compact('balancedetails'));
      }else if($searchUsername != NULL) {
        $balancedetails = DB::table('balance_reseller')
                          ->select('balance_reseller.*', 'reseller.username')
                          ->JOIN('reseller', 'balance_reseller.reseller_id', '=', 'reseller.id')
                          ->WHERE('reseller.username', $searchUsername)
                          ->get();

        // $balancedetails->appends($request->all());
        return view('pages.reseller.balance_reseller_detail', compact('balancedetails'));
      }
    }

    public function searchTransaction(Request $request)
    {
        $searchUsername = $request->inputUsername;
        $startDate      = $request->inputMinDate;
        $endDate        = $request->inputMaxDate;
  
        if($endDate < $startDate){
          return back()->with('alert','alert');
        }
  
        if ($searchUsername != NULL && $startDate != NULL && $endDate != NULL){
  
          $transactions = DB::table('reseller_history')
                            ->select('reseller_history.*', 'reseller.username')
                            ->JOIN('reseller', 'reseller_history.reseller_id', '=', 'reseller.id')
                            ->WHERE('reseller.username', $searchUsername)
                            ->wherebetween('timestamp', [$startDate." 00:00:00", $endDate." 23:59:59"])
                            ->orderBy('timestamp', 'asc')
                            ->get();
  
        //   $transactions->appends($request->all());
          return view('pages.reseller.reseller_transaction_detail', compact('transactions'));
  
        }else if ($searchUsername != NULL && $startDate != NULL) {
  
          $transactions = DB::table('reseller_history')
                            ->select('reseller_history.*', 'reseller.username')
                            ->JOIN('reseller', 'reseller_history.reseller_id', '=', 'reseller.id')
                            ->WHERE('reseller.username', $searchUsername)
                            ->WHERE('timestamp', '>=', $startDate." 00:00:00")
                            ->orderBy('timestamp', 'asc')
                            ->get();
  
        //   $transactions->appends($request->all());
          return view('pages.reseller.reseller_transaction_detail', compact('transactions'));
  
        }else if ($searchUsername != NULL && $endDate != NULL) {
          $transactions = DB::table('reseller_history')
                            ->select('reseller_history.*', 'reseller.username')
                            ->JOIN('reseller', 'reseller_history.reseller_id', '=', 'reseller.id')
                            ->WHERE('reseller.username', $searchUsername)
                            ->WHERE('timestamp', '<=', $endDate." 23:59:59")
                            ->orderBy('timestamp', 'desc')
                            ->get();
  
        //   $transactions->appends($request->all());
          return view('pages.reseller.reseller_transaction_detail', compact('transactions'));
        }else if($searchUsername != NULL) {
          $transactions = DB::table('reseller_history')
                          ->select('reseller_history.*', 'reseller.username')
                          ->JOIN('reseller', 'reseller_history.reseller_id', '=', 'reseller.id')
                          ->WHERE('reseller.username', $searchUsername)
                          ->get();
  
        //   $transactions->appends($request->all());
          return view('pages.reseller.reseller_transaction_detail', compact('transactions'));
        }
    }

    public function detailTransaction($month, $year)
    {
        $transactions = DB::table('reseller_history')
                        ->select('reseller_history.*', 'reseller.username')
                        ->join('reseller','reseller_history.reseller_id','=','reseller.id')
                        ->whereYear('timestamp', $year)
                        ->whereMonth('timestamp', $month)
                        ->orderby('timestamp', 'ASC')
                        ->get();

        return view('pages.reseller.reseller_transaction_detail', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validate = [
          'username' => 'unique:reseller,username',
          'phone'    => 'unique:reseller,phone',
          'email'    => 'unique:reseller,email',
          'idcard'   => 'unique:reseller,ktp'
        ];
  
        $validator = Validator::make($data,$validate);
  
        if($validator->fails())
        {
  
          return back()->withInput()->with('alert', $validator->errors()->first());
  
        }
  
        Reseller::insertData([
          'username' => $request->username,
          'password' => bcrypt($request->password),
          'name'     => $request->name,
          'phone'    => $request->phone,
          'email'    => $request->email,
          'ktp'      => $request->idcard,
          'address'  => $request->address,
          'guid'     => bcrypt($request->username.$request->email.$request->idcard)
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Register Reseller with username '. $request->username
        ]);
  
        return back()->with('alert','REGISTER SUCCESSFULL');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
