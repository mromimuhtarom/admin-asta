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
                <tr>
                  <td>
                    <input id="autorefresh"@if($checked == 'checked') checked @endif type="checkbox" name="autorefresh" class="deletepermission">
                    <div class="btn sa-btn-primary btn-xs">{{ TranslateMenuGame('Auto Refresh')}}</div>
                  </td>
                </tr>
               </table>
              </div>
             
              {{-- ROOM NOVICE --}}
              <div class="@if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-view*')) tableactive @endif" style="border:2px solid black;width:auto;float:left;margin-right:5%;">
                <table border="0" width="100%" style="">
                  <tr class="border-bottom" style="padding-left:2%;padding-right:2%;">
                    <td class="@if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-view*')) color-fontactive @endif">
                      <a href="{{ route('Monitoring_Table_DominoQ') }}?checkauto={{ $checked }}"><b>{{ TranslateMenuGame('Novice') }}</b></a>
                    </td>
                  </tr>
                  <tr style="padding-left:2%; padding-right:2%;">
                    <td valign="top">
                      <table>
                        <tr>
                          <td>
                            <div class="" style="float:left;margin-right:4%;">{{ TranslateMenuGame('Online') }}</div>
                          </td>
                          <td>
                            <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:4%;">{{ count($onlinenovice) }}</div>
                          </td>
                          <td>
                            <div style="float:left;">{{ TranslateMenuGame('Players') }}</div>
                          </td>
                          <td>
                            <div style="float:right;margin-left:10%;">
                              <form action="{{ route('Monitoring_Table_DominoQ') }}">
                                <input type="hidden" class="checkauto" name="checkauto" value="@if($checked == 'checked') checked @endif">                            
                                <button type="submit" class="btn bg-blue-light text-white btntablearrow @if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-view*')) btnactivetable @endif"><i class="fa fa-arrow-down icontable" style=""></i></button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>

              {{-- ROOM INTERMEDIATE --}}
              <div class="@if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-intermediate*')) tableactive @endif" style="border:2px solid black; width:auto; float:left;margin-right:5%;">
                <table border="0" width="100%">
                  <tr class="border-bottom" style="padding-left:5%;padding-right:5%;">
                    <td class="@if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-intermediate*')) color-fontactive @endif">
                      <a href="{{ route('Monitoring_Table_DominoQ-intermediate') }}?checkauto={{ $checked }}"><b>{{ TranslateMenuGame('Intermediate') }}</b></a>
                    </td>
                  </tr>
                  <tr style="padding-left:5%;padding-right:5%;">
                    <td valign="top">
                      <table>
                        <tr>
                          <td>
                            <div style="float:left;">{{ TranslateMenuGame('Online') }}</div>
                          </td>
                          <td>
                            <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($onlineintermediate) }}</div>
                          </td>
                          <td>
                            <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('Players') }}</div> 
                          </td>
                          <td>
                            <div style="float:right">
                              <form action="{{ route('Monitoring_Table_DominoQ-intermediate')}}">
                                <input type="hidden" class="checkauto" name="checkauto" value="@if($checked == 'checked') checked @endif">
                                <button type="submit" class="btn bg-blue-light text-white btntablearrow @if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-intermediate*')) btnactivetable @endif"><i class="fa fa-arrow-down icontable"></i></button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
              
              {{-- ROOM PRO  --}}
              <div class="@if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-pro*')) tableactive @endif" style="border:2px solid black;width:auto;float:left">
                <table border="0" width="100%">
                  <tr class="border-bottom" style="padding-left:2%; padding-right:2%;">
                    <td  class="@if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-pro*')) color-fontactive @endif">
                      <a href="{{ route('Monitoring_Table_Asta_Poker-pro') }}?checkauto={{ $checked }}"><b>{{ TranslateMenuGame('Pro') }}</b></a>
                    </td>
                  </tr>
                  <tr style="padding-left:2%;padding-right:2%;">
                    <td valign="top">
                      <table>
                        <tr>
                          <td>
                            <div style="float:left;">{{ TranslateMenuGame('Online') }}</div>
                          </td>
                          <td>
                            <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($onlinepro) }}</div> 
                          </td>
                          <td>
                            <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('Players') }}</div> 
                          </td>
                          <td>
                            <div style="float:right;">
                              <form action="{{ route('Monitoring_Table_DominoQ-pro') }}">
                                <input type="hidden" class="checkauto" name="checkauto" value="@if($checked == 'checked') checked @endif">
                                <button type="submit" class="btn bg-blue-light text-white btntablearrow @if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-pro*')) btnactivetable @endif"><i class="fa fa-arrow-down icontable"></i></button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>


        {{-- TABLE NOVICE --}}
        @if(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-view*'))
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <div class="row">
              <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                {{ Translate_menuPlayers('Total Record Entries is') }} {{ $dmqPlayersNovice->total() }}
            </div>
            </div>
            <table class="table table-bordered" id="tablerefreshed1">
              <thead>
                <tr>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Table Name') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Play Time') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Seat') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Username Player') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('See Detail') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $dmqPlayersNovice as $tb)
                  @if(dmqplayeronline($tb->table_id))
                    <tr>
                      <td class="th-sm">{{ $tb->name }}</td>
                      <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                      <td class="th-sm">{{ $tb->max_player }}</td>
                      <td class="th-sm">
                        @foreach (dmqplayeronline($tb->table_id) as $plyr)
                          <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>, &nbsp;   
                        @endforeach
                      </td>
                      <td class="th-sm">
                        <form action="{{ route('Monitoring_Table_DominoQ-game')}}" target="_blank">
                          <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                          <input type="hidden" name="name_table" value="{{ $tb->name }}">
                          <button type="submit" class="btn bg-blue-light text-white">{{ TranslateMenuGame('See') }}</button>
                        </form>
                      </td>
                    </tr>
                  @else
                    <tr>
                      <td class="th-sm">{{ $tb->name }}</td>
                      <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                      <td class="th-sm">{{ $tb->max_player }}</td>
                      <td class="th-sm">
                        @foreach(dmqplayeronline($tb->table_id) as $plyr)
                          <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;
                        @endforeach
                      </td>
                      <td class="th-sm">
                        <form action="{{ route('Monitoring_Table_DominoQ-game') }}">
                          <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                          <input type="hidden" name="name_table" value="{{ $tb->name }}">
                          <button type="submit" class="btn bg-blue-light text-white"{{ TranslateMenuGame('See') }}></button>
                        </form>
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
          <div style="display: flex;justify-content: center;">{{ $dmqPlayersNovice->links() }}</div>
        </div>


      {{-- TABLE INTERMEDIATE --}}
      @elseif(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-intermediate*'))
     
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <div class="row">
              <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                {{ Translate_menuPlayers('Total Record Entries is') }} {{ $dmqPlayersintermediate->total() }}
              </div>
            </div>
      
            <table class="table table-bordered" id="tablerefreshed1">
              <thead>
                <tr>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Table Name') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Play Time') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Seat') }} </th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Username Player') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('See Detail') }}</th>
                </tr>
              </thead>
            <tbody>
              @foreach ($dmqPlayersintermediate as $tb)
                @if(dmqplayeronline($tb->table_id))
                  <tr>
                    <td class="th-sm">{{ $tb->name }}</td>
                    <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                    <td class="th-sm">{{ $tb->max_player }}</td>
                    <td class="th-sm">
                      @foreach (dmqplayeronline($tb->table_id) as $plyr)
                        <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                      @endforeach
                    </td>
                    <td class="th-sm">
                      <form action="{{ route('Monitoring_Table_DominoQ-game')}}" target="_blank">
                        <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                        <input type="hidden" name="name_table" value="{{ $tb->name }}">
                        <button type="submit" class="btn bg-blue-light text-white">{{ TranslateMenuGame('See') }}</button>
                      </form>  
                    </td>
                  </tr>
                @else
                  <tr>
                    <td class="th-sm">{{ $tb->name }}</td>
                    <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                    <td class="th-sm">{{ $tb->max_player }}</td>
                    <td class="th-sm">
                      @foreach (dmqplayeronline($tb->table_id) as $plyr)
                        <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                      @endforeach
                    </td>
                    <td class="th-sm">
                      <form action="{{ route('Monitoring_Table_DominoQ-game')}}">
                        <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                        <input type="hidden" name="name_table" value="{{ $tb->name }}">
                        <button type="submit" class="btn bg-blue-light text-white">{{ TranslateMenuGame('See') }}</button>
                      </form>  
                    </td>
                  </tr>
                  @endif
              @endforeach
            </tbody>
            </table>
          </div>
        <div style="display: flex;justify-content: center;">{{ $dmqPlayersintermediate->links() }}</div>
      </div>


      {{-- TABLE PRO --}}
      @elseif(Request::is('Game/Domino-QQ/Monitoring_Table_DominoQ/Monitoring_Domino_QQ-pro*'))
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer" id="Novice">
            <div class="row">
              <!-- Button tambah bot baru -->
              <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                  {{ Translate_menuPlayers('Total Record Entries is') }} {{ $dmqPlayersPro->total() }}
              </div>
                          <!-- End Button tambah bot baru -->
            </div>
            <table class="table table-bordered" id="tablerefreshed1">
              <thead>
                <tr>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Table Name') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Play Time') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Seat') }} </th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('Username Player') }}</th>
                  <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('See Detail') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($dmqPlayersPro  as $tb)
                  @if(dmqplayeronline($tb->table_id)) 
                    <tr>
                      <td class="th-sm">{{ $tb->name }}</td>
                      <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                      <td class="th-sm">{{ $tb->max_player }}</td>
                      <td class="th-sm">
                        @foreach (dmqplayeronline($tb->table_id) as $plyr)
                          <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                        @endforeach
                      </td>
                      <td class="th-sm">
                        <form action="{{ route('Monitoring_Table_DominoQ-game')}}" target="_blank">
                          <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                          <input type="hidden" name="name_table" value="{{ $tb->name }}">
                          <button type="submit" class="btn bg-blue-light text-white">{{ TranslateMenuGame('See') }}</button>
                        </form>  
                      </td>
                    </tr>
                  @else
                    <tr>
                      <td class="th-sm">{{ $tb->name }}</td>
                      <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                      <td class="th-sm">{{ $tb->max_player }}</td>
                      <td class="th-sm">
                        @foreach (dmqplayeronline($tb->table_id) as $plyr)
                          <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                        @endforeach
                      </td>
                      <td class="th-sm">
                        <form action="{{ route('Monitoring_Table_DominoQ-game')}}">
                          <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                          <input type="hidden" name="name_table" value="{{ $tb->name }}">
                          <button type="submit" class="btn bg-blue-light text-white">{{ TranslateMenuGame('See') }}</button>
                        </form>  
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
          <div style="display: flex;justify-content: center;">{{ $dmqPlayersPro->links() }}</div>                   
        </div>
      @endif  
    </div>
  </div>
