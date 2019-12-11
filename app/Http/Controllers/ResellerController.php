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
use App\ItemsGold;
use App\ItemPoint;
use File;
use Storage;    

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
                $name = 'Nama Pengguna';
                break;
            
            case "name":
                $name = "Nama";
                break;
            
            case "phone":
                $name = "Telepon";
                break;
            
            case "email":
                $name = "Email";
                break;

            case "gold":
                $name = "Koin";
                break;

            case "rank_id":
                $name = "Peringkat ID";
                break;
            
            default:
                "";
        }
        Log::create([
            'op_id' => Session::get('userId'),
            'action_id'   => '2',
            'datetime'        => Carbon::now('GMT+7'),
            'desc' => 'Edit'.$name.' di menu Daftar Agen dengan ID '.$pk.' menjadi '.$value
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
                'desc'      => 'Edit kata sandi di menu Daftar Agen dengan AgenId '.$pk.' menjadi '. $password
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
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Daftar Agen dengan AgenID '.$userid
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
        $id        = $request->id;
        $rankname  = $request->rankname;
        $validator = Validator::make($request->all(),[
            'id'       => 'required|integer',
            'rankname' => 'required',
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
            'desc'      => 'Menambahkan data di menu Peringkat Agen dengan Nama Peringkat '. $rankname
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
                $name = 'ID Pemesanan';
                break;            
            case "name":
                $name = "Nama";
                break;
            
            case "gold_group":
                $name = "Grup Koin";
                break;
            
            case "accumulate_type":
                $name = "Jenis Akumulasi";
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
            'desc' => 'Edit'.$name.' di menu Peringkat Agen dengan Order ID '.$pk.' menjadi '.$value
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
                'desc'      => 'Hapus di menu Peringkat Agen dengan AgenID '.$id
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
                                 'asta_db.store_transaction_hist.action_date',
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
  
                if(is_numeric($searchUsername) !== true):
                    $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                      ->wherebetween('asta_db.store_transaction_hist.action_date', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();
                else:
                    $transactions =   $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                      ->wherebetween('asta_db.store_transaction_hist.action_date', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $startDate != NULL) {
                
                if(is_numeric($searchUsername) !== true):
                    $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                      ->WHERE('action_date', '>=', $startDate." 00:00:00")
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();
                else:
                    $transactions =   $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                      ->WHERE('action_date', '>=', $startDate." 00:00:00")
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $endDate != NULL) {
                
                if(is_numeric($searchUsername) !== true):
                    $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                      ->WHERE('action_date', '<=', $endDate." 23:59:59")
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();
                else:
                    $transactions =   $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                      ->WHERE('action_date', '<=', $endDate." 23:59:59")
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }else if($searchUsername != NULL) {

                if(is_numeric($searchUsername) !== true):
                    $transactions = $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                    ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                    ->get();
                else:
                    $transactions = $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                    ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                    ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }
        } else if($choosedate == 'request')
        {
            if ($searchUsername != NULL && $startDate != NULL && $endDate != NULL){
  
                if(is_numeric($searchUsername) !== true):
                    $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                      ->wherebetween('asta_db.store_transaction_hist.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();
                else:
                    $transactions =   $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                      ->wherebetween('asta_db.store_transaction_hist.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $startDate != NULL) {
        
                if(is_numeric($searchUsername) !== true):
                    $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                      ->WHERE('datetime', '>=', $startDate." 00:00:00")
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();
                else:
                    $transactions =   $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                      ->WHERE('datetime', '>=', $startDate." 00:00:00")
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
        
              }else if ($searchUsername != NULL && $endDate != NULL) {

                if(is_numeric($searchUsername) !== true):
                    $transactions =   $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                      ->WHERE('datetime', '<=', $endDate." 23:59:59")
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();
                else:
                    $transactions =   $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                      ->WHERE('datetime', '<=', $endDate." 23:59:59")
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();
                endif;
        
              //   $transactions->appends($request->all());
                return view('pages.reseller.report_Transaction', compact('transactions', 'datenow'));
              }else if($searchUsername != NULL) {
                
                if(is_numeric($searchUsername) !== true):
                    $transactions = $reportTransaction->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                                    ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                    ->get();
                else:
                    $transactions = $reportTransaction->WHERE('asta_db.store_transaction_hist.user_id',  '=', $searchUsername)
                                    ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                    ->get();

                endif;

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
                        'asta_db.store_transaction_hist.action_date',
                        'asta_db.store_transaction_hist.shop_type',
                        'asta_db.store_transaction_hist.status',
                        'asta_db.store_transaction_hist.datetime', 
                        'asta_db.reseller.username'
                    )
                    ->join('asta_db.reseller','asta_db.store_transaction_hist.user_id','=','asta_db.reseller.reseller_id')
                    ->whereYear('action_date', $year)
                    ->whereMonth('action_date', $month)
                    ->where('shop_type', '=', 2)
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

        if(is_numeric($searchUsername) !== true):
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                              ->wherebetween('asta_db.reseller_balance.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                              ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                              ->get();
        else:
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.reseller_id', '=', $searchUsername)
                              ->wherebetween('asta_db.reseller_balance.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                              ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                              ->get();
        endif;

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));

      }else if ($searchUsername != NULL && $startDate != NULL) {

        if(is_numeric($searchUsername) !== true):
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                              ->WHERE('asta_db.reseller_balance.datetime', '>=', $startDate." 00:00:00")
                              ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                              ->get();
        else:
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', '=', $searchUsername)
                              ->WHERE('asta_db.reseller_balance.datetime', '>=', $startDate." 00:00:00")
                              ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                              ->get();
        endif;

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));

      }else if ($searchUsername != NULL && $endDate != NULL) {

        if(is_numeric($searchUsername) !== true):
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                              ->WHERE('asta_db.reseller_balance.datetime', '<=', $endDate." 23:59:59")
                              ->orderBy('asta_db.reseller_balance.datetime', 'desc')
                              ->get();
        else:
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.reseller_id', '=', $searchUsername)
                              ->WHERE('asta_db.reseller_balance.datetime', '<=', $endDate." 23:59:59")
                              ->orderBy('asta_db.reseller_balance.datetime', 'desc')
                              ->get();
        endif;

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'datenow'));
      }else if($searchUsername != NULL) {

        if(is_numeric($searchUsername) !== true):
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                              ->get();
        else:
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.reseller_id', '=', $searchUsername)
                              ->get();
        endif;

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
          $validate = [
            'username'      => 'unique:reseller,username',
            'phone'         => 'unique:reseller,phone',
            'email'         => 'unique:reseller,email',
            'identitycard'  => 'unique:reseller,ktp'
          ];
    
          $validator = Validator::make($data,$validate);
    
          if($validator->fails())
          {
            return back()->withInput()->with('alert', $validator->errors()->first());
          }
  
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
            'desc'      => 'Menambahkan data di menu Pendaftaran Agen di menu Pendaftaran Agen dengan nama pengguna '. $request->username
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
                        ->join('item_cash', 'item_cash.item_id', '=', 'asta_db.store_transaction.item_id')
                        ->join('asta_db.reseller', 'asta_db.reseller.reseller_id', '=', 'asta_db.store_transaction.user_id')
                        ->join('asta_db.payment', 'asta_db.payment.id', '=', 'asta_db.store_transaction.payment_id')
                        ->select(
                            'asta_db.reseller.reseller_id',
                            'asta_db.reseller.username',
                            'asta_db.payment.name as bankname',
                            'item_cash.name as item_name',
                            'asta_db.store_transaction.item_id',
                            'item_cash.item_get',
                            'asta_db.store_transaction.datetime',
                            'asta_db.store_transaction.quantity',
                            'asta_db.store_transaction.item_price',
                            'asta_db.store_transaction.description',
                            'asta_db.store_transaction.shop_type',
                            'asta_db.store_transaction.id',
                            'asta_db.store_transaction.payment_id',
                            'asta_db.store_transaction.item_type'
                        )
                        ->where('asta_db.store_transaction.status', '=', 0)
                        ->where('asta_db.store_transaction.shop_type', '=', 2)
                        ->orderBy('asta_db.store_transaction.datetime', 'ASC')
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
                        
        $menu     = MenuClass::menuName('Request Transaction');
        $submenu  = MenuClass::menuName('Reseller Transaction');
        $mainmenu = MenuClass::menuName('Reseller');
        return view('pages.reseller.request_transaction', compact('item_gold', 'item_cash', 'item_point', 'transactions', 'menu', 'mainmenu', 'submenu'));
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
        $desc                     = $request->description;
        $quantity                 = $request->quantity;
        $payment_id               = $request->payment_id;
        $datetime                 = $request->datetime;
        $shop_type                = $request->shop_type;
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
                'description'   =>  $desc,
                'quantity'      =>  $quantity,
                'payment_id'    =>  $payment_id,
                'datetime'      =>  $datetime,
                'shop_type'     =>  $shop_type,
                'item_type'     =>  4,
                'item_price'    =>  $amount,
                'action_date'   => Carbon::now('GMT+7')
        ]);

  
          $checkTotalGold = Reseller::select('gold')->where('reseller_id', '=', $reseller_id)->first();
        //   $checkamount = DB::table('rese')
          ResellerBalance::create([
            'reseller_id' => $reseller_id,
            'action_id'   => 16,
            'credit'      => 0,
            'debet'       => $goldAwarded,
            'balance'     => $checkTotalGold->gold,
            'datetime'    => Carbon::now('GMT+7')
          ]);

        StoreTransaction::where('user_id', '=', $reseller_id)->where('shop_type', '=', $shop_type)->delete();


          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '5',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menerima permintaan transaksi di menu Transaksi Permintaan Agen dengan Agenid'. $reseller_id
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
        $desc           = $request->description;
        $quantity       = $request->quantity;
        $payment_id     = $request->payment_id;
        $datetime       = $request->datetime;
        $shop_type      = $request->shop_type;
        $item_type      = $request->item_type;

        StoreTransactionHist::create([
            'user_id'       => $reseller_id,
            'item_name'     =>  'nanti',
            'status'        =>  0,
            'description'   =>  $desc,
            'quantity'      =>  $quantity,
            'payment_id'    =>  $payment_id,
            'datetime'      =>  $datetime,
            'shop_type'     =>  $shop_type,
            'item_type'     =>  4,
            'item_price'    =>  $amount
        ]);
        StoreTransaction::where('user_id', '=', $reseller_id)->where('shop_type', '=', $shop_type)->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '6',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menolak permintaan transaksi di menu Transaksi Permintaan Agen dengan Agenid'. $reseller_id
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
                        'order',
                        'item_get',
                        'item_type',
                        'price',
                        'trans_type',
                        'google_key',
                        'status',
                        'shop_type'
                    )
                    ->where('shop_type', '=', 2)
                    ->orderBy('order', 'asc')
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
        $value     = str_replace(':', ',', $active->value);
        $endis     = explode(",", $value);
        $valueitem = str_replace(':', ',', $itemtype->value);
        $item      = explode(",", $valueitem);
        $timenow   = Carbon::now('GMT+7');
        return view('pages.reseller.item_store_reseller', compact('getItems', 'menu', 'endis', 'mainmenu', 'item', 'timenow'));
    }
