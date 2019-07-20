<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Classes\MenucLass;

class User_Banking_TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu          = MenuClass::menuName('User Bank Transaction');
        $mainmenu       = MenuClass::menuName('Transaction');
        $rewardRequest = DB::select('SELECT reward_transaction.*, user.avatar, reward_item.name as reward_name,user.username, operator.username as operator FROM reward_transaction JOIN user ON user.user_id = reward_transaction.user_id JOIN reward_item ON reward_item.id = reward_transaction.item_id LEFT JOIN operator ON reward_transaction.user_Id = operator.operator_id');
        $rewardApprove = DB::select('SELECT reward_transaction.*, user.avatar, reward_item.name as reward_name,user.username, operator.username as operator FROM reward_transaction JOIN user ON user.user_id = reward_transaction.user_id JOIN reward_item ON reward_item.id = reward_transaction.item_id LEFT JOIN operator ON reward_transaction.operator_id = operator.operator_id ORDER BY reward_transaction.date_approved DESC');
        return view('pages.transaction.user_bank_transaction', compact('rewardRequest', 'rewardApprove', 'menu', 'mainmenu'));
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
