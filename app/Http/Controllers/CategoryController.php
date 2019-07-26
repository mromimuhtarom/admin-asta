<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\Group;
use App\Log;
use Session;
use Carbon\Carbon;
use Validator;

// asta poker model
use App\TpkRoom;

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
        $category = TpkRoom::select(
                        'name', 
                        'min_buy', 
                        'max_buy', 
                        'stake', 
                        'timer',
                        'room_id'
                    )
                    ->get();
        $menu     = MenuClass::menuName('Category Asta Poker');
        $submenu  = MenuClass::menuName('Asta Poker');
        $mainmenu = MenuClass::menuName('Games');
        return view('pages.game_asta.category', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big two index
     */
    public function BigTwoindex()
    {
        $category = BigTwoRoom::select(
                        'name', 
                        'stake', 
                        'min_buy', 
                        'max_buy', 
                        'timer',
                        'room_id'
                    )
                    ->get();
        
        $menu     = MenuClass::menuName('Category Big Two');
        $submenu  = MenuClass::menuName('Big Two');
        $mainmenu = MenuClass::menuName('Games');
        return view('pages.game_asta.bigTwoCategory', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big domino susun index
     */
    public function DominoSusunindex()
    {
        $category = DominoSusunRoom::select(
                        'name',
                        'stake',
                        'stake_pass',
                        'min_buy',
                        'max_buy',
                        'timer',
                        'room_id'
                    )
                    ->get();
        $menu     = MenuClass::menuName('Category Domino Susun');
        $submenu  = MenuClass::menuName('Domino Susun');
        $mainmenu = MenuClass::menuName('Games');
        return view('pages.game_asta.dominoSusunCategory', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * asta big domino QQ index
     */
    public function DominoQindex()
    {
        $category = DominoQRoom::select(
                        'name',
                        'stake',
                        'min_buy',
                        'max_buy',
                        'timer',
                        'room_id'
                    )
                    ->get();
        $menu     = MenuClass::menuName('Category Domino QQ');
        $submenu  = MenuClass::menuName('Domino QQ');
        $mainmenu = MenuClass::menuName('Games');
        return view('pages.game_asta.dominoQCategory', compact('category', 'menu', 'submenu', 'mainmenu'));
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
        $validator = Validator::make($request->all(),[
            'categoryName'  => 'required',
            'minbuy'        => 'required|integer',
            'maxbuy'        => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $categoryname   = $request->categoryName;
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;
        

        $tpk_category =  TpkRoom::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy,
            'stake'     => '0',
            'timer'     => '0'
        ]);
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new category Asta Poker in menu Category Asta Poker with name'. $tpk_category->name
        ]);

        return redirect()->route('Category_Asta_Poker')->with('success','Data Added');

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
        $validator = Validator::make($request->all(),[
            'categoryName'  => 'required',
            'minbuy'        => 'required|integer',
            'maxbuy'        => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $categoryname   = $request->categoryName;
        $stake          = $request->stake;
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;

        $minbuyvalidation = $stake * 3 * 13;
        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', 'Min Buy can\'t be under Stake multiplied by 3 multiplied 13 or under '.$minbuyvalidation);
        }  else if($minbuy > $maxbuy)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy');
        }

        $bgt_category = BigTwoRoom::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy,
            'stake'     => $stake,
            'timer'     => '0'
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new Category Asta Big Two in menu Category Asta Big Two with name '. $bgt_category->name
        ]);
 
        return redirect()->route('Category_Big_Two')->with('success','Data Added');
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
        $validator = Validator::make($request->all(),[
            'categoryName'  => 'required',
            'minbuy'        => 'required|integer',
            'maxbuy'        => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $categoryname     = $request->categoryName;
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

        $dms_category = DominoSusunRoom::create([
            'name'          => $categoryname,
            'min_buy'       => $minbuy,
            'max_buy'       => $maxbuy,
            'stake'         => $stake,
            'stake_pass'    => $stake,
            'timer'         => '0'
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new Category Domino Susun in menu Category Domino Susun with name'. $dms_category->name
        ]);

        return redirect()->route('Category_Domino_Susun')->with('success','Data Added');

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
        $validator = Validator::make($request->all(),[
            'categoryName'  => 'required',
            'minbuy'        => 'required|integer',
            'maxbuy'        => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $categoryname = $request->categoryName;
        $minbuy       = $request->minbuy;
        $maxbuy       = $request->maxbuy;
        $stake        = $request->stake;

        $minbuyvalidation = $stake * 10;
        $maxbuyvalidation = $minbuyvalidation * 2;
        if($minbuy < $minbuyvalidation)
        {
            return back()->with('alert', 'Min Buy can\'t be under Stake multiplied by 10 or under '.$minbuyvalidation);
        }  else if($maxbuy < $maxbuyvalidation)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy multiplied by 4 or under '.$maxbuyvalidation);
        } else if($minbuy > $maxbuy)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy');
        }

        $dmq_category = DominoQRoom::create([
            'name'          => $categoryname,
            'min_buy'       => $minbuy,
            'max_buy'       => $maxbuy,
            'stake'         => $stake,
            'timer'         => '0'
        ]);


        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new Category Domino QQ in menu Category Domino QQ with name '. $dmq_category->name
        ]);

        return redirect()->route('Category_Domino_QQ')->with('success','Data Added');

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
  
  
        TpkRoom::where('room_id', '=', $pk)->update([
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
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.'in menu Category Asta Poker with roomid '.$pk.' to '. $value
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
  
        if($name == 'min_buy')
        {
            $validasiminbuy = BigTwoRoom::where('room_id', '=', $pk)->first();
            $count          = $validasiminbuy->stake * 3 * 13;
            if($count > $value)
            {
                return response()->json("Min Buy can't be under Stake multiplied by 3 multiplied by 13 or under ".$count." ", 400);
            } else if($value > $validasiminbuy->max_buy)
            {
                return response()->json("Min Buy can't be Up To Max Date", 400);
            }
            BigTwoRoom::where('room_id', '=', $pk)->update([
                'min_buy'   => $value
            ]); 
        } else if($name == 'max_buy')
        {
            $validasimaxbuy = BigTwoRoom::where('room_id', '=', $pk)->first();
            if($value < $validasimaxbuy->min_buy)
            {
                return response()->json("Max Buy can't be under Min Buy", 400);
            } 
            BigTwoRoom::where('room_id', '=', $pk)->update([
                'max_buy'   => $value
            ]); 
        } else 
        {
            BigTwoRoom::where('room_id', '=', $pk)->update([
                $name => $value 
            ]);
        } 
  
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
                $name = "Stake";
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
          'desc'      => 'Edit '.$name.' in menu Category Big Two with roomid '.$pk.' to '. $value
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
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $dmsroom     = DominoSusunRoom::where('room_id', '=', $pk)->first();
        $countminbuy = $dmsroom->stake * 10;
        $countmaxbuy = $countminbuy * 4;
  
        if($name == 'stake')
        {

            DominoSusunRoom::where('room_id', '=', $pk)->update([
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
                DominoSusunRoom::where('room_id', '=', $pk)->update([
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
                DominoSusunRoom::where('room_id', '=', $pk)->update([
                    'max_buy' => $value 
                ]);
            }
        } else 
        {
            DominoSusunRoom::where('room_id', '=', $pk)->update([
                $name => $value 
            ]);
        } 
  
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
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' in menu Category Domino Susun with roomid '.$pk.' to '. $value
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
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $dmqroom     = DominoQRoom::where('room_id', '=', $pk)->first();
        $countminbuy = $dmqroom->stake * 10;
        $countmaxbuy = $countminbuy * 2;
  
        if($name == 'stake')
        {
            $minbuy = $value * 10;
            $maxbuy = $minbuy *2;
            DominoQRoom::where('room_id', '=', $pk)->update([
                'stake'   => $value,
                'min_buy' => $minbuy,
                'max_buy' => $maxbuy
            ]);
        } 
        else if($name == 'min_buy')
        {
            if($value < $countminbuy)
            {
                return response()->json("Min Buy can't be under Stake multiplied by 10 or under ".$countminbuy." ", 400);
            } else if($value > $dmqroom->max_buy)
            {
                return response()->json("Min Buy can't be up to Max Buy ".$countminbuy." ", 400);
            } else 
            {
                DominoQRoom::where('room_id', '=', $pk)->update([
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
                DominoQRoom::where('room_id', '=', $pk)->update([
                    'max_buy' => $value 
                ]);
            }
        } else 
        {
            DominoQRoom::where('room_id', '=', $pk)->update([
                $name => $value 
            ]);
        }
  
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
          'op_id'       => Session::get('userId'),
          'action_id'   => '2',
          'datetime'    => Carbon::now('GMT+7'),
          'desc' => 'Edit '.$name.' in menu Category Domino QQ with roomid '.$pk.' to '. $value
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
            TpkRoom::where('room_id', '=', $roomid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Category Asta Poker with Room ID '.$roomid
            ]);

            return redirect()->route('Category_Asta_Poker')->with('success','Data Deleted');
        }
        return redirect()->route('Category_Asta_Poker')->with('success','Something wrong');      
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
            BigTwoRoom::where('room_id', '=', $roomid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Category Asta Big Two with Room ID '.$roomid
            ]);
            return redirect()->route('Category_Big_Two')->with('success','Data Deleted');
        }
        return redirect()->route('Category_Big_Two')->with('success','Something wrong');      
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
            DominoSusunRoom::where('room_id', '=', $roomid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Category Domino Susun with Room ID '.$roomid
            ]);
            return redirect()->route('Category_Domino_Susun')->with('success','Data Deleted');
        }
        return redirect()->route('Category_Domino_Susun')->with('success','Something wrong');      
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
            DominoQRoom::where('room_id', '=', $roomid)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Category Domino QQ with Room ID '.$roomid
            ]);
            return redirect()->route('Category_Domino_QQ')->with('success','Data Deleted');
        }
        return redirect()->route('Category_Domino_QQ')->with('success','Something wrong');      
    }
}
