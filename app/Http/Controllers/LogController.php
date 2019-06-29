<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use App\Action;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Action::select('action')->where('id', '!=', 7)->where('id', '!=', 8)->get();
        return view('pages.admin.log_admin', compact('logs'));
    }



    public function search(Request $request)
    {
        $inputUser    = $request->username;
        $inputMinDate = $request->dari;
        $inputMaxDate = $request->sampai;
        $inputAction  = $request->action;
  
        $actionSearch =  Action::select('action')->where('id', '!=', 7)->where('id', '!=', 8)->get();
  
        if($inputUser != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputAction != NULL) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                 ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                 ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                 ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                 ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                 ->wherebetween('asta_db.log_operator.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                 ->orderBy('asta_db.log_operator.datetime', 'desc')
                 ->get();
                 
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL && $inputAction != NULL && $inputMinDate != NULL) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                  ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '>=', $inputMinDate." 00:00:00")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
                  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL && $inputAction != NULL &&  $inputMaxDate != NULL) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                  ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '<=', $inputMaxDate." 23:59:59")
                  ->orderBy('asta_db.log_operator.datetime', 'asc')
                  ->get();
                  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputMinDate != NULL && $inputMaxDate != NULL &&  $inputAction != NULL) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                 ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                 ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                 ->wherebetween('asta_db.log_operator.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                 ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                 ->orderBy('asta_db.log_operator.datetime', 'desc')
                 ->get();
  
                 
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
       }else if ($inputMinDate != NULL && $inputMaxDate != NULL){
         $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                 ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                 ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                 ->wherebetween('asta_db.log_operator.datetime', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                 ->orderBy('asta_db.log_operator.datetime', 'asc')
                 ->get();
  
                 
         return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
       }else if ($inputUser != NULL && $inputMaxDate != NULL){
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '<=', $inputMaxDate." 23:59:59")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL &&  $inputAction != NULL) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();

          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else if($inputMinDate != NULL &&  $inputAction != NULL) {
               $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                       ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                       ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                       ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                       ->WHERE('asta_db.log_operator.datetime', '>=', $inputMinDate." 00:00:00")
                       ->orderBy('asta_db.log_operator.datetime', 'desc')
                       ->get();
  
  
                return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else if($inputMaxDate != NULL &&  $inputAction != NULL) {
                $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                        ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                        ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                        ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                        ->WHERE('asta_db.log_operator.datetime', '<=', $inputMaxDate." 23:59:59")
                        ->orderBy('asta_db.log_operator.datetime', 'desc')
                        ->get();
  
  
                return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else if($inputUser != NULL && $inputMinDate != NULL ) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '>=', $inputMinDate." 00:00:00")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
  
         return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
       }else if ($inputMinDate != NULL){
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->WHERE('asta_db.log_operator.datetime', '>=', $inputMinDate." 00:00:00")
                  ->orderBy('asta_db.log_operator.datetime', 'asc')
                  ->get();
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if ($inputMaxDate != NULL){
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator ', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->WHERE('asta_db.log_operator.datetime', '<=', $inputMaxDate." 23:59:59")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL ){
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                  ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                  ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                  ->where('asta_db.operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputAction != NULL) {
          $logs = Log::select('asta_db.log_operator.*', 'asta_db.action.action', 'asta_db.operator.username')
                 ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                 ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id')
                 ->where('asta_db.action.action', 'LIKE', '%'.$inputAction.'%')
                 ->orderBy('asta_db.log_operator.datetime', 'desc')
                 ->get();
  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else{
          return self::index();
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
