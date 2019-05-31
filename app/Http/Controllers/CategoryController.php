<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\Group;
use App\Log;
use Session;
use Carbon\Carbon;

// asta poker model
use App\Room;

// asta big two model
use App\BigTwoRoom;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta poker index
     */
    public function index()
    {
        $category = Room::all();
        $menu  = MenuClass::menuName('Category Asta Poker');
        return view('pages.game_asta.category', compact('category', 'menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big two index
     */
     public function BigTwoindex()
     {
         $category = BigTwoRoom::all();
         return view('pages.game_asta.bigTwoCategory', compact('category'));
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
     * asta poker store
     */
    public function store(Request $request)
    {

        $categoryname   = $request->categoryName;
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;
        

        Room::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy,
            'stake'     => '0',
            'timer'     => '0'
        ]);

        return redirect()->route('Category-view')->with('success','Data Added');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * asta big two store
     */
     public function BigTwostore(Request $request)
     {
        $categoryname   = $request->categoryName;
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;

        BigTwoRoom::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy,
            'stake'     => '0',
            'timer'     => '0'
        ]);
 
           return redirect()->route('BigTwoCategory-view')->with('success','Data Added');
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
     * asta poker update
     */
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        Room::where('roomid', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Room Name";
                break;
            case "min_buy":
                $name = "Min Buy";
                break;
            case "max_buy":
                $name = "Max Buy";
                break;
            case "stake":
                $name = "stake";
                break;
            case "timer":
                $name = "timer";
                break;
            default:
              "";
        }
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '15',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' groupID '.$pk.' to '. $value
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta big two update
     */
    public function BigTwoupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        BigTwoRoom::where('roomid', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Room Name";
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
            case "stake":
                $name = "Stake";
                break;
            case "timer":
                $name = "Timer";
                break;
            default:
              "";
        }
  
        // Log::create([
        //   'operator_id' => Session::get('userId'),
        //   'menu_id'     => '15',
        //   'action_id'   => '2',
        //   'date'        => Carbon::now('GMT+7'),
        //   'description' => 'Edit '.$name.' groupID '.$pk.' to '. $value
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta poker destroy
     */
    public function destroy(Request $request)
    {
        $roomid = $request->categoryid;
        if($roomid != '')
        {
            Room::where('roomid', '=', $roomid)->delete();
            return redirect()->route('Category-view')->with('success','Data Deleted');
        }
        return redirect()->route('Category-view')->with('success','Something wrong');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta big two destroy 
     */
    public function BigTwodestroy(Request $request)
    {
        $roomid = $request->categoryid;
        if($roomid != '')
        {
            BigTwoRoom::where('roomid', '=', $roomid)->delete();
            return redirect()->route('BigTwoCategory-view')->with('success','Data Deleted');
        }
        return redirect()->route('BigTwoCategory-view')->with('success','Something wrong');      
    }
}
