<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportProblem;
use PDF;
use App\ReportFeedback;
use Storage;
use File;
use Carbon\Carbon;
use App\ConfigText;
use Validator;

class AbuseTransactionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abusetransaction = ReportProblem::join('asta_db.user', 'asta_db.user.user_id', 'asta_db.report_problem.user_id')
                            ->select(
                                'asta_db.report_problem.id',
                                'asta_db.user.username',
                                'asta_db.report_problem.user_id',
                                'asta_db.report_problem.message',
                                'asta_db.report_problem.date',
                                'asta_db.report_problem.isread'
                            )
                            ->orderby('asta_db.report_problem.date', 'desc')
                            ->get();
                            ReportProblem::where('isread', '=', 0)->update([
                                'isread' => 1
                            ]);
        $datenow        =   Carbon::now('GMT+7');
        $config_text    =   ConfigText::select(
                                'value'
                                ) ->where('id', '=', 15)
                                  ->first();
        $replace        =   str_replace(':',',', $config_text->value);
        $AbusetrnsType  =   explode(",", $replace);
        

        
        return view('pages.feedback.abusetransactionreport', compact('abusetransaction', 'AbusetrnsType', 'datenow'));
    }

    public function api_insert_abuse_transaction(Request $request)
    {
        $user_id     = $request->user_id;
        $item        = $request->item;
        $jlh         = $request->jlh;
        $time        = $request->time;
        $description = $request->description;
        $id_problem  = ReportProblem::select('id')->orderby('id', 'desc')->first();
        if($id_problem->id === NULL )
        {
            $id = 0 + 1;
        } else {
            $id          = $id_problem->id + 1;
        }

        ReportProblem::create([
            'user_id' => $user_id,
            'type'    => 1,
            'message' => "Item Name : ".$item."\n Quantity : ".$jlh."\n ".$description,
            'isread'  => 0,
            'date'    => Carbon::now('GMT+7')
        ]);
        $all   = $request->all();
        $image = $request->base64Image;

        $image_decode = base64_decode($image);
        // $imageName    = $id.'.'.'jpg';
        // $image_main = Storage::disk('s3')->put($rootpath, file_get_contents($file));
        $f = finfo_open();  

        $mime_type = finfo_buffer($f, $image_decode, FILEINFO_MIME_TYPE);
        // $a = File::mimeType($image_decode);
        $rootpath   = 'unity-asset/upload/report/' .$id.'.jpg';
        // $image_main = Storage::createLocalDriver(['root' => $rootpath]);
        if(function_exists('exif_imagetype')) {
            // open with EXIF
         } 
        $image_main = Storage::disk('s3');
        if($image_main->put($rootpath, $image_decode ))
        {
          echo 'Successful image';
        } else 
        {
          echo 'Failed';
        }

        return 'Successfull insert Data';
    }


    public function alldataabusetransaction()
    {
        $feedbacktransaction = ReportProblem::join('asta_db.user', 'asta_db.user.user_id', 'asta_db.report_problem.user_id')
                        ->select(
                            'asta_db.report_problem.id',
                            'asta_db.user.username',
                            'asta_db.report_problem.user_id',
                            'asta_db.report_problem.message',
                            'asta_db.report_problem.date'
                        )
                        ->get();
        return $feedbacktransaction;
    }

    public function personalabusetransaction($id)
    {
        $feedbacktransaction = ReportProblem::join('asta_db.user', 'asta_db.user.user_id', 'asta_db.report_problem.user_id')
                        ->select(
                            'asta_db.report_problem.id',
                            'asta_db.user.username',
                            'asta_db.report_problem.user_id',
                            'asta_db.report_problem.message',
                            'asta_db.report_problem.date'
                        )
                        ->where('asta_db.report_problem.id', '=', $id)
                        ->first();
        return $feedbacktransaction;
    }

    public function pdfpersonal($user_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->transactionabusepersonal($user_id));
        return $pdf->stream();
    }

    public function transactionabusepersonal($user_id)
    {
        $personal = $this->personalabusetransaction($user_id);
        $output = '
        <table align="center" style="margin-top:4%;">
            <tr>
                <td>ID Player</td>
                <td>:</td>
                <td>'.$personal->user_id.'</td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>'.$personal->username.'</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>:</td>
                <td>'.$personal->message.'</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>:</td>
                <td>'.$personal->date.'</td>
            </tr>
        </table>
        ';
        return $output;
    }

    public function pdfall()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->report_abuseTransactionAll());
        return $pdf->stream();
    }

    public function report_abuseTransactionAll()
    {
        $alldata = $this->alldataabusetransaction();
        $output = '
        <table border="1" width="100%" height="auto">
        <tr>
            <td align="center">Player ID</td>
            <td align="center">Username</td>
            <td align="center">Message</td>
            <td align="center">date</td>
        </tr>
        ';
        foreach($alldata as $fdgame)
        {
            $output .= '
            <tr>
                <td>'.$fdgame->user_id.'</td>
                <td>'.$fdgame->username.'</td>
                <td>'.$fdgame->message.'</td>
                <td>'.$fdgame->date.'</td>
            </tr>
            ';
        }
        $output .= '</table>';
        return $output;
    }

    public function search(Request $request)
    {
        $player     =   $request->inputPlayer;
        $minDate    =   $request->inputMinDate;
        $maxDate    =   $request->inputMaxDate;
        $TransType  =   $request->TransactionType;
        $datenow    =   Carbon::now('GMT+7');
        $abusetransaction = ReportProblem::join('asta_db.user', 'asta_db.user.user_id', 'asta_db.report_problem.user_id')
                            ->select(
                                'asta_db.report_problem.id',
                                'asta_db.user.username',
                                'asta_db.report_problem.user_id',
                                'asta_db.report_problem.message',
                                'asta_db.report_problem.date',
                                'asta_db.report_problem.isread'
                            );

        $config_text    =   ConfigText::select(
                        'value'
                        ) ->where('id', '=', 15)
                          ->first();
        $replace        =   str_replace(':',',', $config_text->value);
        $AbusetrnsType  =   explode(",", $replace);
        
        $action_abuse_transaction   =   [
            $AbusetrnsType[0]   =>  $AbusetrnsType[1],
            $AbusetrnsType[2]   =>  $AbusetrnsType[3]
        ];

        $validator      =   Validator::make($request->all(), [
            'inputMinDate'  =>  'required|date',
            'inputMaxDate'  =>  'required|date',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if($maxDate < $minDate){
            return back()->with('alert', 'end Date can\'t be less than start date');
        }

        if($player != NULL && $minDate != NULL && $maxDate != NULL && $TransType != NULL)
        {
            if(is_numeric() !== true):
            else:
            endif;
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->where('asta_db.report_problem.type', '=', $TransType)
                        ->whereBetween('asta_db.report_problem.date' ,[$minDate." 00:00:00", $maxDate." 23:59:59"])
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $player != NULL && $minDate != NULL && $TransType != NULL )
        {
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->where('asta_db.report_problem.type', '=', $TransType)
                        ->where('asta_db.report_problem.date', '>=', $minDate)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feeback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $player != NULL && $maxDate != NULL && $TransType != NULL )
        {
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->where('asta_db.report_problem.type', '=', $TransType)
                        ->where('asta_db.report_problem.date', '<=', $maxDate)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $player != NULL && $TransType != NULL )
        {
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->where('asta_db.report_problem.type', '=', $TransType)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $minDate != NULL && $TransType != NULL )
        {
            $search = $abusetransaction->where('asta_db.report_problem.date', '>=', $minDate)
                        ->where('asta_db.report_problem.type', '=', $TransType)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if($maxDate != NULL && $TransType != NULL )
        {
            $search = $abusetransaction->where('asta_db.report_problem.date', '>=', $maxDate)
                        ->where('asta_db.report_problem.type', '=', $TransType)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $player != NULL && $minDate != NULL && $maxDate != NULL )
        {
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->whereBetween('asta_db.report_problem.date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $minDate != NULL && $maxDate != NULL)
        {
            $search = $abusetransaction->whereBetween('asta_db.report_problem.date', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $player != NULL && $maxDate != NUll )
        {
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->where('asta_db.report_problem.date', '<=', $maxDate)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $minDate != NULL )
        {
            $search = $abusetransaction->where('asta_db.report_problem.date', '>=', $minDate)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $maxDate != NULL )
        {
            $search = $abusetransaction->where('asta_db.report_problem.date', '<=', $maxDate)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else if( $TransType != NULL )
        {
            $search = $abusetransaction->where('asta_db.report_problem.Type', '=', $TransType)
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow','action_abuse_transaction', 'AbusetrnsType'));
        } else if( $player != NULL )
        {
            $search = $abusetransaction->where('asta_db.user.username', 'LIKE', '%'.$player.'%')
                        ->paginate(20);
            $search->appends($request->all());
            return view('pages.feedback.abusetransactionreport', compact('search', 'datenow', 'action_abuse_transaction', 'AbusetrnsType'));
        } else {
            return redirect()->route('Abuse_Transaction_Report');
        }
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
    public function update(Request $request, $id)
    {
        //
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
