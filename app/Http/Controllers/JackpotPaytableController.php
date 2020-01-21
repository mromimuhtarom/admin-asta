<?php

namespace App\Http\Controllers;

use App\Jackpot_paytable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Classes\MenuClass;
use App\Log;
use Carbon\Carbon;

class JackpotPaytableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jackpot_paytable = Jackpot_paytable::all();

        // //roles for jackpot_paytable pages
        // $menus1 = MenuClass::menuName('Jackpot Paytable');


        // return view('pages.game_asta.jackpot_paytable', compact('jackpot_paytable', 'menus1'));
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

       if ($request->ajax()) {


         $jackpot = Jackpot_paytable::create([
          'dealerid' => Session::get('dealerId'),
          'title'    => $request->title,
        ]);

        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '20',
          'action_id'   => '3',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Create new Jackpot Paytable with name '. $jackpot->title
        ]);

        return json_encode([
          "status"  => "OK",
          "message" => "new Pay Type Created"
        ]);

      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jackpot_paytable  $jackpot_paytable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jackpot_paytable $jackpot_paytable)
    {
      $pk    = $request->pk;
      $name  = $request->name;
      $value = $request->value;


      Jackpot_paytable::where('id', '=', $pk)->update([
        $name => $value
      ]);

      switch ($name) {
        case "title":
            $name = "Title";
            break;
        case "multiplier":
            $name = "Multiplier";
            break;
        case "key":
            $name = "Key";
            break;
        case "expire":
            $name = "Expire";
            break;
        case "category":
            $name = "Category";
            break;
        case "permanent":
            $name = "Permanent";
            break;
        default:
          "";
    }


    Log::create([
      'operator_id' => Session::get('userId'),
      'menu_id'     => '20',
      'action_id'   => '2',
      'date'        => Carbon::now('GMT+7'),
      'description' => 'Edit '.$name.' Jackpot Paytable Id '.$pk.' to '. $value
    ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jackpot_paytable  $jackpot_paytable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jackpot_paytable $jackpot_paytable,  Request $request)
    {

      $pk    = $request->pk;
      $name  = $request->name;
      $value = $request->value;

      if($name == 'delete') {

        Jackpot_paytable::destroy($pk);

        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '20',
          'action_id'   => '4',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Jackpot Paytable Has Been Deleted with Id '. $pk
        ]);

        return json_encode([
          "status"  => "OK",
          "message" => "Pay Has Been Deleted"
        ]);
      }
    }
}
