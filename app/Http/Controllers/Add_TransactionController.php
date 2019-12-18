<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use Illuminate\Support\Facades\Input;
use App\ConfigText;
use App\Stat;
use App\BalanceChip;
use App\BalanceGold;
use App\BalancePoint;
use Carbon\Carbon;

class Add_TransactionController extends Controller
{
    public function index()
    {
        // for action name
        $action       = ConfigText::select(
                          'name',
                          'value'
                        ) 
                        ->where('id', '=', 11)
                        ->first();

        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
          $actionbalance[10] => $actionbalance[11],
          $actionbalance[12] => $actionbalance[13]
        ];
        return view('pages.transaction.add_transaction', compact('actblnc'));
    }

    public function search(Request $request)
    {
        $searhUser   = $request->inputPlayer;
        $sorting     = $request->sorting;
        $namecolumn  = $request->namecolumn;
        $getUsername = Input::get('inputPlayer');


        if($sorting == NULL): 
          $sorting = 'desc';
        endif;
        
        //Column name 
        if($namecolumn == NULL):
          $namecolumn = 'asta_db.user_stat.user_id';
        endif;

        // for sorting data
        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;


        // query database
        $currency_player = Player::join('asta_db.user_stat', 'asta_db.user_stat.user_id', '=', 'asta_db.user.user_id')
                           ->select(
                                'asta_db.user.username',
                                'asta_db.user_stat.gold',
                                'asta_db.user_stat.chip',
                                'asta_db.user_stat.point',
                                'asta_db.user_stat.user_id'
                           )
                           ->orderby($namecolumn, $sorting);


        // search with username or user id
        if($searhUser == NULL):
            $add_transaction = $currency_player->paginate(20); 
        elseif(!is_numeric($searhUser)):
            $add_transaction = $currency_player->where('asta_db.user.username', '=', $searhUser)
                               ->paginate(20); 
        elseif(is_numeric($searhUser)):
            $add_transaction = $currency_player->where('asta_db.user_stat.user_id', '=', $searhUser)
                               ->paginate(20);             
        endif;

        // for action name
        $action       = ConfigText::select(
                          'name',
                          'value'
                        ) 
                        ->where('id', '=', 11)
                        ->first();

        $value               = str_replace(':', ',', $action->value);
        $actionbalance       = explode(",", $value);
        $actblnc = [
          $actionbalance[10] => $actionbalance[11],
          $actionbalance[12] => $actionbalance[13]
        ];  

        $add_transaction->appends($request->all());

        return view('pages.transaction.add_transaction', compact('add_transaction', 'getUsername', 'sortingorder', 'actblnc'));
    }

    public function update(Request $request)
    {
      $user_id       = $request->user_id;
      $columnname    = $request->columnname;
      $valuecurrency = $request->currency;
      $type          = $request->type;
      
      $stat = Stat::where('user_id', '=', $user_id)->first();
      


      if($columnname == 'chip'):
        $totalbalance = $stat->chip + $valuecurrency;
        $balance = BalanceChip::create([
            'user_id'   => $user_id,
            'action_id' => $type,
            'game_id'   => 0,
            'debit'     => $valuecurrency,
            'credit'    => 0,
            'balance'   => $totalbalance,
            'datetime'  => Carbon::now('GMT+7')
        ]);
      elseif($columnname == 'gold'):
        $totalbalance = $stat->gold + $valuecurrency;
        $balance = BalanceGold::create([
            'user_id'   => $user_id,
            'action_id' => $type,
            'debit'     => $valuecurrency,
            'credit'    => 0,
            'balance'   => $totalbalance,
            'datetime'  => Carbon::now('GMT+7')
        ]);
      elseif($columnname == 'point'):
        $totalbalance = $stat->point + $valuecurrency;
        $balance = BalancePoint::create([
            'user_id'   => $user_id,
            'game_id'   => 0,
            'action_id' => $type,
            'debit'     => $valuecurrency,
            'credit'    => 0,
            'balance'   => $totalbalance,
            'datetime'  => Carbon::now('GMT+7')
        ]);
      endif;
      Stat::where('user_id', '=', $user_id)->update([
        $columnname => $totalbalance
      ]);


      return back()->with('success', 'Successfull Update');
    } 

}