<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use Session;
use DB;
use Carbon\Carbon;
use App\Classes\MenuClass;

// asta poker model
use App\Table;
use App\Room;

// asta big 2 model
use App\BigTwoTable;
use App\BigTwoRoom;

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
        $menu  = MenuClass::menuName('Table Asta Big Two');
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
        Table::create([
            'name' => $request->tableName,
            'roomid'    => $request->category,
            'max_player'    =>  '0',
            'small_blind'   =>  '0',
            'big_blind'     =>  '0',
            'jackpot'       =>  '0'
        ]);

        Log::create([
        'operator_id' => Session::get('userId'),
        'menu_id'     => '14',
        'action_id'   => '3',
        'date'        => Carbon::now('GMT+7'),
        'description' => 'Create new Table with name '.$request->tableName
        ]);

        return redirect()->route('Table-view')->with('success','Data Added');
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
         BigTwoTable::create([
             'name'         => $request->tableName,
             'roomid'       => $request->category,
             'max_player'   =>  '0',
             'turn'         =>  '0',
             'total_bet'    =>  '0',
         ]);
 
        //    Log::create([
        //      'operator_id' => Session::get('userId'),
        //      'menu_id'     => '14',
        //      'action_id'   => '3',
        //      'date'        => Carbon::now('GMT+7'),
        //      'description' => 'Create new Big Two Table with name '.$request->tableName
        //    ]);
 
        return redirect()->route('BigTwoTable-view')->with('success','Data Added');
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
          'operator_id' => Session::get('userId'),
          'menu_id'     => '14',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' gameID '.$pk.' to '. $value
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
   
        // Log::create([
        // 'operator_id' => Session::get('userId'),
        // 'menu_id'     => '14',
        // 'action_id'   => '2',
        // 'date'        => Carbon::now('GMT+7'),
        // 'description' => 'Edit '.$name.' gameID '.$pk.' to '. $value
        // ]);
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
            return redirect()->route('Table-view')->with('success','Data Deleted');
        }
        return redirect()->route('Table-view')->with('success','Something wrong');                
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
             return redirect()->route('BigTwoTable-view')->with('success','Data Deleted');
         }
         return redirect()->route('BigTwoTable-view')->with('success','Something wrong');                
     }
}
