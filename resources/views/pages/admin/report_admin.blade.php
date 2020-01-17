@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Admin') }}">{{ translate_MenuContentAdmin('Admin') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Admin') }}">{{ translate_MenuContentAdmin('Report Admin') }}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
@if (\Session::has('alert'))
  <div class="alert alert-danger">
    <p>{{\Session::get('alert')}}</p>
  </div>
@endif
@if (count($errors) > 0)
<div class="error-val">
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>
</div>
@endif
    <div class="search bg-blue-dark" style="margin-bottom:3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('ReportAdmin-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    @if(Request::is('Admin/Report_Admin/ReportAdmin-search*'))
                        <div class="col">
                            <input type="text" name="inputPlayer" class="left" placeholder="username" value="{{ $player }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <select name="logType" class="form-control">
                                <option value="">{{ translate_MenuContentAdmin('Choose Log Type') }}</option>
                                <option value="{{ $logonlinetype[0] }}" @if($logtype == $logonlinetype[0]) selected @endif;>{{ $logonlinetype[1]}} {{ translate_MenuContentAdmin('Admin') }}</option>
                                <option value="{{ $logonlinetype[2] }}" @if($logtype == $logonlinetype[2]) selected @endif;>{{ $logonlinetype[3]}} {{ translate_MenuContentAdmin('Admin') }}</option>
                            </select>
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate" value="{{ $minDate }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate" value="{{ $maxDate }}">
                        </div>
                    @else 
                        <div class="col">
                            <input type="text" name="inputPlayer" class="left" placeholder="username">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <select name="logType" class="form-control">
                                <option value="">{{ translate_MenuContentAdmin('Choose Log Type') }}</option>
                                <option value="{{ $logonlinetype[0] }}">{{ $logonlinetype[1]}} {{ translate_MenuContentAdmin('Admin') }}</option>
                                <option value="{{ $logonlinetype[2] }}">{{ $logonlinetype[3]}} {{ translate_MenuContentAdmin('Admin') }}</option>
                            </select>
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                        </div>
                    @endif
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i>{{ translate_MenuContentAdmin('Search') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  

@if(Request::is('Admin/Report_Admin/ReportAdmin-search*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-history"></i> </span>
            <h2>{{ translate_MenuContentAdmin('Admin Report') }}</h2>
        </div>
    
        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
        </div>
    </header>
    <div> 
                    
        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->
        </div>
        <!-- end widget edit box -->
                    
        <!-- widget content -->
        <div class="widget-body p-0">
                    
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th>{{ translate_MenuContentAdmin('Admin ID') }}</th>
                        <th>{{ translate_MenuContentAdmin('Username') }}</th>
                        <th>{{ translate_MenuContentAdmin('Status') }}</th>
                        <th>{{ translate_MenuContentAdmin('Time Stamp') }}</th>
                        <th>{{ translate_MenuContentAdmin('Ip') }}</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($log_login as $login)
                        <tr>
                          <td>{{ $login->user_id }}</td>
                          <td>{{ $login->username }}</td>
                          <td>{{ $action_report_admin[$login->action_id] }}{{ translate_MenuContentAdmin('Admin') }}</td>
                          <td>{{ $login->datetime }}</td>
                          <td>{{ $login->ip }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
                    
    </div>
    <!-- end widget div -->
                    
</div>
    <!-- end widget -->
<script>
  var responsiveHelper_dt_basic = responsiveHelper_dt_basic || undefined;
			
	var breakpointDefinition = {
	    tablet : 1024,
		phone : 480
	};
	
	$('#dt_basic').dataTable({
	    "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'>r>"+
		    "t"+
			"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
			"autoWidth" : true,
			"oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
		},
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
        "order": [[ 2, "desc" ]],
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: false
	});
</script>
@endif
@endsection