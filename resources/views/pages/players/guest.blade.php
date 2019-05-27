@extends('index')

@section('sidebarmenu')
    @include('menu.menuplayer')    
@endsection

@section('content')
{{-- <div class="table-aii">
    <div class="footer-table">
        <div class="add-btn-smt">
            Guest
        </div>
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
        <thead class="th-table">
          <tr>
            <th class="th-sm">ID Guest</th>
            <th class="th-sm">Device</th>
          </tr>
        </thead>
        <tbody>
            @foreach($guests as $gs)
            <tr>
                <td>{{ $gs->username }}</td>
                @if ($gs->device_id == NULL)
                    <td>{{ "Device is Not Connected"}}</td>
                @else
                    <td>{{ $gs->device_id }}</td>
                @endif
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
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
      });
</script>    --}}
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
                    <th class="th-sm">ID Guest</th>
                    <th class="th-sm">Device</th>
                </tr>
              </thead>
              <tbody>
                    @foreach($guests as $gs)
                    <tr>
                     <td>{{ $gs->username }}</td>
                     @if ($gs->device_id == NULL)
                    <td>{{ "Device is Not Connected"}}</td>
                    @else
                    <td>{{ $gs->device_id }}</td>
                    @endif
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
        // table = $('#dt-material-checkbox').dataTable({
        //     columnDefs: [{
        //     orderable: false,
        //     className: 'select-checkbox',
        //     targets: 0
        //     }],
        //     "pagingType": "full_numbers",
        //     "bInfo" : false,
        //     "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
        //     select: {
        //     style: 'os',
        //     selector: 'td:first-child'
        //     },
        //     "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //         $.ajaxSetup({
        //           headers: {
        //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //           }
        //         });
  
        //         $('.usertext').editable({
        //           mode :'popup'
        //         });
      
        //     }
        // });
        // var responsiveHelper_dt_basic = responsiveHelper_dt_basic || undefined;
              // 	var responsiveHelper_datatable_fixed_column = responsiveHelper_datatable_fixed_column || undefined;
                  var responsiveHelper_datatable_col_reorder = responsiveHelper_datatable_col_reorder || undefined;
                  // var responsiveHelper_datatable_tabletools = responsiveHelper_datatable_tabletools ||undefined;
                  
                  var breakpointDefinition = {
                      tablet : 1024,
                      phone : 480
                  };
        $('#datatable_col_reorder').dataTable({
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
                      text: 'Show / hide columns',
                      className: 'btn btn-default',
                      columnText: function ( dt, idx, title ) {
                          return title;
                      }			        
                  } ],
                  
                  responsive: true
              });
  </script>
@endsection