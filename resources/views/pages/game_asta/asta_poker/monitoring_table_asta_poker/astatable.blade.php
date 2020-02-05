@extends('index')


@section('page')
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_Asta_Poker') }}">Games > Asta Poker</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_Asta_Poker') }}">Monitoring Table</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_Asta_Poker') }}">Novice</a></li>
@endsection


@section('content')
  <!-- Form Category -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header class="border border-light">
      {{-- <div>	 --}}
        <h2><strong><i class="fa fa-gamepad"></i> {{ TranslateMenuGame('Asta Poker Table') }}</strong></h2>
        <span style="background-color:#fffffe;margin-right:1%;margin-left:1%;color:black;margin-top:auto;margin-bottom:auto;padding-right:1%;padding-left:1%;">
          <i class="fa fa-user-circle" style="color:#00ff34"></i> 0
        </span>
      {{-- </div> --}}
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
                  <tr>
                    <td>
                      <input id="autorefresh" type="checkbox" name="autorefresh" class="deletepermission">
                      <div class="btn sa-btn-primary btn-xs">{{ TranslateMenuGame('Auto Refresh') }}</div>
                    </td>
                  </tr>
                </table>
              </div>

              <div style="border:2px solid black;width:auto;float:left;margin-right:5%;">
                <table border="0" width="100%" style="">
                  <tr class="border-bottom">
                    <td>
                      {{ TranslateMenuGame('Novice') }}
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">
                        <div style="float:left;">{{ TranslateMenuGame('Online') }}</div>
                        <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($tpkPlayersinvoice ) }}</div>
                        <div style="float:left;">{{ TranslateMenuGame('Players') }}</div> 
                        <div style="float:right;margin-left:10%;"><button class="btn bg-blue-light text-white"><i class="fa fa-arrow-down"></i></button></div>
                    </td>
                  </tr>
                </table>
              </div>

              <div style="border:2px solid black;width:auto;float:left;margin-right:5%;">
                <table border="0" width="100%">
                  <tr class="border-bottom">
                    <td>
                      {{ TranslateMenuGame('Intermediate') }}
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">
                        <div style="float:left;">{{ TranslateMenuGame('Online') }}</div>
                        <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($tpkPlayersinvoice ) }}</div> 
                        <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('Players') }}</div> 
                        <div style="float:right"><button class="btn bg-blue-light text-white"><i class="fa fa-arrow-down"></i></button></div>
                    </td>
                  </tr>
                </table>
              </div>

              <div style="border:2px solid black;width:auto;float:left;">
                <table border="0" width="100%">
                  <tr class="border-bottom">
                    <td>
                      {{ TranslateMenuGame('Pro') }}
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">
                        <div style="float:left;">{{ TranslateMenuGame('Online') }}</div>
                        <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($tpkPlayersinvoice ) }}</div> 
                        <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('Players') }}</div> 
                        <div style="float:right;"><button class="btn bg-blue-light text-white"><i class="fa fa-arrow-down"></i></button></div>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- end pertama -->
              <!-- Kedua -->
              {{-- <div class="border border-dark">
                <div style="float:left;margin-right:1%;">{{ TranslateMenuGame('Online') }}</div>
                <div class="border" style="width:min-content;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($tpkPlayersinvoice ) }}</div> 
                <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('Players') }}</div>
                <a href="#" id="refreshtable" class="btn sa-btn-primary btn-xs" style="float:left;">Refresh</a>
              </div> --}}
              <!-- end kedua -->
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
                    <td class="th-sm">{{ $tb->name }}</td>
                    <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                    <td class="th-sm">{{ $tb->max_player }}</td>
                    <td class="th-sm">
                      @foreach ($tb['TpkPlayer'] as $plyr)
                        {{ $plyr->username }},                          
                      @endforeach
                    </td>
                    <td class="th-sm">
                      <form action="{{ route('Monitoring_Table_Asta_Poker-game')}}">
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
        var url = "{{ route('Monitoring_Table_Asta_Poker') }}"; 
        location.reload();        
        // $('table#tablerefreshed1').fadeOut('slow').load(url + ' #tablerefreshed1').fadeIn("slow") //note: the space before #div1 is very important
      });
      $('#autorefresh').click(function(){
          if($(this).prop("checked") == true){
            console.log('aa');
            setInterval(function(){
              $("#tablerefreshed1").load('{{ route("Monitoring_Table_Asta_Poker") }}' + " #tablerefreshed1");
            }, 5000);
          }
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