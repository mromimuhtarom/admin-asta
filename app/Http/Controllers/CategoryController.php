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

// asta domino susun model
use App\DominoSusunRoom;

// asta domino QQ model
use App\DominoQRoom;

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
        $menu  = MenuClass::menuName('Category Asta Big Two');
        return view('pages.game_asta.bigTwoCategory', compact('category', 'menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big domino susun index
     */
    public function DominoSusunindex()
    {
        $category = DominoSusunRoom::all();
        return view('pages.game_asta.dominoSusunCategory', compact('category'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big domino QQ index
     */
    public function DominoQindex()
    {
        $category = DominoQRoom::all();
        return view('pages.game_asta.dominoQCategory', compact('category'));
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
        

        $tpk_category =  Room::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy,
            'stake'     => '0',
            'timer'     => '0'
        ]);
        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '61',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Category Asta Poker'. $tpk_category->name
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

        $bgt_category = BigTwoRoom::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy,
            'stake'     => '0',
            'timer'     => '0'
        ]);

        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '62',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Category Asta Big Two'. $bgt_category->name
        ]);
 
        return redirect()->route('BigTwoCategory-view')->with('success','Data Added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * asta domino susun store
     */
    public function DominoSusunstore(Request $request)
    {

        $categoryname   = $request->categoryName;
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;
        

        $dms_category = DominoSusunRoom::create([
            'name'          => $categoryname,
            'min_buy'       => $minbuy,
            'max_buy'       => $maxbuy,
            'stake'         => '0',
            'stake_pass'    => '0',
            'timer'         => '0'
        ]);

        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '62',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Category Domino Susun'. $dms_category->name
        ]);

        return redirect()->route('DominoSCategory-view')->with('success','Data Added');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * asta domino QQ store
     */
    public function DominoQstore(Request $request)
    {

        $categoryname   = $request->categoryName;
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;
        

        $dmq_category = DominoQRoom::create([
            'name'          => $categoryname,
            'min_buy'       => $minbuy,
            'max_buy'       => $maxbuy,
            'stake'         => '0',
            'timer'         => '0'
        ]);


        Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '64',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Category Domino QQ'. $dmq_category->name
        ]);

        return redirect()->route('DominoQCategory-view')->with('success','Data Added');

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
          'menu_id'     => '61',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' roomid '.$pk.' to '. $value
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
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '62',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' roomid '.$pk.' to '. $value
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta domino susun update
     */
    public function DominoSusunupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        DominoSusunRoom::where('roomid', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Room Name";
                break;
            case "stake":
                $name = "Stake";
                break;
            case "stake_pass":
                $name = "Stake Pass";
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
          'operator_id' => Session::get('userId'),
          'menu_id'     => '63',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' roomid '.$pk.' to '. $value
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta domino QQ update
     */
    public function DominoQupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        DominoQRoom::where('roomid', '=', $pk)->update([
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
            case "timer":
                $name = "Timer";
                break;
            default:
              "";
        }
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '64',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' roomid '.$pk.' to '. $value
        ]);
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

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '61',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Category Asta Poker Room ID '.$roomid
            ]);

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

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '62',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Category Asta Big Two Room ID '.$roomid
            ]);
            return redirect()->route('BigTwoCategory-view')->with('success','Data Deleted');
        }
        return redirect()->route('BigTwoCategory-view')->with('success','Something wrong');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta domino susun destroy 
     */
    public function DominoSusundestroy(Request $request)
    {
        $roomid = $request->categoryid;
        if($roomid != '')
        {
            DominoSusunRoom::where('roomid', '=', $roomid)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '63',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Category Domino Susun Room ID '.$roomid
            ]);
            return redirect()->route('DominoSCategory-view')->with('success','Data Deleted');
        }
        return redirect()->route('DominoSCategory-view')->with('success','Something wrong');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * asta domino QQ destroy 
     */
    public function DominoQdestroy(Request $request)
    {
        $roomid = $request->categoryid;
        if($roomid != '')
        {
            DominoQRoom::where('roomid', '=', $roomid)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '64',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Category Domino QQ Room ID '.$roomid
            ]);
            return redirect()->route('DominoQCategory-view')->with('success','Data Deleted');
        }
        return redirect()->route('DominoQCategory-view')->with('success','Something wrong');      
    }
}
