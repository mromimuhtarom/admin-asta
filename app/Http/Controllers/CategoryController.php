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
            'max_buy'   => $maxbuy
        ]);
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu kategori Asta Poker dengan nama'. $tpk_category->name
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
        $minbuy         = $request->minbuy;
        $maxbuy         = $request->maxbuy;

        if($minbuy > $maxbuy)
        {
            return back()->with('alert', 'Max Buy can\'t be under Min Buy');
        }

        $bgt_category = BigTwoRoom::create([
            'name'      => $categoryname,
            'min_buy'   => $minbuy,
            'max_buy'   => $maxbuy
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu Kategori Asta Big Two dengan nama '. $bgt_category->name
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

        $dms_category = DominoSusunRoom::create([
            'name'          => $categoryname,
            'min_buy'       => $minbuy,
            'max_buy'       => $maxbuy,
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu Kategori Domino Susun dengan nama'. $dms_category->name
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

        $dmq_category = DominoQRoom::create([
            'name'          => $categoryname,
            'min_buy'       => $minbuy,
            'max_buy'       => $maxbuy
        ]);


        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu Kategori Domino QQ dengan nama '. $dmq_category->name
        ]);

        return redirect()->route('Category_Domino_QQ')->with('success','Data Added');

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
                $name = "Nama Ruang";
                break;
            case "min_buy":
                $name = "Minimal Beli";
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                break;
            case "timer":
                $name = "Pengatur Waktu";
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.'di menu Kategori Asta Poker dengan Ruangid '.$pk.' menjadi '. $value
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

        BigTwoRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                break;
            case "min_buy":
                $name = "Minimal Beli";
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                break;
            case "timer":
                $name = "Pengatur Waktu";
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' di menu KategorI Big Two dengan Ruangid '.$pk.' menjadi '. $value
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

        DominoSusunRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                break;
            case "min_buy":
                $name = "Minimal Beli";
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                break;
            case "timer":
                $name = "Pengatur Waktu";
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '2',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' di menu Kategory Domino Susun dengan Ruangid '.$pk.' menjadi '. $value
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
        
        DominoQRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                break;
            case "min_buy":
                $name = "Minimal Beli";
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                break;
            case "timer":
                $name = "Pengatur Waktu";
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'       => Session::get('userId'),
          'action_id'   => '2',
          'datetime'    => Carbon::now('GMT+7'),
          'desc' => 'Edit '.$name.' di menu KategorI Domino QQ dengan Ruangid '.$pk.' menjadi '. $value
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
                'desc'      => 'Hapus di menu Kategori Asta Poker dengan RuangID '.$roomid
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
                'desc'      => 'Hapus di menu Kategori Asta Big Two dengan RuangID '.$roomid
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
                'desc'      => 'Hapus di menu Kategory Domino Susun dengan RuangID '.$roomid
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
                'desc'      => 'Hapus di menu Kategori Domino QQ dengan RuangID '.$roomid
            ]);
            return redirect()->route('Category_Domino_QQ')->with('success','Data Deleted');
        }
        return redirect()->route('Category_Domino_QQ')->with('success','Something wrong');      
    }
}
