<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsGold;
use Illuminate\Support\Facades\DB;
use App\Classes\MenuClass;
use App\Log;
use Carbon\Carbon;
use Session;
use Validator;

class ChipStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu  = MenuClass::menuName('Chip Store');
        $items = ItemsGold::where('category', '=', 'Chip')->get();
        return view('pages.store.chip_store', compact('items', 'menu'));
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
            'title'       => 'required',
            'goldcost'    => 'required|integer',
            'chipawarded' => 'required|integer'
          ]);
    
          if ($validator->fails()) {
            return back()->withErrors($validator->errors());
          }

          $chip = ItemsGold::create([
            'name'        => $request->title,
            'category'    => 'Chip',
            'goldCost'    => $request->goldcost,
            'chipAwarded' => $request->chipawarded,
            'image'       => 'Chips',
            'active'      => 0
          ]);
  
          Log::create([
              'op_id'     => Session::get('userId'),
              'action_id' => '3',
              'datetime'  => Carbon::now('GMT+7'),
              'desc'      => 'Create new in menu Chip Store with Title '. $chip->name
          ]);
          return redirect()->route('Chip_Store')->with('success','Data Insert Successfull');
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
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        ItemsGold::where('id', '=', $pk)->update([
            $name =>$value
        ]);
  
        switch ($name) {
          case "name":
              $name = "Name Chip";
              break;
          case "chipAwarded":
              $name = "Chip Awarded";
              break;
          case "goldCost":
              $name = "Gold Cost";
              break;
          case "active":
              $name = "active";
              break;
          default:
            "";
      }
  
  
      Log::create([
        'op_id'     => Session::get('userId'),
        'action_id' => '2',
        'datetime'  => Carbon::now('GMT+7'),
        'desc'      => 'Edit '.$name.' in menu Chip Store with Id '.$pk.' to '. $value
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
            ItemsGold::where('id', '=', $id)->delete();   
            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Delete in menu Chip Store with ID '.$id
            ]);

            return redirect()->route('Chip_Store')->with('success','Data Deleted');
        }
        return redirect()->route('Chip_Store')->with('success','Something wrong');   
    }
}
