<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VersionAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xml = simplexml_load_file("../../asta-asset/text/xml/books_report.xml");
        return view('pages.version_asset.version_asset', compact('xml'));
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

        $gamep= simplexml_load_file("../../asta-asset/text/xml/books_report.xml");
        foreach($gamep->game as $gamew)
        {
            if($name == 'gamecode')
            {
                if($gamew['id'] == $pk)
                {
                    $gamew->gamecode = $value;
                    break;
                }
            } else if($name == 'link')
            {
                if($gamew['id'] == $pk)
                {
                    $gamew->link = $value;
                    break;
                }
            }
        }
        
        file_put_contents("../../asta-asset/text/xml/books_report.xml", $gamep->asXML());


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
