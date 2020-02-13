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
          $actionbalance[20] => $actionbalance[21],
          $actionbalance[22] => $actionbalance[23],
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
          $actionbalance[20] => $actionbalance[21],
          $actionbalance[22] => $actionbalance[23]
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
      $validator = Validator::make($request->all(),[
        'type'        => 'required',
        'currency'    => 'required',
        'description' => 'required',
      ]);

      if($validator->fails()){
        return back()->with('alert', 'kolom tidak boleh kosong');
      }
      
      //KONDISI PENJUMLAHAN DAN PENGURANGAN BALANCE
      //=== CHIP ===//
      if($columnname == 'chip'):

        //untuk type bonus atau gratis
        if($type == 6 || $type == 7):

          //validasi jika angka input lebih besar dari current balance gold di database untuk pengurangan //
          if($valuecurrency < 0):
            return back()->with('alert', alertTranslate('For type Bonus or Free number not allowed negative number'));
          endif;

          $totalbalance = $stat->chip + $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([
            'chip'  =>  $totalbalance
          ]);

          if($storetransactionday):
            $total_rewardchip =  $storetransactionday->reward_chip + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
                'date'            => Carbon::now('GMT+7')->toDateString(),
                'date_created'    => Carbon::now('GMT+7'),
                'reward_chip'     => $total_rewardchip
            ]);
          else:
            StoreTransactionDay::create([
                  'date'         => Carbon::now('GMT+7')->toDateString(),
                  'date_created' => Carbon::now('GMT+7'),
                  'user_id'      => $user_id,
                  'reward_chip'  => $valuecurrency,
              ]);
          endif;

          Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance chip dengan user ID ' .$user_id. ' jumlah yang ditambahkan dengan '.$valuecurrency. ' chip. Dengan alasan: ' .$description
          ]);

        //type adjust
        elseif($type == 12):

          //validasi untuk angka tidak dapat diperbolehkan negatif //
          if($valuecurrency < 0 ):
            return back()->with('alert', alertTranslate('For Type Adjust number did not allowed negative'));
          endif;

          
          $totalbalance = $valuecurrency;
          
          Stat::where('user_id', '=', $user_id)->update([
            'chip'  =>  $totalbalance
          ]);
          
          if($stat->chip > $valuecurrency):

            //Selisih chip yang dimiliki user dengan adjust//
            $userchip = $valuecurrency - $stat->chip;

            //Total correction chip//
            $total_correctionchip = $storetransactionday->correction_chip + $userchip;

            //Tambah keterangan di log admin//

            $op_math = 'ditambahkan dengan';

            //untuk balance reseller//
            BalanceChip::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $userchip,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

          elseif($stat->chip < $valuecurrency):
            //selisih chip yang dimiliki reseller dengan yang adjust//
            $userchip = $stat->chip - $valuecurrency;

            //untuk total correction chip//
            $total_correctionchip = $storetransactionday->correction_chip - $userchip;

            //untuk keterangan di log Admin//
            $op_math = 'dikurangkan dengan';

            // insert ke balance chip //
            BalanceChip::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  0,
              'credit'    =>  $userchip,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

            elseif($stat->chip == $valuecurrency):
              //untuk total correction chip//
              $total_correctionchip = $storetransactionday->correction_chip - $userchip;
  
              //untuk keterangan di log Admin//
              $op_math = 'diisi dengan';
  
              // insert ke balance chip //
              BalanceChip::create([
                'user_id'   =>  $user_id,
                'action_id' =>  $type,
                'game_id'   =>  0,
                'debit'     =>  0,
                'credit'    =>  0,
                'balance'   =>  $valuecurrency,
                'datetime'  =>  Carbon::now('GMT+7')
              ]);
          endif;
        
          //Insert ke storetransactionday//
          if($storetransactionday):
            $total_correctionchip = $storetransactionday->correction_chip + $totalbalance;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
              'date'            =>  Carbon::now('GMT+7')->toDateString(),
              'date_created'    =>  Carbon::now('GMT+7'),
              'correction_chip' =>  $total_correctionchip
            ]);
          else:
            StoreTransactionDay::create([
              'date'            => Carbon::now('GMT+7')->toDateString(),
              'date_created'    => Carbon::now('GMT+7'),
              'user_id'         => $user_id,
              'correction_chip' => $valuecurrency 
            ]);
          endif;
          
            Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance CHIP dengan user ID ' .$user_id. ' jumlah yang ' .$op_math.' '.$valuecurrency. ' Chip. Dengan alasan: ' .$description
            ]);


        //Untuk type correction//
        elseif($type == 11):
          //Untuk validasi jika angka input lebih besar dari angka di chip database untuk pengurangan//
          $angka = str_replace('-', '', $valuecurrency);
          
          if($valuecurrency < 0):
            if($stat->chip < $angka):
              return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
            endif;
          endif;

          //Menambah chip user//
          $totalbalance = $stat->chip + $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([  
            'chip' => $totalbalance
          ]);

          //insert insert ke table store transaction day//
          if($storetransactionday):
            $total_correctionchip = $storetransactionday->correction_chip + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
              'date'            =>  Carbon::now('GMT+7')->toDateString(),
              'date_created'    =>  Carbon::now('GMT+7'),
              'correction_chip' =>  $total_correctionchip
            ]);
          else:
            StoreTransactionDay::create([
              'date'            => Carbon::now('GMT+7')->toDateString(),
              'date_created'    => Carbon::now('GMT+7'),
              'user_id'         => $user_id,
              'correction_chip' => $valuecurrency
            ]);
          endif;
          
          //insert ke balance chip//
          if($valuecurrency > 0):
            BalanceChip::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $valuecurrency,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);


            //LOG ADMIN
            $op_math = 'ditambahkan dengan';
          elseif($valuecurrency < 0):
            $replaceminus = str_replace('-', '', $valuecurrency);
            BalanceChip::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'debit'     =>  0,
              'credit'    =>  $replaceminus,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

            //LOG ADMIN
            $op_math = 'dikurangkan dengan';
          endif;

          Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit balance chip dengan user ID '.$user_id.' jumlah yang '.$op_math.' '.$valuecurrency. ' chip. Dengan alasan: '. $description
          ]);
        endif;

       
      
      //=== GOLD ===/
      elseif($columnname == 'gold'):
        //untuk type bonus atau gratis
        if($type == 6 || $type == 7):

          //validasi jika angka input lebih besar dari current balance gold di database untuk pengurangan //
          if($valuecurrency < 0):
            return back()->with('alert', alertTranslate('For type Bonus or Free number not allowed negative number'));
          endif;

          $totalbalance = $stat->gold + $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([
            'gold'  =>  $totalbalance
          ]);

          if($storetransactionday):
            $total_rewardgold =  $storetransactionday->reward_gold + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
                'date'            => Carbon::now('GMT+7')->toDateString(),
                'date_created'    => Carbon::now('GMT+7'),
                'reward_gold'     => $total_rewardgold
            ]);
          else:
            StoreTransactionDay::create([
                  'date'         => Carbon::now('GMT+7')->toDateString(),
                  'date_created' => Carbon::now('GMT+7'),
                  'user_id'      => $user_id,
                  'reward_gold'  => $valuecurrency,
              ]);
          endif;

          Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance gold dengan user ID ' .$user_id. ' jumlah yang ditambahkan dengan '.$valuecurrency. ' gold. Dengan alasan: ' .$description
          ]);

        //type adjust
        elseif($type == 12):
          //validasi untuk angka tidak dapat diperbolehkan negatif //
          if($valuecurrency < 0 ):
            return back()->with('alert', alertTranslate('For Type Adjust number didnot allowed negative'));
          endif;

          $totalbalance = $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([
            'gold'  =>  $totalbalance
          ]);
          
          if($stat->gold > $valuecurrency):

            //Selisih gold yang dimiliki user dengan adjust//
            $usergold = $valuecurrency - $stat->gold;

            //Total correction gold//
            $total_correctiongold = $storetransactionday->correction_gold + $usergold;

            //Tambah keterangan di log admin//

            $op_math = 'ditambahkan dengan';

            //untuk balance gold//
            BalanceGold::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $usergold,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

          elseif($stat->gold < $valuecurrency):
            

            //selisih gold yang dimiliki reseller dengan yang adjust//
            $usergold = $stat->gold - $valuecurrency;

            //untuk total correction gold//
            $total_correctiongold = $storetransactionday->correction_gold - $usergold;

            //untuk keterangan di log Admin//
            $op_math = 'dikurangkan dengan';

            // insert ke balance gold //
            BalanceGold::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  0,
              'credit'    =>  $usergold,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

            elseif($stat->gold == $valuecurrency):  
              //untuk total correction gold//
              $total_correctiongold = $storetransactionday->correction_gold - $usergold;
  
              //untuk keterangan di log Admin//
              $op_math = 'diisi dengan';
  
              // insert ke balance gold //
              BalanceGold::create([
                'user_id'   =>  $user_id,
                'action_id' =>  $type,
                'game_id'   =>  0,
                'debit'     =>  0,
                'credit'    =>  0,
                'balance'   =>  $valuecurrency,
                'datetime'  =>  Carbon::now('GMT+7')
              ]);
          endif;
        
          //Insert ke storetransactionday//
          if($storetransactionday):
            $total_correctiongold = $storetransactionday->correction_gold + $totalbalance;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
              'date'            =>  Carbon::now('GMT+7')->toDateString(),
              'date_created'    =>  Carbon::now('GMT+7'),
              'correction_gold' =>  $total_correctiongold
            ]);
          else:
            StoreTransactionDay::create([
              'date'            => Carbon::now('GMT+7')->toDateString(),
              'date_created'    => Carbon::now('GMT+7'),
              'user_id'         => $user_id,
              'correction_gold' => $valuecurrency 
            ]);
          endif;
          
            Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance gold dengan user ID ' .$user_id. ' jumlah yang ' .$op_math.' '.$valuecurrency. ' gold. Dengan alasan: ' .$description
            ]);


        //Untuk type correction//
        elseif($type == 11):
          //Untuk validasi jika angka input lebih besar dari angka di gold database untuk pengurangan//
          $angka = str_replace('-', '', $valuecurrency);
          
          if($valuecurrency < 0):
            if($stat->gold < $angka):
              return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
            endif;
          endif;

          //Menambah gold user//
          $totalbalance = $stat->gold + $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([  
            'gold' => $totalbalance
          ]);

          //insert insert ke table store transaction day//
          if($storetransactionday):
            $total_correctiongold = $storetransactionday->correction_gold + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
              'date'            =>  Carbon::now('GMT+7')->toDateString(),
              'date_created'    =>  Carbon::now('GMT+7'),
              'correction_gold' =>  $total_correctiongold
            ]);
          else:
            StoreTransactionDay::create([
              'date'            => Carbon::now('GMT+7')->toDateString(),
              'date_create'     => Carbon::now('GMT+7'),
              'user_id'         => $user_id,
              'correction_gold' => $valuecurrency
            ]);
          endif;
          
          //insert ke balance gold//
          if($valuecurrency > 0):
            BalanceGold::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $valuecurrency,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);


            //LOG ADMIN
            $op_math = 'ditambahkan dengan';
          elseif($valuecurrency < 0):
            $replaceminus = str_replace('-', '', $valuecurrency);
            BalanceGold::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'debit'     =>  0,
              'credit'    =>  $replaceminus,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

            //LOG ADMIN
            $op_math = 'dikurangkan dengan';
          endif;

          Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit balance gold dengan user ID '.$user_id.' jumlah yang '.$op_math.' '.$valuecurrency. ' gold. Dengan alasan: '. $description
          ]);
        endif;

      //=== POINT ===//
      elseif($columnname == 'point'):
        //untuk type bonus atau gratis
        if($type == 6 || $type == 7):

          //validasi jika angka input lebih besar dari current balance point di database untuk pengurangan //
          if($valuecurrency < 0):
            return back()->with('alert', alertTranslate('For type Bonus or Free number not allowed negative number'));
          endif;

          $totalbalance = $stat->point + $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([
            'point'  =>  $totalbalance
          ]);

          if($storetransactionday):
            $total_rewardpoint =  $storetransactionday->reward_point + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
                'date'            => Carbon::now('GMT+7')->toDateString(),
                'date_created'    => Carbon::now('GMT+7'),
                'reward_point'    => $total_rewardpoint
            ]);
          else:
            StoreTransactionDay::create([
                  'date'         => Carbon::now('GMT+7')->toDateString(),
                  'date_created' => Carbon::now('GMT+7'),
                  'user_id'      => $user_id,
                  'reward_point' => $valuecurrency,
              ]);
          endif;

          Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance poin dengan user ID ' .$user_id. ' jumlah yang ditambahkan dengan '.$valuecurrency. ' poin. Dengan alasan: ' .$description
          ]);

        //type adjust
        elseif($type == 12):
          //validasi untuk angka tidak dapat diperbolehkan negatif //
          if($valuecurrency < 0 ):
            return back()->with('alert', alertTranslate('For Type Adjust number didnot allowed negative'));
          endif;
        
          $totalbalance = $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([
            'point'  =>  $totalbalance
          ]);

          
          
          if($stat->point < $valuecurrency):

            //Selisih point yang dimiliki user dengan adjust//
            $userpoint = $valuecurrency - $stat->point;

            //Total correction point//
            $total_correctionpoint = $storetransactionday->correction_point + $userpoint;

            //Tambah keterangan di log admin//

            $op_math = 'ditambahkan dengan';

            //untuk balance Point//
            BalancePoint::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $userpoint,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

          elseif($stat->point < $valuecurrency):
            
            //selisih point yang dimiliki reseller dengan yang adjust//
            $userpoint = $stat->point - $valuecurrency;

            //untuk total correction point//
            $total_correctionpoint = $storetransactionday->correction_point - $userpoint;

            //untuk keterangan di log Admin//
            $op_math = 'dikurangkan dengan';

            // insert ke balance point //
            BalancePoint::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  0,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

          elseif($stat->point == $valuecurrency):
            
            //untuk total correction point//
            $total_correctionpoint = $storetransactionday->correction_point - $userpoint;
    
            //untuk keterangan di log Admin//
            $op_math = 'diisi dengan';

            // insert ke balance point //
            BalancePoint::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  0,
              'credit'    =>  0,
              'balance'   =>  $valuecurrency,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);
          endif;
        
          //Insert ke storetransactionday//
          if($storetransactionday):
            $total_correctionpoint = $storetransactionday->correction_point + $totalbalance;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
              'date'              =>  Carbon::now('GMT+7')->toDateString(),
              'date_created'      =>  Carbon::now('GMT+7'),
              'correction_point'  =>  $total_correctionpoint
            ]);
          else:
            StoreTransactionDay::create([
              'date'            => Carbon::now('GMT+7')->toDateString(),
              'date_created'    => Carbon::now('GMT+7'),
              'user_id'         => $user_id,
              'correction_point' => $valuecurrency 
            ]);
          endif;
          
            Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance point dengan user ID ' .$user_id. ' jumlah yang ' .$op_math.' '.$valuecurrency. ' point. Dengan alasan: ' .$description
            ]);


        //Untuk type correction//
        elseif($type == 11):
          //Untuk validasi jika angka input lebih besar dari angka di chip database untuk pengurangan//
          $angka = str_replace('-', '', $valuecurrency);
          
          if($valuecurrency < 0):
            if($stat->point < $angka):
              return back()->with('alert', alertTranslate('balance cannot be reduced, please enter the appropriate amount'));
            endif;
          endif;

          //Menambah poin user//
          $totalbalance = $stat->point + $valuecurrency;
          Stat::where('user_id', '=', $user_id)->update([  
            'point' => $totalbalance
          ]);

          //insert insert ke table store transaction day//
          if($storetransactionday):
            $total_correctionpoint = $storetransactionday->correction_point + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->update([
              'date'            =>  Carbon::now('GMT+7')->toDateString(),
              'date_created'    =>  Carbon::now('GMT+7'),
              'correction_point' =>  $total_correctionpoint
            ]);
          else:
            StoreTransactionDay::create([
              'date'            => Carbon::now('GMT+7')->toDateString(),
              'date_create'     => Carbon::now('GMT+7'),
              'user_id'         => $user_id,
              'correction_point' => $valuecurrency
            ]);
          endif;
          
          //insert ke balance point//
          if($valuecurrency > 0):
            BalancePoint::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $valuecurrency,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);


            //LOG ADMIN
            $op_math = 'ditambahkan dengan';
          elseif($valuecurrency < 0):
            $replaceminus = str_replace('-', '', $valuecurrency);
            BalancePoint::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'debit'     =>  0,
              'credit'    =>  $replaceminus,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

            //LOG ADMIN
            $op_math = 'dikurangkan dengan';
          endif;

          Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit balance point dengan user ID '.$user_id.' jumlah yang '.$op_math.' '.$valuecurrency. ' point. Dengan alasan: '. $description
          ]);
        endif;
      endif;


      return back()->with('success', alertTranslate('Successful update'));

    }
}
