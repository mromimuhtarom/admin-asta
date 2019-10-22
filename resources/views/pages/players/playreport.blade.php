@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Play_Report') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Play_Report') }}">Play Report</a></li>
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
                    <div class="col">
                        <input type="text" class="left" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select name="inputGame" class="form-control">
                            <option value="">Choose Game</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->desc }}">{{ $gm->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
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
            <h2>Player Report </h2>
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
                    
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th>Round ID</th>
                        <th>Username</th>
                        <th>Playing Game</th>
                        <th>Table</th>
                        <th>Seat</th>
                        <th>Hand Card</th>
                        <th>Bet</th>
                        <th>Win Lose</th>
                        <th>Status</th>
                        <th>Time Stamp</th>
                        {{-- <th>Country</th> --}}
                    </tr>
                </thead>
                <tbody>
                        @foreach ($player_history as $history)
                        <tr>
                          <td><a href="" class="delete{{ $history->round_id }}" id="roundid_detail" data-pk="{{ $history->round_id }}" data-toggle="modal"data-target="#roundid-modal{{ $history->round_id }}">{{ $history->round_id }}</a></td>
                          <td>{{ $history->username }}</td>
                          <td>{{ $history->gamename }}</td>
                          <td>{{ $history->tablename }}</td>
                          <td>{{ $history->seat_id }}</td>
                          <td>{{ $history->hand_card }}</td>
                          <td>{{ $history->bet }}</td>
                          <td>{{ $history->win_lose }}</td>
                          @php
                          if($history->status === 0) {
                              $status = 'Lose';
                          } else if($history->status === 1) {
                              $status = 'Win';
                          } else if($history->status === 2) {
                              $status = 'Draw';
                          }
                          @endphp
                          <td>{{ $status }}</td>
                          <td>{{ $history->date }}</td>
                          {{-- <td>{{ $history->countryname }}</td> --}}
                        </tr>
                        @endforeach
                </tbody>
            </table>
                
        </div>
        <!-- end widget content -->
                    
    </div>
    <!-- end widget div -->
                    
</div>
    <!-- end widget -->

