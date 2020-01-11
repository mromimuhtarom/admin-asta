<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Carbon\Carbon;
use DB;
use App\AvatarPlayer;
use App\Classes\MenuClass;
use Response;
use Validator;
use App\ConfigText;
use App\Log;


class AvatarPlayerController extends Controller
{
    public function index()
    {
        $avatarPlayer   =   AvatarPlayer::select(
                                'id',
                                'name',
                                'path'
                            )
                            ->get();
        $menu           =   MenuClass::menuName('Avatar player');
        $mainmenu       =   MenuClass::menuName('Players');
        $timenow        =   Carbon::now('GMT+7');

        // --- Disabled Enabled --- //
        $active         =   ConfigText::select(
                                'name',
                                'value'
                            )
                            ->where('id', '=', 4)
                            ->first();
        $value          =   str_replace(':', ',', $active->value);
        $endis          =   explode(",", $value);
        
        
        return view('pages.players.avatar_player', compact('avatarPlayer', 'menu', 'endis', 'mainmenu', 'timenow'));
    }


  
    public function store(Request $request)
    {
        $id     =   AvatarPlayer::select('id')
                    ->orderBy('id', 'desc')
                    ->first();

        $validator = Validator::make($request->all(),[
            'title'     =>  'required',
            'file'      =>  'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($id === NULL)
        {
            $id_last = 0;
        } else {
            $id_last = $id->id;
        }

        $id_new                 =   $id_last + 1;
        $file                   =   $request->file('file');
        $ekstensi_diperbolehkan =   array('jpg');
        $filename               =   $file->getClientOriginalName();
        $x                      =   explode('.', $filename);
        $ekstensi               =   strtolower(end($x));
        $nama_file_unik         =   $id_new.'.'.$ekstensi;
        

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
                if($request->title == NULL)
                {
                    return redirect()->route('avatar_player')->with('alert', 'Name can\'t be NULL ');
                } else {
                    $validator = Validator::make($request->all(),[
                        'title' =>  'required'
                    ]);

                    if($validator->fails()){
                        return back()->withErrors($validator->errors());
                    }

                    //MENYIMPAN KE AWS S3
                    $pathS3 =   'avatar/'.$nama_file_unik;
                    Storage::disk('s3')->put($pathS3, file_get_contents($file));
                    
                    //MENYIMPAN KE DATABASE
                    $avatarPlayer = AvatarPlayer::create([
                        'id'      =>    $id_new,
                        'name'    =>    $request->title,
                        'path'    =>    $nama_file_unik
                    ]);

                    //MENYIMPAN LOG
                    Log::create([
                        'op_id'     =>  Session::get('userId'),
                        'action_id' =>  '3',
                        'datetime'  =>  Carbon::now('GMT+7'),
                        'desc'      =>  'Membuat insert baru di menu Avatar player dengan nama'. $avatarPlayer->subject
                    ]);
                    return redirect()->route('avatar_player')->with('success', 'Insert Data successfull');
                }
        } else {
            return back()->with('alert', 'Ekstensi file tidak diperbolehkan');
        }
    }
        

    public function updateImage(Request $request)
    {
        $pk         =   $request->pk;
        $id         =   AvatarPlayer::where('id', '=', $pk)
                        ->first();
        $validator  =   Validator::make($request->all(), [
                            'file'  =>  'required'
                        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $file                   =   $request->file('file');
        $ekstensi_diperbolehkan =   array('jpg');
        $filename               =   $_FILES['file']['name'];
        $x                      =   explode('.', $filename);
        $ekstensi               =   strtolower(end($x));
        $nama_file_unik         =   $pk.'.'.$ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            //MENYIMPAN KE AWS S3
            $pathS3     =   'avatar/'.$nama_file_unik;
            Storage::disk('s3')->put($pathS3, file_get_contents($file));

            //RECORD LOG
            Log::create([
                'op_id'     =>  Session::get('userId'),
                'action_id' =>  '3',
                'datetime'  =>  Carbon::now('GMT+7'),
                'desc'      =>  'Update gambar di menu avatar player dengan ID'.$pk
            ]);
            return redirect()->route('avatar_player')->with('success', 'Update image successfull');
        }
        else {
            return redirect()->route('avatar_player')->with('alert', 'format must be jpg and pictorial');
        }
    }


    public function update(Request $request)
    {
        $pk     =   $request->pk;
        $name   =   $request->name;
        $value  =   $request->value;
        
        AvatarPlayer::where('id', '=', $pk)->update([
            $name => $value,
        ]);

        $timenow = Carbon::now('GMT+7');

        switch($name) {
            case 'name':
                $name = "Nama";
            break;
        default:
            "";
        }

        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '2',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Edit '.$name.' di menu Avatar player dengan Id '.$pk.' menjadi '. $value
        ]);
    }

    public function destroy(Request $request)
    {
        $id             = $request->id;
        $avatarPlayer   = AvatarPlayer::select('id')
                            ->where('id', '=', $id)
                            ->first();

        $pathS3         =   'avatar/'.$id.'.jpg';

        if($id != '')
        {
            Storage::disk('s3')->delete($pathS3);
            AvatarPlayer::where('id', '=', $id)->delete();
            Log::create([
                'op_id'     =>  Session::get('userId'),
                'action_id' =>  '4',
                'datetime'  =>  Carbon::now('GMT+7'),
                'desc'      =>  'Hapus di menu Avatar player dengan ID '.$id
            ]);
            return redirect()->route('avatar_player')->with('success', 'Data deleted');
        }
        return redirect()->route('avatar_player')->with('alert', 'Something wrong');
    }

    public function deleteAll(Request $request)
    {
        $ids    =   $request->userIdAll;
        $imageid=   $request->imageid;
        
        //DELETE 
        Storage::disk('s3')->delete(explode(",", $imageid));
        DB::table('asta_db.avatar')->whereIn('id', explode(",", $ids))->delete();
        
        //RECORD LOG
        Log::create([
            'op_id'     =>  Session::get('userId'),
            'action_id' =>  '4',
            'datetime'  =>  Carbon::now('GMT+7'),
            'desc'      =>  'Hapus di menu avatar player dengan ID ' .$ids
        ]);
        return redirect()->route('avatar_player')->with('success', 'Data deleted');
    }
}
