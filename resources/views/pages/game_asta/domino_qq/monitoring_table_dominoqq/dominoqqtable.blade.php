@extends('index')

@section('page')
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_DominoQ') }}">Games > Domino QQ</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_DominoQ') }}">Monitoring Table</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_DominoQ') }}">Novice</a></li>
@endsection

@section('content')
<!-- Form Category -->
<link rel="stylesheet" href="/css/tableactive.css">
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header class="border border-light">
        <h2><strong><i class="fa fa-gamepad"></i>Domino QQ Table</strong></h2>
        <span style="background-color:#fffffe;margin-right:1%;margin-left:1%;color:black;margin-top:auto;margin-bottom:auto;padding-right:1%;padding-left:1%;">
          <i class="fa fa-user-circle" style="color:#00ff34"></i> {{ count($onlinedmq)}}
        </span>				
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col">
              <!-- Pertama -->
              <div style="float:left;margin-right:5%;">
               <table border="0">
                <tr>
                  <td>
                    <a href="#" id="refreshtable" class="btn sa-btn-primary btn-xs" style="float:left;">{{ TranslateMenuGame('Refresh') }}</a>
                  </td>
                </tr>
                <tr
               </table>
              </div>
             
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>

    
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <table class="table table-bordered" id="tablerefreshed1">
              <thead>
                <tr>
                  <th class="th-sm">{{ TranslateMenuGame('Table Name') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Play Time') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Seat') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Username Player') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('See Detail') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($table as $tb)
                  <tr>
                    <td>{{ $tb->name }}</td>
                    <td>{{ strNormalFast($tb->timer) }}</td>
                    <td>{{ $tb->max_player }}</td>
                    <td>
                      @foreach ($tb['DominoQPlayer'] as $plyr)
                        {{ $plyr->username }},                          
                      @endforeach
                    </td>
                    <td>
                      <form action="{{ route('Monitoring_Table_DominoQQ-game')}}" target="_blank">
                        <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                        <input type="hidden" name="name_table" value="{{ $tb->name }}">
                        <button type="submit" class="btn bg-blue-light text-white">{{ TranslateMenuGame('See') }}</button>
                      </form>  
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  <!-- End Form Category -->

  <script type="text/javascript">
        $(document).ready(function() {
        $('table.table').dataTable( {
            "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
            "pagingType": "full_numbers",
        });

        $('#refreshtable').on('click', function() {
            console.log('aa');
            var url = "{{ route('Monitoring_Table_Asta_Poker') }}"; 
            location.reload();        
            // $('table#tablerefreshed1').fadeOut('slow').load(url + ' #tablerefreshed1').fadeIn("slow") //note: the space before #div1 is very important
        });
        });

        table = $('table.table').dataTable({
            "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
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
                $('.usertext').editable({
                mode : 'inline',
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