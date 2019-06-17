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
        //
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

        return redirect()->route('ResellerRank-view')->with('success','Data Added');
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

            return redirect()->route('ListReseller-view')->with('success','Reset Password Successfully');
        }
        return redirect()->route('ListReseller-view')->with('alert','Password is Null');
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
            return redirect()->route('ListReseller-view')->with('success','Data Deleted');
        }
        return redirect()->route('ListReseller-view')->with('success','Somethong wrong');                
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
            return redirect()->route('ResellerRank-view')->with('success','Data Deleted');
        }
        return redirect()->route('ResellerRank-view')->with('success','Somethong wrong');  
    }
}