<!-- Modal -->
@foreach ($player_history as $history)
<div class="modal fade" tabindex="-1" style="width:100%;" id="roundid-modal{{ $history->round_id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog1 modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Detail Round ID</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

            <header>
                <div class="widget-header">	
                    <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                    <h2>Round ID {{ $history->round_id }}</h2>
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
                    @if ($history->gamename === 'Big Two')
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>Sit</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                    <th>Chip</th>
                                    <th>Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $arrayjson_decode = array_gameplaylog($history->gameplay_log)
                                @endphp                   
                                @foreach($arrayjson_decode as $row)
                                @if ($row['game_state'] === 'NEW_ROUND')
                                @foreach ($row['player'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($player['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['card'] }}</td>
                                </tr>
                                @endforeach  
                                @elseif($row['game_state'] === 'PLAYER_ACTION')
                                <tr>
                                    <td>{{ $row['player']['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($row['player']['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['action']}}</td>
                                    <td></td>
                                    <td>{{ $row['player']['card'] }}</td>
                                </tr>  
                                @elseif ($row['game_state'] === 'END_ROUND')
                                @foreach ($row['player'] as $endplayer)
                                <tr>
                                    <td>{{ $endplayer['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($endplayer['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $endplayer['status'] }}</td>
                                    <td>{{ $endplayer['chip'] }}</td>
                                    <td>{{ $endplayer['card'] }}</td>
                                </tr>
                                @endforeach     
                                @endif
                                @endforeach                 
                            </tbody>
                        </table>  
                    @elseif($history->gamename === 'Texas Poker') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>Sit</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                    <th>Chip</th>
                                    <th>Card</th>
                                    <th>Card Table</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $inputMinDate = "2019-10-18";
                                $inputMaxDate = "2019-10-18";
                                $tbtpk = App\TpkRound::where('tpk_round.round_id', '=', 4910)->first();
                                $arrayjson_decode = array_gameplaylog($tbtpk->gameplay_log);
                                @endphp                   
                                @foreach($arrayjson_decode as $row)
                                @if ($row['game_state'] === 'NEW_ROUND')
                                @foreach ($row['player'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($player['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['card'] }}</td>
                                    <td>{{ $row['card_table']}}</td>
                                </tr>
                                @endforeach  
                                @elseif($row['game_state'] === 'TURN_BET')
                                <tr>
                                    <td>{{ $row['player']['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($row['player']['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['player']['action']}}</td>
                                    <td>{{ $row['player']['chip']}}</td>
                                    <td>{{ $row['player']['card'] }}</td>
                                    <td>{{ $row['card_table'] }}</td>
                                </tr>  
                                @elseif ($row['game_state'] === 'END_ROUND')
                                @foreach ($row['player'] as $endplayer)
                                <tr>
                                    <td>{{ $endplayer['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($endplayer['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $endplayer['status'] }}</td>
                                    <td>{{ $endplayer['chip'] }}</td>
                                    <td>{{ $endplayer['card'] }}</td>
                                    <td>{{ $row['card_table'] }}</td>
                                </tr>
                                @endforeach     
                                @endif
                                @endforeach                 
                            </tbody>
                        </table>     
                    @elseif($history->gamename === 'Domino QQ') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>Sit</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                    <th>Chip</th>
                                    <th>Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $inputMinDate = "2019-10-19";
                                $inputMaxDate = "2019-10-19";
                                $tbdmq = App\DmqRound::where('dmq_round.round_id', '=', 1327)->first();
                                $arrayjson_decode = array_gameplaylog($tbdmq->gameplay_log);
                                @endphp                   
                                @foreach($arrayjson_decode as $row)
                                @if ($row['game_state'] === 'NEW_ROUND')
                                @foreach ($row['players'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($player['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['card'] }}</td>
                                </tr>
                                @endforeach  
                                @elseif($row['game_state'] === 'DRAW')
                                @foreach ($row['players'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    <td>{{ $player['username'] }}</td>
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['card'] }}</td>
                                </tr>
                                @endforeach
                                @elseif($row['game_state'] === 'PLAYER_ACTION')
                                <tr>
                                    <td>{{ $row['player']['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($row['player']['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['action']}}</td>
                                    <td>{{ $row['player']['chip']}}</td>
                                    <td></td>
                                </tr>  
                                @elseif ($row['game_state'] === 'ACTION_DONE')
                                @foreach ($row['players'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    <td>{{ $player['username'] }}</td>
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['card'] }}</td>
                                </tr>
                                @endforeach
                                @elseif($row['game_state'] === 'PLAYER_WIN')     
                                <tr>
                                    <td>{{ $row['winner']['seat_id'] }}</td>
                                    <td>{{ $row['winner']['username'] }}</td>
                                    <td>{{ $row['game_state']}}</td>
                                    <td>{{ $row['winner']['chip']}}</td>
                                    <td></td>
                                </tr>  
                                @endif
                                @endforeach                 
                            </tbody>
                    </table>     
                    @elseif($history->gamename === 'Domino Susun') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>Sit</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                    <th>Chip</th>
                                    <th>Domino</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $inputMinDate = "2019-10-19";
                                $inputMaxDate = "2019-10-19";
                                $tbdms = App\DmsRound::where('dms_round.round_id', '=', 726)->first();

                                $arrayjson_decode = array_gameplaylog($tbdms->gameplay_log);
                                
                                @endphp                   
                                @foreach($arrayjson_decode as $row)
                                @if ($row['game_state'] === 'READY')
                                @foreach ($row['players'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($player['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['hand'] }}</td>
                                </tr>
                                @endforeach  
                                @elseif($row['game_state'] === 'DRAW')
                                @foreach ($row['players'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    <td>{{ $player['username'] }}</td>
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['hand'] }}</td>
                                </tr>
                                @endforeach
                                @elseif($row['game_state'] === 'PLAYER_ACTION')
                                <tr>
                                    <td>{{ $row['player']['seat_id'] }}</td>
                                    @foreach ($player_username as $plyr)
                                    @if ($row['player']['user_id'] === $plyr->user_id)
                                    <td>{{ $plyr->username }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $row['action']}}</td>                                  
                                    <td></td>
                                    @if ($row['action'] !== 'PASS')
                                    <td>{{ $row['domino']}}</td>
                                    @endif  
                                </tr>  
                                @elseif ($row['game_state'] === 'ACTION_DONE')
                                @foreach ($row['players'] as $key => $player) 
                                <tr>
                                    <td>{{ $player['seat_id'] }}</td>
                                    <td>{{ $player['username'] }}</td>
                                    <td>{{ $row['game_state'] }}</td>
                                    <td>{{ $player['chip'] }}</td>
                                    <td>{{ $player['hand'] }}</td>
                                </tr>
                                @endforeach
                                @elseif($row['game_state'] === 'PLAYER_WIN')     
                                <tr>
                                    <td>{{ $row['winner']['seat_id'] }}</td>
                                    <td>{{ $row['winner']['username'] }}</td>
                                    <td>{{ $row['game_state']}}</td>
                                    <td>{{ $row['winner']['chip']}}</td>
                                    <td></td>
                                </tr>  
                                @endif
                                @endforeach                 
                            </tbody>
                    </table>                              
                    @endif                        
                </div>
                <!-- end widget content -->
                            
            </div>
            <!-- end widget div -->
                            
         </div>



        </div>
        <div class="modal-footer" style="width:100%;">
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Exit</button>
        </div>
      </div>
    </div>
</div>
@endforeach




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
        "order": [[ 9, "desc" ]],
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