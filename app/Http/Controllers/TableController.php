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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for asta poker
     */
    public function index()
    {
        $menu     = MenuClass::menuName('Table Asta Poker');
        $mainmenu = MenuClass::menuName('Games');
        $submenu  = MenuClass::menuName('Asta Poker');
        // $tables = Table::select()->where([['tabletype', '!=','m'],['clubId','=','0'],['seasonId', '=', '0']])->orderBy('bb', 'asc')->orderBy('tablename', 'asc')->get();
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
        return view('pages.game_asta.table', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for big two
     */
    public function BigTwoindex()
    {
        $menu     = MenuClass::menuName('Table Big Two');
        $mainmenu = MenuClass::menuName('Games');
        $submenu  = MenuClass::menuName('Big Two');
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
        return view('pages.game_asta.bigTwoTable', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for Domino Susun
     */
    public function DominoSusunindex()
    {
        $menu     = MenuClass::menuName('Table Domino Susun');
        $mainmenu = MenuClass::menuName('Games');
        $submenu  = MenuClass::menuName('Domino Susun');
        $tables = DominoSusunTable::join('asta_db.dms_room', 'asta_db.dms_room.room_id', '=', 'asta_db.dms_table.room_id')
                ->select(
                    'asta_db.dms_room.name as roomname',
                    'asta_db.dms_table.name',
                    'asta_db.dms_table.max_player',
                    'asta_db.dms_table.game_state',
                    'asta_db.dms_table.current_turn_seat_id',
                    'asta_db.dms_table.total_bet',
                    'asta_db.dms_table.table_id',
                    'asta_db.dms_table.stake',
                    'asta_db.dms_table.min_buy',
                    'asta_db.dms_table.max_buy',
                    'asta_db.dms_table.timer',
                    'asta_db.dms_table.stake_pass'
                )
                ->get();
        $category = DominoSusunRoom::all();
        return view('pages.game_asta.dominoSusunTable', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for Domino Susun
     */
    public function DominoQindex()
    {
        $menu     = MenuClass::menuName('Table Domino QQ');
        $mainmenu = MenuClass::menuName('Games');
        $submenu  = MenuClass::menuName('Domino QQ');
        $tables = DominoQTable::join('asta_db.dmq_room', 'asta_db.dmq_room.room_id', '=', 'asta_db.dmq_table.room_id')
                  ->select(
                    'asta_db.dmq_room.name as roomname',
                    'asta_db.dmq_table.name',
                    'asta_db.dmq_table.max_player',
                    'asta_db.dmq_table.game_state',
                    'asta_db.dmq_table.current_turn_seat_id',
                    'asta_db.dmq_table.total_bet',
                    'asta_db.dmq_table.table_id',
                    'asta_db.dmq_table.stake',
                    'asta_db.dmq_table.min_buy',
                    'asta_db.dmq_table.max_buy',
                    'asta_db.dmq_table.timer'
                  )
                  ->get();
        $category = DominoQRoom::all();
        return view('pages.game_asta.dominoQTable', compact('tables', 'category', 'menu', 'mainmenu', 'submenu'));
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
     * store for asta poker
     */
    public function store(Request $request)
    {
        $category = $request->category;
        $sb       = $request->sb;
        $bb       = $request->bb;
        $minbuy   = $request->minbuy;
        $maxbuy  = $request->maxbuy;
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required',
            'minbuy'       => 'required|int',
            'maxbuy'       => 'required|int'          
            
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $bbvalidation = $minbuy / 10;
        $sbvalidation = $bbvalidation / 2;
        if($bb < $bbvalidation)
        {
            return back()->with('alert', 'your Big blind can\'t be under Minbuy divided 10 '.$bbvalidation.' ');
        } else if($sb < $sbvalidation)
        {
            return back()->with('alert', 'your Small Blind can\'t be under Big Blind divided 2 '.$sbvalidation.' ');
        }

        TpkTable::create([
            'name'          => $request->tableName,
            'room_id'        => $request->category,
            'max_player'    =>  '0',
            'small_blind'   =>  $sb,
            'big_blind'     =>  $bb,
            'jackpot'       =>  '0',
            'min_buy'       =>  $minbuy,
            'max_buy'       =>  $maxbuy,
            'timer'         =>  '0'
        ]);

        Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '3',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Create new in menu Asta Poker Table with name '.$request->tableName
        ]);

        return redirect()->route('Table_Asta_Poker')->with('success','Data Added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * store for asta poker
     */
     public function BigTwostore(Request $request)
     {
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required',
            
        ], [
            'category.integer'  => 'category is required'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $stake  = $request->stake;
        $minbuy = $request->minbuy;
        $maxbuy = $request->maxbuy;
        $minbuyvalidation = $stake * 3 * 13;
        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', 'Min Buy can\'t be under Stake multiplied by 3 multiplied 13 or under '.$minbuyvalidation);
        }  else if($minbuy > $maxbuy)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy');
        }

        BigTwoTable::create([
            'name'       => $request->tableName,
            'room_id'    => $request->category,
            'max_player' => '0',
            'turn'       => '0',
            'total_bet'  => '0',
            'stake'      => $stake,
            'min_buy'    => $minbuy,
            'max_buy'    => $maxbuy,
            'timer'      => '0'
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Big Two Table with name '.$request->tableName
        ]);
 
        return redirect()->route('Table_Big_Two')->with('success','Data Added');
     }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * store for domino susun
     */
    public function DominoSusunstore(Request $request)
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
        $minbuyvalidation = $stake * 10;
        $maxbuyvalidation = $minbuyvalidation * 4;
        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', 'Min Buy can\'t be under Stake multiplied by 10 or under '.$minbuyvalidation);
        }  else if($maxbuy < $maxbuyvalidation)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy multiplied by 4 or under '.$maxbuyvalidation);
        } else if($minbuy > $maxbuy)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy ');
        }

        DominoSusunTable::create([
            'name'                 => $request->tableName,
            'room_id'              => $request->category,
            'max_player'           => '0',
            'game_State'           => '0',
            'current_turn_seat_id' => '0',
            'total_bet'            => '0',
            'stake'                => $stake,
            'stake_pass'           => $stake,
            'min_buy'              => $minbuy,
            'max_buy'              => $maxbuy,
            'timer'                => '0'
        ]);

          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Domino Susun Table  with name '.$request->tableName
          ]);

       return redirect()->route('Table_Domino_Susun')->with('success','Data Added');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * store for domino QQ
     */
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
        $minbuyvalidation = $stake * 10;
        $maxbuyvalidation = $minbuyvalidation * 2;


        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', 'Min Buy can\'t be under Stake multiplied by 10 or under '.$minbuyvalidation);
        }  else if($maxbuy < $maxbuyvalidation)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy multiplied by 2 or under '.$maxbuyvalidation);
        } else if($minbuy > $maxbuy)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy');
        }

        DominoQTable::create([
            'name'                 => $request->tableName,
            'room_id'              => $request->category,
            'max_player'           => '0',
            'game_State'           => '0',
            'current_turn_seat_id' => '0',
            'total_bet'            => '0',
            'stake'                => $stake,
            'min_buy'              => $minbuy,
            'max_buy'              => $maxbuy,
            'timer'                => '0'
        ]);

          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Domino QQ Table with name '.$request->tableName
          ]);

       return redirect()->route('Table_Domino_QQ')->with('success','Data Added');
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
     * edit for asta poker
     */
    public function update(Request $request)
    {
        $pk           = $request->pk;
        $name         = $request->name;
        $value        = $request->value;
        $findcategory = TpkTable::where('table_id', '=', $pk)->first();
        $bbvalidation = $findcategory->min_buy / 10;
        $sbvalidation = $bbvalidation / 2;
  
        if($name == 'big_blind')
        {
            if($value < $bbvalidation)
            {
                return response()->json("your Small Blind can't be under Big Blind divided 2 or under ".$bbvalidation." ", 400);
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
                return response()->json("your Small Blind can't be under Big Blind divided 2 or under ".$findcategory->min_buy." ", 400);
            } else 
            {
                TpkTable::where('table_id', '=', $pk)->update([
                    'small_blind'   => $value
                  ]);
            }
        } else 
        {
            TpkTable::where('table_id', '=', $pk)->update([
                $name => $value
              ]);
        }
  
        switch ($name) {
            case "name":
                $name = "Table Name";
                break;
            case "roomid":
                $name = "room id";
                break;
            case "max_player":
                $name = "Max Player";
                break;
            case "small_blind":
                $name = "Small Blind";
                break;
            case "big_blind":
                $name = "Big Blind";
                break;
            case "jackpot":
                $name = "Jackpot";
                break;
            case "min_buy":
                $name = "Min Buy";
                break;
            case "max_buy":
                $name = "Max Buy";
                break;
            case "timer":
                $name = "Timer";
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' in menu Table Asta Poker with gameID '.$pk.' to '. $value
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * edit for asta big two
     */
    public function BigTwoupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        if($name == 'min_buy')
        {
            $validasiminbuy = BigTwoTable::where('table_id', '=', $pk)->first();
            $count          = $validasiminbuy->stake * 3 * 13;
            if($count > $value)
            {
                return response()->json("Min Buy can't be under Stake multiplied by 3 multiplied by 13 or under ".$count." ", 400);
            } else if($value > $validasiminbuy->max_buy)
            {
                return response()->json("Min Buy can't be Up To Max Date", 400);
            }
            BigTwoTable::where('table_id', '=', $pk)->update([
                'min_buy'   => $value
            ]); 
        } else if($name == 'max_buy')
        {
            $validasimaxbuy =BigTwoTable::where('table_id', '=', $pk)->first();
            if($value < $validasimaxbuy->min_buy)
            {
                return response()->json("Max Buy can't be under Min Buy", 400);
            } 
            BigTwoTable::where('table_id', '=', $pk)->update([
                'max_buy'   => $value
            ]); 
        } else 
        {
            BigTwoTable::where('table_id', '=', $pk)->update([
                $name => $value 
            ]);
        } 

        switch ($name) {
            case "name":
                $name = "Table Name";
                break;
            case "roomid":
                $name = "room id";
                break;
            case "turn":
                $name = "turn";
                break;
            case "total_bet":
                $name = "Total Bet";
                break;
            case "stake":
                $name = "Stake";
                break;
            case "min_buy":
                $name = "Min Buy";
                break;
            case "max_buy":
                $name = "Max Buy";
                break;
            default:
            "";
        }

    Log::create([
        'op_id' => Session::get('userId'),
        'action_id'   => '2',
        'datetime'        => Carbon::now('GMT+7'),
        'desc' => 'Edit '.$name.' in menu Table Big Two with roomID '.$pk.' to '. $value
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * edit for asta domino susun
     */
    public function DominoSusunupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $dmsroom     = DominoSusunTable::where('table_id', '=', $pk)->first();
        $countminbuy = $dmsroom->stake * 10;
        $countmaxbuy = $countminbuy * 4;
  
        if($name == 'stake')
        {

            DominoSusunTable::where('table_id', '=', $pk)->update([
                'stake'      => $value,
                'stake_pass' => $value,
            ]);
        } else if($name == 'min_buy')
        {
            if($value < $countminbuy)
            {
                return response()->json("Min Buy can't be under Stake multiplied by 10 or under ".$countminbuy." ", 400);
            } else if($value > $dmsroom->max_buy)
            {
                return response()->json("Min Buy can't be up to max date ", 400);
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
                return response()->json("Max Buy can't be under Stake multiplied by 4 or under ".$countmaxbuy." ", 400);
            } else if($value < $dmsroom->min_buy)
            {
                return response()->json("Max Buy can't be under Min Buy", 400);
            } else 
            {
                DominoSusunTable::where('table_id', '=', $pk)->update([
                    'max_buy' => $value 
                ]);
            }
        } else 
        {
            DominoSusunTable::where('table_id', '=', $pk)->update([
                $name => $value 
            ]);
        } 

        switch ($name) {
            case "name":
                $name = "Table Name";
                break;
            case "roomid":
                $name = "room id";
                break;
            case "max_player":
                $name = "Max Player";
                break;
            case "game_state":
                $name = "Game State";
                break;
            case "current_turn_seat_id":
                $name = "Current Turn Seat ID";
                break;
            case "total_bet":
                $name = "Total Bet";
                break;
            case "stake":
                $name = "Stake & Stake Pass";
                break;
            case "min_buy":
                $name = "Min Buy";
                break;
            case "max_buy":
                $name = "Max Buy";
                break;
            default:
            "";
        }

    Log::create([
        'op_id' => Session::get('userId'),
        'action_id'   => '2',
        'datetime'        => Carbon::now('GMT+7'),
        'desc' => 'Edit '.$name.' in menu Table Domino Susun with roomID '.$pk.' to '. $value
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * edit for asta domino susun
     */
    public function DominoQupdate(Request $request)
    {
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $dmqtable    = DominoQTable::where('table_id', '=', $pk)->first();
        $countminbuy = $dmqtable->stake * 10;
        $countmaxbuy = $countminbuy * 2;
  
        if($name == 'min_buy')
        {
            if($value < $countminbuy)
            {
                return response()->json("Min Buy can't be under Stake multiplied by 10 or under ".$countminbuy." ", 400);
            } else if($value > $dmqroom->max_buy)
            {
                return response()->json("Min Buy can't be up to Max Buy ".$countminbuy." ", 400);
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
                return response()->json("Max Buy can't be under Stake multiplied by 2 or under ".$countmaxbuy." ", 400);
            } else if($value < $dmqroom->min_buy)
            {
                return response()->json("Max Buy can't be under Min Buy ", 400);
            } else 
            {
                DominoQTable::where('table_id', '=', $pk)->update([
                    'max_buy' => $value 
                ]);
            }
        } else 
        {
            DominoQTable::where('table_id', '=', $pk)->update([
                $name => $value 
            ]);
        }

        switch ($name) {
            case "name":
                $name = "Table Name";
                break;
            case "roomid":
                $name = "room id";
                break;
            case "max_player":
                $name = "Max Player";
                break;
            case "game_state":
                $name = "Game State";
                break;
            case "current_turn_seat_id":
                $name = "Current Turn Seat ID";
                break;
            case "total_bet":
                $name = "Total Bet";
                break;
            default:
            "";
        }

    Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu table Domino QQ with roomID '.$pk.' to '. $value
    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * destroy for asta poker
     */
    public function destroy(Request $request)
    {
        $tableid = $request->tableid;
        if($tableid != '')
        {
            TpkTable::where('table_id', '=', $tableid)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Table Asta Poker with room ID '.$tableid
            ]);
            return redirect()->route('Table_Asta_Poker')->with('success','Data Deleted');
        }
        return redirect()->route('Table_Asta_Poker')->with('success','Something wrong');                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * destroy for asta big two
     */
    public function BigTwodestroy(Request $request)
    {
        $tableid = $request->tableid;
        if($tableid != '')
        {
            BigTwoTable::where('table_id', '=', $tableid)->delete();
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu table Big Two with room ID '.$tableid
            ]);
            return redirect()->route('Table_Big_Two')->with('success','Data Deleted');
        }
        return redirect()->route('Table_Big_Two')->with('success','Something wrong');                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * destroy for asta domino susun
     */
    public function DominoSusundestroy(Request $request)
    {
        $tableid = $request->tableid;
        if($tableid != '')
        {
            DominoSusunTable::where('table_id', '=', $tableid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete Domino Susun Table with room ID '.$tableid
            ]);
            return redirect()->route('Table_Domino_Susun')->with('success','Data Deleted');
        }
        return redirect()->route('Table_Domino_Susun')->with('success','Something wrong');                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * destroy for asta domino QQ
     */
    public function DominoQdestroy(Request $request)
    {
        $tableid = $request->tableid;
        if($tableid != '')
        {
            DominoQTable::where('table_id', '=', $tableid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu table Domino QQ with room ID '.$tableid
            ]);
            return redirect()->route('Table_Domino_QQ')->with('success','Data Deleted');
        }
        return redirect()->route('Table_Domino_QQ')->with('success','Something wrong');                
    }
}
