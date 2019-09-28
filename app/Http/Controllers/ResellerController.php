<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Reseller;
use Session;
use App\Log;
use Carbon\Carbon;
use Validator;
use App\ResellerTransactionDay;
use App\ResellerBalance;
use App\StoreTransactionHist;
use App\StoreTransaction;
use App\Classes\MenuClass;
use App\ResellerRank;
use App\ItemsCash;
use App\ConfigText;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//****************************************** Menu List Reseller ******************************************//
//---------- Index List Reseller --------- //
    public function index()
    {
        $menu     = MenuClass::menuName('List Reseller');
        $mainmenu = MenuClass::menuName('Reseller');
        $rank     = ResellerRank::all();
        $reseller = Reseller::join('asta_db.reseller_rank', 'asta_db.reseller_rank.id', '=', 'asta_db.reseller.rank_id')->select('asta_db.reseller_rank.name as rankname', 'asta_db.reseller.reseller_id', 'asta_db.reseller.username', 'asta_db.reseller.phone', 'asta_db.reseller.email', 'asta_db.reseller.gold', 'asta_db.reseller.fullname')->get();
        return view('pages.reseller.listreseller', compact('menu', 'reseller', 'rank', 'mainmenu'));
    }
//-------- End Index List Reseller ------ //

//-------- Update List Reseller ---------//
    public function update(Request $request)
    {
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        Reseller::where('reseller_id', '=', $pk)->update([
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
//-------- End Update List Reseller --------- //

// ------- Password Update List Reseller ------- //
    public function PasswordUpdate(Request $request)
    {
        $pk = $request->userid;
        $password = $request->password;
        
        if($password != '') {
            Reseller::where('reseller_id', '=', $pk)->update([
                'userpass' => bcrypt($password)
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
// ------- End Password Update List Reseller ------- //

// -------Delete List Reseller ------ //
    public function destroy(Request $request)
    {
        $userid = $request->id;
        if($userid != '')
        {
            Reseller::where('reseller_id', '=', $userid)->delete();

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
//----- End List Reseller ------//
//****************************************** End Menu List Reseller ******************************************//


//****************************************** Menu Reseller Rank ******************************************//

// ------- Index Reseller Rank ------- //
    public function ResellerRank()
    {
        $rank        = ResellerRank::select('id', 'name', 'gold', 'type', 'bonus')->get();
        $menu        = MenuClass::menuName('Rank Reseller');
        $mainmenu    = MenuClass::menuName('Reseller');
        $configtype  = ConfigText::where('id', '=', 10) ->select('value')->first();
        $replacetype = str_replace(':', ',', $configtype->value);
        $explodetype = explode(',', $replacetype);

        return view('pages.reseller.reseller_rank', compact('rank', 'menu', 'mainmenu', 'explodetype'));
    }
// ------- End Index Reseller Rank ------- //

// ------ Insert Reseller Rank ------ //
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

        $rank = ResellerRank::create([
            'id'    => $id,
            'name'  => $rankname,
            'type'  => '0',
            'bonus' => '0'
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Reseller Rank with Rank Name '. $rankname
        ]);

        return redirect()->route('Reseller_Rank')->with('success','Data Added');
    }
// ------ End Insert Reseller Rank ------ //

// ----- Update Reseller Rank ------//
    public function updateRank(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
    
        

        ResellerRank::where('id', '=', $pk)->update([
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
//-------- End Update Reseller Rank ---------//

//------- Delete Reseller Rank -------- //
    public function destroyRank(Request $request)
    {
        $id = $request->id;
        if($id != '')
        {
            ResellerRank::where('id', '=', $id)->delete();

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
//-------- End Delete Reseller Rank ----------//
//****************************************** End Menu Reseller Rank ******************************************//



//****************************************** Menu Report Transaction ******************************************//

//------- Index Report Transaction -------//
    public function ReportTransaction()
    {
        $transactions = DB::select('SELECT year(date_created) as year, month(date_created) as monthnumber,monthname(date_created) as monthname, sum(buy_gold) as totalgold FROM asta_db.reseller_transaction_day GROUP BY year,monthname');
        // $transactions = DB::select('SELECT year(timestamp) as year, month(timestamp) as monthnumber,monthname(timestamp) as monthname, sum(gold) as totalgold FROM reseller_history GROUP BY year,monthname');
        $datenow = Carbon::now('GMT+7');
        return view('pages.reseller.report_transaction', compact('transactions', 'datenow'));
    }
//------ End Report Transaction -------//

//------ Search Report Transaction ------//
    public function searchReportTransaction(Request $request)
    {
        $searchUsername    = $request->inputUsername;
        $startDate         = $request->inputMinDate;
        $endDate           = $request->inputMaxDate;
        $choosedate        = $request->choosedate;
        $datenow           = Carbon::now('GMT+7');
        $reportTransaction = DB::table('asta_db.store_transaction_hist')
                             ->JOIN('asta_db.reseller', 'asta_db.store_transaction_hist.user_id', '=', 'asta_db.reseller.reseller_id')
                             ->select(
                                 'asta_db.store_transaction_hist.user_id',
                                 'asta_db.reseller.username',
                                 'asta_db.store_transaction_hist.item_name',
                                 'asta_db.store_transaction_hist.quantity',
                                 'asta_db.store_transaction_hist.item_price',
                                 'asta_db.store_transaction_hist.status',
                                 'asta_db.store_transaction_hist.datetime',
                                 'asta_db.store_transaction_hist.action_date'
                             );
        $validator = Validator::make($request->all(),[
            'inputMinDate'    => 'required|date',
            'inputMaxDate'    => 'required|date',
            'choosedate'      => 'required',
        ]);
    
        if ($validator->fails()) {
            return self:: ReportTransaction()->withErrors($validator->errors());
        }
  
        if($endDate < $startDate){
          return back()->with('alert','End Date can\'t be more than start date');
        }
  
        if($choosedate == 'approvedecline')
        {
            if ($searchUsername != NULL && $startDate != NULL && $endDate != NULL){
  
                $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                  ->wherebetween('asta_db.store_transaction_hist.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                  ->orderBy('asta_db.store_transaction_hist.datetime', 'asc')
                                  ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $startDate != NULL) {
        
                $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', $searchUsername)
                                  ->WHERE('datetime', '>=', $startDate." 00:00:00")
                                  ->orderBy('datetime', 'asc')
                                  ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $endDate != NULL) {
                $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', $searchUsername)
                                  ->WHERE('datetime', '<=', $endDate." 23:59:59")
                                  ->orderBy('datetime', 'desc')
                                  ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }else if($searchUsername != NULL) {
                $transactions = $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }
        } else if($choosedate == 'request')
        {
            if ($searchUsername != NULL && $startDate != NULL && $endDate != NULL){
  
                $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                  ->wherebetween('asta_db.store_transaction_hist.action_date', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                  ->orderBy('asta_db.store_transaction_hist.action_date', 'asc')
                                  ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $startDate != NULL) {
        
                $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', $searchUsername)
                                  ->WHERE('action_date', '>=', $startDate." 00:00:00")
                                  ->orderBy('action_date', 'asc')
                                  ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $endDate != NULL) {
                $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', $searchUsername)
                                  ->WHERE('action_date', '<=', $endDate." 23:59:59")
                                  ->orderBy('action_date', 'desc')
                                  ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }else if($searchUsername != NULL) {
                $transactions = $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                ->get();
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }
        }
    }
//------- End Search Report Transaction ------//

//------ Detail Report Transaction ------//
public function detailTransaction($month, $year)
{
    $transactions = StoreTransactionHist::select(
                        'asta_db.store_transaction_hist.user_id',
                        'asta_db.store_transaction_hist.item_name',
                        'asta_db.store_transaction_hist.quantity',
                        'asta_db.store_transaction_hist.item_price',
                        'asta_db.store_transaction_hist.status',
                        'asta_db.store_transaction_hist.datetime', 
                        'asta_db.reseller.username'
                    )
                    ->join('asta_db.reseller','asta_db.store_transaction_hist.user_id','=','asta_db.reseller.reseller_id')
                    ->whereYear('datetime', $year)
                    ->whereMonth('datetime', $month)
                    ->where('user_type', '=', 4)
                    ->orderby('datetime', 'ASC')
                    ->get();
    $datenow        = Carbon::now('GMT+7');

    return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
}
//------ End Detail Report Transaction ------//
//****************************************** End Menu Report Transaction ******************************************//

//****************************************** Menu Balance Reseller ******************************************//
//------ Index Balance Reseller ------//
    public function BalanceReseller()
    {
        $datenow = Carbon::now('GMT+7');
        return view('pages.reseller.balance_reseller', compact('datenow'));
    }
//----- End Index Balance Reseller -------//

//----- Search Balance Reseller -----//
    public function searchBalance(Request $request)
    {
      $searchUsername      = $request->inputUsername;
      $startDate           = $request->inputMinDate;
      $endDate             = $request->inputMaxDate;
      $startDateComparison = Carbon::parse($startDate)->timestamp;
      $endDateComparison   = Carbon::parse($endDate)->timestamp;
      $datenow             = Carbon::now('GMT+7');
      $balanceReseller     = ResellerBalance::select(
                                'asta_db.reseller_balance.reseller_id',
                                'asta_db.reseller_balance.debet',
                                'asta_db.reseller_balance.credit',
                                'asta_db.reseller_balance.balance',
                                'asta_db.reseller_balance.datetime', 
                                'asta_db.reseller.username', 
                                'asta_db.action.action'
                             )
                             ->JOIN('asta_db.reseller', 'asta_db.reseller_balance.reseller_id', '=', 'asta_db.reseller.reseller_id')
                             ->JOIN('asta_db.action', 'asta_db.action.id', '=', 'asta_db.reseller_balance.action_id');
      
      if($endDateComparison < $startDateComparison){
        return back()->with('alert','End Date can\'t be less than start date');
      }

      if ($searchUsername != NULL && $startDate != NULL && $endDate != NULL){

        $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', $searchUsername)
                          ->wherebetween('asta_db.reseller_balance.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                          ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                          ->get();

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));

      }else if ($searchUsername != NULL && $startDate != NULL) {

        $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', $searchUsername)
                          ->WHERE('asta_db.reseller_balance.datetime', '>=', $startDate." 00:00:00")
                          ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                          ->get();

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));

      }else if ($searchUsername != NULL && $endDate != NULL) {
        $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', $searchUsername)
                          ->WHERE('asta_db.reseller_balance.datetime', '<=', $endDate." 23:59:59")
                          ->orderBy('asta_db.reseller_balance.datetime', 'desc')
                          ->get();

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));
      }else if($searchUsername != NULL) {
        $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', $searchUsername)
                          ->get();

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));
      }
    }
//----- End Search Balance Reseller -----//
//****************************************** End Menu Balance Reseller ******************************************//

//****************************************** Menu Register Reseller ******************************************//
//------ Index Register Reseller ------//
    public function RegisterReseller()
    {
        $menu     = MenuClass::menuName('Register Reseller');
        $mainmenu = MenuClass::menuName('Reseller');
        return view('pages.reseller.register_reseller', compact('menu', 'mainmenu'));
    }
//------ End Register Reseller -------//

//------ Insert Register Reseller ------//
    public function store(Request $request)
    {
        $data = $request->all();
        $datetimenow = Carbon::now('GMT+7');
  
        Reseller::insertData([
          'username' => $request->username,
          'userpass' => bcrypt($request->password),
          'fullname' => $request->firstName.' '.$request->lastName,
          'phone'    => $request->phone,
          'email'    => $request->email,
          'identify' => $request->idcard,
          'join_date'=> $datetimenow,
          'gold'     => 0,
          'rank_id'  => 1,
          'rank_gold'=> 0,
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Register Reseller with username '. $request->username
        ]);
  
        return back()->with('success','REGISTER SUCCESSFULL');
    }
//------ End Insert Register Reseller ------//
//****************************************** End Menu Register Reseller ******************************************//

//****************************************** Menu Request Transaction ******************************************//
//----- Index Request Transaction -----//
    public function RequestTransaction()
    {
        $transactions = DB::table('asta_db.store_transaction')
                        ->join('items_cash', 'items_cash.id', '=', 'asta_db.store_transaction.item_id')
                        ->join('asta_db.reseller', 'asta_db.reseller.reseller_id', '=', 'asta_db.store_transaction.user_id')
                        ->join('asta_db.payment', 'asta_db.payment.id', '=', 'asta_db.store_transaction.payment_id')
                        ->select(
                            'asta_db.reseller.reseller_id',
                            'asta_db.reseller.username',
                            'asta_db.payment.name as bankname',
                            'items_cash.name as item_name',
                            'items_cash.goldAwarded',
                            'asta_db.store_transaction.datetime',
                            'asta_db.store_transaction.quantity',
                            'asta_db.store_transaction.item_price',
                            'asta_db.store_transaction.description',
                            'asta_db.store_transaction.id',
                            'asta_db.store_transaction.payment_id',
                            'asta_db.store_transaction.item_type'
                        )
                        ->where('asta_db.store_transaction.status', '=', 0)
                        ->where('asta_db.store_transaction.shop_type', '=', 2)
                        ->orderBy('asta_db.store_transaction.datetime', 'ASC')
                        ->get();
                        
        $menu     = MenuClass::menuName('Request Transaction');
        $submenu  = MenuClass::menuName('Reseller Transaction');
        $mainmenu = MenuClass::menuName('Reseller');
        return view('pages.reseller.request_transaction', compact('transactions', 'menu', 'mainmenu', 'submenu'));
    }
//------ End Index Request Transaction ------//

//------ Request Transaction Approve -------//
    public function RequestTransactionApprove(Request $request)
    {
        $resellerId               = $request->resellerId;
        $goldAwarded              = $request->goldbuy;
        $amount                   = $request->price;
        $reseller_id              = $request->reseller_id;
        $item_name                = $request->item_name;
        $desc                     = $request->desc;
        $quantity                 = $request->quantity;
        $payment_id               = $request->payment_id;
        $datetime                 = $request->datetime;
        $user_type                = $request->user_type;
        $item_type                = $request->item_type;
        $datetimenow              = Carbon::now('GMT+7');
        $datenow                  = $datetimenow->toDateString();
        $reseller_transaction_day = ResellerTransactionDay::where('reseller_id', '=', $reseller_id)
                                    ->whereDate('date', '=', $datenow)
                                    ->first();

        if($reseller_transaction_day)
        {
            $gold   = $reseller_transaction_day->buy_gold + $goldAwarded;
            $amount = $reseller_transaction_day->buy_amount + $amount;

            ResellerTransactionDay::where('reseller_id', '=', $reseller_id)->update([
                'buy_gold'      => $gold,
                'buy_amount'    => $amount
            ]);
        } else 
        {
            ResellerTransactionDay::create([
                'date'          =>  $datenow,
                'reseller_id'   =>  $reseller_id,
                'buy_gold'      =>  $goldAwarded,
                'buy_amount'    =>  $amount,
                'sell_gold'     =>  0,
                'date_created'  =>  $datetimenow
            ]);
        }
        

        StoreTransactionHist::create([
                'user_id'       => $reseller_id,
                'item_name'     =>  'nanti',
                'status'        =>  2,
                'desc'          =>  $desc,
                'quantity'      =>  $quantity,
                'payment_id'    =>  $payment_id,
                'datetime'      =>  $datetime,
                'user_type'     =>  $user_type,
                'item_type'     =>  4,
                'item_price'    =>  $amount
        ]);

  
          $checkTotalGold = Reseller::select('gold')->where('reseller_id', '=', $reseller_id)->first();
        //   $checkamount = DB::table('rese')
          ResellerBalance::create([
            'reseller_id' => $reseller_id,
            'action_id'   => 2,
            'credit'      => 0,
            'debet'       => $goldAwarded,
            'balance'     => $checkTotalGold->gold,
            'datetime'    => Carbon::now('GMT+7')
          ]);

        StoreTransaction::where('user_id', '=', $reseller_id)->where('user_type', '=', 4)->delete();


          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '5',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'approve request transaction with reseller id'. $reseller_id
          ]);

          return back()->with('success','Approved Succesful');
    }
//------ End Request Transaction Approve -------//


//------ Request Transaction Decline -------//
    public function RequestTransactionDecline(Request $request)
    {
        $declineOrderId = $request->declineId;
        $goldAwarded    = $request->goldbuy;
        $amount         = $request->price;
        $reseller_id    = $request->reseller_id;
        $item_name      = $request->item_name;
        $desc           = $request->desc;
        $quantity       = $request->quantity;
        $payment_id     = $request->payment_id;
        $datetime       = $request->datetime;
        $user_type      = $request->user_type;
        $item_type      = $request->item_type;

        StoreTransactionHist::create([
            'user_id'       => $reseller_id,
            'item_name'     =>  'nanti',
            'status'        =>  0,
            'desc'          =>  $desc,
            'quantity'      =>  $quantity,
            'payment_id'    =>  $payment_id,
            'datetime'      =>  $datetime,
            'user_type'     =>  $user_type,
            'item_type'     =>  4,
            'item_price'    =>  $amount
        ]);
        StoreTransaction::where('user_id', '=', $reseller_id)->where('user_type', '=', 4)->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '6',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'decline request transaction with reseller id'. $reseller_id
        ]);
        return back()->with('success','Declined Succesful');
    }
//------ End Request Transaction Decline -------//
//****************************************** End Menu Request Transaction ******************************************//



//****************************************** Menu Item Store Reseller******************************************//
// ------- index Item Store Reseller -------- //
    public function ItemStoreReseller()
    {
        $menu     = MenuClass::menuName('Item Store Reseller');
        $mainmenu = MenuClass::menuName('Reseller');
        $getItems = ItemsCash::select(
                        'item_id',
                        'name',
                        'item_get',
                        'item_type',
                        'price',
                        'trans_type',
                        'google_key',
                        'status',
                        'shop_type'
                    )
                    ->where('shop_type', '=', 4)
                    ->orderBy('item_id', 'desc')
                    ->get();
        $active   = ConfigText::select(
                        'name', 
                        'value'
                    )
                    ->where('id', '=', 4)
                    ->first();
        $itemtype = ConfigText::select(
                        'name', 
                        'value'
                    )
                    ->where('id', '=', 5)
                    ->first();
        $value    = str_replace(':', ',', $active->value);
        $endis    = explode(",", $value);
        $valueitem    = str_replace(':', ',', $itemtype->value);
        $item    = explode(",", $valueitem);
        return view('pages.reseller.item_store_reseller', compact('getItems', 'menu', 'endis', 'mainmenu', 'item'));
    }
// ------- End index Item Store Reseller -------- //

// ------- Insert Item Store Reseller -------- //
    public function ItemResellerstore(Request $request)
    {
        $title          = $request->title;
        $goldAwarded    = $request->goldAwarded;
        $priceCash      = $request->priceCash;
        $googleKey      = $request->googleKey;
        $itemType       = $request->itemType;

        $validator = Validator::make($request->all(),[
            'title'       => 'required',
            'goldAwarded' => 'required|integer',
            'priceCash'   => 'required|integer',
            'googleKey'   => 'required',
            'itemType'    => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $gold = ItemsCash::create([
            'name'       => $title,
            'item_get'   => $goldAwarded,
            'price'      => $priceCash,
            'shop_type'  => 2,
            'item_type'  => $itemType,
            'google_key' => $googleKey,
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Item Store Reseller with title '. $request->title
        ]);

        return redirect()->route('Item_Store_Reseller')->with('success','Data Added');
    }
// ------- End Insert Item Store Reseller -------- //

// ------- Update Item Store Reseller -------- //
    public function updateItemstoreReseller(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        ItemsCash::where('item_id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "name":
                $name = "Name";
                break;
            case "item_get":
                $name = "Gold Awarded";
                break;
            case "price":
                $name = "Price Cash";
                break;
            case "shop_type":
                $name = "Shop Type";
                break;
            case "google_key":
                $name = "Google Key";
                break;
            case "status":
                $name = "Status";
                break;
            case "trans_type":
                $name = "Pay Transaction";
                break;
            default:
            "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' in menu Item Store Reseller with ID '.$pk.' to '. $value
        ]);
    }
// ------- End Update Item Store Reseller -------- //

// ------- Delete Item Store Reseller -------- //
    public function destroyItemStoreReseller(Request $request)
    {
        $getItemdId    = $request->userid;
        if($getItemdId  != '') 
        {
            ItemsCash::where('item_id', '=', $getItemdId)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Item Store Reseller with ID '.$getItemdId
            ]);
            return redirect()->route('Item_Store_Reseller')->with('success','Data Deleted');
        } else if($getItemdId  == NULL )
        {
            return redirect()->route('Item_Store_Reseller')->with('alert','ID must be Fill'); 
        }
        
    }
// ------- End Delete Item Store Reseller --------//
//****************************************** Menu Item Store Reseller******************************************//
}
