@extends('index')

@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Report_Players') }}">{{ Translate_menuPlayers('L_PLAYERS') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Report_Players') }}">{{ Translate_menuPlayers('L_REPORT_PLAYER') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!--- Warning Alert --->
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
<!--- End Warning Alert --->

<!--- Content Search --->
    <div class="search bg-blue-dark" style="margin-bottom: 3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('ReportPlayer-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    @if (Request::is('Players/Report_Players/ReportPlayer-search'))
                    <div class="col">
                        <input type="text" name="inputPlayer" class="left" placeholder="username/Player ID" value="{{ $player }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select name="logType" class="form-control">
                            <option value="">{{ Translate_menuPlayers('L_CHOOSE_LOG_TYPE') }}</option>
                            <option value="{{ $logonlinetype[0] }}" @if($logtype == $logonlinetype[0]) selected @endif;>Pemain {{ ConfigTextTranslate($logonlinetype[1])}}</option>
                            <option value="{{ $logonlinetype[2] }}" @if($logtype == $logonlinetype[2]) selected @endif;>Pemain {{ ConfigTextTranslate($logonlinetype[3])}}</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMinDate"  value="{{ $minDate }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMaxDate"  value="{{ $maxDate }}">
                    </div>
                    @else
                    <div class="col">
                        <input type="text" name="inputPlayer" class="left" placeholder="username/Player ID">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select name="logType" class="form-control">
                            <option value="">{{ Translate_menuPlayers('L_CHOOSE_LOG_TYPE') }}</option>
                            <option value="{{ $logonlinetype[0] }}">Pemain {{ ConfigTextTranslate($logonlinetype[1])}}</option>
                            <option value="{{ $logonlinetype[2] }}">Pemain {{ ConfigTextTranslate($logonlinetype[3])}}</option>
                        </select>
                    </div> 
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMinDate"  value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMaxDate"  value="{{ $datenow->toDateString() }}">
                    </div>                    
                    @endif
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
<!--- End Content Search --->

<!--- Show After Search --->
@if (Request::is('Players/Report_Players/ReportPlayer-search'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-history"></i> </span>
            <h2>{{ Translate_menuPlayers('L_REPORT_PLAYER') }} </h2>
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
                <div class="widget-body-toolbar">
        
                        <div class="row">
                          
                          <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                            {{ Translate_menuPlayers('L_TOTAL_RECORD') }} {{ $log_login->total() }}</div>
                
                        </div>
                
                </div>
                    
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th>{{ Translate_menuPlayers('L_PLAYER_ID') }}</th>
                        <th>{{ Translate_menuPlayers('L_USERNAME') }}</th>
                        <th>{{ Translate_menuPlayers('L_STATUS') }}</th>
                        <th>{{ Translate_menuPlayers('L_TIMESTAMP') }}</th>
                        <th>{{ Translate_menuPlayers('L_IP') }}</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($log_login as $login)
                        <tr>
                          <td>{{ $login->user_id }}</td>
                          <td>{{ $login->username }}</td>
                          <td> pemain {{ ConfigTextTranslate($action_report_player[$login->action_id]) }}</td>
                          <td>{{ date("d-m-Y H:i:s", strtotime($login->datetime)) }}</td>
                          <td>{{ $login->ip }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
        <div style="display:flex;justify-content: center;">{{ $log_login->links() }}</div>
                    
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
            "bInfo" : false,
            "paging" : false,
            "bLengthChange" : false,
			"oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
		},
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: false
	});
</script>
@endif
<!--- End Show After Search --->
@endsection