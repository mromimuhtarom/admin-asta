<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerLevel;
use App\PlayerRank;
use App\Log;
use Session;
use Carbon\Carbon;
use DB;
use App\Classes\MenuClass;

class PlayersLevelController extends Controller
{
    public function index()
    {
        $playerslevel = PlayerLevel::all();
        $playersrank = PlayerRank::all();
        $menu        = MenuClass::menuName('L_PLAYERS');
        $mainmenu    = MenuClass::menuName('L_PLAYERS_LEVEL');
        return view('pages.players.players_level', compact('playerslevel', 'playersrank', 'menu', 'mainmenu'));
    }

    public function store(Request $request)
    {
        $level      = $request->level;
        $experience = $request->experience;

        $levels = PlayerLevel::where('level', '=', $level)->first();
        if($levels):
            return back()->with('alert', 'level is already used please use another level');
        endif;

        PlayerLevel::create([
            'level'      => $level,
            'experience' => $experience
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '9',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data level pemain ('.$level.')'
        ]);

        return back()->with('success', alertTranslate("L_DATA_INPUT_SUCCESSFULL"));
    }

    public function store_rank(Request $request)
    {
        $name = $request->name;
        $level = $request->level;
        

        PlayerRank::create([
            'name'  =>  $name,
            'level' =>  $level
        ]);

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '9',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data peringkat pemain ('.$name.')'
        ]);

        return back()->with('success', alertTranslate('L_DATA_INPUT_SUCCESSFULL'));
    }

    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = PlayerLevel::where('level', '=', $pk)->first();

        PlayerLevel::where('level', '=', $pk)->update([
            $name   =>  $value
        ]);

        switch($name){
            case "level":
                $name = "Level";
                $currentvalue = $currentname->level;
                break;
            case "experience":
                $name = "Experience";
                $currentvalue = $currentname->experience;
                break;
            default:
                "";
        }
    
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '9',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' data level pemain ('.$pk.') '.$currentvalue.' => '. $value
        ]);

    }

    public function update_rank(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        $currentname = PlayerRank::where('id', '=', $pk)->first();

        PlayerRank::where('id', '=', $pk)->update([
            $name   =>  $value
        ]);

        switch($name){
            case "name":
                $name = "Nama";
                $currentvalue = $currentname->name;
                break;
            case "level":
                $name = "Level";
                $currentvalue = $currentname->level;
                break;
            default:
                "";
        }
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '9',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' peringkat pemain ('.$pk.') '.$currentvalue.' => '. $value
        ]);

    }


    public function destroy(Request $request)
    {
        $level = $request->level;
   
        if($level != '')
        {
            DB::table('asta_db.user_level')->where('level', '=', $level)->delete();
    
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '9',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data level pemain ('.$level.')'
            ]);
            return redirect()->route('Players_Level')->with('success', alertTranslate("L_DATA_DELETED"));
        }
        return redirect()->route('Players_Level')->with('alert', alertTranslate('L_SOMETHING_WRONG'));
       
    }


    public function destroy_rank(Request $request)
    {
        $id = $request->id;
   
        if($id != '')
        {
            $user_rank = DB::table('asta_db.user_rank')->where('id', '=', $id)->first();
            DB::table('asta_db.user_rank')->where('id', '=', $id)->delete();
    
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '9',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data peringkat pemain ('.$user_rank.')'
            ]);
            return redirect()->route('Players_Level')->with('success', alertTranslate('L_DATA_DELETED'));
        }
        return redirect()->route('Players_Level')->with('alert', alertTranslate("L_SOMETHING_WRONG"));
       
    }

    public function delete_all(Request $request)
    {
        $levelall = $request->levelAll;
        $currentname = $request->usernameAll;
        
        DB::table('asta_db.user_level')->whereIn('level', explode(",", $levelall))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus data Level pemain ('.$currentname.')'
        ]);
        return redirect()->route('Players_Level')->with('success', alertTranslate('L_DATA_DELETED'));        
    }

    public function delete_allRank(Request $request)
    {
        $id = $request->id;
        $currentname = $request->usernameAll;
        
        DB::table('asta_db.user_rank')->whereIn('id', explode(",", $id))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus data Peringkat pemain ('.$curentname.')'
        ]);
        return redirect()->route('Players_Level')->with('success', AlertTranslate('L_DATA_DELETED'));        
    }
}
