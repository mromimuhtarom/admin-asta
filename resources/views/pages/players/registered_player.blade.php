@extends('index')

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
            
            <table id="registered-players" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th class="th-sm">Username</th>
                  <th class="th-sm">Date Created</th>
                  <th class="th-sm">Register From</th>
                  <th class="th-sm">Device</th>
                  <th class="th-sm">Country</th>
                </tr>
              </thead>
              <tbody>
                @foreach($registered as $regis)
                <tr>
                    <td>{{ $regis->username }}</td>
                    <td>{{ $regis->join_date }}</td>
                    @php
                        if($regis->facebook_id !== ''){
                            $user_type = 'Facebook';
                        } else if($regis->user_type === 1) {
                            $user_type = 'Asta';
                        }
                    @endphp
                    <td>{{ $user_type }}</td>
                    <td>{{ $regis->devicename}}</td>
                    <td>{{ $regis->countryname }}</td>
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

  </div>
</div>
<!-- END .sa-content-wrapper -->

@endsection

@section('script')

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

            $('.usertext').editable({
              mode :'popup'
            });

        },
      responsive: true
    });
  </script>
@endsection