@extends('index')

@section('page')
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_DominoS') }}">Games > Domino Susun</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_DominoS') }}">Monitoring Table</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_DominoS') }}">Novice</a></li>
@endsection

@section('content')
<!-- Form Category -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <div class="widget-header">
            <h2><strong><i class="fa fa-gamepad"></i> Domino Susun Table </strong></h2>
        </div>
    </header>
</div>

<div>
  
    <div class="widget-body">
      <div class="widget-body-toolbar">
        <div class="row">
          <!-- Button tambah data baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <!-- Pertama -->
            <div style="border:1px solid black;">
              
              <a href="#" id="refreshtable" class="btn sa-btn-primary btn-xs" style="float:left;">Refresh</a>
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
                    @foreach ($tb['DominoSPlayer'] as $plyr)
                      {{ $plyr->username }},                          
                    @endforeach
                  </td>
                  <td>
                    <form action="{{ route('Monitoring_Table_DominoS')}}">
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