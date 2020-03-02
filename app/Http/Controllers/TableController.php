<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use Session;
use DB;
use Carbon\Carbon;
use App\Classes\MenuClass;
use Validator;

// asta poker model
use App\TpkTable;
use App\TpkRoom;

// asta big 2 model
use App\BigTwoTable;
use App\BigTwoRoom;

// domino susun model
use App\DominoSusunTable;
use App\DominoSusunRoom;

// domino susun model
use App\DominoQTable;
use App\DominoQRoom;


class TableController extends Controller
{
    
    public function index()
    {
        $menu     = MenuClass::menuName('L_TABLE_ASTA_POKER');
        $mainmenu = MenuClass::menuName('L_GAMES');
        $submenu  = MenuClass::menuName('L_ASTA_POKER');
        $tables = TpkTable::join('asta_db.tpk_room', 'asta_db.tpk_room.room_id', '=', 'asta_db.tpk_table.room_id')
                  ->select(
                      'asta_db.tpk_room.name as roomname',
                      'asta_db.tpk_table.room_id',
                      'asta_db.tpk_table.name',
                      'asta_db.tpk_table.max_player',
                      'asta_db.tpk_table.small_blind',
                      'asta_db.tpk_table.big_blind',
                      'asta_db.tpk_table.jackpot',
                      'asta_db.tpk_table.table_id',
                      'asta_db.tpk_table.min_buy',
                      'asta_db.tpk_table.max_buy',
                      'asta_db.tpk_table.timer'
                  )
                  ->get();
        $category = TpkRoom::all();
        return view('pages.game_asta.asta_poker.table', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }

    public function BigTwoindex()
    {
        $menu     = MenuClass::menuName('L_TABLE_BIG_TWO');
        $mainmenu = MenuClass::menuName('L_GAMES');
        $submenu  = MenuClass::menuName('L_BIG_TWO');
        $tables = BigTwoTable::join('asta_db.bgt_room', 'bgt_room.room_id', '=', 'asta_db.bgt_table.room_id')
                ->select(
                    'asta_db.bgt_room.name as roomname',
                    'asta_db.bgt_table.name',
                    'asta_db.bgt_table.max_player',
                    'asta_db.bgt_table.turn', 
                    'asta_db.bgt_table.total_bet',
                    'asta_db.bgt_table.table_id',
                    'asta_db.bgt_table.stake',
                    'asta_db.bgt_table.min_buy',
                    'asta_db.bgt_table.max_buy',
                    'asta_db.bgt_table.timer'
                )
                ->get();
        $category = BigTwoRoom::all();
        return view('pages.game_asta.big_two.bigTwoTable', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }


    public function DominoSusunindex()
    {
        $menu     = MenuClass::menuName('L_TABLE_DOMINO_SUSUN');
        $mainmenu = MenuClass::menuName('L_GAMES');
        $submenu  = MenuClass::menuName('L_DOMINO_SUSUN');
        $tables   = DominoSusunTable::join('asta_db.dms_room', 'asta_db.dms_room.room_id', '=', 'asta_db.dms_table.room_id')
                    ->select(
                        'asta_db.dms_room.name as roomname',
                        'asta_db.dms_table.name',
                        'asta_db.dms_table.max_player',
                        'asta_db.dms_table.game_state',
                        'asta_db.dms_table.turn',
                        'asta_db.dms_table.total_bet',
                        'asta_db.dms_table.table_id',
                        'asta_db.dms_table.stake',
                        'asta_db.dms_table.min_buy',
                        'asta_db.dms_table.max_buy',
                        'asta_db.dms_table.timer'
                    )
                    ->get();
        $category = DominoSusunRoom::all();
        return view('pages.game_asta.domino_susun.dominoSusunTable', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }


    public function DominoQindex()
    {
        $menu     = MenuClass::menuName('L_TABLE_DOMINO_QQ');
        $mainmenu = MenuClass::menuName('L_GAMES');
        $submenu  = MenuClass::menuName('L_DOMINO_QQ');
        $tables   = DominoQTable::join('asta_db.dmq_room', 'asta_db.dmq_room.room_id', '=', 'asta_db.dmq_table.room_id')
                    ->select(
                        'asta_db.dmq_room.name as roomname',
                        'asta_db.dmq_table.name',
                        'asta_db.dmq_table.max_player',
                        'asta_db.dmq_table.game_state',
                        'asta_db.dmq_table.turn',
                        'asta_db.dmq_table.total_bet',
                        'asta_db.dmq_table.table_id',
                        'asta_db.dmq_table.stake',
                        'asta_db.dmq_table.min_buy',
                        'asta_db.dmq_table.max_buy',
                        'asta_db.dmq_table.timer'
                    )
                    ->get();
        $category = DominoQRoom::all();
        return view('pages.game_asta.domino_qq.dominoQTable', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }


    public function store(Request $request)
    {
        $category = $request->category;
        $sb       = $request->sb;
        $bb       = $request->bb;
        $minbuy   = $request->minbuy;
        $maxbuy   = $request->maxbuy;
        $room = TpkRoom::where('room_id', '=', $category)->first();
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required',
            'minbuy'        => 'required|int',
            'maxbuy'        => 'required|int'
                      
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $bbvalidation = $minbuy / 10;
        $sbvalidation = $bbvalidation / 2;
        if($bb < $bbvalidation)
        {
            return back()->with('alert', alertTranslate("your Big blind can't be under Minbuy divided 10 ").$bbvalidation.' ');
        } else if($sb < $sbvalidation)
        {
            return back()->with('alert', alertTranslate("your Small Blind can't be under Big Blind divided 2 ").$sbvalidation.' ');
        } else if($minbuy < $room->min_buy)
        {
            return back()->with('alert', alertTranslate("Min buy table can't be under Min Buy room"));
        } else if($maxbuy > $room->max_buy)
        {
            return back()->with('alert', alertTranslate("Max buy table can't be up to max buy room"));
        }

        TpkTable::create([
            'name'        => $request->tableName,
            'room_id'     => $request->category,
            'max_player'  => '5',
            'small_blind' => $sb,
            'big_blind'   => $bb,
            'jackpot'     => '0',
            'min_buy'     => $minbuy,
            'max_buy'     => $maxbuy,
            'timer'       => '7'
        ]);

        Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '13',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Menambahkan data ('.$request->tableName.')'
        ]);

        return redirect()->route('Table_Asta_Poker')->with('success', alertTranslate('Data Added'));
    }


     public function BigTwostore(Request $request)
     {
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required',
            
        ], [
            'category.integer'  => 'category dibutuhkan'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $stake            = $request->stake;
        $minbuy           = $request->minbuy;
        $maxbuy           = $request->maxbuy;
        $category         = $request->category;
        $minbuyvalidation = $stake * 3 * 13;
        $maxbuyvalidation = $minbuyvalidation * 4;
        $room             = BigTwoRoom::where('room_id', '=', $category)->first();
        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', alertTranslate("Min Buy can't be under Stake multiplied by 3 multiplied 13 or under ").$minbuyvalidation);
        }  else if($minbuy > $maxbuy)
        {
            return back()->with('alert', alertTranslate("Max buy can't be under min buy"));
        } else if($minbuy < $room->min_buy)
        {
            return back()->with('alert', alertTranslate("Min buy can't be under max buy").$room->min_buy.'');
        } else if($maxbuy > $room->max_buy)
        {
            return back()->with('alert', alertTranslate("Max buy can't be up to max buy room"));
        }

        BigTwoTable::create([
            'name'       => $request->tableName,
            'room_id'    => $category,
            'max_player' => '4',
            'turn'       => '0',
            'total_bet'  => '0',
            'stake'      => $stake,
            'min_buy'    => $minbuy,
            'max_buy'    => $maxbuy,
            'timer'      => '7'
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '16',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data ('.$request->tableName.')'
        ]);
 
        return redirect()->route('Table_Big_Two')->with('success', alertTranslate('Data Added'));
     }

    public function DominoSusunstore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required|integer',
            
        ], [
            'category.integer'  => 'category dibutuhkan'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $minbuy           = $request->minbuy;
        $maxbuy           = $request->maxbuy;
        $stake            = $request->stake;
        $category         = $request->category;
        $minbuyvalidation = $stake * 10;
        $maxbuyvalidation = $minbuyvalidation * 4;
        $room             = DominoSusunRoom::where('room_id', '=', $category)->first();
        $lastrecord       = DominoSusunTable::orderby('table_id', 'desc')->first();
        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', alertTranslate("Max buy can't be under Stake multiplied by 10 or under").$minbuyvalidation);
        }  else if($maxbuy < $maxbuyvalidation)
        {
            return back()->with('alert', alertTranslate("Max buy can't be under Min buy multiplied by 4 or under ").$maxbuyvalidation);
        } else if($minbuy > $maxbuy)
        {
            return back()->with('alert', alertTranslate("Max buy can't be under min buy"));
        } else if($minbuy < $room->min_buy)
        {
            return back()->with('alert', alertTranslate("Min buy table can't be under Min Buy room"));
        } else if($maxbuy > $room->max_buy)
        {
            return back()->with('alert', alertTranslate("Max buy table can't be up to max buy room"));
        }

