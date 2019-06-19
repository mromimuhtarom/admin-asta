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
    public function index()
    {
        $menu  = MenuClass::menuName('List Reseller');
        $reseller = Reseller::getAllData();
        return view('pages.reseller.listreseller', compact('menu', 'reseller'));
    }

    public function ResellerRank()
    {
        $rank = DB::table('reseller_rank')->get();
        $menu  = MenuClass::menuName('Reseller Rank');
        return view('pages.reseller.reseller_rank', compact('rank', 'menu'));
    }

    public function ResellerTransaction()
    {
        $transactions = DB::select('SELECT year(timestamp) as year, month(timestamp) as monthnumber,monthname(timestamp) as monthname, sum(gold) as totalgold FROM reseller_history GROUP BY year,monthname');
        return view('pages.reseller.reseller_transaction', compact('transactions'));
    }

    public function BalanceReseller()
    {
        return view('pages.reseller.balance_reseller');
    }

    public function RegisterReseller()
    {
        $menu  = MenuClass::menuName('Register Reseller');
        return view('pages.reseller.register_reseller', compact('menu'));
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
            'operator_id' => Session::get('userId'),
            'menu_id'     => '83',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Register Reseller with username '. $request->username
        ]);
  
        return back()->with('alert','REGISTER SUCCESSFULL');
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
            'operator_id' => Session::get('userId'),
            'menu_id'     => '80',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Reseller Rank with Rank Name '. $rankname
        ]);

        return redirect()->route('Reseller_Rank')->with('success','Data Added');
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
            'operator_id' => Session::get('userId'),
            'menu_id'     => '79',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit'.$name.' Reseller ID '.$pk.' To '.$value
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
                'operator_id' => Session::get('userId'),
                'menu_id'     => '79',
                'action_id'   => '1',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Edit password ResellerId '.$pk.' to '. $password
            ]);

            return redirect()->route('List_Reseller')->with('success','Reset Password Successfully');
        }
        return redirect()->route('List_Reseller')->with('alert','Password is Null');
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
            'operator_id' => Session::get('userId'),
            'menu_id'     => '80',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit'.$name.' Reseller Rank Order ID '.$pk.' To '.$value
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
        $userid = $request->id;
        if($userid != '')
        {
            DB::table('reseller')->where('id', '=', $userid)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '79',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete reseller with reseller ID '.$userid
            ]);
            return redirect()->route('List_Reseller')->with('success','Data Deleted');
        }
        return redirect()->route('List_Reseller')->with('success','Somethong wrong');                
    }


    public function destroyRank(Request $request)
    {
        $id = $request->id;
        if($id != '')
        {
            DB::table('reseller_rank')->where('order_id', '=', $id)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '80',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Reseller Rank with reseller ID '.$id
            ]);
            return redirect()->route('Reseller_Rank')->with('success','Data Deleted');
        }
        return redirect()->route('Reseller_Rank')->with('success','Somethong wrong');  
    }
}
