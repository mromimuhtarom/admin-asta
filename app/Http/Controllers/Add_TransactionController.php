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
        $menu        = MenuClass::menuName('L_TRANSACTION');
        $mainmenu    = MenuClass::menuName('L_ADD_TRANSACTION');

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

      $currentname = Player::where('user_id', '=', $user_id)->first();

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

            //untuk balance reseller//
            BalanceChip::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'game_id'   =>  0,
              'debit'     =>  $valuecurrency,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

          if($storetransactionday):
            $total_rewardchip =  $storetransactionday->reward_chip + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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

          $currentvalue = str_replace('.00', '', $stat->chip);

          Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance CHIP di menu tambah transaksi dengan username '.$currentname->username.'. Dari balance '.$currentvalue.' ditambahkan dengan '.$valuecurrency. ' chip, menjadi '.$totalbalance.' Dengan alasan: ' .$description
          ]);

        //type adjust
        elseif($type == 12):

          //validasi untuk angka tidak dapat diperbolehkan negatif //
          if($valuecurrency < 0 ):
            return back()->with('alert', alertTranslate('For Type Adjust number did not allowed negative'));
          endif;

          
          $totalbalance = $valuecurrency;
          
          
          if($stat->chip > $valuecurrency):

            //Selisih chip yang dimiliki user dengan adjust//
            $userchip   = $stat->chip - $valuecurrency;
            $resultdiff = -$userchip;
            
            //Total correction chip//

            //Tambah keterangan di log admin//

            $op_math = 'dikurangi dengan';

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
            $userchip = $valuecurrency - $stat->chip;
            $resultdiff = $userchip;

            //untuk total correction chip//

            //untuk keterangan di log Admin//
            $op_math = 'ditambah';

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
              $resultdiff = 0;
  
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

          Stat::where('user_id', '=', $user_id)->update([
            'chip'  =>  $totalbalance
          ]);
        
          //Insert ke storetransactionday//
          if($storetransactionday):
            $total_correctionchip = $storetransactionday->correction_chip + $resultdiff;
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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

          $currentvalue = str_replace('.00', '', $stat->chip);
            
            Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance CHIP di menu tambah transaksi dengan username ' .$currentname->username. '. Dari balance '.$currentvalue.' chip, ' .$op_math.' '.$userchip. ' Chip, penyesuaian menjadi '.$totalbalance.' chip. Dengan alasan: ' .$description
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
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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
            $op_math = 'ditambah';
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
            $op_math = 'dikurangi';
          endif;

          $currentvalue = str_replace('.00', '', $stat->chip);

          Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit balance CHIP di menu tambah transaksi dengan username '.$currentname->username.'. Dari balance '.$currentvalue.' chip, '.$op_math.' '.$valuecurrency.' chip, koreksi menjadi '.$totalbalance. ' chip. Dengan alasan: '. $description
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

          
          //untuk balance gold//
          BalanceGold::create([
            'user_id'   =>  $user_id,
            'action_id' =>  $type,
            'debit'     =>  $valuecurrency,
            'credit'    =>  0,
            'balance'   =>  $totalbalance,
            'datetime'  =>  Carbon::now('GMT+7')
          ]);

          if($storetransactionday):
            $total_rewardgold =  $storetransactionday->reward_gold + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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

          $currentvalue = str_replace('.00', '', $stat->gold);

          Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance KOIN di menu tambah transaksi dengan username ' .$currentname->username.'. Dari balance '.$currentvalue.' ditambahkan dengan '.$valuecurrency.' koin, menjadi '.$totalbalance.' koin. Dengan alasan: ' .$description
          ]);

        //type adjust
        elseif($type == 12):
          //validasi untuk angka tidak dapat diperbolehkan negatif //
          if($valuecurrency < 0 ):
            return back()->with('alert', alertTranslate('For Type Adjust number didnot allowed negative'));
          endif;

          $totalbalance = $valuecurrency;
          
          if($stat->gold > $valuecurrency):

            //Selisih gold yang dimiliki user dengan adjust//
            $usergold = $stat->gold - $valuecurrency;
            $resultdiff = -$usergold;


            //Tambah keterangan di log admin//

            $op_math = 'dikurangi dengan';

            //untuk balance gold//
            BalanceGold::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'debit'     =>  $usergold,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

          elseif($stat->gold < $valuecurrency):
            

            //selisih gold yang dimiliki reseller dengan yang adjust//
            // $usergold = $stat->gold - $valuecurrency;
            $usergold = $valuecurrency - $stat->gold;
            $resultdiff = $usergold;


            //untuk keterangan di log Admin//
            $op_math = 'ditambah';

            // insert ke balance gold //
            BalanceGold::create([
              'user_id'   =>  $user_id,
              'action_id' =>  $type,
              'debit'     =>  0,
              'credit'    =>  $usergold,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);

            elseif($stat->gold == $valuecurrency):  
              //untuk total correction gold//
              $resultdiff = 0;
  
              //untuk keterangan di log Admin//
              $op_math = 'diisi dengan';
  
              // insert ke balance gold //
              BalanceGold::create([
                'user_id'   =>  $user_id,
                'action_id' =>  $type,
                'debit'     =>  0,
                'credit'    =>  0,
                'balance'   =>  $valuecurrency,
                'datetime'  =>  Carbon::now('GMT+7')
              ]);
          endif;
        
          //Insert ke storetransactionday//
          if($storetransactionday):
            $total_correctiongold = $storetransactionday->correction_gold + $resultdiff;
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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

          Stat::where('user_id', '=', $user_id)->update([
            'gold'  =>  $totalbalance
          ]);

          $currentvalue = str_replace('.00', '', $stat->gold);
          
            Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance koin di menu tambah transaksi dengan username ' .$currentname->username.' . Dari balance '.$currentvalue.' koin, '.$op_math.' '.$usergold.' koin, penyesuaian menjadi '.$totalbalance.' koin. Dengan alasan: ' .$description
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
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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
              'debit'     =>  $valuecurrency,
              'credit'    =>  0,
              'balance'   =>  $totalbalance,
              'datetime'  =>  Carbon::now('GMT+7')
            ]);


            //LOG ADMIN
            $op_math = 'ditambahkan';
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
            $op_math = 'dikurangi';
          endif;

          $currentvalue = str_replace('.00', '', $stat->gold);

          Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit balance koin di menu tambah transaksi dengan username '.$currentname->username.'. Dari balance '.$currentvalue.' koin, '.$op_math.' '.$valuecurrency.' koin, koreksi menjadi '.$totalbalance.' koin. Dengan alasan: '. $description
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

          //untuk balance Point//
          BalancePoint::create([
            'user_id'   =>  $user_id,
            'action_id' =>  $type,
            'game_id'   =>  0,
            'debit'     =>  $valuecurrency,
            'credit'    =>  0,
            'balance'   =>  $totalbalance,
            'datetime'  =>  Carbon::now('GMT+7')
          ]);

          if($storetransactionday):
            $total_rewardpoint =  $storetransactionday->reward_point + $valuecurrency;
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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

          $currentvalue = str_replace('.00', '', $stat->point);

          Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance POINT di menu tambah transaksi dengan username ' .$currentname->username. '. Dari balance '.$currentvalue.' ditambahkan dengan '.$valuecurrency. ' poin. menjadi '.$totalbalance.' poin. Dengan alasan: ' .$description
          ]);

        //type adjust
        elseif($type == 12):
          //validasi untuk angka tidak dapat diperbolehkan negatif //
          if($valuecurrency < 0 ):
            return back()->with('alert', alertTranslate('For Type Adjust number didnot allowed negative'));
          endif;
        
          $totalbalance = $valuecurrency;
        
          
          if($stat->point > $valuecurrency):

            //Selisih point yang dimiliki user dengan adjust//
            $userpoint = $stat->point - $valuecurrency;
            $resultdiff = -$userpoint;
            

            //Tambah keterangan di log admin//

            $op_math = 'dikurangi dengan';

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
            $userpoint = $valuecurrency- $stat->point;
            $resultdiff = $userpoint;


            //untuk keterangan di log Admin//
            $op_math = 'ditambah';

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
            $resultdiff = $valuecurrency;
    
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
            $total_correctionpoint = $storetransactionday->correction_point + $resultdiff;
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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

          Stat::where('user_id', '=', $user_id)->update([
            'point'  =>  $totalbalance
          ]);

          $currentvalue = str_replace('.00', '', $stat->point);
          
            Log::create([
              'op_id'     =>  Session::get('userId'),
              'action_id' =>  '2',
              'datetime'  =>  Carbon::now('GMT+7'),
              'desc'      =>  'Edit balance POINT di menu tambah transaksi dengan username ' .$currentname->username. '. Dari balance '.$currentvalue.' poin, '.$op_math.' '.$userpoint. ' point, penyesuaian menjadi '.$totalbalance.' point. Dengan alasan: ' .$description
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
            StoreTransactionDay::where('user_id', '=', $user_id)->where('date', '=', Carbon::now('GMT+7')->toDateString())->update([
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
            $op_math = 'ditambah';
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
            $op_math = 'dikurangi';
          endif;

          $currentvalue = str_replace('.00', '', $stat->point);

          Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit balance POINT di menu tambah transaksi dengan username '.$currentname->username.'. Dari balance '.$currentvalue.' poin, '.$op_math.' '.$valuecurrency. ' point, koreksi menjadi '.$totalbalance.' point. Dengan alasan: '. $description
          ]);
        endif;
      endif;


      return back()->with('success', alertTranslate('Successful update'));

    }
}
