@extends('index')

@section('page')
    <li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Players_Level') }}">{{ Translate_menuPlayers('Players level') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Players_Level') }}">{{ Translate_menuPlayers('Players level') }}</a></li>
@endsection

@section('content')

<div class="settings-table">
  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>{{ Translate_menuPlayers('Players level') }}</strong></h2>	
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:700px;">
            
            <div class="table-outer">
                <div class="widget-body-toolbar">
        
                  <div class="row">
                    
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create player level') }}
                        </button>
                      </div>
                    </div>
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">{{ Translate_menuPlayers('Players level') }}</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Experience') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($playerslevel as $level)
                        <tr>
                            <td><a href="#" class="inlinelevel" data-name="username" data-title="Username" data-pk="" data-type="text" data-url="">{{ $level->level}}</a></td>
                            <td>{{ $level->experience}}</td>
                        </tr>    
                    @endforeach
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
          <h2><strong>{{ Translate_menuPlayers('Players Rank') }}</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:700px;">
            
            <div class="table-outer">

                <div class="row">
                    
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create Rank Player') }}
                        </button>
                      </div>
                    </div>
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">{{ TranslateMenuGame('Players level') }}</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Level') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($playersrank as $rank)
                        <tr>
                            <td>{{ $rank->name }}</td>
                            <td>{{ $rank->level }}</td>
                        </tr>
                    @endforeach
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
      "lengthMenu": [[10, 10, 20, -1], [10, 10, 20, "All"]],
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

      $('.inlinelevel').editable({
            mode :'inline',
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            }
      });
     
    },
    responsive: false
  });

</script>
@endsection