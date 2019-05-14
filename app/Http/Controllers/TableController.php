<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;
use App\Log;
use Session;
use Carbon\Carbon;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tables = Table::select()->where([['tabletype', '!=','m'],['clubId','=','0'],['seasonId', '=', '0']])->orderBy('bb', 'asc')->orderBy('tablename', 'asc')->get();
        $tables = Table::join('tpk_room', 'tpk_room.roomid', '=', 'tpk_table.roomid')->select('tpk_room.name as roomname', 'tpk_table.*')->get();
        return view('pages.game_asta.table', compact('tables'));
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
        Table::create([
            'dealerid'  => Session::get('dealerId'),
            'tablename' => $request->tableName,
            'tabletype' => $request->tabletype,
            'startTime' => Carbon::now('GMT+7')->timestamp
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
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        Table::where('gameID', '=', $pk)->update([
          $name => $value
        ]);
  
        switch ($name) {
            case "tablename":
                $name = "Table Name";
                break;
            case "tabletype":
                $name = "Table Type";
                break;
            case "botsAllowed":
                $name = "Bots";
                break;
            case "rakeRate":
                $name = "Rake";
                break;
            case "levelLimit":
                $name = "Level";
                break;
            case "seats":
                $name = "Seats";
                break;
            case "speed":
                $name = "Speed";
                break;
            case "sb":
                $name = "Small Blind";
                break;
            case "bb":
                $name = "Big Blind";
                break;
            case "baseSB":
                $name = "Small Blind";
                break;
            case "baseBB":
                $name = "Big Blind";
                break;
            case "tablelow":
                $name = "Min Buy";
                break;
            case "tablelimit":
                $name = "Max Buy";
                break;
            case "jackpotLow":
                $name = "Jackpot Low";
                break;
            case "jackpotMed":
                $name = "Jackpot Med";
                break;
            case "jackpotHi":
                $name = "Jackpot Hi";
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
