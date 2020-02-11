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
use Illuminate\Support\Facades\Input;   

class ResellerController extends Controller
{
    
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
            'desc' => 'Edit '.$name.' di menu Daftar Agen dengan ID '.$pk.' menjadi '.$value
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

            return redirect()->route('List_Reseller')->with('success', alertTranslate("Reset Password Successfully"));
        }
        return redirect()->route('List_Reseller')->with('alert', alertTranslate("Password is Null"));
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
            return redirect()->route('List_Reseller')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('List_Reseller')->with('success', alertTranslate('Somethong wrong'));                
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

        return redirect()->route('Reseller_Rank')->with('success', alertTranslate('Data added'));
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
            case "type":
                $name = "Type";
                if($value == 1):
                    $value = 'Bulanan';
                else:
                    $value = 'Mingguan';
                endif;
                break;
            
            default:
                "";
        }


        Log::create([
            'op_id' => Session::get('userId'),
            'action_id'   => '2',
            'datetime'        => Carbon::now('GMT+7'),
            'desc' => 'Edit '.$name.' di menu Peringkat Agen dengan Order ID '.$pk.' menjadi '.$value
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
            return redirect()->route('Reseller_Rank')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Reseller_Rank')->with('alert', alertTranslate('Somethong wrong'));  
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
        return view('pages.reseller.transaction.report_transaction', compact('transactions', 'datenow'));
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
          return back()->with('alert', alertTranslation("end date can't be more than start date"));
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
        
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
            } else if ($startDate != NULL && $endDate != NULL) {
                    $transactions =   $reportTransaction->wherebetween('asta_db.store_transaction_hist.action_date', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                      ->orderBy('asta_db.store_transaction_hist.action_date', 'desc')
                                      ->get();

                    return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
        
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
        
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
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
                return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
            } else if ($startDate != NULL && $endDate != NULL) {
                    $transactions =   $reportTransaction->wherebetween('asta_db.store_transaction_hist.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                      ->orderBy('asta_db.store_transaction_hist.datetime', 'desc')
                                      ->get();

                    return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
            }
        }

    }
//------- End Search Report Transaction ------//

//------ Detail Report Transaction ------//
public function detailTransaction(Request $request, $month, $year)
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
    
    $startDate      = Carbon::now('GMT+7')->toDateString();
    $endDate        = Carbon::now('GMT+7')->toDateString();
    
    return view('pages.reseller.transaction.report_transaction', compact('transactions', 'startDate', 'endDate'));
}
//------ End Detail Report Transaction ------//
//****************************************** End Menu Report Transaction ******************************************//



//****************************************** Menu Transaction Day Reseller ******************************************//
//------ Index Transaction Day Reseller --------//
    public function TransactionDayReseller() 
    {
        $datenow = Carbon::now('GMT+7')->toDateString();
        return view('pages.reseller.transaction.transaction_day_reseller', compact('datenow'));
    }
//------ End Index Transaction Day Reseller --------//

