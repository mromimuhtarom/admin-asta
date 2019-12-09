@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('High_Roller') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('High_Roller') }}">Log Player</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!----- Warning Alert ----->
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
<!----- End Warning Alert ------>

<!----- Conten Search ----->
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('LogPlayer-search') }}">
            <div class="row h-100 w-100">
                <div class="col">
                    <input type="text" name="username" class="left" placeholder="username / Player ID">
                </div>
                <div class="col">
                    <select name="action" id="" class="form-control">
                        <option value="">Choose Action</option>
                        @foreach($action as $ac)
                        <option value="{{ $ac->id }}">{{ $ac->action}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="dari" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="sampai" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!------ End Content Search ----->

<!----- Show After Search ------>
@if (Request::is('Players/Log_Players/LogPlayer'))
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-history"></i> </span>
            <h2>Log Player </h2>
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
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                        Total Record Entries is {{ $logplayer->total() }}
                    </div>
                                <!-- End Button tambah bot baru -->
                </div>
            </div>                     
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th><a href="{{ route('LogPlayer-search') }}?username={{ $getusername }}&action={{ $getAction }}&dari={{ $getMindate }}&sampai={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.log_user.user_id">Player ID<i class="fa fa-sort{{ iconsorting('asta_db.log_user.user_id') }}"></i></a></th>
                        <th><a href="{{ route('LogPlayer-search') }}?username={{ $getusername }}&action={{ $getAction }}&dari={{ $getMaxdate }}&sampai={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username"> Username <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                        <th><a href="{{ route('LogPlayer-search') }}?username={{ $getusername }}&action={{ $getAction }}&dari={{ $getMaxdate }}&sampai={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.log_user.action_id"> Action <i class="fa fa-sort{{ iconsorting('asta_db.log_user.action_id') }}"></i></a></th>
                        <th><a href="{{ route('LogPlayer-search') }}?username={{ $getusername }}$action={{ $getAction }}&dari={{ $getMaxdate }}&sampai={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.log_user.description"> Desc <i class="fa fa-sort{{ iconsorting('asta_db.log_user.description') }}"></i></a></th>
                        <th><a href="{{ route('LogPlayer-search') }}?username={{ $getusername }}$action={{ $getAction }}&dari={{ $getMindate }}&sampai={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.log_user.datetime"> TimeStamp <i class="fa fa-sort{{ iconsorting('asta_db.log_user.datetime') }}"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logplayer  as $log)
                    <tr>
                        <td>{{ $log->user_id}}</td>
                        <td>{{ $log->username }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->desc }}</td>
                        <td>{{ $log->datetime }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
        <div style="display: flex;justify-content: center;">{{ $logplayer->links() }}</div>                    
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
        "paging":false,
        "bInfo":false,
        "ordering": false,
        "bLengthChange": false,
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: false
	});
</script>
@endif
<!----- End Search After Search ----->
@endsection