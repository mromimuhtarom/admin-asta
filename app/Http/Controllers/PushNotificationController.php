<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use DB;
use App\PushNotification;
use App\Table;
use Session;
use Carbon\Carbon;
use App\Log;
use App\Game;
use Validator;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu          = MenuClass::menuName('L_PUSH_NOTIFICATION');
        $mainmenu      = MenuClass::menuName('L_NOTIFICATION');
        $notifications = PushNotification::select(
                            'msg',
                            'type',
                            'date'
                         )
                         ->get();
        $game          = Game::select(
                            'id',
                            'name'
                         )
                         ->get();
                
        $datenow       = Carbon::now('GMT+7')->toDateString();
        return view('pages.notification.push_notification', compact('notifications','mainmenu', 'game', 'menu', 'datenow'));
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'message'   =>  'required',
            'game'  =>  'required|integer|',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        PushNotification::create([
            'title'   => $request->title,
            'message' => $request->message,
            'gameId'  => $request->game
        ]);

          Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Create new in menu Push Notification with title '.$request->title
          ]);

          return redirect()->route('Push_Notification')->with('success','Data Added');
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
  
        PushNotification::where('id', '=', $pk)->update([
            $name =>$value
        ]);
  
        switch ($name) {
          case "title":
              $name = "Title";
              break;
          case "message":
              $name = "Message";
              break;
          case "gameId":
              $name = "Game Id";
              break;
          default:
            "";
      }
  
  
      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu Push Notification with Id '.$pk.' to '. $value
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
            PushNotification::where('id', '=', $id)->delete();

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Push Notification with ID '.$id
              ]);
            return redirect()->route('Push_Notification')->with('success','Data Deleted');
        }
        return redirect()->route('Push_Notification')->with('success','Something wrong');   
    }
}
