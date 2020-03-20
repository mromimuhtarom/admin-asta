<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Game;
use App\DominoQTable;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ------ store transaction history ------//
        $store_transaction_all = DB::table('store_transaction_hist')->where('shop_type', '=', 1)->get();

        // -------- untuk chip store -------//
        $store_transaction_chip = DB::table('store_transaction_hist')->where('item_type', '=', 1)->where('shop_type', '=', 1)->get();
        $roundcirclechip        = 2 * 40 * pi();
        $percentchip            = count($store_transaction_chip)/count($store_transaction_all)*100;
        $percentagechipdraw     = $roundcirclechip * $percentchip /100;
        $counttotalchip         = count($store_transaction_chip);
        // -------- end untuk chip store -------//

        // ------- untuk gold store ------//
        $store_transaction_gold = DB::table('store_transaction_hist')->where('item_type', '=', 2)->where('shop_type', '=', 1)->get();
        $roundcirclegold        = 2 * 30 * pi();
        $percentgold            = count($store_transaction_gold)/count($store_transaction_all)*100;
        $percentagegolddraw     = $roundcirclegold * $percentgold /100;
        $counttotalgold         = count($store_transaction_gold);
        // ------- end untuk gold store ------//

        // ------- untuk point store ------//
        $store_transaction_point = DB::table('store_transaction_hist')->where('item_type', '=', 3)->where('shop_type', '=', 1)->get();
        $roundcirclepoint        = 2 * 20 * pi();
        $percentpoint            = count($store_transaction_point)/count($store_transaction_all)*100;
        $percentagepointdraw     = $roundcirclepoint * $percentpoint /100;
        $counttotalpoint         = count($store_transaction_point);
        // ------- end untuk point store ------//
        // ------ end store transaction history ------//


        // ------ store transaction Request ------//
        $store_transaction_request_all = DB::table('store_transaction')->where('shop_type', '=', 1)->get();

        // -------- untuk chip store -------//
        $store_transaction_chip_request = DB::table('store_transaction')->where('item_type', '=', 1)->where('shop_type', '=', 1)->get();
        $roundcirclechip_request        = 2 * 40 * pi();
        $percentchip_request            = count($store_transaction_chip_request)/count($store_transaction_request_all)*100;
        $percentagechipdraw_request     = $roundcirclechip_request * $percentchip_request /100;
        $counttotalchip_request         = count($store_transaction_chip_request);
        // -------- end untuk chip store -------//

        // ------- untuk gold store ------//
        $store_transaction_gold_request = DB::table('store_transaction')->where('item_type', '=', 2)->where('shop_type', '=', 1)->get();
        $roundcirclegold_request        = 2 * 30 * pi();
        $percentgold_request            = count($store_transaction_gold)/count($store_transaction_request_all)*100;
        $percentagegolddraw_request     = $roundcirclegold_request * $percentgold_request /100;
        $counttotalgold_request         = count($store_transaction_gold_request);
        // ------- end untuk gold store ------//

        // ------- untuk point store ------//
        $store_transaction_point_request = DB::table('store_transaction')->where('item_type', '=', 3)->where('shop_type', '=', 1)->get();
        $roundcirclepoint_request        = 2 * 20 * pi();
        $percentpoint_request            = count($store_transaction_point_request)/count($store_transaction_request_all)*100;
        $percentagepointdraw_request     = $roundcirclepoint_request * $percentpoint_request /100;
        $counttotalpoint_request         = count($store_transaction_point_request);
        // ------- end untuk point store ------//
        // ------ end store transaction Request------//

        //--- untuk yg telah mendaftar jadi player atau guest ---//
        $registered      = DB::table('user')->where('user_type', '=', 1)->orWhere('user_type', '=', 2)->get();
        $countregistered = count($registered);
        //--- untuk yg telah mendaftar jadi player atau guest ---//
        //---- untuk guset yg telah daftar ---- //
        $guest      = DB::table('user')->where('user_type', '=', 2)->get();
        $countguest = count($guest);
        //---- end untuk guset yg telah daftar ---- //
        //---- untuk yang online ---- //
        $online      = DB::table('user_active')->where('table_id', '!=', 0)->where('game_id', '!=', 0)->get();
        $countonline = count($online);
        //---- end untuk yang online ---- //



        $gameName =     Game::all();
        $rooms    =     DominoQTable::join('asta_db.dmq_room', 'dmq_room.room_id', '=', 'dmq_table.room_id')
                        ->select(DB::raw('count("asta_db.dmq_table.room_id") as room_id'), 'asta_db.dmq_room.name as harga')
                        ->groupBy('asta_db.dmq_table.room_id')->get();
                        
        return view('pages.dashboard.home', compact('gameName', 'rooms', 'percentagechipdraw', 
        'percentagegolddraw', 'percentagepointdraw', 'counttotalchip', 'counttotalgold', 
        'counttotalpoint', 'percentagechipdraw_request', 'percentagegolddraw_request', 
        'percentagepointdraw_request', 'counttotalchip_request', 'counttotalgold_request', 
        'counttotalpoint_request', 'countregistered', 'countguest', 'countonline'));
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
