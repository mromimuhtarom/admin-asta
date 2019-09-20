<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\ReportFeedback;

class FeedbackGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbackgame = $this->alldatafeedbackgame();
        return view('pages.feedback.feedbackgame', compact('feedbackgame'));
    }

    public function alldatafeedbackgame()
    {
        $feedbackgame = ReportFeedback::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.report_feedback.user_id')
                        ->select(
                            'asta_db.report_feedback.date',
                            'asta_db.report_feedback.user_id',
                            'asta_db.report_feedback.msg',
                            'asta_db.report_feedback.rating',
                            'asta_db.user.username',
                            'asta_db.report_feedback.id'
                        )
                        ->get();
        return $feedbackgame;
    }

    public function personalfeedbackgame($iduser)
    {
        $feedbackgame = ReportFeedback::join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.report_feedback.user_id')
                        ->select(
                            'asta_db.report_feedback.date',
                            'asta_db.report_feedback.user_id',
                            'asta_db.report_feedback.rating',
                            'asta_db.report_feedback.msg',
                            'asta_db.user.username'
                        )
                        ->where('id', '=', $iduser)
                        ->first();
        return $feedbackgame;
    }

    public function pdfpersonal($user_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->feedbackgamepersonal($user_id));
        return $pdf->stream();
    }

    public function feedbackgamepersonal($user_id)
    {
        $personal = $this->personalfeedbackgame($user_id);
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
                <td>Rating</td>
                <td>:</td>
                <td>'.$personal->strRating().'</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>:</td>
                <td>'.$personal->msg.'</td>
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
        $pdf->loadHTML($this->feedbackgameall());
        return $pdf->stream();
    }

    public function feedbackgameall()
    {
        $alldata = $this->alldatafeedbackgame();
        $output = '
        <table border="1" width="100%" height="auto">
        <tr>
            <td align="center">Player ID</td>
            <td align="center">Username</td>
            <td align="center">Rating</td>
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
                <td>'.$fdgame->strRating().'</td>
                <td>'.$fdgame->msg.'</td>
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
