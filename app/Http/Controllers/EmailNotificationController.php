<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailNotification;
use App\Classes\MenuClass;
use App\Log;
use DB;
use Session;
use Carbon\Carbon;
use Validator;

class EmailNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $menu               = MenuClass::menuName('Email Notification');
        // $mainmenu           = MenuClass::menuName('Notification');
        // $emailnotifications = EmailNotification::all();
        return view('pages.Maintenance.underconstruction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $file                   = $request->file('file');
        $bcrypt                 = bcrypt($request->password);
        $ekstensi_diperbolehkan = array('png','jpg','PNG','JPG');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $acak                   = rand(1,99);
        $nama_file_unik         = 'notification'.$acak.'.'.$ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {           
                if ($file->move(public_path('../public/upload/EmailNotification'), $nama_file_unik))
                {
                    $validator = Validator::make($request->all(),[
                        'subject' => 'required',
                        'message' => 'required',
                        'email'   => 'required|email',
                        'type'    => 'required',
                    ]);
                
                    if ($validator->fails()) {
                        return back()->withErrors($validator->errors());
                    }
        
                    $notification = EmailNotification::create([
                        'dealerId'  =>  '1',
                        'subject'   =>  $request->subject,
                        'imageUrl'  => $nama_file_unik,
                        'message'   =>  $request->message,
                        'fromName'  =>  'Engine Poker',
                        'fromEmail' =>  $request->email,
                        'type'      =>  $request->type
                    ]);
            
                    Log::create([
                      'op_id'     => Session::get('userId'),
                      'action_id' => '3',
                      'datetime'  => Carbon::now('GMT+7'),
                      'desc'      => 'Create new in menu Email Notification with title '. $notification->subject
                    ]);
                    return redirect()->route('Email_Notification')->with('success', alertTranslate('L_INSERT_DATA_SUCCESS'));
            
                }
                else
                {
                    echo "Gagal Upload File";
                }
            }
            else
            {       
                echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            echo 'Ekstensi file tidak di perbolehkan';
        }

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

    public function updateimage(Request $request)
    {
        $pk                     = $request->pk;
        $file                   = $request->file('file');
        $bcrypt                 = bcrypt($request->password);
        $ekstensi_diperbolehkan = array('png','jpg','PNG','JPG');
        $nama                   = $_FILES['file']['name'];
        $x                      = explode('.', $nama);
        $ekstensi               = strtolower(end($x));
        $ukuran                 = $_FILES['file']['size'];
        $acak                   = rand(1,99);
        $nama_file_unik         = 'notification'.$acak.'.'.$ekstensi;

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
        {
            if($ukuran < 1044070)
            {           
                if ($file->move(public_path('../public/upload/EmailNotification'), $nama_file_unik))
                {
                    EmailNotification::where('id', '=', $pk)->update([
                        'imageUrl' => $nama_file_unik
                    ]);

                    Log::create([
                        'op_id'     => Session::get('userId'),
                        'action_id' => '2',
                        'datetime'  => Carbon::now('GMT+7'),
                        'desc'      => 'Edit imageUrl in menu Email Notification with ID '.$pk.' to '. $nama_file_unik
                    ]);
                    return redirect()->route('Email_Notification')->with('success', alertTranslate('Update Image successfull'));
            
                }
                else
                {
                    echo "Gagal Upload File";
                }
            }
            else
            {       
                echo 'Ukuran file terlalu besar';
            }
        }
        else
        {       
            echo 'Ekstensi file tidak di perbolehkan';
        }
    }

    
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
  
  
        EmailNotification::where('id', '=', $pk)->update([
              $name => $value
          ]);
  
          switch ($name) {
              case "subject": 
                  $name = "Subject";
                  break;
              case "message": 
                  $name = "Message";
                  break;
              case "fromName": 
                  $name = "fromName";
                  break;
              case "fromEmail": 
                  $name = "From Email";
                  break;
              case "type": 
                  $name = "Type";
                  break;
              case "cdn": 
                  $name = "cdn";
                  break;
              case "codeKey": 
                  $name = "Code Key";
                  break;
              case "codeKey": 
                  $name = "Code Key";
                  break;
              default:
                "";
          }
  
  
          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' in menu Email Notification with Id '.$pk.' to '. $value
          ]);
    }

    
    public function destroy(Request $request)
    {
        $id = $request->id;
        if($id != '')
        {
            EmailNotification::where('id', '=', $id)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Email Notification with ID '.$id
            ]);

            return redirect()->route('Email_Notification')->with('success', alertTranslate('Data deleted'));
        }
        return redirect()->route('Email_Notification')->with('success', alertTranslate('Something wrong'));   
    }
    
}
