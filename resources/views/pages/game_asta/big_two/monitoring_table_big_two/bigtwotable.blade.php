@extends('index')

@section('page')
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_Big_Two') }}">Games > Big Two</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_Big_Two') }}">Monitoring Table</a></li>
<li class="breadcrumb-item"><a href="{{ route('Monitoring_Table_Big_Two') }}">Novice</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/tableactive.css">
<!-- Form Category -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header class="border border-light">
      {{-- <div>	 --}}
        <h2><strong><i class="fa fa-gamepad"></i> {{ TranslateMenuGame('L_ASTA_BIG_TWO_TABLE') }}</strong></h2>
        <span style="background-color:#fffffe;margin-right:1%;margin-left:1%;color:black;margin-top:auto;margin-bottom:auto;padding-right:1%;padding-left:1%;">
          <i class="fa fa-user-circle" style="color:#00ff34"></i> {{ count($onlinebgt) }}
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
                            <a href="#" id="refreshtable" class="btn sa-btn-primary btn-xs" style="float:left;">{{ TranslateMenuGame('L_REFRESH') }}</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input id="autorefresh"@if($checked == 'checked') checked @endif type="checkbox" name="autorefresh" class="deletepermission">
                            <div class="btn sa-btn-primary btn-xs">{{ TranslateMenuGame('L_AUTO_REFRESH') }}</div>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="@if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitoring_Big_Two-view*')) tableactive @endif" style="border:2px solid black;width:auto;float:left;margin-right:5%;">
                      <table border="0" width="100%" style="">
                        <tr class="border-bottom" style="padding-left:2%;padding-right:2%;">
                          <td class="@if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitoring_Big_Two-view*')) color-fontactive @endif">
                            <a href="{{ route('Monitoring_Table_Big_Two') }}?checkauto={{ $checked }}"><b>{{ TranslateMenuGame('L_NOVICE') }}</b></a>
                          </td>
                        </tr>
                        <tr style="padding-left:2%;padding-right:2%;">
                          <td valign="top">
                            <table>
                              <tr>
                                <td>
                                  <div class="" style="float:left;margin-right:4%;">{{ TranslateMenuGame('L_ONLINE') }}</div>                            
                                </td>
                                <td>
                                  <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:4%;">{{ count($onlineinvoice) }}</div>
                                </td>
                                <td>
                                  <div style="float:left;">{{ TranslateMenuGame('L_PLAYERS') }}</div> 
                                </td>
                                <td>
                                  <div style="float:right;margin-left:10%;">
                                    <form action="{{ route('Monitoring_Table_Big_Two') }}">
                                      <input type="hidden" class="checkauto" name="checkauto" value="@if($checked == 'checked') checked @endif">                            
                                      <button type="submit" class="btn bg-blue-light text-white btntablearrow @if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitoring_Big_Two-view*')) btnactivetable @endif"><i class="fa fa-arrow-down icontable" style=""></i></button>
                                    </form>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="@if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-intermediate*')) tableactive @endif" style="border:2px solid black;width:auto;float:left;margin-right:5%;">
                      <table border="0" width="100%">
                        <tr class="border-bottom" style="padding-left:5%;padding-right:5%;">
                          <td class="@if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-intermediate*')) color-fontactive @endif">
                            <a href="{{ route('Monitoring_Table_Big_Two-intermediate') }}?checkauto={{ $checked }}"><b>{{ TranslateMenuGame('L_INTERMEDIATE') }}</b></a>
                          </td>
                        </tr>
                        <tr style="padding-left:5%;padding-right:5%;">
                          <td valign="top">
                            <table>
                              <tr>
                                <td>
                                  <div style="float:left;">{{ TranslateMenuGame('L_ONLINE') }}</div>
                                </td>
                                <td>
                                  <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($onlineintermediate) }}</div> 
                                </td>
                                <td>
                                  <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('L_PLAYERS') }}</div> 
                                </td>
                                <td>
                                  <div style="float:right">
                                    <form action="{{ route('Monitoring_Table_Big_Two-intermediate') }}">
                                      <input type="hidden" class="checkauto" name="checkauto" value="@if($checked == 'checked') checked @endif">                            
                                      <button type="submit" class="btn bg-blue-light text-white btntablearrow @if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-intermediate*')) btnactivetable @endif"><i class="fa fa-arrow-down icontable"></i></button>
                                    </form>
                                  </div>
                                </td>
                              </tr>
                            </table>

                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="@if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-pro*')) tableactive @endif" style="border:2px solid black;width:auto;float:left;">
                      <table border="0" width="100%">
                        <tr class="border-bottom" style="padding-left:2%;padding-right:2%;">
                          <td  class="@if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-pro*')) color-fontactive @endif">
                            <a href="{{ route('Monitoring_Table_Big_Two-pro') }}?checkauto={{ $checked }}"><b>{{ TranslateMenuGame('L_PRO') }}</b></a>
                          </td>
                        </tr>
                        <tr style="padding-left:2%;padding-right:2%;">
                          <td valign="top">
                              <table>
                                <tr>
                                  <td>
                                    <div style="float:left;">{{ TranslateMenuGame('L_ONLINE') }}</div>
                                  </td>
                                  <td>
                                    <div class="border" style="width:min-content;float:left;padding-left:1%;padding-right:1%;float:left;margin-right:1%;">{{ count($onlinepro) }}</div> 
                                  </td>
                                  <td>
                                    <div style="margin-right:2%;float:left;">{{ TranslateMenuGame('L_PLAYERS') }}</div> 
                                  </td>
                                  <td>
                                    <div style="float:right;">
                                      <form action="{{ route('Monitoring_Table_Big_Two-pro') }}">
                                        <input type="hidden" class="checkauto" name="checkauto" value="@if($checked == 'checked') checked @endif">
                                        <button type="submit" class="btn bg-blue-light text-white btntablearrow @if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-pro*')) btnactivetable @endif"><i class="fa fa-arrow-down icontable"></i></button>
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
  
          
          
        @if(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitoring_Big_Two-view*'))
          <div class="custom-scroll table-responsive" style="height:800px;">
            <div class="table-outer">
              <div class="row">
                  <!-- Button tambah bot baru -->
                  <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                      {{ Translate_menuPlayers('Total Record Entries is') }} {{ $bgtPlayersnovice->total() }}
                  </div>
                              <!-- End Button tambah bot baru -->
              </div>
              <table class="table table-bordered" id="tablerefreshed1">
                <thead>
                  <tr>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_TABLE_NAME') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_PLAY_TIME') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_SEAT') }} </th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_USERNAME_PLAYER') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_SEE_DETAIL') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($bgtPlayersnovice  as $tb)
                    @if(bgtplayeronline($tb->table_id)) 
                      <tr>
                        <td class="th-sm">{{ $tb->name }}</td>
                        <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                        <td class="th-sm">{{ $tb->max_player }}</td>
                        <td class="th-sm">
                          @foreach (bgtplayeronline($tb->table_id) as $plyr)
                            <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                          @endforeach
                        </td>
                        <td class="th-sm">
                          <form action="{{ route('Monitoring_Table_Big_Two-game')}}" target="_blank">
                            <input type="hidden" name="id_table" value="{{ $tb->table_id }}">
                            <input type="hidden" name="name_tables" value="{{ $tb->name }}">
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
                          @foreach (bgtplayeronline($tb->table_id) as $plyr)
                            <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                          @endforeach
                        </td>
                        <td class="th-sm">
                          <form action="{{ route('Monitoring_Table_Big_Two-game')}}">
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
            <div style="display: flex;justify-content: center;">{{ $bgtPlayersnovice->links() }}</div>                    

          </div>
        @elseif(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-intermediate*'))
          <div class="custom-scroll table-responsive" style="height:800px;">
            <div class="table-outer" id="Novice">
              <div class="row">
                  <!-- Button tambah bot baru -->
                  <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                      {{ Translate_menuPlayers('Total Record Entries is') }} {{ $bgtPlayersintermediate->total() }}
                  </div>
                              <!-- End Button tambah bot baru -->
              </div>
              <table class="table table-bordered" id="tablerefreshed1">
                <thead>
                  <tr>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_TABLE_NAME') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_PLAY_TIME') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_SEAT') }} </th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_USERNAME_PLAYER') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_SEE_DETAIL') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($bgtPlayersintermediate  as $tb)
                    @if(bgtplayeronline($tb->table_id)) 
                      <tr>
                        <td class="th-sm">{{ $tb->name }}</td>
                        <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                        <td class="th-sm">{{ $tb->max_player }}</td>
                        <td class="th-sm">
                          @foreach (bgtplayeronline($tb->table_id) as $plyr)
                            <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                          @endforeach
                        </td>
                        <td class="th-sm">
                          <form action="{{ route('Monitoring_Table_Big_Two-game')}}" target="_blank">
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
                          @foreach (bgtplayeronline($tb->table_id) as $plyr)
                            <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                          @endforeach
                        </td>
                        <td class="th-sm">
                          <form action="{{ route('Monitoring_Table_Big_Two-game')}}">
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
            <div style="display: flex;justify-content: center;">{{ $bgtPlayersintermediate->links() }}</div>                    

          </div>
        @elseif(Request::is('Game/Big-Two/Monitoring_Table_Big_Two/Monitor_Big_Two-pro*'))
          <div class="custom-scroll table-responsive" style="height:800px;">
            <div class="table-outer" id="Novice">
              <div class="row">
                  <!-- Button tambah bot baru -->
                  <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                      {{ Translate_menuPlayers('Total Record Entries is') }} {{ $bgtPlayersPro->total() }}
                  </div>
                              <!-- End Button tambah bot baru -->
              </div>
              <table class="table table-bordered" id="tablerefreshed1">
                <thead>
                  <tr>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_TABLE_NAME') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_PLAY_TIME') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_SEAT') }} </th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_USERNAME_PLAYER') }}</th>
                    <th class="th-sm" style="background-color:#ffffff;">{{ TranslateMenuGame('L_SEE_DETAIL') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($bgtPlayersPro  as $tb)
                    @if(bgtplayeronline($tb->table_id)) 
                      <tr>
                        <td class="th-sm">{{ $tb->name }}</td>
                        <td class="th-sm">{{ strNormalFast($tb->timer) }}</td>
                        <td class="th-sm">{{ $tb->max_player }}</td>
                        <td class="th-sm">
                          @foreach (bgtplayeronline($tb->table_id) as $plyr)
                            <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                          @endforeach
                        </td>
                        <td class="th-sm">
                          <form action="{{ route('Monitoring_Table_Big_Two-game')}}" target="_blank">
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
                          @foreach (bgtplayeronline($tb->table_id) as $plyr)
                            <a href="{{ route('chip_detail') }}?inputPlayer={{ $plyr->user_id }}">{{ $plyr->username }}</a>,&nbsp;                          
                          @endforeach
                        </td>
                        <td class="th-sm">
                          <form action="{{ route('Monitoring_Table_Big_Two-game')}}">
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
            <div style="display: flex;justify-content: center;">{{ $bgtPlayersPro->links() }}</div>                    

          </div>
        @endif
        
        </div>
      </div>
    </div>


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
            console.log('aa');
            var url = "{{ route('Monitoring_Table_Asta_Poker') }}"; 
            location.reload();   
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
                }, 300000);
                
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
            }, 300000);
          } else {
            $(".checkauto").val('');
            clearTimeout(reloading);
          }
        });
    
        table = $('table.table').dataTable({
          "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
          "autoWidth" : true,
          "paging": false,
          "ordering": false,
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