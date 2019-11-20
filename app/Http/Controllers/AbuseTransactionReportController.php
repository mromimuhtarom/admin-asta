<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportProblem;
use PDF;
use App\ReportFeedback;

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
                                'asta_db.report_problem.date'
                            )
                            ->get();
                            ReportProblem::where('isread', '=', 0)->update([
                                'isread' => 1
                            ]);

        
        return view('pages.feedback.abusetransactionreport', compact('abusetransaction'));
    }

    public function api_insert_abuse_transaction(Request $request)
    {
        $user_id    = $request->user_id;
        $item       = $request->item;
        $jlh        = $request->jlh;
        $time       = $request->time;
        $description = $request->description;

        ReportProblem::create([
            'user_id' => $user_id,
            'type'    => 1,
            'message' => "Item Name : ".$item."\n Quantity : ".$jlh."\n ".$description,
            'isread'  => 0,
            'date'    => $time
        ]);
        // $all   = $request->all();
        // $image = $request->base64Image;
        // $id    = $request->userId;

        // $image_decode = base64_decode($image);
        // $imageName = $id.'.'.'jpg';

        // $rootpath = '../public/report_problem';
        // $client = Storage::createLocalDriver(['root' => $rootpath]);
        // if($client->put($imageName, $image_decode))
        // {
        //   echo 'Successful';
        // } else 
        // {
        //   echo 'Failed';
        // }

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
