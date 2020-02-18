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
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data level pemain di menu level pemain dengan level '.$level
        ]);

        return back()->with('success', alertTranslate("Data input successfull"));
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
            'op_id'     => Session::get('user_id'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data peringkat pemain di menu level pemain dengan nama level '.$name
        ]);

        return back()->with('success', alertTranslate('Data input successfull'));
    }

    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        PlayerLevel::where('level', '=', $pk)->update([
            $name   =>  $value
        ]);

        switch($name){
            case "level":
                $name = "Level";
                break;
            case "experience":
                $name = "Experience";
                break;
            default:
                "";
        }

        Log::create([
            'op_id'     => Session::get('user_id'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' data level pemain di menu Level Pemain dengan level '.$pk.' menjadi '. $value
        ]);

    }

    public function update_rank(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        PlayerRank::where('id', '=', $pk)->update([
            $name   =>  $value
        ]);

        switch($name){
            case "name":
                $name = "Nama";
                break;
            case "level":
                $name = "Level";
                break;
            default:
                "";
        }
        Log::create([
            'op_id'     => Session::get('user_id'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' data peringkat pemain di menu Level Pemain dengan level '.$pk.' menjadi '. $value
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
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data level pemain di menu Level Pemain dengan Level '.$level
            ]);
            return redirect()->route('Players_Level')->with('success', alertTranslate("Data deleted"));
        }
        return redirect()->route('Players_Level')->with('alert', alertTranslate('Something wrong'));
       
    }


    public function destroy_rank(Request $request)
    {
        $id = $request->id;
   
        if($id != '')
        {
            DB::table('asta_db.user_rank')->where('id', '=', $id)->delete();
    
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus data peringkat pemain di menu Level Pemain dengan ID '.$id
            ]);
            return redirect()->route('Players_Level')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Players_Level')->with('alert', alertTranslate("Something wrong"));
       
    }

    public function delete_all(Request $request)
    {
        $levelall = $request->levelAll;
        
        DB::table('asta_db.user_level')->whereIn('level', explode(",", $levelall))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus data Level pemain di menu Level Pemain dengan level '.$levelall
        ]);
        return redirect()->route('Players_Level')->with('success', alertTranslate('Data deleted'));        
    }

    public function delete_allRank(Request $request)
    {
        $id = $request->id;
        
        DB::table('asta_db.user_rank')->whereIn('id', explode(",", $id))->delete();
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus data Peringkat pemain di menu Level Pemain dengan id '.$id
        ]);
        return redirect()->route('Players_Level')->with('success', AlertTranslate('Data deleted'));        
    }
}
