<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use Storage;
use Validator;

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
        $xml_andro = simplexml_load_file("https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/XML/Android/asset_game.xml");
        $xml_ios   = simplexml_load_file("https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/XML/IOS/asset_game.xml");
        // $xml_andro = simplexml_load_file("../../asta-api/AssetBundle/XML/Android/asset_game.xml");
        // $xml_ios   = simplexml_load_file("../../asta-api/AssetBundle/XML/IOS/asset_game.xml");
        return view('pages.version_asset.version_asset', compact('xml_andro', 'xml_ios', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu      = MenuClass::menuName('Version Asset Apk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    
     /* ===================================== FUNCTION STORE CREATE ASSET ====================================== */
    
    // FUNCTION STORE ASSET ANDROID
    public function store(Request $request)
    {   
    
        $file       = $request->fileAdr;
        $xml = new \DomDocument("1.0");
        // $xml->load("https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/XML/Android/asset_game.xml");
        $xml->load("../public/upload/xml/Android/asset_game.xml");
        $validator  = Validator::make($request->all(), [
            'fileAdr'       => 'required',
            'Name'          => 'required',
            'Type'          => 'required',
            'Link'          => 'required',
            'Version'       => 'required',
            'FolderName'    => 'required'          
        ]);


        if($validator->fails()):
            return back()->withErrors($validator->errors());
        endif;

        $type           = $request->Type;
        $link           = $request->Link;
        $version        = $request->Version;
        $tagelement     = $request->FolderName;
        $name           = $request->Name;

        $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $link);

        $rootTag        = $xml->getElementsByTagName("main_asset")->item(0);

        $infoTag        = $xml->createElement($tagelement);
        $type_xml       = $xml->createElement("type", $type);
        $link_xml       = $xml->createElement("link", $link);
        $version_xml    = $xml->createElement("ver", $version);

        $infoTag->setAttribute('name', $name);
        $infoTag->appendChild($type_xml);
        $infoTag->appendChild($link_xml);
        $infoTag->appendChild($version_xml);
        $rootTag->appendChild($infoTag);

        $xml->save('../public/upload/xml/Android/asset_game.xml');
        $PathS3   = 'unity-asset/XML/Android/asset_game.xml';
        $xmllocal = "../public/upload/xml/Android/asset_game.xml";

        //upload file
        $uploadFile = $replacepath . $name;
        Storage::disk('s3')->put($uploadFile, file_get_contents($file));
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu Versi Aset APK untuk android dengan Nama '. $name
        ]);
        
        return back()->with('success', 'Data saved!');

    }

    // FUNCTION STORE ASSET IOS
    public function storeIos(Request $request)
    {
        $file       = $request->fileIOS;
        $validator  = Validator::make($request->all(), [
            'fileIOS'       => 'required',
            'Name'          => 'required',
            'Type'          => 'required',
            'Link'          => 'required',
            'Version'       => 'required',
            'FolderName'    => 'required'
            
        ]);

        if($validator->fails()):
            return back()->withErrors($validator->errors());
        endif;
        

        $xml = new \DomDocument("1.0");
        $xml->load("../public/upload/xml/IOS/asset_game.xml");
        
        $type           = $request->Type;
        $link           = $request->Link;
        $version        = $request->Version;
        $tagelement     = $request->FolderName;
        $name           = $request->Name;

        $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $link);

        $rootTag        = $xml->getElementsByTagName("main_asset")->item(0);

        $infoTag        = $xml->createElement($tagelement);
        $type_xml       = $xml->createElement("type", $type);
        $link_xml       = $xml->createElement("link", $link);
        $version_xml    = $xml->createElement("ver", $version);

        $infoTag->setAttribute('name', $name);
        $infoTag->appendChild($type_xml);
        $infoTag->appendChild($link_xml);
        $infoTag->appendChild($version_xml);
        $rootTag->appendChild($infoTag);

        $xml->save('../public/upload/xml/IOS/asset_game.xml');
        $xmllocal = "../public/upload/xml/IOS/asset_game.xml";
        
        //upload xml
        $PathS3   = 'unity-asset/XML/IOS/asset_game.xml';
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));

        //upload file
        $uploadFile = $replacepath . $name;
        Storage::disk('s3')->put($uploadFile, file_get_contents($file));

        
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '3',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Menambahkan data di menu Versi Aset APK untuk IOS dengan Nama '. $name
        ]);
        return back()->with('success', 'Data saved!');

    }


    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;
        

        $gamep = simplexml_load_file("../public/upload/xml/Android/asset_game.xml");
        foreach($gamep->children() as $gamew)
        {
            
            if($name == 'type')
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
        
        file_put_contents("../public/upload/xml/Android/asset_game.xml", $gamep->asXML());
        $PathS3   = 'unity-asset/XML/Android/asset_game.xml';
        $xmllocal = "../public/upload/xml/Android/asset_game.xml";

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' di menu Versi Aset APK untuk Android dengan nama '.$pk.' menjadi '. $value
          ]);
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));
    }

    
    public function update_ios(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        $gamep = simplexml_load_file("../public/upload/xml/IOS/asset_game.xml");
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
        
        file_put_contents("../public/upload/xml/IOS/asset_game.xml", $gamep->asXML());
        $PathS3   = 'unity-asset/XML/IOS/asset_game.xml';
        $xmllocal = "../public/upload/xml/IOS/asset_game.xml";

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' di menu Versi Aset APK untuk IOS dengan nama '.$pk.' menjadi '. $value
          ]);
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));
    }   
    
    
    /* ===================================== FUNCTION UPDATE ASSET ====================================== */

    //FUNCTION UPDATE ASSET ANDROID
    public function updateAssetAndroid (Request $request)
    {
        $pk         = $request->pk;
        $file       = $request->fileEditADR;
        $name       = $request->Name;
        $link       = $request->Link;
        $version    = $request->Version;
        $gamep      = simplexml_load_file("../public/upload/xml/Android/asset_game.xml");

        foreach($gamep->children() as $gamew)
        {
            
                if($gamew['name'] == $pk)
                {
                    
                    $gamew->ver = $version;
                    $gamew['name'] = $name;
                    // break;
                }
               
        }

        $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $link);
        
        file_put_contents("../public/upload/xml/Android/asset_game.xml", $gamep->asXML());
        $xmllocal = "../public/upload/xml/Android/asset_game.xml";

        //update xml to aws s3
        $PathS3   = 'unity-asset/XML/Android/asset_game.xml';
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));

        //update file to aws s3
        $uploadFile = $replacepath . $name;
        Storage::disk('s3')->put($uploadFile, file_get_contents($file));

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Update FILE aset  di menu Versi Aset APK untuk Android dengan nama '.$pk
          ]);
        return back()->with('success', 'Input succeeded');
    }


    //FUNCTION UPDATE ASSET IOS
    public function updateAssetIOS(Request $request)
    {
        $pk         =   $request->pk;
        $file       =   $request->fileEditIOS;
        $name       =   $request->Name;
        $link       =   $request->Link;
        $version    =   $request->Version;
        $gamep      =   simplexml_load_file("../public/upload/xml/IOS/asset_game.xml");

        foreach($gamep->children() as $gamew)
        {
            if($gamew['name'] == $pk)
            {
                $gamew->ver     = $version;
                $gamew['name']  = $name;
            }
        }

        $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $link);

        file_put_contents("../public/upload/xml/IOS/asset_game.xml", $gamep->asXML());
        $xmllocal   =   "../public/upload/xml/IOS/asset_game.xml";

        //update XML to aws s3
        $PathS3     =   'unity-asset/XML/IOS/asset_game.xml';
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));

        //update file to aws s3
        $uploadFile = $replacepath . $name;
        Storage::disk('s3')->put($uploadFile, file_get_contents($file));

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Update FILE aset  di menu Versi Aset APK untuk IOS dengan nama '.$pk
          ]);
        return back()->with('success', 'Input Succeeded');
    }

 
    /* ===================================== FUNCTION DELETE ASSET ====================================== */
    //FUNCTION DELETE ASSET ANDROID
    public function destroy(Request $request)
    {
        $tag    =   $request->id;
        $id     =   $request->name;
        $link   =   $request->Link;
        $xml    =   new \DomDocument("1.0", "UTF-8");
        $xml->load('../public/upload/xml/Android/asset_game.xml');
        $xpath  =   new \DOMXPATH($xml);

        foreach($xpath->query("/main_asset/".$tag."[@name = '$id']") as $node )
        {
            $node->parentNode->removeChild($node);
        }

        $xml->formatoutput = true;

        //delete file in aws s3
        $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $link);
        $deleteFile = $replacepath . $id;
        Storage::disk('s3')->delete($deleteFile);

        //save xml local
        $xml->save('../public/upload/xml/Android/asset_game.xml');
        $xmllocal = "../public/upload/xml/Android/asset_game.xml";

        //save xml into aws s3
        $PathS3   = 'unity-asset/XML/Android/asset_game.xml';
        Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));    
        

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Versi Aset APK untuk Android dengan nama '.$id
        ]);
        return back()->with('success', 'Data deleted!');

    }

    //FUNCTION DELETE ASSET IOS
    public function destroyIOS(Request $request)
    {
            $tag    =   $request->id;
            $id     =   $request->name;
            $link   =   $request->link;
            $xml    =   new \DomDocument("1.0", "UTF-8");
            $xml->load('../public/upload/xml/IOS/asset_game.xml');
            $xpath  =   new \DOMXPATH($xml);

            foreach($xpath->query("/main_asset/".$tag."[@name = '$id']") as $node)
            {
                $node->parentNode->removeChild($node);
            }

            $xml->formatoutput = true;

            //delete file in aws s3
            $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $link);
            $deleteFile = $replacepath . $id;
            Storage::disk('s3')->delete($deleteFile);


            //save xml local
            $xml->save('../public/upload/xml/IOS/asset_game.xml');
            $xmllocal = '../public/upload/xml/IOS/asset_game.xml';

            //save xml into aws s3
            $PathS3   = 'unity-asset/XML/IOS/asset_game.xml';
            Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '4',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Hapus di menu Versi Aset APK untuk IOS dengan nama '.$id
            ]);
            return back()->with('success', 'Data deleted!');

    }

    public function deleteAllSelectedADR(Request $request)
    {
        $tag        =   $request->ids;
        $id         =   $request->names;
        $link       =   $request->LinksAll; 
        $xml        =   new \DomDocument("1.0", "UTF-8");
        $xml->load('../public/upload/xml/Android/asset_game.xml');
        $xpath      =   new \DOMXPATH($xml);
        $idsArray   =   explode(",", $id);
        $tagArray   =   explode(",", $tag);
        $linkArray  =   explode(",", $link);

        foreach($idsArray as  $ids)
        {
            foreach($tagArray as $tgs)    
            {
                foreach($linkArray as $lka)
                {
                    foreach($xpath->query("/main_asset/".$tgs."[@name = '$ids']") as $node)
                    {
                        $node->parentNode->removeChild($node);
                    }

                    $xml->formatouput = true;

                    //delete file in aws s3
                    $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $lka);
 
                    $deleteFile  = $replacepath . $ids;
                    Storage::disk('s3')->delete($deleteFile);
                    
                    //save xml local
                    $xml->save('../public/upload/xml/Android/asset_game.xml');
                    $xmllocal = '../public/upload/xml/Android/asset_game.xml';

                    //save xml into aws s3
                    $PathS3 = 'unity-asset/XML/Android/asset_game.xml';
                    Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));
                }
                
            }
        }
        
        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Versi Aset APK untuk Android dengan nama '.$id
        ]);
        return back()->with('success', 'Data deleted!');

    }

    public function deleteAllSelectedIOS(Request $request)
    {
        $tag        =   $request->ids2;
        $id         =   $request->names2;
        $link       =   $request->LinksAll2;

        $xml        =   new \DomDocument("1.0", "UTF-8");
        $xml->load('../public/upload/xml/IOS/asset_game.xml');
        $xpath      =   new \DOMXPATH($xml);
        $idsArray   =   explode(",", $id);
        $tagArray   =   explode(",", $tag);
        $linkArray  =   explode(",", $link);

        foreach($idsArray as  $ids)
        {
            foreach($tagArray as $tgs)    
            {
                foreach($linkArray as $lka)
                {
                    foreach($xpath->query("/main_asset/".$tgs."[@name = '$ids']") as $node)
                    {
                        $node->parentNode->removeChild($node);
                    }

                    $xml->formatouput = true;

                    //delete file in aws s3
                    $replacepath = str_replace('https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/', '', $lka);
 
                    $deleteFile  = $replacepath . $ids;
                    Storage::disk('s3')->delete($deleteFile);
                    
                    //save xml local
                    $xml->save('../public/upload/xml/IOS/asset_game.xml');
                    $xmllocal = '../public/upload/xml/IOS/asset_game.xml';

                    //save xml into aws s3
                    $PathS3 = 'unity-asset/XML/IOS/asset_game.xml';
                    Storage::disk('s3')->put($PathS3, file_get_contents($xmllocal));
                }
                
            }
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '4',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Hapus di menu Versi Aset APK untuk IOS dengan nama '.$id
        ]);
        return back()->with('success', 'Data deleted!');
    }
}