// ------- End index Item Store Reseller -------- //

// ------- Insert Item Store Reseller -------- //
    public function ItemResellerstore(Request $request)
    {
        $id = ItemsCash::select('item_id')
              ->orderBy('item_id', 'desc')
              ->first();
        
        if($id === NULL )
        {
            $id_last = 0;
        } else {
            $id_last = $id->item_id;
        }
        $id_new                                   = $id_last + 1;
        $file                                     = $request->file('file');
        $file_wtr                                 = $request->file('file1');
        $ekstensi_diperbolehkan                   = array('png');
        $nama                                     = $_FILES['file']['name'];
        $nama_wtr                                 = $_FILES['file1']['name'];
        $x                                        = explode('.', $nama);
        $x_wtr                                    = explode('.', $nama_wtr);
        $ekstensi                                 = strtolower(end($x));
        $ekstensi_wtr                             = strtolower(end($x_wtr));
        $ukuran                                   = $_FILES['file']['size'];
        $nama_file_unik                           = $id_new.'.'.$ekstensi;
        list($width, $height)                     = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {

                $title          = $request->title;
                $goldAwarded    = $request->goldAwarded;
                $priceCash      = $request->priceCash;
                $googleKey      = $request->googleKey;
                // $itemType       = $request->itemType;
        
                $validator = Validator::make($request->all(),[
                    'order'       => 'required|integer',
                    'title'       => 'required',
                    'goldAwarded' => 'required|integer',
                    'priceCash'   => 'required|integer',
                    'googleKey'   => 'required',
                ]);
        
                if ($validator->fails()) {
                    return back()->withErrors($validator->errors());
                }             

                if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                {
                    list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                    // watermark image
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;


                    // Memuat gambar utama
                    $source = imagecreatefrompng($file->move(public_path('../public/upload/Gold/image1'), $nama_file_unik));
                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/Gold/image2'), $nama_file_unik));

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width = imagesx($source);
                    $main_height = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    $pos_x = $width - $width_watermark;
                    $pos_y = $height - $height_watermark;
                    imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 

                    $temp       = image_data($source);
                    $awsPath    = "unity-asset/store/gold/".$nama_file_unik;
                    $merge      = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    Storage::disk('s3')->put($awsPath, $temp);
                    // imagepng($source, $thumbnail);
                    // imagedestroy($source);
                   // end watermark image
                } else {
                    // $file->move(public_path('unity-asset/store/gold'), $nama_file_unik);
                    $rootpath = 'unity-asset/store/gold/'.$nama_file_unik;
                    $img_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
                }
                          
                $gold = ItemsCash::create([
                    'name'       => $title,
                    'item_get'   => $goldAwarded,
                    'price'      => $priceCash,
                    'shop_type'  => 2,
                    'item_type'  => 2,
                    'google_key' => $googleKey,
                ]);
        
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '3',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Menambahkan data di menu Toko Agen dengan judul '. $request->title
                ]);
                return redirect()->route('Item_Store_Reseller')->with('success','Data Added');                 
            }
            else
            {
                return redirect()->route('Item_Store_Reseller')->with('alert','Ukuran file terlalu besar');
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Item_Store_Reseller')->with('alert','Ekstensi file tidak di perbolehkan');
            // echo 'Ekstensi file tidak di perbolehkan';
        }
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
                $name = "Nama";
                break;
            case "item_get":
                $name = "Koin didapatkan";
                break;
            case "price":
                $name = "Harga Uang Tunai";
                break;
            case "google_key":
                $name = "Kunci Google";
                break;
            case "status":
                $name = "Status";
                break;
            case "trans_type":
                $name = "Jenis Pembayaran";
                $value = strTypeTransaction($value);
                break;
            default:
            "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' di menu Toko Barang dengan ID '.$pk.' menjadi '. $value
        ]);
    }
