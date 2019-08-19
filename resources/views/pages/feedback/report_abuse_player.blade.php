@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('User_Admin') }}">Feedback</a></li>
        <li class="breadcrumb-item"><a href="{{ route('User_Admin') }}">Report Abuse Player</a></li>
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
        <form action="{{ route('ReportAbusePlayer-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col">
                    <input type="text" name="inputReportPlayer" class="left" placeholder="Report Player">
                </div>
                <div class="col" style="padding-left:1%;">
                    <input type="text" name="inputReportedPlayer" class="form-control" placeholder="Reported Player">
                </div>
                <div class="col" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:1%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>  

@if(Request::is('FeedBack/Report_Abuse_Player/ReportAbusePlayer-search*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">
<header>
    <div class="widget-header">	
        <span class="widget-icon"> <i class="fa fa-history"></i> </span>
        <h2>Report Abuse Player </h2>
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
                    <th>Report</th>
                    <th>Reported</th>
                    <th>Reason</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($problemplayer as $pplayer)
                    <tr>
                      @foreach($abuseplayer as $abplyr)
                      @if ($abplyr->user_id == $pplayer->report)
                      <td>{{ $abplyr->username }}</td>
                      @elseif($abplyr->user_id == $pplayer->reported)
                      <td>{{ $abplyr->username }}</td>
                      @endif
                      @endforeach
                      <td>{{ $pplayer->reason }}</td>
                      <td>{{ $pplayer->date }}</td>
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
    responsive: true
});
</script>
@endif
@endsection