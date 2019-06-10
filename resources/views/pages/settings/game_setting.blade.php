@extends('index')

@section('sidebarmenu')
@include('menu.menusetting')    
@endsection


@section('content')

<div class="game-settings">
  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Asta Poker</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive">
            
            <div class="table-outer">
              <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Asta Big 2</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive">
            
            <div class="table-outer">
              <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Domino Susun</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive">
            
            <div class="table-outer">
              <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Domino QQ</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive">
            
            <div class="table-outer">
              <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
    });
  });

  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
    "autoWidth" : true,
    "paging": false,
    "classes": {
      "sWrapper": "dataTables_wrapper dt-bootstrap4"
    },
    "oLanguage": {
      "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },
    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.inlineSetting').editable({
            mode :'inline'
        });
     
    },
    responsive: true
  });
</script>
@endsection