@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('High_Roller') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('High_Roller') }}">High Roller</a></li>
@endsection


@section('content')
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
      <header>
        <div class="widget-header">	
          <span class="widget-icon"> <i class="fa fa-group"></i> </span>
          <h2>High Rollers</h2>
        </div>

        <div class="widget-toolbar">
          <!-- add: non-hidden - to disable auto hide -->
        </div>
      </header>

      <!-- widget div-->
      <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
          <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->

        <!-- widget content -->
        <div class="widget-body p-0">
          
          <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th data-hide="phone">Back Account</th>
                <th data-hide="phone,tablet">Players</th>
                <th data-hide="phone,tablet">Country</th>
                <th data-hide="phone,tablet">Gold</th>
              </tr>
            </thead>
            <tbody>
                @foreach($player as $plyr)
              <tr>
                <td>{{ number_format($plyr->chip, 2,',', '.') }}</td>
                <td>{{ $plyr->username }}</td>
                <td>{{ $plyr->name }}</td>
                <td>{{ $plyr->gold}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        
        </div>
        <!-- end widget content -->

      </div>
      <!-- end widget div -->

  </div>
<script>
				var responsiveHelper_datatable_col_reorder = responsiveHelper_datatable_col_reorder || undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
      $('#datatable_col_reorder').dataTable({
				"sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'f>r>"+
						    "t"+
						    "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
				"autoWidth" : true,
        "bSort" : false,
				"classes": {
					"sWrapper":      "dataTables_wrapper dt-bootstrap4"
				},
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
				},
			    buttons: [ {
			        extend: 'colvis',
			        text: 'Show / hide columns',
			        className: 'btn btn-default',
			        columnText: function ( dt, idx, title ) {
			            return title;
			        }			        
			    } ],
			    
				responsive: false
			});
</script>    
@endsection