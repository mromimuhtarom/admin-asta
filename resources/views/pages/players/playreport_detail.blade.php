@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('PlayReport-view') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('PlayReport-view') }}">Play Report</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="search bg-blue-dark" style="margin-bottom: 2%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('PlayReport-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col">
                        <input type="text" class="form-control" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select name="inputGame" class="form-control">
                            <option value="">Choose Game</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->name }}">{{ $gm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMinDate">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMaxDate">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Player Report </h2>
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
                        <th>Playing Game</th>
                        <th>Table</th>
                        <th>Seat</th>
                        <th>Hand Card</th>
                        <th>Table Name</th>
                        <th>Bet</th>
                        <th>Win Lose</th>
                        <th>Status</th>
                        <th>Time Stamp</th>
                        {{-- <th>Country</th> --}}
                    </tr>
                </thead>
                <tbody>
                        @foreach ($player_history as $history)
                        <tr>
                          <td>{{ $history->username }}</td>
                          <td>{{ $history->gamename }}</td>
                          <td>{{ $history->tablename }}</td>
                          <td>{{ $history->seatid }}</td>
                          <td>{{ $history->hand_card }}</td>
                          <td>{{ $history->tablename }}</td>
                          <td>{{ $history->bet }}</td>
                          <td>{{ $history->win_lose }}</td>
                          @php
                          if($history->status === 0) {
                              $status = 'Lose';
                          } else if($history->status === 1) {
                              $status = 'Win';
                          } else if($history->status === 2) {
                              $status = 'Draw';
                          }
                          @endphp
                          <td>{{ $status }}</td>
                          <td>{{ $history->date }}</td>
                          {{-- <td>{{ $history->countryname }}</td> --}}
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
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: true
	});
</script>
@endsection