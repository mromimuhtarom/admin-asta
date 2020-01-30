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
        return view('pages.game_asta.asta_poker.category', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

    
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
        return view('pages.game_asta.big_two.bigTwoCategory', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

   
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
        return view('pages.game_asta.domino_susun.dominoSusunCategory', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

    
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
        return view('pages.game_asta.domino_qq.dominoQCategory', compact('category', 'menu', 'submenu', 'mainmenu'));
    }

    
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

        return redirect()->route('Category_Asta_Poker')->with('success', alertTranslate('Data Added'));

    }

    
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
 
        return redirect()->route('Category_Big_Two')->with('success', alertTranslate('Data Added'));
    }

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

        return redirect()->route('Category_Domino_Susun')->with('success', alertTranslate('Data Added'));

    }

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

        return redirect()->route('Category_Domino_QQ')->with('success', alertTranslate('Data Added'));

    }

    
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

            return redirect()->route('Category_Asta_Poker')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Category_Asta_Poker')->with('alert', alertTranslate('Something wrong'));      
    }


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
            return redirect()->route('Category_Big_Two')->with('success', alertTranslate('Data Deleted'));
        }
     return redirect()->route('Category_Big_Two')->with('alert', alertTranslate('Something wrong'));      
    }

    
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
            return redirect()->route('Category_Domino_Susun')->with('success', alertTranslate('Data Deleted'));
        }
        return redirect()->route('Category_Domino_Susun')->with('alert', alertTranslate('Something wrong'));      
    }

    
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
            return redirect()->route('Category_Domino_QQ')->with('success', alertTranslate('Data Deleted'));
        }
        return redirect()->route('Category_Domino_QQ')->with('alert', alertTranslate('Something wrong'));      
    }
}
 