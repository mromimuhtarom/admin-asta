@extends('index')

@section('namepages')
<h1 class="page-header"><i class="fa-fw fa fa-home"></i>  Players <span>> Active Players</span></h1>
@endsection


@section('content')
<!-- BEGIN .sa-content-wrapper -->
<div class="sa-content-wrapper">
  <div class="sa-content">
    <section id="players-online">
      <!-- Widget ID (each widget will need unique ID)-->
      <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
        <header>
          <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Players Online </h2>
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
                  <th data-hide="phone">User Player</th>
                  <th data-class="expand">Rank</th>
                  <th data-hide="phone">Chip</th>
                  <th data-hide="phone">Gold Coins</th>
                  <th data-hide="phone">From</th>
                  <th data-hide="phone">Playing Games</th>
                  <th data-hide="phone,tablet">Table</th>
                  <th data-hide="phone,tablet">Device</th>
                  <th data-hide="phone,tablet">Date</th>
                  <th data-hide="phone,tablet">Time</th>
                </tr>
              </thead>
              <tbody>
                @foreach($online as $ol)
                <tr>
                    <td>{{ $ol->username }}</td>
                    <td>{{ $ol->rank_id }}</td>
                    <td>{{ $ol->chip }}</td>
                    <td>{{ $ol->gold }}</td>
                    @php
                    if($ol->user_type === 2) {
                        $user_type = 'Guest';
                    } else if($ol->facebook_id !== ''){
                        $user_type = 'Facebook';
                    } else if($ol->user_type === 1) {
                        $user_type = 'Register';
                    }
                    @endphp
                    <td>{{ $user_type }}</td>
                    <td>{{ $ol->game_name }}</td>
                    <td></td>
                    <td>{{ $ol->devicename }}</td>
                    @php
                    $date = new DateTime($ol->date_login);                        
                    @endphp
                    <td>{{  $date->format("Y-m-d") }}</td>
                    @php
                    $time = strtotime($ol->date_login)    
                    @endphp
                    <td>{{ date("H:i:s", $time)}}</td>
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
    </section>

    {{-- <section class="player-offline">
      <!-- Widget ID (each widget will need unique ID)-->
      <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-3" data-widget-editbutton="false">
          <header>
            <div class="widget-header">	
              <span class="widget-icon"> <i class="fa fa-table"></i> </span>
              <h2>Players Offline</h2>
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
                      <th class="th-sm">User Player</th>
                      <th class="th-sm">Rank</th>
                      <th class="th-sm">Chip</th>
                      <th class="th-sm">Gold Coins</th>
                      <th class="th-sm">From</th>
                      <th class="th-sm">Table</th>
                      <th class="th-sm">Device</th>
                      <th class="th-sm">Date</th>
                      <th class="th-sm">Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($offline as $of)
                  <tr>
                      <td>{{ $of->username }}</td>
                      <td>{{ $of->rank_id }}</td>
                      <td>{{ $of->chip }}</td>
                      <td>{{ $of->gold }}</td>
                      @php
                      if($of->user_type === 2) {
                          $user_type = 'Guest';
                      } else if($of->facebook_id !== ''){
                          $user_type = 'Facebook';
                      } else if($of->user_type === 1) {
                          $user_type = 'Register';
                      }
                      @endphp
                      <td>{{ $user_type }}</td>
                      <td></td>
                      <td>{{ $of->name }}</td>
                      @php
                      $date = new DateTime($of->date_login);                        
                      @endphp
                      <td>{{  $date->format("Y-m-d") }}</td>
                      @php
                      $time = strtotime($of->date_login)    
                      @endphp
                      <td>{{ date("H:i:s", $time)}}</td>
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
      </section>
    </section> --}}

    							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
								<header>
									<div class="widget-header">	
										<span class="widget-icon"> <i class="fa fa-table"></i> </span>
										<h2>Hide / Show Columns </h2>
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
													<th data-hide="phone">ID</th>
													<th data-class="expand">Name</th>
													<th>Phone</th>
													<th data-hide="phone">Company</th>
													<th data-hide="phone,tablet">Zip</th>
													<th data-hide="phone,tablet">City</th>
													<th data-hide="phone,tablet">Date</th>
													<th data-hide="phone,tablet">Zip</th>
													<th data-hide="phone,tablet">City</th>
													<th data-hide="phone,tablet">Date</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Jennifer</td>
													<td>1-342-463-8341</td>
													<td>Et Rutrum Non Associates</td>
													<td>35728</td>
													<td></td>
													<td>03/04/14</td>
													<td>35728</td>
													<td>Fogo</td>
													<td>03/04/14</td>
												</tr>
											</tbody>
										</table>
									
									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
				
							</div>
							<!-- end widget -->

  </div>
</div>
<!-- END .sa-content-wrapper -->

<script type="text/javascript">
  // table = $('table.table').dataTable({
  //   "sDom": "<'dt-toolbar d-flex align-items-center'<f><'hidden-xs ml-auto'B>r>"+
  //       "t"+
  //       "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
  //   "autoWidth" : true,
  //   "classes": {
  //     "sWrapper": "dataTables_wrapper dt-bootstrap4"
  //   },
  //   "oLanguage": {
  //     "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
  //   },
  //     buttons: [ {
  //         extend: 'colvis',
  //         text: 'Show / hide columns',
  //         className: 'btn btn-default',
  //         columnText: function ( dt, idx, title ) {
  //             return title;
  //         }			        
  //     } ],
  //     "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
  //         $.ajaxSetup({
  //           headers: {
  //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //           }
  //         });

  //         $('.usertext').editable({
  //           mode :'popup'
  //         });

  //     },
  //   responsive: true


  var responsiveHelper_datatable_col_reorder = responsiveHelper_datatable_col_reorder || undefined;

  var breakpointDefinition = {
    tablet : 1024,
    phone : 480
  };

  alert('hello');

  /* COLUMN SHOW - HIDE */
  table = $('#datatable_col_reorder').dataTable({
    "sDom": "<'dt-toolbar d-flex align-items-center'<f><'hidden-xs ml-auto'B>r>"+
        "t"+
        "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
    "autoWidth" : true,
    "classes": {
      "sWrapper":      "dataTables_wrapper dt-bootstrap4"
    },
    "oLanguage": {
      "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },
      buttons: [ {
          extend: 'colvis',
          text: 'players-online',
          className: 'btn btn-default',
          columnText: function ( dt, idx, title ) {
              return title;
          }			        
      } ],
      
    responsive: true
  });
  
  /* END COLUMN SHOW - HIDE */
    
      // columnDefs: [{
      // orderable: false,
      // className: 'select-checkbox',
      // targets: 0
      // }],
      // "pagingType": "full_numbers",
      // "bInfo" : false,
      // "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
      // select: {
      // style: 'os',
      // selector: 'td:first-child'
      // },
      // "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      //     $.ajaxSetup({
      //       headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //       }
      //     });

      //     $('.usertext').editable({
      //       mode :'popup'
      //     });

      // }
  });
</script>    
@endsection