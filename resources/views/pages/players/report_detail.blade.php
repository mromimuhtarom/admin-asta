@extends('index')

@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection


@section('content')
<div class="search bg-teal">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Report-search') }}" method="get" role="search">
                <div class="row h-100 w-100">
                    <div class="col">
                        <input type="text" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col">
                        <select name="inputGame">
                            <option>Choose Game</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}">{{ $gm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="date" name="inputMinDate">
                    </div>
                    <div class="col">
                        <input type="date" name="inputMaxDate">
                    </div>
                    <div class="col">
                        <button class="myButton" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
    
        {{-- <div class="table-aii" style=" display: table; width: auto;">
            <div class="table-header">
                    Report
            </div>
             <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Username</th>
                    <th class="th-sm">Playing Game</th>
                    <th class="th-sm">Table</th>
                    <th class="th-sm">Seat</th>
                    <th class="th-sm">Card</th>
                    <th class="th-sm">Table Card</th>
                    <th class="th-sm">Bet</th>
                    <th class="th-sm">Win Amount</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">Time Stamp</th>
                    <th class="th-sm">Country</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($player_history as $history)
                    <tr>
                      <td></td>
                      <td>{{ $history->username }}</td>
                      <td>{{ $history->gamename }}</td>
                      <td>{{ $history->tablename }}</td>
                      <td>{{ $history->seat }}</td>
                      <td>{{ $history->cards }}</td>
                      <td>{{ $history->tablecards }}</td>
                      <td>{{ $history->bet }}</td>
                      <td>{{ $history->winAmount }}</td>
                      <td>{{ $history->status }}</td>
                      <td>{{ $history->ts }}</td>
                      <td>{{ $history->countryname }}</td>
                      <td></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
             
        </div>
<script>
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
      });
</script> --}}
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Standard Data Tables </h2>
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
                        <th data-hide="phone">Username</th>
                        <th data-class="expand">Playing Game</th>
                        <th data-hide="phone">Table</th>
                        <th>Seat</th>
                        <th data-hide="phone,tablet">Card</th>
                        <th data-hide="phone,tablet">Table Card</th>
                        <th data-hide="phone,tablet">Bet</th>
                        <th data-hide="phone,tablet">Win Amount</th>
                        <th data-hide="phone,tablet">Status</th>
                        <th data-hide="phone,tablet">Time Stamp</th>
                        <th data-hide="phone,tablet">Country</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($player_history as $history)
                        <tr>
                          <td></td>
                          <td>{{ $history->username }}</td>
                          <td>{{ $history->gamename }}</td>
                          <td>{{ $history->tablename }}</td>
                          <td>{{ $history->seat }}</td>
                          <td>{{ $history->cards }}</td>
                          <td>{{ $history->tablecards }}</td>
                          <td>{{ $history->bet }}</td>
                          <td>{{ $history->winAmount }}</td>
                          <td>{{ $history->status }}</td>
                          <td>{{ $history->ts }}</td>
                          <td>{{ $history->countryname }}</td>
                          <td></td>
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
	    "sDom": "<'dt-toolbar d-flex'<f><'ml-auto hidden-xs show-control'l>r>"+
		    "t"+
			"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
			"autoWidth" : true,
			"oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
		},
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: true
	});
</script>
@endsection