@extends('index')

@section('namepages')
<h1 class="page-header"><i class="fa-fw fa fa-home"></i>  Players <span>> Active Players</span></h1>
@endsection


@section('content')
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
        <div class="custom-scroll table-responsive" style="height: 600px;">
          <div class="table-outer">
        
            <table id="online-players" class="table table-striped table-bordered table-hover" width="100%">
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
                  <th data-hide="phone,tablet">timestamp</th>
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
                    } else if($ol->user_type === 1){
                        $user_type = 'Player';
                    } 
                    @endphp
                    <td>{{ $user_type }}</td>
                    <td>{{ $ol->game_name }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $ol->date_login}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div> 
      </div>
      <!-- end widget content -->
    </div>
    <!-- end widget div -->
  </div>


<script type="text/javascript">
  table = $('table.table').dataTable({
    "sDom": "<'dt-toolbar d-flex align-items-center'<f><'hidden-xs ml-auto'B>r>"+
        "t"+
        "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
    "autoWidth" : true,
    "classes": {
      "sWrapper": "dataTables_wrapper dt-bootstrap4"
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
      "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      },
    responsive: true
  });
</script>

@endsection
