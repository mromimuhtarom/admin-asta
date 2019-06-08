<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = DB::table('action')
                ->select('action')
                ->groupBy('action')
                ->get();
        return view('pages.admin.log_admin', compact('logs'));
    }



    public function search(Request $request)
    {
        $inputUser    = $request->username;
        $inputMinDate = $request->dari;
        $inputMaxDate = $request->sampai;
        $inputAction  = $request->action;
  
        $actionSearch =  DB::table('action')
                         ->select('action')
                         ->groupBy('action')
                         ->get();
  
        if($inputUser != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputAction != NULL) {
          $logs = DB::table('admin_log')
                 ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                 ->join('action', 'admin_log.action_id','=', 'action.id')
                 ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                 ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                 ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
                 ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                 ->wherebetween('admin_log.date', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                 ->orderBy('admin_log.date', 'desc')
                 ->get();
                 
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL && $inputAction != NULL && $inputMinDate != NULL) {
          $logs = DB::table('admin_log')
                  ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                  ->join('action', 'admin_log.action_id','=', 'action.id')
                  ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                  ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                  ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                  ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('admin_log.date', '>=', $inputMinDate." 00:00:00")
                  ->orderBy('admin_log.date', 'desc')
                  ->get();
                  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL && $inputAction != NULL &&  $inputMaxDate != NULL) {
          $logs = DB::table('admin_log')
                  ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                  ->join('action', 'admin_log.action_id','=', 'action.id')
                  ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                  ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                  ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                  ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('admin_log.date', '<=', $inputMaxDate." 23:59:59")
                  ->orderBy('admin_log.date', 'asc')
                  ->get();
                  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputMinDate != NULL && $inputMaxDate != NULL &&  $inputAction != NULL) {
          $logs = DB::table('admin_log')
                 ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                 ->join('action', 'admin_log.action_id','=', 'action.id')
                 ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                 ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                 ->wherebetween('admin_log.date', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                 ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                 ->orderBy('admin_log.date', 'desc')
                 ->get();
  
                 
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
       }else if ($inputMinDate != NULL && $inputMaxDate != NULL){
         $logs = DB::table('admin_log')
                 ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                 ->join('action', 'admin_log.action_id','=', 'action.id')
                 ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                 ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                 ->wherebetween('admin_log.date', [$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                 ->orderBy('admin_log.date', 'asc')
                 ->get();
  
                 
         return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
       }else if ($inputUser != NULL && $inputMaxDate != NULL){
          $logs = DB::table('admin_log')
                  ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                  ->join('action', 'admin_log.action_id','=', 'action.id')
                  ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                  ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                  ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->WHERE('admin_log.date', '<=', $inputMaxDate." 23:59:59")
                  ->orderBy('admin_log.date', 'desc')
                  ->get();
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL &&  $inputAction != NULL) {
          $logs = DB::table('admin_log')
             ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
             ->join('action', 'admin_log.action_id','=', 'action.id')
             ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
             ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
             ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
             ->where('action.action', 'LIKE', '%'.$inputAction.'%')
             ->orderBy('admin_log.date', 'desc')
             ->get();

          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else if($inputMinDate != NULL &&  $inputAction != NULL) {
               $logs = DB::table('admin_log')
                       ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                       ->join('action', 'admin_log.action_id','=', 'action.id')
                       ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                       ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                       ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                       ->WHERE('admin_log.date', '>=', $inputMinDate." 00:00:00")
                       ->orderBy('admin_log.date', 'desc')
                       ->get();
  
  
                return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else if($inputMaxDate != NULL &&  $inputAction != NULL) {
                $logs = DB::table('admin_log')
                        ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                        ->join('action', 'admin_log.action_id','=', 'action.id')
                        ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                        ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                        ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                        ->WHERE('admin_log.date', '<=', $inputMaxDate." 23:59:59")
                        ->orderBy('admin_log.date', 'desc')
                        ->get();
  
  
                return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
        }else if($inputUser != NULL && $inputMinDate != NULL ) {
          $logs = DB::table('admin_log')
                 ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                 ->join('action', 'admin_log.action_id','=', 'action.id')
                 ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                 ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                 ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
                 ->WHERE('admin_log.date', '>=', $inputMinDate." 00:00:00")
                 ->orderBy('admin_log.date', 'desc')
                 ->get();
  
  
         return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
       }else if ($inputMinDate != NULL){
          $logs = DB::table('admin_log')
                  ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                  ->join('action', 'admin_log.action_id','=', 'action.id')
                  ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                  ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                  ->WHERE('admin_log.date', '>=', $inputMinDate." 00:00:00")
                  ->orderBy('admin_log.date', 'asc')
                  ->get();
  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if ($inputMaxDate != NULL){
          $logs = DB::table('admin_log')
                  ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                  ->join('action', 'admin_log.action_id','=', 'action.id')
                  ->join('operator ', 'admin_log.operator_id', '=', 'operator .operator_id')
                  ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                  ->WHERE('admin_log.date', '<=', $inputMaxDate." 23:59:59")
                  ->orderBy('admin_log.date', 'desc')
                  ->get();
  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputUser != NULL ){
          $logs = DB::table('admin_log')
                  ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                  ->join('action', 'admin_log.action_id','=', 'action.id')
                  ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                  ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                  ->where('operator.username', 'LIKE', '%'.$inputUser.'%')
                  ->orderBy('admin_log.date', 'desc')
                  ->get();
  
  
          return view('pages.admin.log_admin_detail', compact('logs', 'actionSearch'));
  
        }else if($inputAction != NULL) {
          $logs = DB::table('admin_log')
                 ->select('admin_log.*', 'action.action', 'operator.username', 'adm_menu.name')
                 ->join('action', 'admin_log.action_id','=', 'action.id')
                 ->join('operator', 'admin_log.operator_id', '=', 'operator.operator_id')
                 ->join('adm_menu', 'admin_log.menu_id','=', 'adm_menu.menu_id')
                 ->where('action.action', 'LIKE', '%'.$inputAction.'%')
                 ->orderBy('admin_log.date', 'desc')
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