        DominoSusunTable::create([
            'name'                 => $request->tableName,
            'room_id'              => $category,
            'max_player'           => '4',
            'game_State'           => '0',
            'turn'                 => '0',
            'total_bet'            => '0',
            'stake'                => $stake,
            'min_buy'              => $minbuy,
            'max_buy'              => $maxbuy,
            'timer'                => '7'
        ]);

          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '19',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data ('.$request->tableName.')'
          ]);

       return redirect()->route('Table_Domino_Susun')->with('success', alertTranslate('Data Added'));
    }

    public function DominoQstore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required|integer',
            
        ], [
            'category.integer'  => 'category is required'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $minbuy           = $request->minbuy;
        $maxbuy           = $request->maxbuy;
        $stake            = $request->stake;
        $category         = $request->category;
        $minbuyvalidation = $stake * 10;
        $maxbuyvalidation = $minbuyvalidation * 2;
        $room             = DominoQRoom::where('room_id', '=', $category)->first();
        $lastrecord       = DominoQTable::orderby('table_id', 'desc')->first();


        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', alertTranslate("Min buy can't be under stake multiplied by 10 or under ").$minbuyvalidation);
        }  else if($maxbuy < $maxbuyvalidation)
        {
            return back()->with('alert', alertTranslate("Max buy can't be under Min Buy multiplied by 2 or under").$maxbuyvalidation);
        } else if($minbuy > $maxbuy)
        {
            return back()->with('alert', alertTranslate("Max buy can't be under min buy"));
        } else if($minbuy < $room->min_buy)
        {
            return back()->with('alert', alertTranslate("Min buy table can't be under Min Buy room"));
        } else if($maxbuy > $room->max_buy)
        {
            return back()->with('alert', alertTranslate("Max buy table can't be up to max buy room"));
        } 

        DominoQTable::create([
            'name'                 => $request->tableName,
            'room_id'              => $category,
            'max_player'           => '4',
            'game_State'           => '0',
            'turn'                 => '0',
            'total_bet'            => '0',
            'stake'                => $stake,
            'min_buy'              => $minbuy,
            'max_buy'              => $maxbuy,
            'timer'         =>  '7'
        ]);

          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '22',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data ('.$request->tableName.')'
          ]);

       return redirect()->route('Table_Domino_QQ')->with('success', alertTranslate('Data Added'));
    }



    public function update(Request $request)
    {
        $pk           = $request->pk;
        $name         = $request->name;
        $value        = $request->value;
        $findcategory = TpkTable::where('table_id', '=', $pk)->first();
        $room         = TpkRoom::where('room_id', '=', $findcategory->room_id)->first();
        $bbvalidation = $findcategory->min_buy / 10;
        $sbvalidation = $bbvalidation / 2;
        $currentname = TpkTable::where('table_id', '=', $pk)->first();
  
        if($name == 'big_blind')
        {
            if($value < $bbvalidation)
            {
                return response()->json(alertTranslate("your Small Blind can't be under Big Blind divided 2 or under ").$bbvalidation." ", 400);
            } else 
            {
                TpkTable::where('table_id', '=', $pk)->update([
                    'big_blind'   => $value
                  ]);
            }
        } else if($name == 'small_blind')
        {

            if($value < $sbvalidation)
            {
                return response()->json(alertTranslate("your Small Blind can't be under Big Blind divided 2 or under ").$findcategory->min_buy." ", 400);
            } else 
            {
                TpkTable::where('table_id', '=', $pk)->update([
                    'small_blind'   => $value
                ]);
            }
        } else if($name == 'min_buy')
        {
            if($value < $room->min_buy)
            {
                return response()->json(alertTranslate("Min buy table can't be under Min Buy room"), 400);
            } 
            TpkTable::where('table_id', '=', $pk)->update([
                $name => $value
            ]);

        } else if($name == 'max_buy')
        {
            if($value > $room->max_buy)
            {
                return response()->json(alertTranslate("Max buy table can't be up to max buy room"), 400);
            }
            TpkTable::where('table_id', '=', $pk)->update([
                $name => $value
            ]);
        } else 
        { 
            DB::table('tpk_table')->where('table_id', '=', $pk)->update([
                $name => $value
            ]);
    
        }
        
        switch ($name) {
            case "name":
                $name = "Nama Meja";
                $currentvalue = $currentname->name;
                break;
            case "room_id":
                $name = "Nama Ruang";
                $queryroom = TpkRoom::where('room_id', '=', $currentname->room_id)->first();
                $currentvalue = $queryroom->name;
                $tablename = TpkRoom::where('room_id', '=', $value)->first();
                $value = $tablename->name;
                break;
            case "max_player":
                $name = "Maksimal Pemain";
                $currentvalue = $currentname->max_player;
                break;
            case "small_blind":
                $name = "Small  Blind";
                $currentvalue = $currentname->small_blind;
                break;
            case "big_blind":
                $name = "Big Blind";
                $currentvalue = $currentname->big_blind;
                break;
            case "jackpot":
                $name = "Jackpot";
                $currentvalue = $currentname->jackpot;
                break;
            case "min_buy":
                $name = "Min Buy";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Max Buy";
                $currentvalue = $currentname->max_buy;
                break;
            case "timer":
                $name = "Timer";
                $currentvalue = strNormalFast($currentname->timer);
                $value = strNormalFast($value);
                break;
            default:
              "";
        }
        $tpktable = DB::table('tpk_table')->where('table_id', '=', $pk)->first();
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '13',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' ('.$tpktable->name.') '.$currentvalue.' => '.$value
        ]);
    }


    public function BigTwoupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = BigTwoTable::where('table_id', '=', $pk)->first();

        if($name == 'min_buy')
        {
            $validasiminbuy = BigTwoTable::where('table_id', '=', $pk)->first();
            $room = BigTwoRoom::where('room_id', '=', $validasiminbuy->room_id)->first();
            $count          = $validasiminbuy->stake * 3 * 13;
            if($count > $value)
            {
                return response()->json(alertTranslate("Min Buy can't be under Stake multiplied by 3 multiplied 13 or under ").$count." ", 400);
            } else if($value > $validasiminbuy->max_buy)
            {
                return response()->json(alertTranslate("Max buy can't be up to max buy room "), 400);
            } else if($value < $room->min_buy)
            {
                return response()->json(alertTranslation("Min buy table can't be under to min buy room "), 400);
            } 
            BigTwoTable::where('table_id', '=', $pk)->update([
                'min_buy'   => $value
            ]); 
        } else if($name == 'max_buy')
        {
            $validasimaxbuy =BigTwoTable::where('table_id', '=', $pk)->first();
            if($value < $validasimaxbuy->min_buy)
            {
                return response()->json(alertTranslate("Max buy can't be under min buy"), 400);
            } else if($value > $room->max_buy)
            {
                return response()->json(alertTranslate("Max buy table can't be up to max buy room"), 400);
            }
            BigTwoTable::where('table_id', '=', $pk)->update([
                'max_buy'   => $value
            ]); 
        } else 
        {
            DB::table('bgt_table')->where('table_id', '=', $pk)->update([
                $name => $value
            ]);
            // return response()->json($value, 400);
            // BigTwoTable::where('table_id', '=', $pk)->update([
            //     $name => $value 
            // ]);
        } 

        switch ($name) {
            case "name":
                $name = "Table Name";
                $currentvalue = $currentname->name;
                break;
            case "room_id":
                $name = "Nama ruang";
                $queryroom = BigTwoRoom::where('room_id', '=', $currentname->room_id)->first();
                $currentvalue = $queryroom->name;
                $tablename = BigTwoRoom::where('room_id', '=', $value)->first();
                $value = $tablename->name;
                break;
            case "turn":
                $name = "turn";
                $currentvalue = $currentname->turn;
                break;
            case "total_bet":
                $name = "Total Bet";
                $currentvalue = $currentname->total_bet;
                break;
            case "stake":
                $name = "Stake";
                $currentvalue = $currentname->stake;
                break;
            case "min_buy":
                $name = "Min Buy";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Max Buy";
                $currentvalue = $currentname->max_buy;
                break;
            case "timer":
                $name = "Timer";
                $currentvalue = strNormalFast($currentname->timer);
                $value = strNormalFast($value);
                break;
            default:
            "";
        }

    $bgttable = DB::table('bgt_table')->where('table_id', '=', $pk)->first();
    Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '16',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' ('.$bgttable->name.') '.$currentvalue.' => '.$value
    ]);
    }


    public function DominoSusunupdate(Request $request)
    {
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $dmsroom     = DominoSusunTable::where('table_id', '=', $pk)->first();
        $room        = DominoSusunRoom::where('room_id', '=', $dmsroom->room_id)->first();
        $countminbuy = $dmsroom->stake * 10;
        $countmaxbuy = $countminbuy * 4;
        $currentname = DominoSusunTable::where('table_id', '=', $pk)->first();
  
        if($name == 'min_buy')
        {
            if($value < $countminbuy)
            {
                return response()->json(alertTranslate("Min buy can't be under stake multiplied by 10 or under ").$countminbuy." ", 400);
            } else if($value > $dmsroom->max_buy)
            {
                return response()->json(alertTranslate("Min buy can't be up to max buy "), 400);
            } else if($value< $room->min_buy)
            {
                return response()->json(alertTranslate("Min Buy can't be under to min buy room "), 400);
            } else 
            {
                DominoSusunTable::where('table_id', '=', $pk)->update([
                    'min_buy' => $value 
                ]);
            }
        } else if($name == 'max_buy')
        {
            if($value < $countmaxbuy)
            {
                return response()->json( alertTranslate("Max buy can't be under Stake multiplied by 4 or under ").$countmaxbuy." ", 400);
            } else if($value < $dmsroom->min_buy)
            {
                return response()->json( alertTranslate("Max buy can't be under min buy"), 400);
            } else if($value > $room->max_buy) 
            {
                return response()->json( alertTranslate("Max buy table can't be up to max buy room"), 400);
            } else 
            {
                DominoSusunTable::where('table_id', '=', $pk)->update([
                    'max_buy' => $value 
                ]);
            }
        } else if($name == 'stake')
        {

            DominoSusunTable::where('table_id', '=', $pk)->update([
                $name => $value 
            ]);

        } else 
        {   
            DB::table('dms_table')->where('table_id', '=', $pk)->update([
                $name => $value
            ]);
    
            // DominoSusunTable::where('table_id', '=', $pk)->update([
            //     $name => $value 
            // ]);
        } 

        switch ($name) {
            case "name":
                $name = "Table Name";
                $currentvalue = $currentname->name;
                break;
            case "room_id":
                $name = "nama ruang";
                $queryroom = DominoSusunRoom::where('room_id', '=', $currentname->room_id)->first();
                $currentvalue = $queryroom->name;
                $tablename = DominoSusunRoom::where('room_id', '=', $value)->first();
                $value = $tablename->name;
                break;
            case "max_player":
                $name = "Max Player";
                $currentvalue = $currentname->max_player;
                break;
            case "game_state":
                $name = "Game State";
                $currentvalue = $currentname->game_state;
                break;
            case "turn":
                $name = "Turn";
                $currentvalue = $currentname->turn;
                break;
            case "total_bet":
                $name = "Total Bet";
                $currentvalue = $currentname->total_bet;
                break;
            case "stake":
                $name = "Stake & Stake Pass";
                $currentvalue = $currentname->stake;
                break;
            case "min_buy":
                $name = "Min Buy";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Max Buy";
                $currentvalue = $currentname->max_buy;
                break;
            case "timer":
                $name = "Timer";
                $currentvalue = strNormalFast($currentname->timer);
                $value = strNormalFast($value);
                break;
            default:
            "";
        }

    $dmstable = DB::table('dms_table')->where('table_id', '=', $pk)->first();
    Log::create([
        'op_id' => Session::get('userId'),
        'action_id'   => '19',
        'datetime'    => Carbon::now('GMT+7'),
        'desc'        => 'Edit '.$name.' ('.$dmstable->name.') '.$currentvalue.' => '. $value
    ]);
    }


    public function DominoQupdate(Request $request)
    {
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $dmqtable    = DominoQTable::where('table_id', '=', $pk)->first();
        $room        = DominoQRoom::where('room_id', '=', $dmqtable->room_id)->first();
        $countminbuy = $dmqtable->stake * 10;
        $countmaxbuy = $countminbuy * 2;
        $currentname = DominoQTable::where('table_id', '=', $pk)->first();
  
        if($name == 'min_buy')
        {
            if($value < $countminbuy)
            {
                return response()->json( alertTranslate("Min buy can't be under stake multiplied by 10 or under ").$countminbuy." ", 400);
            } else 
            if($value > $dmqroom->max_buy)
            {
                return response()->json( alertTranslate("Min buy can't be up to max buy ").$countminbuy." ", 400);
            } else if($value < $room->min_buy)
            {
                return response()->json( alertTranslate("Min buy table can't be under Min Buy room"), 400);
            } else 
            {
                DominoQTable::where('table_id', '=', $pk)->update([
                    'min_buy' => $value 
                ]);
            }
        } else if($name == 'max_buy')
        {
            if($value < $countmaxbuy)
            {
                return response()->json( alertTranslate("Max buy can't be under Stake multiplied by 2 or under ").$countmaxbuy." ", 400);
            } else 
            if($value < $dmqroom->min_buy)
            {
                return response()->json( alertTranslate("Max buy can't be under min buy "), 400);
            } else if($value > $room->max_buy)
            {
                return response()->json( alertTranslate("Max Buy table can't be Up to Max Buy room "), 400);
            }else 
            {
                DominoQTable::where('table_id', '=', $pk)->update([
                    'max_buy' => $value 
                ]);
            }
        } else if($name == 'stake')
        {
            DominoQTable::where('table_id', '=', $pk)->update([
                $name => $value 
            ]);
        } else 
        {
            DB::table('dmq_table')->where('table_id', '=', $pk)->update([
                $name => $value
            ]);
            // DominoQTable::where('table_id', '=', $pk)->update([
            //     $name => $value 
            // ]);
        }

        switch ($name) {
            case "name":
                $name = "Table Name";
                $currentvalue = $currentname->name;
                break;
            case "room_id":
                $name = "room id";
                $queryroom = DominoQRoom::where('room_id', '=', $currentname->room_id)->first();
                $currentvalue = $queryroom->name;
                $tablename = DominoQRoom::where('room_id', '=', $value)->first();
                $value = $tablename->name;
                break;
            case "max_player":
                $name = "Max Player";
                $currentvalue = $currentname->max_player;
                break;
            case "game_state":
                $name = "Game State";
                $currentvalue = $currentname->game_state;
                break;
            case "turn":
                $name = "Turn";
                $currentvalue = $currentname->turn;
                break;
            case "total_bet":
                $name = "Total Bet";
                $currentvalue = $currentname->total_bet;
                break;
            case "timer":
                $name = "Timer";
                $currentvalue = strNormalFast($currentname->timer);
                $value = strNormalFast($value);
                break;
            default:
            "";
        }

    $dmqtable = DB::table('dmq_table')->where('table_id', '=', $pk)->first();
    Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '22',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' ('.$dmqtable->name.') '.$currentvalue.' => '. $value
    ]);
    }


    public function destroy(Request $request)
    {
        $tableid = $request->tableid;

        if($tableid != '')
        {
            $tpk_table = TpkTable::where('table_id', '=', $tableid)->first();
            TpkTable::where('table_id', '=', $tableid)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '13',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Meja Asta Poker dengan nama meja '.$tpk_table->name
            ]);
            return redirect()->route('Table_Asta_Poker')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Table_Asta_Poker')->with('alert', alertTranslate('Something wrong'));                
    }

    public function deleteAllSelectedTpk(Request $request)
    {
        $ids    =   $request->AstaAll;
        $currentname = $request->usernameAll;

        DB::table('asta_db.tpk_table')->whereIn('table_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '13',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus data (' .$currentname.')'
        ]);
        return redirect()->route('Table_Asta_Poker')->with('succes', alertTranslate('Data deleted'));
    }


    public function BigTwodestroy(Request $request)
    {
        $tableid = $request->tableid;
        
        if($tableid != '')
        {   
            $bgt_table = BigTwoTable::where('table_id', '=', $tableid)->first();
            BigTwoTable::where('table_id', '=', $tableid)->delete();
            
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '16',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data ('.$bgt_table->name.')'
            ]);
            return redirect()->route('Table_Big_Two')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Table_Big_Two')->with('alert', alertTranslate('Something wrong'));                
    }

    public function BigTwoDeleteAll(Request $request)
    {
        $ids    =   $request->AstaAll;
        $currentname = $request->usernameAll;

        DB::table('asta_db.bgt_table')->whereIn('table_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '16',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu table Big two dengan nama' .$currentname
        ]);
        return redirect()->route('Table_Big_Two')->with('success', alertTranslate('Data deleted'));
    }


    public function DominoSusundestroy(Request $request)
    {
        $tableid = $request->tableid;
        if($tableid != '')
        {
            $dms_table = DominoSusunTable::where('table_id', '=', $tableid)->first();
            DominoSusunTable::where('table_id', '=', $tableid)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '16',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data ('.$dms_table->name.')'
            ]);
            return redirect()->route('Table_Domino_Susun')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Table_Domino_Susun')->with('alert', alertTranslate('Something wrong'));                
    }

    public function DominoSDeleteAll(Request $request)
    {
        $ids    =   $request->AstaAll;
        $currentname = $request->usernameAll;

        DB::table('asta_db.dms_table')->whereIn('table_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '16',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus data (' .$currentname.')'
        ]);
        return redirect()->route('Table_Domino_Susun')->with('success', alertTranslate('Data deleted'));
    }


    public function DominoQdestroy(Request $request)
    {
        $tableid = $request->tableid;
        if($tableid != '')
        {
            $dmq_table = DominoQTable::where('table_id', '=', $tableid)->first();
            DominoQTable::where('table_id', '=', $tableid)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '22',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data ('.$dmq_table->name.')'
            ]);
            return redirect()->route('Table_Domino_QQ')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Table_Domino_QQ')->with('alert', alertTranslate('Something wrong'));                
    }

    public function DominoQDeleteAll(Request $request)
    {
        $ids    =   $request->AstaAll;
        $currentname = $request->usernameAll;

        DB::table('asta_db.dmq_table')->whereIn('table_id', explode(",", $ids))->delete();
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '22',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus data (' .$currentname.')'
        ]);
        return redirect()->route('Table_Domino_QQ')->with('succes', alertTranslate('Data deleted'));
    
    }

}