// ------- End Update Item Store Reseller -------- //




// ------- Update Image Item Store Reseller -------//
    public function updateImageItemStoreReseller(Request $request)
    {
        $pk                     = $request->pk;
        $file                   = $request->file('file');
        $file_wtr               = $request->file('file1');
        $ekstensi_diperbolehkan = array('png');
        $nama                   = $_FILES['file']['name'];
        $nama_wtr               = $_FILES['file1']['name'];
        $x                      = explode('.', $nama);
        $x_wtr                  = explode('.', $nama_wtr);
        $ekstensi               = strtolower(end($x));
        $ekstensi_wtr           = strtolower(end($x_wtr));
        $ukuran                 = $_FILES['file']['size'];
        $nama_file_unik         = $pk.'.'.$ekstensi;
        list($height, $width)   = getimagesize($file);

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {
                if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                {
                    list($width_watermark, $height_watermark)   = getimagesize($file_wtr);
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;

                    // Memuat gambar utama
                    $source = imagecreatefrompng($file->move(public_path('../public/upload/Gold/image1'), $nama_file_unik));

                    // Memuat gambar watermark
                    $watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/Gold/image2'), $nama_file_unik));

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width = imagesx($watermark);
                    $water_height = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width = imagesx($source);
                    $main_height = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    // $dime_x = -180;
                    // $dime_y = 200;
                    // menyalin kedua gambar
                    // imagecopy($source, $watermark, imagesx($source) - $main_width - $dime_x, imagesy($source) - $water_height - $dime_y, 0, 0, imagesx($watermark), imagesy($watermark));
                    $pos_x = $width - $width_watermark;
                    $pos_y = $height - $height_watermark;
                    imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 
                    
                    $temp    = image_data($source);
                    $awsPath = "unity-asset/store/gold/".$nama_file_unik;
                    $merge   = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);

                    Storage::disk('s3')->put($awsPath, $temp);
                    // imagepng($source, $thumbnail);
                    // imagedestroy($source);
                }
                else 
                {
                    $rootpath = 'unity-asset/store/gold/';
                    $img_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));

                    $path = '../public/upload/Gold/image1/'.$pk.'.png';
                    File::delete($path);    
                    $path = '../public/upload/Gold/image2/'.$pk.'.png';
                    File::delete($path);    
                    // return redirect()->route('Goods_Store')->with('alert','Gagal Upload File');
                }
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '2',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Edit gambar di menu Toko Agen dengan ID '.$pk.' menjadi '.$nama_file_unik
                ]);
                return redirect()->route('Item_Store_Reseller')->with('success','Update Image successfull');

            }
            else 
            {
                return redirect()->route('Item_Store_Reseller')->with('alert','Ukuran file terlalu besar');
            }
        }
        else 
        {
            return redirect()->route('Item_Store_Reseller')->with('alert', 'Image Must Be png Format');
        }
    }
