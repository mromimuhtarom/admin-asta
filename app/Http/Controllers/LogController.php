<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Log;
use Carbon\Carbon;
use App\Action;
use Validator;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actionSearch = Action::select('action', 'id')
                        ->whereBetween('id', [1, 6])
                        ->get();
        $datenow = Carbon::now('GMT+7');
        return view('pages.admin.log_admin', compact('actionSearch', 'datenow'));
    }



    public function search(Request $request)
    {
        $searchUser  = $request->username;
        $minDate     = $request->dari;
        $maxDate     = $request->sampai;
        $inputAction = $request->action;
  
        $actionSearch = Action::select('action', 'id')
                        ->whereBetween('id', [1, 6])
                        ->get();
        $datenow      = Carbon::now('GMT+7');
        $logOperator  = Log::select(
                                'asta_db.log_operator.datetime',
                                'asta_db.log_operator.desc', 
                                'asta_db.action.action', 
                                'asta_db.operator.username'
                        )
                        ->join('asta_db.action', 'asta_db.log_operator.action_id','=', 'asta_db.action.id')
                        ->join('asta_db.operator', 'asta_db.log_operator.op_id', '=', 'asta_db.operator.op_id');

        $validator = Validator::make($request->all(),[
            'dari'   => 'required|date',
            'sampai' => 'required|date',
        ]);
    
        if ($validator->fails()) {
            return self::index()->withErrors($validator->errors());
        }
        if($maxDate < $minDate){
                return back()->with('alert','End Date can\'t be less than start date');
        }

        if($searchUser != NULL && $minDate != NULL && $maxDate != NULL && $inputAction != NULL) {
          $logs = $logOperator->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->where('asta_db.log_operator.action_id', '=', $inputAction)
                  ->wherebetween('asta_db.log_operator.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
                  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
        }else if($searchUser != NULL && $inputAction != NULL && $minDate != NULL) {
          $logs = $logOperator->where('asta_db.log_operator.action_id', '=', $inputAction)
                  ->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '>=', $minDate." 00:00:00")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
                  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
        }else if($searchUser != NULL && $inputAction != NULL &&  $maxDate != NULL) {
          $logs = $logOperator->where('asta_db.log_operator.action_id', '=', $inputAction)
                  ->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '<=', $maxDate." 23:59:59")
                  ->orderBy('asta_db.log_operator.datetime', 'asc')
                  ->get();
                  
  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
                
        }else if($minDate != NULL && $maxDate != NULL &&  $inputAction != NULL) {
          $logs = $logOperator->wherebetween('asta_db.log_operator.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                 ->where('asta_db.log_operator.action_id', '=', $inputAction)
                 ->orderBy('asta_db.log_operator.datetime', 'desc')
                 ->get();
                 
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
       }else if ($minDate != NULL && $maxDate != NULL){
         $logs = $logOperator->wherebetween('asta_db.log_operator.datetime', [$minDate." 00:00:00", $maxDate." 23:59:59"])
                 ->orderBy('asta_db.log_operator.datetime', 'asc')
                 ->get();
  
                 
         return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
       }else if ($searchUser != NULL && $maxDate != NULL){
          $logs = $logOperator->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '<=', $maxDate." 23:59:59")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
        }else if($searchUser != NULL &&  $inputAction != NULL) {
          $logs = $logOperator->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->where('asta_db.log_operator.action_id', '=', $inputAction)
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();

          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
        }else if($minDate != NULL &&  $inputAction != NULL) {
               $logs = $logOperator->where('asta_db.log_operator.action_id', '=', $inputAction)
                       ->WHERE('asta_db.log_operator.datetime', '>=', $minDate." 00:00:00")
                       ->orderBy('asta_db.log_operator.datetime', 'desc')
                       ->get();
  
  
                return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
        }else if($maxDate != NULL &&  $inputAction != NULL) {
                $logs = $logOperator->where('asta_db.log_operator.action_id', '=', $inputAction)
                        ->WHERE('asta_db.log_operator.datetime', '<=', $maxDate." 23:59:59")
                        ->orderBy('asta_db.log_operator.datetime', 'desc')
                        ->get();
  
  
                return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
        }else if($searchUser != NULL && $minDate != NULL ) {
          $logs = $logOperator->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->WHERE('asta_db.log_operator.datetime', '>=', $minDate." 00:00:00")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
  
         return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
       }else if ($minDate != NULL){
          $logs = $logOperator->WHERE('asta_db.log_operator.datetime', '>=', $minDate." 00:00:00")
                  ->orderBy('asta_db.log_operator.datetime', 'asc')
                  ->get();
  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
        }else if ($maxDate != NULL){
          $logs = $logOperator->WHERE('asta_db.log_operator.datetime', '<=', $maxDate." 23:59:59")
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
        }else if($searchUser != NULL ){
          $logs = $logOperator->where('asta_db.operator.username', 'LIKE', '%'.$searchUser.'%')
                  ->orderBy('asta_db.log_operator.datetime', 'desc')
                  ->get();
  
  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
  
        }else if($inputAction != NULL) {
          $logs = $logOperator->where('asta_db.log_operator.action_id', '=', $inputAction)
                 ->orderBy('asta_db.log_operator.datetime', 'desc')
                 ->get();
  
  
          return view('pages.admin.log_admin', compact('logs', 'actionSearch', 'datenow'));
        }else{
          return self::index();
        }

    }
}
