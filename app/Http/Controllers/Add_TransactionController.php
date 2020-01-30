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
use App\Log;
use Session;
use Validator;
use App\Classes\MenuClass;
use App\StoreTransactionDay;

class Add_TransactionController extends Controller
{
    public function index()
    {
        //for action name
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
          $actionbalance[12] => $actionbalance[13],
          $actionbalance[20] => $actionbalance[21]
        ];
        
        return view('pages.transaction.add_transaction', compact('actblnc'));
    }

    //FUNGSI SEARCH
    public function search(Request $request)
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
                           ->where('asta_db.user.status', '=', 2)
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
          $actionbalance[12] => $actionbalance[13],
          $actionbalance[20] => $actionbalance[21]
        ];  

        $add_transaction->appends($request->all());

        return view('pages.transaction.add_transaction', compact('add_transaction', 'getUsername', 'sortingorder', 'actblnc', 'menu', 'mainmenu'));
    }


    //FUNGSI UPDATE
    public function update(Request $request)
    {
      $user_id       = $request->user_id;
      $columnname    = $request->columnname;
      $valuecurrency = $request->currency;
      $type          = $request->type;
      $plusminus     = $request->operator_aritmatika;
      $description   = $request->description;
      
      $stat = Stat::where('user_id', '=', $user_id)->first();

      $storetransactionday = StoreTransactionDay::where('user_id', '=', $user_id)
                             ->where('date', '=', Carbon::now('GMT+7')->toDateString())
                             ->first();


      //VALIDASI FORM INPUT

      
      //KONDISI PENJUMLAHAN DAN PENGURANGAN BALANCE
      //=== CHIP ===//
      if($columnname == 'chip'):
        if( $plusminus == "+"):    
          $plusminus    = "";
          $totalbalance = $stat->chip + $valuecurrency;
          $op_math      = "ditambahkan";
          $validator    = Validator::make($request->all(), [
            'currency'    => 'required',
            'type'        => 'required',
            'description' => 'required'
          ]);

          if ($validator->fails()) :
            return back()->withErrors($validator->errors());
          endif;

          //UPDATE DATABASE
          $balance = BalanceChip::create([
              'user_id'   => $user_id,
              'action_id' => $type,
              'game_id'   => 0,
              'debit'     => $valuecurrency,
              'credit'    => 0,
              'balance'   => $totalbalance,
              'datetime'  => Carbon::now('GMT+7')
          ]);
        else:
          $plusminus    = "-";
          $op_math      = "dikurang";
          $totalbalance = $stat->chip - $valuecurrency;
          $type         = 11;

          //PREVENT BALANCE MINUS CHIP
          if($stat->chip == 0):
            return back()->with('alert', alertTranslate('balance cannot be reduced'));
          endif;

          if($stat->chip < $valuecurrency):
            return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
          endif;

          $validator = Validator::make($request->all(), [
            'currency'    =>  'required',
            'description' =>  'required'
          ]);

          if ($validator->fails()) :
            return back()->withErrors($validator->errors());
          endif;

          //UPDATE DATABASE
          $balance = BalanceChip::create([
              'user_id'   => $user_id,
              'action_id' => $type,
              'game_id'   => 0,
              'debit'     => 0,
              'credit'    => $valuecurrency,
              'balance'   => $totalbalance,
              'datetime'  => Carbon::now('GMT+7')
          ]);
        endif;



        // lari ke table store transaction day jika di tambah atau dikurang
        if($storetransactionday):
          StoreTransactionDay::where('user_id', '=', $user_id)->update([
            'date'            => Carbon::now('GMT+7')->toDateString(),
            'date_created'    => Carbon::now('GMT+7'),
            'correction_chip' => $plusminus.$valuecurrency
          ]);
        else:
          StoreTransactionDay::create([
            'user_id'         => $user_id,
            'date'            => Carbon::now('GMT+7')->toDateString(),
            'date_created'    => Carbon::now('GMT+7'),
            'correction_chip' => $plusminus.$valuecurrency
          ]);
        endif;
        
        //RECORD LOG 
        Log::create([
          'op_id'     =>  Session::get('userId'),
          'action_id' =>  '2',
          'datetime'  =>  Carbon::now('GMT+7'),
          'desc'      =>  'Edit balance Chip dengan ID ' .$user_id. ' jumlah yang '.$op_math.' '.$valuecurrency. ' chip. Dengan alasan: ' .$description
        ]);
      
      //=== GOLD ===/
      elseif($columnname == 'gold'):
        if( $plusminus == "+"): 
          $plusminus    = "";
          $totalbalance = $stat->gold + $valuecurrency;
          $op_math      = 'ditambahkan';
          $validator    = Validator::make($request->all(), [
            'currency'    => 'required',
            'type'        => 'required',
            'description' => 'required'
          ]);

          if ($validator->fails()) :
            return back()->withErrors($validator->errors());
          endif;

          //UPDATE DATABASE
          $balance = BalanceGold::create([
              'user_id'   => $user_id,
              'action_id' => $type,
              'debit'     => $valuecurrency,
              'credit'    => 0,
              'balance'   => $totalbalance,
              'datetime'  => Carbon::now('GMT+7')
          ]);

        else:
          $plusminus = "-";
          $totalbalance = $stat->gold - $valuecurrency;
          $op_math      = 'dikurang';
          $type         = 11;

          $validator = Validator::make($request->all(), [
            'currency'    =>  'required',
            'description' =>  'required'
          ]);
          
        //PREVENT BALANCE MINUS GOLD
          if($stat->gold == 0):
            return back()->with('alert', alertTranslate('balance cannot be reduced'));
          endif;

          if($stat->gold < $valuecurrency):
            return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
          endif;


          if ($validator->fails()) :
            return back()->withErrors($validator->errors());
          endif;

          //UPDATE DATABASE
          $balance = BalanceGold::create([
              'user_id'   => $user_id,
              'action_id' => $type,
              'debit'     => 0,
              'credit'    => $valuecurrency,
              'balance'   => $totalbalance,
              'datetime'  => Carbon::now('GMT+7')
          ]);

        endif;



        // lari ke table store transaction day jika di tambah atau dikurang
        if($storetransactionday):
          // $gold = $storetransactionday->correction_gold + $valuecurrency;
          StoreTransactionDay::where('user_id', '=', $user_id)->update([
            'date'            => Carbon::now('GMT+7')->toDateString(),
            'date_created'    => Carbon::now('GMT+7'),
            'correction_gold' => $plusminus.$valuecurrency
          ]);
        else:
          StoreTransactionDay::create([
            'user_id'         => $user_id,
            'date'            => Carbon::now('GMT+7')->toDateString(),
            'date_created'    => Carbon::now('GMT+7'),
            'correction_gold' => $plusminus.$valuecurrency
          ]);
        endif;
        
        //RECORD LOG 
        Log::create([
          'op_id'     =>  Session::get('userId'),
          'action_id' =>  '2',
          'datetime'  =>  Carbon::now('GMT+7'),
          'desc'      =>  'Edit balance koin dengan ID ' .$user_id. ' jumlah yang '.$op_math.' '.$valuecurrency. ' koin. Dengan alasan: ' .$description
        ]);


      //=== POINT ===//
      elseif($columnname == 'point'):
        if( $plusminus == "+"): 
          $plusminus = "";   
          $totalbalance = $stat->point + $valuecurrency;
          $op_math = 'ditambahkan';

          $validator = Validator::make($request->all(), [
            'currency'    =>  'required',
            'type'        =>  'required',
            'description' =>  'required'
          ]);

          if ($validator->fails()) :
            return back()->withErrors($validator->errors());
          endif;

          //UPDATE DATABASE
          $balance = BalancePoint::create([
              'user_id'   => $user_id,
              'game_id'   => 0,
              'action_id' => $type,
              'debit'     => $valuecurrency,
              'credit'    => 0,
              'balance'   => $totalbalance,
              'datetime'  => Carbon::now('GMT+7')
          ]);
        else:
          $plusminus = "-";   
          $totalbalance = $stat->point - $valuecurrency;
          $op_math = 'dikurang';
          $type         = 11;

          $validator = Validator::make($request->all(), [
            'currency'    =>  'required',
            'description' =>  'required'
          ]);
          
          //PREVENT BALANCE MINUS POINT
          if($stat->point == 0):
            return back()->with('alert', alertTranslate('balance cannot be reduced'));
          endif;

          if($stat->point < $valuecurrency):
            return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
          endif;

          if ($validator->fails()) :
            return back()->withErrors($validator->errors());
          endif;

          //UPDATE DATABASE
          $balance = BalancePoint::create([
              'user_id'   => $user_id,
              'game_id'   => 0,
              'action_id' => $type,
              'debit'     => 0,
              'credit'    => $valuecurrency,
              'balance'   => $totalbalance,
              'datetime'  => Carbon::now('GMT+7')
          ]);
        endif;

        // lari ke table store transaction day jika di tambah atau dikurang
        if($storetransactionday):
          // $point = $storetransactionday->correction_point + $valuecurrency;
          StoreTransactionDay::where('user_id', '=', $user_id)->update([
            'date'             => Carbon::now('GMT+7')->toDateString(),
            'date_created'     => Carbon::now('GMT+7'),
            'correction_point' => $plusminus.$valuecurrency
          ]);
        else:
          StoreTransactionDay::create([
            'user_id'          => $user_id,
            'date'             => Carbon::now('GMT+7')->toDateString(),
            'date_created'     => Carbon::now('GMT+7'),
            'correction_point' => $plusminus.$valuecurrency
          ]);
        endif;

        //RECORD LOG
        Log::create([
          'op_id'     =>  Session::get('userId'),
          'action_id' =>  '2',
          'datetime'  =>  Carbon::now('GMT+7'),
          'desc'      =>  'Edit balance Poin dengan ID ' .$user_id. ' jumlah yang '. $op_math.' '.$valuecurrency. ' poin. Dengan alasan: ' .$description
        ]);

      endif;

      Stat::where('user_id', '=', $user_id)->update([
        $columnname => $totalbalance
      ]);

      return back()->with('success', alertTranslate('Successful update'));

    }
}
