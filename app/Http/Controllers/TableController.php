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
use App\Table;
use App\Room;

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
        $menu  = MenuClass::menuName('Table Asta Poker');
        // $tables = Table::select()->where([['tabletype', '!=','m'],['clubId','=','0'],['seasonId', '=', '0']])->orderBy('bb', 'asc')->orderBy('tablename', 'asc')->get();
        $tables = Table::join('tpk_room', 'tpk_room.roomid', '=', 'tpk_table.roomid')
                  ->select(
                      'tpk_room.name as roomname',
                      'tpk_table.*'
                  )
                  ->get();
        $category = Room::all();
        return view('pages.game_asta.table', compact('tables', 'category', 'menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for big two
     */
    public function BigTwoindex()
    {
        $menu  = MenuClass::menuName('Table Big Two');
        $tables = BigTwoTable::join('bgt_room', 'bgt_room.roomid', '=', 'bgt_table.roomid')
                ->select(
                    'bgt_room.name as roomname',
                    'bgt_table.*'
                )
                ->get();
        $category = BigTwoRoom::all();
        return view('pages.game_asta.bigTwoTable', compact('tables', 'category', 'menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for Domino Susun
     */
    public function DominoSusunindex()
    {
        $menu  = MenuClass::menuName('Table Domino Susun');
        $tables = DominoSusunTable::join('dms_room', 'dms_room.roomid', '=', 'dms_table.roomid')
                ->select(
                    'dms_room.name as roomname',
                    'dms_table.*'
                )
                ->get();
        $category = DominoSusunRoom::all();
        return view('pages.game_asta.dominoSusunTable', compact('tables', 'category', 'menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index for Domino Susun
     */
    public function DominoQindex()
    {
        $menu  = MenuClass::menuName('Table Domino QQ');
        $tables = DominoQTable::join('dmq_room', 'dmq_room.roomid', '=', 'dmq_table.roomid')
                ->select(
                    'dmq_room.name as roomname',
                    'dmq_table.*'
                )
                ->get();
        $category = DominoQRoom::all();
        return view('pages.game_asta.dominoQTable', compact('tables', 'category', 'menu'));
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
        $validator = Validator::make($request->all(),[
            'tableName'     => 'required',
            'category'      => 'required',
            
        ], [
            'category.integer'  => 'category is required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        Table::create([
            'name'          => $request->tableName,
            'roomid'        => $request->category,
            'max_player'    =>  '0',
            'small_blind'   =>  '0',
            'big_blind'     =>  '0',
            'jackpot'       =>  '0'
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

        BigTwoTable::create([
            'name'         => $request->tableName,
            'roomid'       => $request->category,
            'max_player'   =>  '0',
            'turn'         =>  '0',
            'total_bet'    =>  '0',
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

        DominoSusunTable::create([
            'name'                  => $request->tableName,
            'roomid'                => $request->category,
            'max_player'            =>  '0',
            'game_State'            =>  '0',
            'current_turn_seatid'   =>  '0',
            'total_bet'             =>  '0',
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

        DominoQTable::create([
            'name'                  => $request->tableName,
            'roomid'                => $request->category,
            'max_player'            =>  '0',
            'game_State'            =>  '0',
            'current_turn_seatid'   =>  '0',
            'total_bet'             =>  '0',
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
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        Table::where('tableid', '=', $pk)->update([
          $name => $value
        ]);
  
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


        BigTwoTable::where('tableid', '=', $pk)->update([
        $name => $value
        ]);

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


        DominoSusunTable::where('tableid', '=', $pk)->update([
        $name => $value
        ]);

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
            case "current_turn_seatid":
                $name = "Current Turn Seat ID";
                break;
            case "total_bet":
                $name = "Total Bet";
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
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;


        DominoQTable::where('tableid', '=', $pk)->update([
        $name => $value
        ]);

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
            case "current_turn_seatid":
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
            DB::table('tpk_table')->where('tableid', '=', $tableid)->delete();
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
            DB::table('bgt_table')->where('tableid', '=', $tableid)->delete();
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
            DB::table('dms_table')->where('tableid', '=', $tableid)->delete();

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
            DB::table('dmq_table')->where('tableid', '=', $tableid)->delete();

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
