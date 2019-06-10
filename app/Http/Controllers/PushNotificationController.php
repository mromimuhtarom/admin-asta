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
class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu          = MenuClass::menuName('Push Notification');
        $notifications = PushNotification::join('game', 'game.id', '=', 'push_notifications.gameId')->select('game.name as gamename', 'push_notifications.*')->get();
        $game          = DB::table('game')->get();
        // $table         = Table::where('dealerId', '=', Session::get('dealerId'))->where('tabletype', '!=', 'm')->where('clubId', '=', 0)->where('seasonId', '=', 0)->orderBy('bb', 'asc')->orderBy('tablename', 'asc')->get();
        return view('pages.notification.push_notification', compact('notifications','tables', 'table', 'game', 'menu'));
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
        PushNotification::create([
            'title'   => $request->title,
            'message' => $request->message,
            'gameId'  => $request->game
        ]);

          Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '73',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Push Notification with title '.$request->title
          ]);

          return redirect()->route('PushNotification-view')->with('success','Data Added');
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
        'operator_id' => Session::get('userId'),
        'menu_id'     => '73',
        'action_id'   => '2',
        'date'        => Carbon::now('GMT+7'),
        'description' => 'Edit '.$name.' Push Notification Id '.$pk.' to '. $value
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
            DB::table('push_notifications')->where('id', '=', $id)->delete();

            Log::create([
                'operator_id' => Session::get('userId'),
                'menu_id'     => '73',
                'action_id'   => '4',
                'date'        => Carbon::now('GMT+7'),
                'description' => 'Delete Push Notification ID '.$id
              ]);
            return redirect()->route('PushNotification-view')->with('success','Data Deleted');
        }
        return redirect()->route('PushNotification-view')->with('success','Something wrong');   
    }
}