// ------- End Update Image Item Store Reseller -------//





// ------- Delete Item Store Reseller -------- //
    public function destroyItemStoreReseller(Request $request)
    {
        $getItemId    = $request->userid;
        $pathS3        = 'unity-asset/store/gold/'.$getItemId.'.png';

        if($getItemId  != '') 
        {
            ItemsCash::where('item_id', '=', $getItemId)->delete();
            Storage::disk('s3')->delete($pathS3);
        
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Toko Agen dengan ID '.$getItemId
            ]);
            return redirect()->route('Item_Store_Reseller')->with('success','Data Deleted');
        } else if($getItemId  == NULL )
        {
            return redirect()->route('Item_Store_Reseller')->with('alert','ID must be Fill'); 
        }
        
    }

    public function deleteAllSelected(Request $request) 
    {
        $ids    =   $request->userIdAll;
        DB::table('asta_db.reseller')->whereIn('reseller_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Daftar Agen dengan AgenID '.$ids
        ]);
        return redirect()->route('List_Reseller')->with('success', 'Data deleted');
    }

    public function deleteAllSelectedRank(Request $request)
    {
        $ids    =   $request->userIdAll;
        DB::table('asta_db.reseller_rank')->whereIn('id', explode(",", $ids))->delete();

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Peringkat Agen dengan ID '.$ids
        ]);
        return redirect()->route('Reseller_Rank')->with('success', 'Data deleted');
    }
// ------- End Delete Item Store Reseller --------//
//****************************************** Menu Item Store Reseller******************************************//
}
