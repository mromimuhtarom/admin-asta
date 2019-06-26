@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Active Admin</a></li>
@endsection

@section('content')  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
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
        <div class="custom-scroll table-responsive" style="max-height: 600px;">
          <div class="table-outer">
        
            <table id="online-players" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>User Admin</th>
                  <th>Date Login</th>
                  <th>Ip</th>
                </tr>
              </thead>
              <tbody>
                @foreach($active as $ol)
                <tr>
                    <td>{{ $ol->username }}</td>
                    <td>{{ $ol->date_login }}</td>
                    <td>{{ $ol->ip }}</td>
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
    "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'f>r>"+
						"t"+
						"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
    "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
    "pagingType": "full_numbers",
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