// ---- Search TransactionDayReseller -------//
    public function searchTransactionDayReseller(Request $request)
    {
        $time       = $request->choose_time;
        $minDate    = $request->inputMinDate;
        $maxDate    = $request->inputMaxDate;
        $namecolumn = $request->namecolumn;
        $datenow    = Carbon::now('GMT+7')->toDateString(); 
    
        // Sorting table
        if($namecolumn == NULL):
            $namecolumn = 'asta_db.reseller_transaction_day.date_created';
        endif;

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;
        
        if($time == 'Day'):
            $transactionday = ResellerTransactionDay::join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction_day.reseller_id')
                              ->select(
                                  'reseller.username',
                                  'reseller_transaction_day.reseller_id',
                                  'reseller_transaction_day.date_created',
                                  DB::raw('sum(reseller_transaction_day.buy_gold) as buy_gold'),
                                  DB::raw('sum(reseller_transaction_day.buy_amount) as buy_amount'),
                                  DB::raw('sum(reseller_transaction_day.sell_gold) as sell_gold'),
                                  DB::raw('sum(reseller_transaction_day.reward_gold) as reward_gold'),
                                  DB::raw('sum(reseller_transaction_day.correction_gold) as correction_gold'),
                                  DB::raw('max(date(reseller_transaction_day.date_created)) As maxDate'),
                                  DB::raw('min(date(reseller_transaction_day.date_created)) As minDate'),
                                  DB::raw(' YEARWEEK(reseller_transaction_day.date_created) As yearperweek')
                              );
            if($minDate != NULL && $maxDate != NULL):
                $history = $transactionday->whereBetween('reseller_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('DATE(reseller_transaction_day.date_created)'))
                           ->paginate(20);
            elseif($minDate != NULL):
                $history = $transactionday->where('reseller_transaction_day.date_created', '>=', $minDate)
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('DATE(reseller_transaction_day.date_created)'))
                           ->paginate(20);
            elseif($maxDate != NULL):
                $history = $transactionday->where('reseller_transaction_day.date_created', '<=', $maxDate)
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('DATE(reseller_transaction_day.date_created)'))
                           ->paginate(20);
            else:
                $history = $transactionday->groupBy(DB::raw('DATE(reseller_transaction_day.date_created)'))
                           ->paginate(20);
            endif;

            return view('pages.reseller.transaction.transaction_day_reseller', compact('history', 'time', 'minDate', 'maxDate', 'sortingorder', 'namecolumn'));
        elseif($time == 'Week'):
            $transactionday = ResellerTransactionDay::join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction_day.reseller_id')
                              ->select(
                                  'reseller.username',
                                  'reseller_transaction_day.reseller_id',
                                  'reseller_transaction_day.date_created',
                                  DB::raw('sum(reseller_transaction_day.buy_gold) as buy_gold'),
                                  DB::raw('sum(reseller_transaction_day.buy_amount) as buy_amount'),
                                  DB::raw('sum(reseller_transaction_day.sell_gold) as sell_gold'),
                                  DB::raw('sum(reseller_transaction_day.reward_gold) as reward_gold'),
                                  DB::raw('sum(reseller_transaction_day.correction_gold) as correction_gold'),
                                  DB::raw('max(date(reseller_transaction_day.date_created)) As maxDate'),
                                  DB::raw('min(date(reseller_transaction_day.date_created)) As minDate'),
                                  DB::raw(' YEARWEEK(reseller_transaction_day.date_created) As yearperweek')
                              );
            if($minDate != NULL && $maxDate != NULL):
                $history = $transactionday->whereBetween('reseller_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('YEARWEEK(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            elseif($minDate != NULL):
                $history = $transactionday->where('reseller_transaction_day.date_created', '>=', $minDate)
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('YEARWEEK(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            elseif($maxDate != NULL):
                $history = $transactionday->where('reseller_transaction_day.date_created', '<=', $maxDate)
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('YEARWEEK(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            else:
                $history = $transactionday->groupBy(DB::raw('YEARWEEK(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            endif;

            return view('pages.reseller.transaction.transaction_day_reseller', compact('history', 'time', 'minDate', 'maxDate', 'sortingorder', 'namecolumn'));
        elseif($time == 'Month'):
            $transactionday = ResellerTransactionDay::join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction_day.reseller_id')
                              ->select(
                                  'reseller.username',
                                  'reseller_transaction_day.reseller_id',
                                  'reseller_transaction_day.date_created',
                                  DB::raw('sum(reseller_transaction_day.buy_gold) as buy_gold'),
                                  DB::raw('sum(reseller_transaction_day.buy_amount) as buy_amount'),
                                  DB::raw('sum(reseller_transaction_day.sell_gold) as sell_gold'),
                                  DB::raw('sum(reseller_transaction_day.reward_gold) as reward_gold'),
                                  DB::raw('sum(reseller_transaction_day.correction_gold) as correction_gold'),
                                  DB::raw('max(date(reseller_transaction_day.date_created)) As maxDate'),
                                  DB::raw('min(date(reseller_transaction_day.date_created)) As minDate'),
                                  DB::raw(' YEARWEEK(reseller_transaction_day.date_created) As yearperweek')
                              );
            if($minDate != NULL && $maxDate != NULL):
                $history = $transactionday->whereBetween('reseller_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('month(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            elseif($minDate != NULL):
                $history = $transactionday->where('reseller_transaction_day.date_created', '>=', $minDate)
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('month(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            elseif($maxDate != NULL):
                $history = $transactionday->where('reseller_transaction_day.date_created', '<=', $maxDate)
                           ->orderBy($namecolumn, $sortingorder)
				           ->groupBy(DB::raw('month(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            else:
                $history = $transactionday->groupBy(DB::raw('month(asta_db.reseller_transaction_day.date_created)'), DB::raw("WEEK('asta_db.reseller_transaction_day.date_created')"))
                           ->paginate(20);
            endif;

            return view('pages.reseller.transaction.transaction_day_reseller', compact('history', 'time', 'minDate', 'maxDate', 'sortingorder', 'namecolumn'));
        elseif($time == 'All time'):
            $transactionday = ResellerTransactionDay::join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction_day.reseller_id')
                              ->select(
                                  'reseller.username',
                                  'reseller_transaction_day.reseller_id',
                                  'reseller_transaction_day.buy_gold as buy_gold',
                                  'reseller_transaction_day.buy_amount as buy_amount',
                                  'reseller_transaction_day.sell_gold as sell_gold',
                                  'reseller_transaction_day.reward_gold as reward_gold',
                                  'reseller_transaction_day.correction_gold as correction_gold',
                                  'reseller_transaction_day.date_created'
                              );
            if($minDate != NULL && $maxDate != NULL):
                $history =  $transactionday->whereBetween('reseller_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);
            elseif($minDate != NULL):
                $history =  $transactionday->where('reseller_transaction_day.date_created', '>=', $minDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);
            elseif($maxDate != NULL):
                $history =  $transactionday->where('reseller_transaction_day.date_created', '<=', $maxDate)
                            ->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);
            else:
                $history =  $transactionday->orderBy($namecolumn, $sortingorder)
                            ->paginate(20);
            endif;
             return view('pages.reseller.transaction.transaction_day_reseller', compact('history', 'time', 'minDate', 'maxDate', 'sortingorder', 'namecolumn'));
        endif;
    }
// ---- End Search TransactionDayReseller -------//

// ---- Detail Transaction Day Reseller ------//
    public function detailTransactionDayReseller(Request $request)
    {
        
        $minDate    = $request->inputMaxDate;
        $maxDate    = $request->inputMaxDate;
        $namecolumn = $request->namecolumn;
        $datenow    = Carbon::now('GMT+7');
        
        // Sorting table
        if($namecolumn == NULL):
            $namecolumn = 'reseller_transaction_day.date_created';
        endif;

        if(Input::get('sorting') === 'asc'):
            $sortingorder = 'desc';
        else:
            $sortingorder = 'asc';
        endif;
        $datenow = 

        $history = ResellerTransactionDay::join('reseller', 'reseller.reseller_id', '=', 'reseller_transaction_day.reseller_id')
                        ->select(
                            'reseller.username',
                            'reseller_transaction_day.reseller_id',
                            'reseller_transaction_day.buy_gold as buy_gold',
                            'reseller_transaction_day.buy_amount as buy_amount',
                            'reseller_transaction_day.sell_gold as sell_gold',
                            'reseller_transaction_day.reward_gold as reward_gold',
                            'reseller_transaction_day.correction_gold as correction_gold',
                            'reseller_transaction_day.date_created'
                        )
                        ->whereBetween('reseller_transaction_day.date_created', [$minDate.' 00:00:00', $maxDate.' 23:59:59'])
                        ->orderBy($namecolumn, $sortingorder)
                        ->paginate(20);
       
        $time      = "Detail";


        return view('pages.reseller.transaction.transaction_day_reseller', compact('history', 'minDate', 'maxDate', 'time', 'sortingorder', 'namecolumn', 'datenow'));

    }
// ---- End Detail Transaction Day Reseller ------//
//****************************************** Menu Transaction Day Reseller ******************************************//




//****************************************** Add Transaction Reseller ******************************************//
//------ Index Add Transaction Reseller --------//
    public function AddTransactionReseller() 
    {
        return view('pages.reseller.transaction.add_transaction_reseller');
    }
//------ End Index Transaction Day Reseller --------//

// ---- Search Add Transaction Reseller -------//
    public function searchAddTransactionReseller(Request $request)
    {
        $searhUser   = $request->inputPlayer;
        $sorting     = $request->sorting;
        $namecolumn  = $request->namecolumn;
        $getUsername = Input::get('inputPlayer');
        $menu        = MenuClass::menuName('Transaction');
        $mainmenu    = MenuClass::menuName('Add Transaction');

        //Sorting
        if($sorting == NULL): 
          $sorting = 'desc';
        endif;
        
        //Column name 
        if($namecolumn == NULL):
          $namecolumn = 'asta_db.reseller.reseller_id';
        endif;

        // for sorting data
        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;

        // query database
        $currency_agen = Reseller::orderby($namecolumn, $sorting);


        // search with username or user id
        if($searhUser == NULL):
            $add_transaction = $currency_agen->paginate(20); 
        elseif(!is_numeric($searhUser)):
            $add_transaction = $currency_agen->where('asta_db.reseller.username', '=', $searhUser)
                               ->paginate(20); 
        elseif(is_numeric($searhUser)):
            $add_transaction = $currency_agen->where('asta_db.reseller.reseller_id', '=', $searhUser)
                               ->paginate(20);             
        endif;

        // for action name
        $action       = ConfigText::select(
                          'name',
                          'value'
                        ) 
                        ->where('id', '=', 11)
                        ->first();

        $value          = str_replace(':', ',', $action->value);
        $actionbalance  = explode(",", $value);
        $actblnc = [
          $actionbalance[10] => $actionbalance[11],
          $actionbalance[12] => $actionbalance[13],
          $actionbalance[20] => $actionbalance[21],
          $actionbalance[22] => $actionbalance[23]
        ];  

        $add_transaction->appends($request->all());

        return view('pages.reseller.transaction.add_transaction_reseller', compact('add_transaction', 'getUsername', 'sortingorder', 'actblnc', 'menu', 'mainmenu'));
    }
// ---- End Search Add Transaction Reseller -------//

// --- UpdateGold Reseller ----//
    public function UpdateGoldReseller(Request $request)
    {
        $agen_id       = $request->agen_id;
        $columnname    = $request->columnname;
        $valuecurrency = $request->currency;
        $type          = $request->type;
        $plusminus     = $request->operator_aritmatika;
        $description   = $request->description;
        
        $resellertransactionday = ResellerTransactionDay::where('reseller_id', '=', $agen_id)
                                  ->where('date', '=', Carbon::now('GMT+7')->toDateString())
                                  ->first();
        $goldreseller = Reseller::where('reseller_id', '=', $agen_id)->first();

        // untuk type bonus atau free
        if($type == 6 || $type == 7):

            // ----- untuk validasi jika angka input lebih besar dari angka di gold database untuk pengurangan ----//
            if($valuecurrency < 0):
                return back()->with('alert', alertTranslate('For type Bonus or Free number not alllowed negative number'));
            endif;

            $totalbalance = $goldreseller->gold + $valuecurrency;
            ResellerBalance::create([
                'reseller_id'   =>  $agen_id,
                'action_id'     =>  $type,
                'debet'         =>  $valuecurrency,
                'credit'        =>  0,
                'balance'       =>  $totalbalance,
                'datetime'      =>  Carbon::now('GMT+7')
            ]);

            Reseller::where('reseller_id', '=', $agen_id )->update([
                'gold' => $totalbalance
            ]);

            //---------- untuk yg insert ke table reseller_transaction_day ------------//
            if($resellertransactionday):
                $totalrewardgold =  $resellertransactionday->reward_gold + $valuecurrency;
                ResellerTransactionDay::where('reseller_id', '=', $agen_id)->update([
                    'date'            => Carbon::now('GMT+7')->toDateString(),
                    'date_created'    => Carbon::now('GMT+7'),
                    'reward_gold'     => $totalrewardgold
                ]);
            else:
                ResellerTransactionDay::create([
                    'date'         => Carbon::now('GMT+7')->toDateString(),
                    'date_created' => Carbon::now('GMT+7'),
                    'reseller_id'  => $agen_id,
                    'reward_gold'  => $valuecurrency,
                ]);
            endif;

            Log::create([
                'op_id'     =>  Session::get('userId'),
                'action_id' =>  '2',
                'datetime'  =>  Carbon::now('GMT+7'),
                'desc'      =>  'Edit balance KOIN dengan Agen ID ' .$agen_id. ' jumlah yang ditambahkan dengan '.$valuecurrency. ' koin. Dengan alasan: ' .$description
            ]);



        //---------- untuk type Adjust --------//
        elseif($type == 12 ):

            // ---- Validasi untuk angka tidak diperbolehkan negatif -----//
            if($valuecurrency < 0):
                return back()->with('alert', alertTranslate('For Type Adjust number didnot allowed negative'));
            endif;
            $totalbalance = $valuecurrency;
            $resellertransactionday = ResellerTransactionDay::where('reseller_id', '=', $agen_id)
                                  ->where('date', '=', Carbon::now('GMT+7')->toDateString())
                                  ->first();
            $goldreseller = Reseller::where('reseller_id', '=', $agen_id)->first();
           
            //--- UNTUK BALANCE ---//
            // --untuk yang valu currency lebih besar dri gold
            if($valuecurrency > $goldreseller->gold):
                $balancegoldtotal = $valuecurrency - $goldreseller->gold;
                $opmath = "ditambahkan dengan";
                ResellerBalance::create([
                    'reseller_id'   =>  $agen_id,
                    'action_id'     =>  $type,
                    'debet'         =>  $balancegoldtotal,
                    'credit'        =>  0,
                    'balance'       =>  $valuecurrency,
                    'datetime'      =>  Carbon::now('GMT+7')
                ]);
            elseif($valuecurrency < $goldreseller->gold):
                $balancegoldtotal = $goldreseller->gold - $valuecurrency;
                $opmath = "dikurangkan dengan";
                ResellerBalance::create([
                    'reseller_id'   =>  $agen_id,
                    'action_id'     =>  $type,
                    'debet'         =>  0,
                    'credit'        =>  $balancegoldtotal,
                    'balance'       =>  $valuecurrency,
                    'datetime'      =>  Carbon::now('GMT+7')
                ]);
            elseif($valuecurrency == $goldreseller->gold):
                $opmath = "sama dengan";
                ResellerBalance::create([
                    'reseller_id'   =>  $agen_id,
                    'action_id'     =>  $type,
                    'debet'         =>  0,
                    'credit'        =>  0,
                    'balance'       =>  $valuecurrency,
                    'datetime'      =>  Carbon::now('GMT+7')
                ]);
            endif;

            if($resellertransactionday):
                $totaltransaction_day = $resellertransactionday->correction_gold + $valuecurrency;
                ResellerTransactionDay::where('reseller_id', '=', $agen_id)->update([
                    'date'            => Carbon::now('GMT+7'),
                    'date_created'    => Carbon::now('GMT+7')->toDateString(),
                    'correction_gold' => $totaltransaction_day 
                ]);
            else:
                ResellerTransactionDay::create([
                    'date'            => Carbon::now('GMT+7'),
                    'reseller_id'     => $agen_id,
                    'correction_gold' => $valuecurrency,
                    'date_created'    => Carbon::now('GMT+7')->toDateString()                    
                ]);
            endif;

            // ----UNTUK UPDATE GOLD ----//
            Reseller::where('reseller_id', '=', $agen_id )->update([
                'gold' => $valuecurrency
            ]);

            Log::create([
                'op_id'     =>  Session::get('userId'),
                'action_id' =>  '2',
                'datetime'  =>  Carbon::now('GMT+7'),
                'desc'      =>  'Edit balance KOIN dengan Agen ID ' .$agen_id. ' jumlah yang '.$opmath.' '.$balancegoldtotal. ' koin. Dengan alasan: ' .$description
            ]);

        //---------- untuk type Correction --------//
        elseif($type == 11):

            // ----- untuk validasi jika angka input lebih besar dari angka di gold database untuk pengurangan ----//
            $angka = str_replace("-", "", $valuecurrency);
            // dd($angka);
            if($valuecurrency < 0):
                if($goldreseller->gold < $angka):
                    return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
                endif;
            endif;


            //--------------- untuk menambahkan gold reseller ------------------// 
            $totalbalance = $goldreseller->gold + $valuecurrency;
            Reseller::where('reseller_id', '=', $agen_id )->update([
                'gold' => $totalbalance
            ]);

            //---------- untuk yg insert ke table reseller_transaction_day ------------//
            if($resellertransactionday):
                $tota_correctiongold = $resellertransactionday->correction_gold + $valuecurrency;
                ResellerTransactionDay::where('reseller_id', '=', $agen_id)->update([
                    'date'            => Carbon::now('GMT+7')->toDateString(),
                    'date_created'    => Carbon::now('GMT+7'),
                    'correction_gold' => $tota_correctiongold
                ]);
            else:
                ResellerTransactionDay::create([
                    'date'            => Carbon::now('GMT+7')->toDateString(),
                    'date_created'    => Carbon::now('GMT+7'),
                    'reseller_id'     => $agen_id,
                    'correction_gold' => $valuecurrency
                ]);
            endif;

            // ------ untuk insert ke balance reseller -----//
            if($valuecurrency > 0):
                ResellerBalance::create([
                    'reseller_id'   =>  $agen_id,
                    'action_id'     =>  $type,
                    'debet'         =>  $valuecurrency,
                    'credit'        =>  0,
                    'balance'       =>  $totalbalance,
                    'datetime'      =>  Carbon::now('GMT+7')
                ]);

                // ---- untuk keterangan di log admin -----//
                $opmath = 'ditambahkan dengan';
            elseif($valuecurrency < 0):
                $replaceminus = str_replace('-', '', $valuecurrency);
                ResellerBalance::create([
                    'reseller_id'   =>  $agen_id,
                    'action_id'     =>  $type,
                    'debet'         =>  0,
                    'credit'        =>  $replaceminus,
                    'balance'       =>  $totalbalance,
                    'datetime'      =>  Carbon::now('GMT+7')
                ]);

                // ---- untuk keterangan di log admin -----//
                $opmath = 'dikurangkan dengan';
            endif;
            
            Log::create([
                'op_id'     =>  Session::get('userId'),
                'action_id' =>  '2',
                'datetime'  =>  Carbon::now('GMT+7'),
                'desc'      =>  'Edit balance KOIN dengan Agen ID ' .$agen_id. ' jumlah yang '.$opmath.' '.$valuecurrency. ' koin. Dengan alasan: ' .$description
            ]);
        endif;

        return back()->with('success', alertTranslate('Successful update'));
    }
// --- End UpdateGold Reseller ----//


//****************************************** Add Transaction Reseller ******************************************//



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
                                'asta_db.reseller_balance.action_id'
                             )
                             ->JOIN('asta_db.reseller', 'asta_db.reseller_balance.reseller_id', '=', 'asta_db.reseller.reseller_id');
        $action  = ConfigText::select(
                        'name',
                        'value'
                    ) 
                    ->where('id', '=', 11)
                    ->first();
        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
            $actionbalance[0]  => $actionbalance[1],
            $actionbalance[2]  => $actionbalance[3],
            $actionbalance[4]  => $actionbalance[5],
            $actionbalance[6]  => $actionbalance[7],
            $actionbalance[8]  => $actionbalance[9],
            $actionbalance[10] => $actionbalance[11],
            $actionbalance[12] => $actionbalance[13],
            $actionbalance[14] => $actionbalance[15],
            $actionbalance[16] => $actionbalance[17],
            $actionbalance[18] => $actionbalance[19],
            $actionbalance[20] => $actionbalance[21],
            $actionbalance[22] => $actionbalance[23],
        ];
      if($endDateComparison < $startDateComparison){
        return back()->with('alert', alertTranslate("end date can't be less than start date"));
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

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'startDate', 'endDate', 'actblnc'));

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

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'startDate', 'endDate', 'actblnc'));

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

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'startDate', 'endDate', 'actblnc'));
      }else if($searchUsername != NULL) {

        if(is_numeric($searchUsername) !== true):
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.username', 'LIKE', '%'.$searchUsername.'%')
                              ->get();
        else:
            $balancedetails = $balanceReseller->WHERE('asta_db.reseller.reseller_id', '=', $searchUsername)
                              ->get();
        endif;

        return view('pages.reseller.balance_reseller', compact('balancedetails', 'startDate', 'endDate', 'actblnc'));
      } else if ($startDate != NULL && $endDate != NULL) {
          $balancedetails = $balanceReseller->wherebetween('asta_db.reseller_balance.datetime', [$startDate." 00:00:00", $endDate." 23:59:59"])
                                            ->orderBy('asta_db.reseller_balance.datetime', 'asc')
                                            ->get();
                                            
        return view('pages.reseller.balance_reseller', compact('balancedetails', 'startDate', 'endDate', 'actblnc'));
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
            'desc'      => 'Menambahkan di menu Pendaftaran Agen dengan nama pengguna '. $request->username
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
        return view('pages.reseller.transaction.request_transaction', compact('item_gold', 'item_cash', 'item_point', 'transactions', 'menu', 'mainmenu', 'submenu'));
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

          return back()->with('success', alertTranslate("Approved Succesful"));
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
        return back()->with('success', alertTranslate("Declined Succesful"));
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
                        'bonus_type',
                        'bonus_get',
                        'status',
                        'shop_type'
                    )
                    ->where('shop_type', '=', 2)
                    ->where('status', '!=', 2)
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
        $bonusType = ConfigText::select(
                        'name',
                        'value'
                    )
                    ->where('id', '=', 5)
                    ->first();
        $valueBonus= str_replace(':', ',', $bonusType->value);
        $bontype  = explode(",", $valueBonus);
        $timenow   = Carbon::now('GMT+7');
        return view('pages.reseller.item_store_reseller', compact('getItems', 'menu', 'endis', 'mainmenu', 'item', 'timenow', 'bontype'));
    }
// ------- End index Item Store Reseller -------- //

// ------- Insert Item Store Reseller -------- //
    public function ItemResellerstore(Request $request)
    {

        $title          = $request->title;
        $goldAwarded    = $request->goldAwarded;
        $priceCash      = $request->priceCash;
        $googleKey      = $request->googleKey;
        $order          = $request->order;

        $validator = Validator::make($request->all(),[
            'title'       => 'required',
            'goldAwarded' => 'required|integer',
            'priceCash'   => 'required|integer',
            'googleKey'   => 'required',
            'order'       => 'required|integer',
            'file'        => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $id = ItemsCash::select('item_id')
              ->orderBy('item_id', 'desc')
              ->first();
        
        if($id === NULL )
        {
            $id_lst = 0;
        } else {
            $id_lst = $id->item_id;
        }
        
          $id_new                 = $id_lst + 1;
          $file                   = $request->file('file');
          $file_wtr               = $request->file('file1');
          $filebonus              = $request->file('filebonus');
          $ekstensi_diperbolehkan = array('png');
          $nama                   = $_FILES['file']['name'];
          $nama_wtr               = $_FILES['file1']['name'];
          $namafilebonus          = $_FILES['filebonus']['name'];
          $x                      = explode('.', $nama);
          $x_wtr                  = explode('.', $nama_wtr);
          $x_bonus                = explode('.', $namafilebonus);
          $ekstensi               = strtolower(end($x));
          $ekstensi_wtr           = strtolower(end($x_wtr));
          $ekstensi_bonus         = strtolower(end($x_bonus));
          $ukuran                 = $_FILES['file']['size'];
          $nama_file_unik         = $id_new.'.'.$ekstensi;
          $imageBonusname         = $id_new.'-2.'.$ekstensi_bonus;
        list($width, $height)                     = getimagesize($file);
       
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 5242880)
            {
                if($file_wtr && in_array($ekstensi_wtr, $ekstensi_diperbolehkan) === true)
                {
                    list($width_watermark, $height_watermark) = getimagesize($file_wtr);
                    // watermark image
                    // Menetapkan nama thumbnail
                    $folder = "../public/upload/Gold/";
                    $thumbnail = $folder.$nama_file_unik;


                    // Memuat gambar utama
                    $rootpath_main      =   '../public/upload/Gold/image1/';
                    $upload_imagemain   =   '../public/upload/Gold/image1';
                    $mainimage          =   Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_main       =   $mainimage->put($nama_file_unik, file_get_contents($file));
                    $source             =   imagecreatefrompng($rootpath_main.$nama_file_unik);
                    // $source = imagecreatefrompng($file->move(public_path('../public/upload/Gold/image1'), $nama_file_unik));
                    
                    // Memuat gambar watermark
                    $rootpath_wtr       =   '../public/upload/Gold/image2/';
                    $upload_imagewtr    =   '../public/upload/Gold/image2';
                    $watermarkimage     =   Storage::createLocalDriver(['root' => $upload_imagemain ]);
                    $putfile_wtr        =   $watermarkimage->put($nama_file_unik, file_get_contents($file_wtr));
                    $watermark          =   imagecreatefrompng($file_wtr->move(public_path('../public/upload/Gold/image2'), $nama_file_unik));
                    //$watermark = imagecreatefrompng($file_wtr->move(public_path('../public/upload/Gold/image2'), $nama_file_unik));

                    // mendapatkan lebar dan tinggi dari gambar watermark
                    $water_width    = imagesx($watermark);
                    $water_height   = imagesy($watermark);

                    // mendapatkan lebar dan tinggi dari gambar utama
                    $main_width     = imagesx($source);
                    $main_height    = imagesy($source);

                    // Menetapkan posisi gambar watermark
                    $pos_x = $width  - $width_watermark;
                    $pos_y = $height - $height_watermark;
                    imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    imagealphablending($source, false);
                    imagesavealpha($source, true);
                    imagecolortransparent($source); 

                    $temp       = image_data($source);
                    $awsPath    = "unity-asset/store/gold/".$nama_file_unik;
                    $merge      = imagecopy($source, $watermark, $pos_x, 0, 0, 0, $width_watermark, $height_watermark);
                    
                    Storage::disk('s3')->put($awsPath, $temp);
            
                    $path   =   '../public/upload/Gold/image1/'.$nama_file_unik;
                    File::delete($path);
                    $path1  =   '../public/upload/Gold/image2/'.$nama_file_unik;
                    File::delete($path1);

                   
                } else {
                    // $file->move(public_path('unity-asset/store/gold'), $nama_file_unik);
                    $rootpath = 'unity-asset/store/gold/'.$nama_file_unik;
                    $img_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));

                }

                //UPLOAD IMAGE BONUS TO AWS
                if($filebonus):
                    $awsPath = 'unity-asset/store/gold/' . $imageBonusname;
                    Storage::disk('s3')->put($awsPath, file_get_contents($filebonus));
                endif;
                
                          
                $gold = ItemsCash::create([
                    'order'      => $order,
                    'name'       => $title,
                    'item_get'   => $goldAwarded,
                    'price'      => $priceCash,
                    'bonus_get'  => $request->itemAwarded,
                    'bonus_type' => $request->BonusType,
                    'shop_type'  => 2,
                    'status'     => $request->status_item,
                    'item_type'  => 2,
                    'google_key' => $googleKey,
                ]);
        
                Log::create([
                    'op_id'     => Session::get('userId'),
                    'action_id' => '3',
                    'datetime'  => Carbon::now('GMT+7'),
                    'desc'      => 'Menambahkan data di menu Toko Agen dengan judul '. $request->title
                ]);
                return redirect()->route('Item_Store_Reseller')->with('success', alertTranslate('Data added'));                 
            }
            else
            {
                return redirect()->route('Item_Store_Reseller')->with('alert', alertTranslate('File size too large'));
                // echo 'Ukuran file terlalu besar';
            }
        }
        else
        {
            return redirect()->route('Item_Store_Reseller')->with('alert', alertTranslate("File extensions are not allowed"));
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
        //  return response()->json($pk, 400);

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
            case "bonus_type":
                $name = "Item Bonus";
                if($value == 1):
                    $value = 'chip';
                elseif($value == 2):
                    $value = 'Koin';
                elseif($value == 3):
                    $value = 'Barang';
                endif;

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
                    
                }
                else 
                {
                    $rootpath = 'unity-asset/store/gold/' .$nama_file_unik;
                    Storage::disk('s3')->put($rootpath, file_get_contents($file));
                    
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


// ------ Update image bonus ------//
    public function updateImageBonusitemstoreresller(Request $request){
        
        $validator = Validator::make($request->all(),[
            'fileImageBonus'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $pk                     = $request->pk;
        $fileBonus              = $request->file('fileImageBonus');
        $ekstensi_diperbolehkan = array('png');
        $namaImageBonus         = $_FILES['fileImageBonus']['name'];
        $xBonus                 = explode('.', $namaImageBonus);
        $ekstensiBonus          = strtolower(end($xBonus));
        $ukuran                 = $_FILES['fileImageBonus']['size'];
        $finalname              = $pk.'-2.'.$ekstensiBonus;


        if(in_array($ekstensiBonus, $ekstensi_diperbolehkan) === true)
        {   
            
            $awsPath   = '/unity-asset/store/gold/'.$finalname;
            Storage::disk('s3')->put($awsPath, file_get_contents($fileBonus));

            //RECORD LOG
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '2',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Edit gambar bonus di menu Toko Item Agen dengan ID '.$pk.' menjadi '.$finalname
            ]);
            
            return redirect()->route('Item_Store_Reseller')->with('success','Update Image Successfull');
        } else {
            return redirect()->route('Item_Store_Reseller')->with('alert','Image must be in png format');
        }


    }
// ------ end update image bonus -------//



// ------- Delete Item Store Reseller -------- //
    public function destroyItemStoreReseller(Request $request)
    {
        $getItemId    = $request->userid;
        $pathS3       = 'unity-asset/store/gold/'.$getItemId.'.png';
        $pathS3_bonus = 'unity-asset/store/gold/'.$getItemId.'.png';

        if($getItemId  != '') 
        {
            ItemsCash::where('item_id', '=', $getItemId)->update([
                'status'    =>  2
            ]);

            Storage::disk('s3')->delete([$pathS3, $pathS3_bonus]);
        
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
        $ids      =   $request->userIdAll;
        $imageid  =   $request->imageid;
        $imgIdBonus =   $request->imageidBonus;
        
        //DELETE
        Storage::disk('s3')->delete(explode(",", $imageid));  
        Storage::disk('s3')->delete(explode(",", $imgIdBonus));      
        DB::table('asta_db.item_cash')->whereIn('item_id', explode(",", $ids))->update([
            'status'    =>  2   
        ]);
        
        //RECORD LOG
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Daftar Agen dengan AgenID '.$ids
        ]);
        return redirect()->route('Item_Store_Reseller')->with('success', 'Data deleted');
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
