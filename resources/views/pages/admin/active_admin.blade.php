@extends('index')

@section('page')
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Role_Admin') }}">{{ translate_menu('L_ADMIN') }}</a></li>
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Role_Admin') }}">{{ translate_menu('L_ACTIVE_ADMIN') }}</a></li>
@endsection

@section('content') <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2"
    data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>{{ translate_MenuContentAdmin('L_PLAYERS_ONLINE') }}</h2>
      </div>

        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
        </div>
    </header>

    <!-- widget div-->
    <div>

        <div class="jarviswidget-editbox">

        </div>

      <!-- widget content -->
      <div class="widget-body p-0">
        <div class="custom-scroll table-responsive" style="max-height: 600px;">
          <div class="table-outer">
        
            <table id="online-players" class="table table-striped table-bordered table-hover" width="100%">
              <thead>
                <tr>
                  <th>{{ translate_MenuContentAdmin('L_USERNAME') }}</th>
                  <th>{{ translate_MenuContentAdmin('L_DATE_LOGIN') }}</th>
                  <th>{{ translate_MenuContentAdmin('L_IP') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($active as $ol)
                <tr>
                    <td>{{ $ol->username }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($ol->date_login)) }}</td>
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
        "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'f>r>" +
            "t" +
            "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
        "lengthMenu": [
            [20, 25, 50, -1],
            [20, 25, 50, "All"]
        ],
        "pagingType": "full_numbers",
        "autoWidth": true,
        "classes": {
            "sWrapper": "dataTables_wrapper dt-bootstrap4"
        },
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
        },
        buttons: [{
            extend: 'colvis',
            text: 'Show / hide columns',
            className: 'btn btn-default',
            columnText: function (dt, idx, title) {
                return title;
            }
        }],
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        },
        responsive: false
    });

</script>
@endsection
