@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Point_Players') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Point_Players') }}">Point Player</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!--- Warning Alert --->
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
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
<!--- End Warning Alert --->

<!--- Content Search --->
    <div class="search bg-blue-dark" style="margin-bottom:3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Point-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col" style="padding-right:-10%">
                        <input type="text" name="inputPlayer" style="width:95%;" class="left" placeholder="username">
                    </div>
                    <div class="col" >
                        <select name="inputGame" class="form-control">
                            <option value="">Choose Game</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}">{{ $gm->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
<!--- End Content Search --->

<!--- Show After Search --->
@if (Request::is('Players/Point_Players/Point-search*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-database"></i> </span>
            <h2>Chip Players </h2>
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
                        <th>Username</th>
                        <th>Game</th>
                        <th>Action</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Total</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($balancedetails as $bd)

                    <tr class="gradeX">
                        <td>{{ $bd->username }}</td>
                        <td>{{ $bd->gamename }}</td>
                        <td>{{ $actblnc[$bd->action_id] }}</td>
                        <td>{{ $bd->debit }}</td>
                        <td>{{ $bd->credit }}</td>
                        <td>{{ $bd->balance }}</td>
                        <td>{{ $bd->datetime }}</td>
                    </tr>
    
    
                    @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
                    
    </div>`
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
        "order": [[ 6, "desc" ]],
        "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
        },
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