<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Log;
use Session;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Group::select()->orderBy('tablelimit')->get();
        return view('pages.game_asta.category', compact('category'));
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
  
        if ($name != 'fee'){
  
          Group::where('id', '=', $pk)->update([
            $name => $value
          ]);
  
        } else {
  
          Group::where('id', '=', $pk)->update([
            $name => $value / 100
          ]);
  
        }
  
        switch ($name) {
            case "name":
                $name = "Group Name";
                break;
            case "tablelow":
                $name = "Min Buy";
                break;
            case "tablelimit":
                $name = "Max Buy";
                break;
            case "fee":
                $name = "Rake";
                break;
            default:
              "";
        }
  
        Log::create([
          'operator_id' => Session::get('userId'),
          'menu_id'     => '15',
          'action_id'   => '2',
          'date'        => Carbon::now('GMT+7'),
          'description' => 'Edit '.$name.' groupID '.$pk.' to '. $value
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
