@extends('index')

@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Play_Report') }}">{{ Translate_menuPlayers('L_PLAYERS') }}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Play_Report') }}">{{ Translate_menuPlayers('L_PLAY_REPORT') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<style>
.modal-dialog1 {
  max-width: 80.15385rem; }
</style>
<!--- Warning Alert --->
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
@if (count($errors) > 0)
<div class="error-val">
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>
</div>
@endif
<!--- End Warnign Alert --->


<!--- Content Search --->
    <div class="search bg-blue-dark" style="margin-bottom:3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('PlayReport-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    @if (Request::is('Players/Play_Report/PlayReport-search*'))
                        <div class="col username">
                            <input type="text" class="form-control" name="inputPlayer" placeholder="username/Player ID" value="{{ $getusername }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="text" class="form-control" name="inputRoundID" placeholder="Round ID" value="{{ $getroundid }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <select name="inputGame" class="form-control">
                                @foreach ($game as $gm)
                                <option value="{{ $gm->desc }}" @if($getgame == $gm->desc) selected @endif;>{{ $gm->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col date-min" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate" value="{{ $inputMinDate  }}">
                        </div>
                        <div class="col date-max" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate" value="{{ $inputMaxDate }}">
                        </div>
                    @else 
                        <div class="col username">
                            <input type="text" class="form-control" name="inputPlayer" placeholder="username/Player ID">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="text" class="form-control" name="inputRoundID" placeholder="Round ID">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <select name="inputGame" class="form-control">
                                @foreach ($game as $gm)
                                <option value="{{ $gm->desc }}">{{ $gm->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col date-min" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                        </div>
                        <div class="col date-max" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                        </div>
                    @endif
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i>{{ Translate_menuPlayers('L_SEARCH') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>   
<!--- End Content Search --->   
    
<!--- Show After Search --->
@if (Request::is('Players/Play_Report/PlayReport-search*'))
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-history"></i> </span>
            <h2>{{ Translate_menuPlayers('L_REPORT_PLAYER') }} </h2>
        </div>
    
        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
        </div>
    </header>
    <div>
                    
        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->
        </div>
        <!-- end widget edit box -->
                    
        <!-- widget content -->
        <div class="widget-body p-0">
                <div class="widget-body-toolbar">
        
                        <div class="row">
                          
                          <!-- Button tambah bot baru -->
                          <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                            {{ Translate_menuPlayers('L_TOTAL_RECORD') }} {{ $player_history->total() }}
                          </div>
                          <!-- End Button tambah bot baru -->
                
                        </div>
                
                      </div>
                    
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=round_id">{{ Translate_menuPlayers('L_ROUND_ID') }}<i class="fa fa-sort{{ iconsorting('round_id') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.user_id">{{ Translate_menuPlayers('L_PLAYER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.user_id') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('L_USERNAME') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=gamename">{{ Translate_menuPlayers('L_PLAYING_GAME') }} <i class="fa fa-sort{{ iconsorting('gamename') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=tablename">{{ Translate_menuPlayers('L_TABLE') }}<i class="fa fa-sort{{ iconsorting('tablename') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=seat_id">{{ Translate_menuPlayers('L_SEAT') }}<i class="fa fa-sort{{ iconsorting('seat_id') }}"></i></a></th>
                        <th>
                            <a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=hand_card_round">
                                @if($_GET['inputGame'] === 'Big Two')
                                {{ Translate_menuPlayers('L_REMAINING_TYPE') }} 
                                @elseif($_GET['inputGame'] === 'Domino QQ')
                                {{ Translate_menuPlayers('L_CARD_VALUE') }} 
                                @else
                                {{ Translate_menuPlayers('L_CARD_TYPE') }} 
                                @endif
                                <i class="fa fa-sort{{ iconsorting('hand_card_round') }}"></i>
                            </a>
                        </th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=bet">{{ Translate_menuPlayers('L_BET') }}<i class="fa fa-sort{{ iconsorting('bet') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=win_lose">{{ Translate_menuPlayers('L_WIN_LOSE') }}<i class="fa fa-sort{{ iconsorting('win_lose') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=status">{{ Translate_menuPlayers('L_STATUS') }}<i class="fa fa-sort{{ iconsorting('status') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=datetime">{{ Translate_menuPlayers('L_TIMESTAMP') }}<i class="fa fa-sort{{ iconsorting('datetime') }}"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($player_history as $history)
                        <tr>
                          <td><a href="#" class="playreport" id="roundid_detail" data-pk="{{ $history->round_id }}" data-toggle="modal"data-target="#roundid-modal">{{ $history->round_id }}</a></td>
                          <td>{{ $history->user_id }}</td>
                          <td>{{ $history->username }}</td>
                          <td>{{ $history->gamename }}</td>
                          <td>{{ $history->tablename }}</td>
                          <td>{{ $history->seat_id }}</td>
                          <td>
                            @if (isset($_GET['inputGame']))
                                @if($_GET['inputGame'] === 'Texas Poker')
                                    @php 
                                        $jsondecode = json_decode($history->gameplay_log);
                                    @endphp 
                                    @if(!empty($jsondecode))
                                        @foreach ($jsondecode->start->players as $start)
                                            @if($start->uid == $history->user_id)  
                                                @foreach($jsondecode->end->players as $end)
                                                    @if($end->seat == $start->seat)
                                                        {{ Translate_menuPlayers(typeCardGamepLayLogBgtTpk($end->type)) }}
                                                    @endif
                                                @endforeach 
                                            @endif                                 
                                        @endforeach 
                                    @endif

                                @elseif($_GET['inputGame'] === 'Big Two')      
                                    @php 
                                    $jsondecode = json_decode($history->gameplay_log);
                                    @endphp        
                                    @foreach ($jsondecode->start->players as $start)
                                        @if($start->uid == $history->user_id)  
                                            @foreach($jsondecode->end->players as $end)
                                                @if($end->seat == $start->seat)
                                                    {{count($end->hand)}}
                                                @endif
                                            @endforeach 
                                        @endif                                 
                                    @endforeach  
                                @elseif($_GET['inputGame'] === 'Domino QQ')
                                    @php 
                                    $jsondecode = json_decode($history->gameplay_log);
                                    $a = 0;
                                    @endphp        
                                    @foreach ($jsondecode->start->players as $start)
                                        @if($start->uid == $history->user_id) 
                                            @foreach($jsondecode->end->players as $end)                                                
                                                    @if($end->seat === $start->seat)
                                                        @for($i=0; $i<count($end->combo); $i++)
                                                            @if($end->type === 0)
                                                                @if($a == 0)
                                                                    @if($i == 0)
                                                                    {{$end->combo[$i]}} :
                                                                    @elseif($i == 1)
                                                                    {{$end->combo[$i]}}
                                                                    @endif
                                                                @endif
                                                            @else 
                                                                {{ Translate_menuPlayers(typecarddmq($end->type)) }}
                                                            @endif
                                                            
                                                        @endfor
                                                        @php 
                                                        $a++;
                                                        @endphp
                                                    @endif
                                            @endforeach 
                                        @endif                                
                                         
                                    @endforeach 
                                @elseif($_GET['inputGame'] === 'Domino Susun')
                                    @php 
                                    $jsondecode = json_decode($history->gameplay_log);
                                    @endphp        
                                    @foreach ($jsondecode->start->players as $start)
                                        @if($start->uid == $history->user_id)  
                                            @foreach($jsondecode->end->players as $end)
                                                @if($end->seat == $start->seat)
                                                    @if($end->type === 0)
                                                   {{ count($end->hand) }} {{ Translate_menuPlayers('L_CARD')}} = {{ $end->total }}
                                                   @else
                                                   {{ Translate_menuPlayers(typecarddms($end->type)) }}
                                                   @endif
                                                @endif
                                            @endforeach 
                                        @endif                                 
                                    @endforeach 
                                @endif
                            @endif
                            

                          </td>                          
                          <td>{{ number_format($history->bet, 2) }}</td>
                          <td>{{ number_format($history->win_lose,2 ) }}</td>
                          @php
                          if($history->status === 0) {
                              $status = ConfigTextTranslate('L_LOSE');
                          } else if($history->status === 1) {
                              $status = ConfigTextTranslate('L_WIN');
                          } else if($history->status === 2) {
                              $status = ConfigTextTranslate('L_DRAW');
                          }
                          @endphp
                          <td>{{ $status }}</td>
                          <td>{{ date("d-m-Y H:i:s", strtotime($history->datetimeround)) }}</td>

                        </tr>
                        @endforeach
                </tbody>
            </table>
                
        </div>
        <!-- end widget content -->
        <div style="display: flex;justify-content: center;">{{ $player_history->links() }}</div>                    
    </div>
    <!-- end widget div -->
                    
</div>
    <!-- end widget -->

<!-- Modal -->
<div class="modal fade" tabindex="-1" style="width:100%;" id="roundid-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog1 modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>{{ Translate_menuPlayers('L_DETAIL_ROUND_ID') }}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
                      <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

            <header>
                <div class="widget-header">	
                    <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                    <h2>{{ Translate_menuPlayers('L_ROUND_ID') }}<span class="round_id"></span></h2>
                </div>
            
                <div class="widget-toolbar">
                    <!-- add: non-hidden - to disable auto hide -->
                </div>
            </header>
            <div>
                            
                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->
                </div>
                <!-- end widget edit box -->
                            
                <!-- widget content -->
                <div class="table-playreport widget-body p-0">
                    <!------- Isinya ada di controller ------>
                </div>
                	<div class="reloadpage1" style="margin-left:50%;margin-right:50%;margin-bottom:50%;">
							<div class="loaderpagecontent"></div>
					</div>

                <!-- end widget content -->
                            
            </div>
            <!-- end widget div -->
                            
          </div>            
        </div>
        <div class="modal-footer" style="width:100%;">
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ Translate_menuPlayers('L_EXIT') }}</button>
        </div>
      </div>
    </div>
</div>

<script>
 $('.playreport').click(function(){
   
   var roundid = $(this).data('pk');

   // AJAX request
   $.ajax({
    url: '{{ route("playreport-modal") }}',
    type: 'GET',
    data: {roundid: roundid, game: '{{ $_GET['inputGame'] }}'},
    beforeSend: function() {
        $(".reloadpage1").show();
        $(".table-playreport-content").hide();

    },
    complete: function(){
        $(".reloadpage1").fadeOut(1000, function() {
            $(".table-playreport-content").fadeIn(700);
        });
    },
    success: function(response){ 
      // Add response in Modal body
      var obj = JSON.parse(response);
      $('.table-playreport').html(obj.tablecontent);
      $('.round_id').html(obj.roundid);

    }
  });
 });
</script>


<script>
    var responsiveHelper_dt_basic = responsiveHelper_dt_basic || undefined;
			
	var breakpointDefinition = {
	    tablet : 1024,
		phone : 480
	};
	
	$('#dt_basic').dataTable({
	    "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'>r>"+
		    "t"+
			"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
	    "autoWidth" : true,
        "ordering"  : false;
        "order": [[ 9, "desc" ]],
        "paging": false,
        "bLengthChange": false,
        'processing': true,
        "bInfo" : false,
		"oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
		},
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: false
	});
</script>
@endif
<!--- End Show After Search --->
@endsection