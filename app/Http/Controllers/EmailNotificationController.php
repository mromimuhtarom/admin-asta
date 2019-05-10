<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailNotification;
use App\Log;
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
        $notifications = EmailNotification::all();
        return view('pages.notification.email_notification', compact('notifications'));
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
        //
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
            'menu_id'     => '18',
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
    public function destroy($id)
    {
        //
    }
}
