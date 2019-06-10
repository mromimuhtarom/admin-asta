<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailNotification;
use App\Classes\MenuClass;
use App\Log;
use DB;
use Session;
use Carbon\Carbon;

class EmailNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu               = MenuClass::menuName('Email Notification');
        $emailnotifications = EmailNotification::all();
        return view('pages.notification.email_notification', compact('emailnotifications', 'menu'));
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
                if ($file->move(public_path('../public/images/EmailNotification'), $nama_file_unik))
                {
                    // Gift::where('id', '=', $pk)->update([
                    //     'imageUrl' => $nama_file_unik
                    // ]);
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
                      'operator_id' => Session::get('userId'),
                      'menu_id'     => '74',
                      'action_id'   => '3',
                      'date'        => Carbon::now('GMT+7'),
                      'description' => 'Create new Email Notification with title '. $notification->subject
                    ]);
                    return redirect()->route('EmailNotification-view')->with('success','Insert Data successfull');
            
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
                if ($file->move(public_path('../public/images/EmailNotification'), $nama_file_unik))
                {
                    EmailNotification::where('id', '=', $pk)->update([
                        'imageUrl' => $nama_file_unik
                    ]);

                    Log::create([
                        'operator_id' => Session::get('userId'),
                        'menu_id'     => '74',
                        'action_id'   => '2',
                        'date'        => Carbon::now('GMT+7'),
                        'description' => 'Edit imageUrl Email Notification ID '.$pk.' to '. $nama_file_unik
                    ]);
                    return redirect()->route('GiftStore-view')->with('success','Update Image successfull');
            
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            'operator_id' => Session::get('userId'),
            'menu_id'     => '74',
            'action_id'   => '2',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' Email Notification Id '.$pk.' to '. $value
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        if($id != '')
        {
            DB::table('notifications')->where('id', '=', $id)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '74',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Email Notification ID '.$id
            ]);

            return redirect()->route('EmailNotification-view')->with('success','Data Deleted');
        }
        return redirect()->route('EmailNotification-view')->with('success','Something wrong');   
    }
    
}
