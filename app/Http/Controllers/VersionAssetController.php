<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;

class VersionAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu      = MenuClass::menuName('Version Asset Apk');
        $xml_andro = simplexml_load_file("../../enginepk/AssetBundle/XML/Android/asset_game.xml");
        $xml_ios   = simplexml_load_file("../../enginepk/AssetBundle/XML/IOS/asset_game.xml");
        return view('pages.version_asset.version_asset', compact('xml_andro', 'xml_ios', 'menu'));
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

        $gamep= simplexml_load_file("../../enginepk/AssetBundle/XML/Android/asset_game.xml");
        foreach($gamep->children() as $gamew)
        {
            
            if($name == 'type_ver')
            {
                if($gamew['name'] == $pk)
                {
                    
                    $gamew->type = $value;
                    break;
                }
            } else if($name == 'link')
            {
                if($gamew['name'] == $pk)
                {
                    $gamew->link = $value;
                    break;
                }
            } else if($name == 'ver')
            {
                if($gamew['name'] == $pk)
                {
                    $gamew->ver = $value;
                    break;
                }
            } else if($name == 'name')
            {
                if($gamew['name'] == $pk)
                {
                    $gamew['name'] = $value;
                    break;
                }
            }
        }
        
        file_put_contents("../../enginepk/AssetBundle/XML/Android/asset_game.xml", $gamep->asXML());


    }

    public function update_ios(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        $gamep= simplexml_load_file("../../enginepk/AssetBundle/XML/IOS/asset_game.xml");
        foreach($gamep->children() as $gamew)
        {
            if($name == 'type_ver')
            {
                if($gamew['name'] == $pk)
                {
                    
                    $gamew->type = $value;
                    break;
                }
            } else if($name == 'link')
            {
                if($gamew['name'] == $pk)
                {
                    $gamew->link = $value;
                    break;
                }
            } else if($name == 'ver')
            {
                if($gamew['name'] == $pk)
                {
                    $gamew->ver = $value;
                    break;
                }
            }  else if($name == 'name')
            {
                if($gamew['name'] == $pk)
                {
                    $gamew['name'] = $value;
                    break;
                }
            }
        }
        
        file_put_contents("../../enginepk/AssetBundle/XML/IOS/asset_game.xml", $gamep->asXML());


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