</div>

  <!-- End Form Category -->

  <script type="text/javascript">
        $(document).ready(function() {
        $('table.table').dataTable( {
            "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
            "pagingType": "full_numbers",
            "paging": false,
            "bInfo":false,
            "ordering":false,
            "bLengthChange": false,
            "searching": false,
            "ordering": false
        });


        $('#refreshtable').on('click', function() {
          console.log('asas');
            var url = "{{ route('Monitoring_Table_DominoQ') }}"; 
            // location.reload();
             $("#tablerefreshed1").load('{{ route("Monitoring_Table_DominoQ") }}' + " #tablerefreshed1");
        // $('#refreshtable').on('click', function() {
        //     console.log('aa');
        //     var url = "{{ route('Monitoring_Table_Asta_Poker') }}"; 
        //     location.reload();        
            // $('table#tablerefreshed1').fadeOut('slow').load(url + ' #tablerefreshed1').fadeIn("slow") //note: the space before #div1 is very important
        });
          $('#autorefresh').click(function(){
              var reloading;
              if($(this).prop("checked") == true){
                $(".checkauto").val("checked");
                setInterval(function(){
                  // $("#tablerefreshed1").load('{{ route("Monitoring_Table_Asta_Poker") }}' + " #tablerefreshed1");
                  // location.reload();
                  window.location.replace("?checkauto=checked");
                  reloading=setTimeout("window.location.reload();", refresh_time);
                }, 3000);
                
              } else {
                window.location.replace("?checkauto=");
                $(".checkauto").val('');
                clearTimeout(reloading);
              }
          });

          if($('#autorefresh').prop("checked") == true)
          {
            $(".checkauto").val("checked");
            setInterval(function(){
              window.location.replace("?checkauto=checked");
              reloading=setTimeout("window.location.reload();", refresh_time);
            }, 3000);
          } else {
            $(".checkauto").val('');
            clearTimeout(reloading);
          }
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