<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\MenuClass;
use Session;
use Carbon\Carbon;
use App\Config;
use Storage;
use File;
use App\ConfigText;

// Log Model
use App\Log;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu               = MenuClass::menuName('General Setting');
        $mainmenu           = MenuClass::menuName('Settings');
        // system settings
        $getMaintenance          = Config::select('id', 'name', 'value')->where('id', '=', '101')->first();
        $getPointExpired         = Config::select('id', 'name', 'value')->where('id', '=', '102')->first();
        $award_signup            = Config::select('id', 'name', 'value')->where('id', '=', '31')->first();
        $award_signup_guest      = Config::select('id', 'name', 'value')->where('id', '=', '32')->first();
        $award_daily_chips       = Config::select('id', 'name', 'value')->where('id', '=', '33')->first();
        $award_daily_chips_guest = Config::select('id', 'name', 'value')->where('id', '=', '34')->first();
        $award_daily_days        = Config::select('id', 'name', 'value')->where('id', '=', '35')->first();
        $award_daily_multiply    = Config::select('id', 'name', 'value')->where('id', '=', '36')->first();

        // Bank Settings
        $getBank            = Config::select('id', 'name', 'value')->where('id', '=', '201')->first();

        // Info Settings
        $getAbout           = Config::select('id', 'name', 'value')->where('id', '=', '4')->first();
        $getPokerWeb        = Config::select('id', 'name', 'value')->where('id', '=', '5')->first();

        // CS & Legal Settings
        $getFb              = Config::select('id', 'name', 'value')->where('id', '=', '901')->first();
        $getTwitter         = Config::select('id', 'name', 'value')->where('id', '=', '902')->first();
        $getIg              = Config::select('id', 'name', 'value')->where('id', '=', '903')->first();
        $getPrivacyPolicy   = Config::select('id', 'name', 'value')->where('id', '=', '2')->first();
        $getTermOfService   = Config::select('id', 'name', 'value')->where('id', '=', '3')->first();
        
        $rootpath = '../public/upload/file_policy';
        $client = Storage::disk('s3');
        // $client = Storage::createLocalDriver(['root' => $rootpath]);


        $onoff = ConfigText::select(
                    'name', 
                    'value'
                 )
                 ->where('id', '=', 9)
                 ->first();
        $converttocomma = str_replace(':', ',', $onoff->value);
        $maintenaceonoff = explode(',', $converttocomma);
        // dd($client->get('term-of-service.txt'));
        

        return view('pages.settings.general_setting', compact('getMaintenance', 'getPointExpired', 'getFb', 
                                                                'getTwitter', 'getIg', 'getPrivacyPolicy', 'getTermOfService',
                                                                'getAbout', 'getPokerWeb', "getBank", 'menu', 'client', 'maintenaceonoff', 'mainmenu',
                                                                'award_signup', 'award_signup_guest', 'award_daily_chips', 'award_daily_chips_guest',
                                                                'award_daily_days', 'award_daily_multiply'));
    }

    public function putAbout(Request $request)
    {
        $contentabout         = $request->contentabout;
        $idabout              = $request->idabout;
        $urlabout             = $request->urlabout;
        $idtermofservice      = $request->idtermofservice;
        $urltermofservice     = $request->urltermofservice;
        $idprivacypolicy      = $request->idprivacypolicy;
        $urlprivacypolicy     = $request->urlprivacypolicy;
        $contenttermofservice = $request->contenttermofservice;
        $contentprivacypolicy = $request->contentprivacypolicy;
        $rootpath             = '../public/upload/file_policy';
        $client               = Storage::createLocalDriver(['root' => $rootpath]);

        if($contentabout)
        {   
            
            $filelication = "../public/upload/file_policy/about.txt";

            $semanticTagleft    =   str_replace('[', '<', $contentabout);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);
            
            
            $client->put('about.txt', $semanticTagcloser);
            
            $PathS3       = 'unity-asset/text_file/about.txt';
            Storage::disk('s3')->put($PathS3, file_get_contents($filelication));
            Config::where('id', '=', $idabout)->update([
                'value' =>  $urlabout
            ]);
            return back()->with('success','Data Updated');

        } else if ($contenttermofservice)
        {   
            $semanticTagleft    =   str_replace('[', '<', $contenttermofservice);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            $client->put('term-of-service.txt', $semanticTagcloser);
            $filelication = $rootpath."/term-of-service.txt";
            $PathS3       = 'unity-asset/text_file/term-of-service.txt';
            Storage::disk('s3')->put($PathS3, file_get_contents($filelication));
            Config::where('id', '=', $idtermofservice )->update([
                'value' =>  $urltermofservice
            ]);
            return back()->with('success','Data Updated');

        } else if ($contentprivacypolicy)
        {
            $semanticTagleft    =   str_replace('[', '<', $contentprivacypolicy);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            $client->put('privacy-policy.txt', $semanticTagcloser);
            $filelication        = $rootpath."/privacy-policy.txt";
            $PathS3              = 'unity-asset/text_file/privacy-policy.txt';
            Storage::disk('s3')->put($PathS3, file_get_contents($filelication));
            Config::where('id', '=', $idprivacypolicy )->update([
                'value' =>  $urlprivacypolicy
            ]);
            return back()->with('success','Data Updated');

        } else 
        {
            return back()->with('alert','Update Can\'t Be process');
        }
        
    }

    public function AboutGame()
    {
        // $rootpath = '../public/upload/file_policy';
        // $client = Storage::createLocalDriver(['root' => $rootpath]);
        // $client->get('about.txt');
        $client = file_get_contents(public_path()."/upload/file_policy/about.txt");
        return $client;
    }

    public function PrivacyPolicyGame()
    {
        $client = file_get_contents(public_path()."/upload/file_policy/privacy-policy.txt");
        return $client;
    } 

    public function TermOfServiceGame()
    {
        $client = file_get_contents(public_path()."/upload/file_policy/term-of-service.txt");
        return $client;
    }

    public function AboutGamehtml()
    {
        // $rootpath = '../public/upload/file_policy';
        // $client = Storage::createLocalDriver(['root' => $rootpath]);
        // $client->get('about.txt');
        $client = file_get_contents(public_path()."/upload/file_policy/about.txt");
        $b = htmlspecialchars($client);
        return $b;
    }

    public function PrivacyPolicyGamehtml()
    {
        $client = file_get_contents(public_path()."/upload/file_policy/privacy-policy.txt");
        $b = htmlspecialchars($client);
        return $b;
    } 

    public function TermOfServiceGamehtml()
    {
        $client = file_get_contents(public_path()."/upload/file_policy/term-of-service.txt");
        $b = htmlspecialchars($client);
        return $b;
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
        $pk    = $request->pk; //get data-pk
        $name  = $request->name; //get data-name
        $value = $request->value; //get data-value

        Config::where('id', '=', $pk)->update([
            $name => $value
        ]);

        switch ($name) {
            case "value":
                $name = "Pengaturan";
                break;
            default:
              "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '2',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.' di menu Pengaturan Umum dengan Konfigurasi ID '.$pk.' menjadi '. $value
        ]);
    }
}
