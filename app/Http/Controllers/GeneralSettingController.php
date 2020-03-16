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
        $menu               = MenuClass::menuName('L_GENERAL_SETTING');
        $mainmenu           = MenuClass::menuName('L_SETTINGS');
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
        $contentastapoker     = $request->contentastapoker;
        $idastapoker          = $request->idastapoker;
        $urlastapoker         = $request->urlastapoker;
        $contentbigtwo        = $request->contentbigtwo;
        $idbigtwo             = $request->idbigtwo;
        $urlbigtwo            = $request->urlbigtwo;
        $contentdominoQQ      = $request->contentdominoQQ;
        $iddominoQQ           = $request->iddominoQQ;
        $urldominoQQ          = $request->urldominoQQ;
        $contentdominosusun   = $request->contentdominosusun;
        $iddominosusun        = $request->iddominosusun;
        $urldominosusun       = $request->urldomiosusun;

  

        if($contentabout)
        {   
            
            $filelication = "../public/upload/file_policy/about.txt";

            $semanticTagleft    =   str_replace('[', '<', $contentabout);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);
            
            
            
            $PathS3       = 'unity-asset/text_file/about.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $idabout)->update([
                'value' =>  $urlabout
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten tentang di tabel Pengaturan Info'
            ]);

            return back()->with('success', alertTranslate("Data Updated"));

        } else if ($contenttermofservice)
        {   
            $semanticTagleft    =   str_replace('[', '<', $contenttermofservice);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            $PathS3       = 'unity-asset/text_file/term-of-service.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $idtermofservice )->update([
                'value' =>  $urltermofservice
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten term of service di tabel CS dan pengaturan legal menu pengaturan umum'
            ]);

            return back()->with('success', alertTranslate("Data Updated"));

        } else if ($contentprivacypolicy)
        {
            $semanticTagleft    =   str_replace('[', '<', $contentprivacypolicy);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            dd($semanticTagcloser);
            $PathS3              = 'unity-asset/text_file/privacy-policy.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $idprivacypolicy )->update([
                'value' =>  $urlprivacypolicy
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten Privacy Policy di tabel CS dan pengaturan legal'
            ]);

            return back()->with('success', alertTranslate('Data Updated'));

        } else if($contentastapoker) {
            $semanticTagleft    =   str_replace('[', '<', $contentastapoker);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            $PathS3             = 'unity-asset/text_file/asta-poker.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $idastapoker )->update([
                'value' =>  $urlastapoker
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten Info Asta Poker di tabel Pengaturan info'
            ]);

            return back()->with('success', alertTranslate('Data Updated'));

        } else if($contentbigtwo) {
            $semanticTagleft    =   str_replace('[', '<', $contentbigtwo);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);
            

            $PathS3             =   'unity-asset/text_file/bigtwo.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $idbigtwo)->update([
                'value' =>  $urlbigtwo
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten Info Big Two di tabel Pengaturan info'
            ]);

            return back()->with('success', alertTranslate('Data Updated'));
        
        } else if($contentdominoQQ) {
            $semanticTagleft    =   str_replace('[', '<', $contentdominoQQ);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            $PathS3             =   'unity-asset/text_file/dominoQQ.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $iddominoQQ)->update([
                'value'         =>  $urldominoQQ
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten Info Domino QQ di tabel Pengaturan info'
            ]);

            return back()->with('success', alertTranslate('Data Updated'));
        } else if($contentdominosusun) {
            $semanticTagleft    =   str_replace('[', '<', $contentdominosusun);
            $semanticTagright   =   str_replace(']', '>', $semanticTagleft);
            $semanticTagclosel  =   str_replace('[/', '</', $semanticTagright);
            $semanticTagcloser  =   str_replace(']', '>', $semanticTagclosel);

            $PathS3             =   'unity-asset/text_file/dominosusun.txt';
            Storage::disk('s3')->put($PathS3, $semanticTagcloser);
            Config::where('id', '=', $iddominosusun)->update([
                     'value' =>  $urldominosusun
            ]);

            Log::create([
                'op_id'     => Session::get('userId'),
                'action_id' => '30',
                'datetime'  => Carbon::now('GMT+7'),
                'desc'      => 'Update konten Info Domino Susun di tabel Pengaturan info'
            ]);

            return back()->with('success', alertTranslate('Data Updated'));
            
        } else
        {
            return back()->with('alert', alertTranslate("Update can't be process"));
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
        $client = file_get_content(public_path()."/upload/file_policy/about.txt");
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

    
    public function update(Request $request)
    {
        $pk    = $request->pk; //get data-pk
        $name  = $request->name; //get data-name
        $value = $request->value; //get data-value
        $currentname = Config::where('id', '=', $pk)->first();

        Config::where('id', '=', $pk)->update([
            $name => $value
        ]);

        $config_data = Config::where('id', $pk)->first();

        switch ($config_data->name) {
            case "fb_url":
                $name = "Facebook";
                $currentvalue = $currentname->value;
                break;
            case "twitter_url":
                $name = "Twitter";
                $currentvalue = $currentname->value;
                break;
                
            case "ig_url":
                $name = "Instagram";
                $currentvalue = $currentname->value;
                break;
            case "award_signup":
                $name = "Hadiah sign up";
                $currentvalue = $currentname->value;
                break;
            case "award_daily_chips":
                $name = "Hadiah chip harian";
                $currentvalue = $currentname->value;
                break;
            case "award_daily_chip_guest":
                $name = "Hadiah chip harian guest";
                $currentvalue = $currentname->value;
                break;
            case "award_daily_days":
                $name = "Hadiah harian";
                $currentvalue = $currentname->value;
                break;
            case "award_daily_multiply":
                $name = "Hadiah berlipat harian";
                $currentvalue = $currentname->value;
                break;
            case "maintenance":
                $name = "Pemeliharaan";
                $currentvalue = $currentname->value;
                break;
            case "termOfService":
                $name = "Term Of Service URL";
                $currentvalue = $currentname->value;
                break;
            case "about":
                $name = "About Url";
                $currentvalue = $currentname->value;
                break;
            case "pokerWeb":
                $name = "Poker Web";
                $currentvalue = $currentname->value;
                break;
            case "point_expired":
                $name = "Masa aktif pemain";
                $currentvalue = $currentname->value;
                break;
            case "BCA":
                $name = "BCA";
                $currentvalue = $currentname->value;
                break;
            case "privacyPolicy":
                $name = "Privacy Policy Url";
                $currentvalue = $currentname->value;
                break;
            default:
              "";
        }

        Log::create([
            'op_id'     => Session::get('userId'),
            'action_id' => '30',
            'datetime'  => Carbon::now('GMT+7'),
            'desc'      => 'Edit '.$name.'. '.$currentvalue.' => '. $value
        ]);
    }
}
