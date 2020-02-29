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
        $menu     = MenuClass::menuName('L_CATEGORY_ASTA_POKER');
        $submenu  = MenuClass::menuName('L_ASTA_POKER');
        $mainmenu = MenuClass::menuName('L_GAMES');
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
        
        $menu     = MenuClass::menuName('L_CATEGORY_BIG_TWO');
        $submenu  = MenuClass::menuName('L_BIG_TWO');
        $mainmenu = MenuClass::menuName('L_GAMES');
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
        $menu     = MenuClass::menuName('L_CATEGORY_DOMINO_SUSUN');
        $submenu  = MenuClass::menuName('L_DOMINO_SUSUN');
        $mainmenu = MenuClass::menuName('L_GAMES');
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
        $menu     = MenuClass::menuName('L_CATEGORY_DOMINO_QQ');
        $submenu  = MenuClass::menuName('L_DOMINO_QQ');
        $mainmenu = MenuClass::menuName('L_GAMES');
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
        $currentname = TpkRoom::where('room_id', '=', $pk)->first();
  
        TpkRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                $currentvalue = $currentname->name;
                break;
            case "min_buy":
                $name = "Minimal Beli";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                $currentvalue = $currentname->max_buy;
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '14',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' dengan nama table '.$currentname->name.'. '.$currentvalue.' => '. $value
        ]);
    }

    
    public function BigTwoupdate(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = BigTwoRoom::where('room_id', '=', $pk)->first();

        BigTwoRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                $currentvalue = $currentname->name;
                break;
            case "min_buy":
                $name = "Minimal Beli";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                $currentvalue = $currentname->max_buy;
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '17',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' dengan nama table '.$currentname->name.'. '.$currentvalue.' => '. $value
        ]);

        
    }

    public function DominoSusunupdate(Request $request)
    {
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $currentname = DominoSusunRoom::where('room_id', '=', $pk)->first();

        DominoSusunRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                $currentvalue = $currentname->name;
                break;
            case "min_buy":
                $name = "Minimal Beli";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                $currentvalue = $currentname->max_buy;
                break;
            default:
              "";
        }
  
        Log::create([
          'op_id'     => Session::get('userId'),
          'action_id' => '20',
          'datetime'  => Carbon::now('GMT+7'),
          'desc'      => 'Edit '.$name.' dengan nama table '.$currentname->name.'. '.$currentvalue.' => '. $value
        ]);
    }


    public function DominoQupdate(Request $request)
    {
        $pk          = $request->pk;
        $name        = $request->name;
        $value       = $request->value;
        $currentname = DominoQRoom::where('room_id', '=', $pk)->first();
        
        DominoQRoom::where('room_id', '=', $pk)->update([
            $name => $value 
        ]);
  
        switch ($name) {
            case "name":
                $name = "Nama Ruang";
                $currentvalue = $currentname->name;
                break;
            case "min_buy":
                $name = "Minimal Beli";
                $currentvalue = $currentname->min_buy;
                break;
            case "max_buy":
                $name = "Maksimal Beli";
                $currentvalue = $currentname->max_buy;
                break;
        }
  
        Log::create([
          'op_id'       => Session::get('userId'),
          'action_id'   => '23',
          'datetime'    => Carbon::now('GMT+7'),
          'desc' => 'Edit '.$name.' nama table '.$currentname->name.'. '.$currentvalue.' => '. $value
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
                'action_id' => '14',
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
                'action_id' => '17',
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
                'action_id' => '20',
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
                'action_id' => '23',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Kategori Domino QQ dengan RuangID '.$roomid
            ]);
            return redirect()->route('Category_Domino_QQ')->with('success', alertTranslate('Data Deleted'));
        }
        return redirect()->route('Category_Domino_QQ')->with('alert', alertTranslate('Something wrong'));      
    }
}
 