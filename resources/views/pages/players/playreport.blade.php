@extends('index')

@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Play_Report') }}">{{ Translate_menuPlayers('Players') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Play_Report') }}">{{ Translate_menuPlayers('Play report') }}</a></li>
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
                        <div class="col">
                            <input type="text" class="left" name="inputPlayer" placeholder="username/Player ID" value="{{ $getusername }}">
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
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate" value="{{ $inputMinDate  }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate" value="{{ $inputMaxDate }}">
                        </div>
                    @else 
                        <div class="col">
                            <input type="text" class="left" name="inputPlayer" placeholder="username/Player ID">
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
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                        </div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                        </div>
                    @endif
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
            <h2>{{ Translate_menuPlayers('Report Player') }} </h2>
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
                            {{ Translate_menuPlayers('Total Record Entries is') }} {{ $player_history->total() }}
                          </div>
                          <!-- End Button tambah bot baru -->
                
                        </div>
                
                      </div>
                    
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=round_id">{{ Translate_menuPlayers('Round ID') }}<i class="fa fa-sort{{ iconsorting('round_id') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.user_id">{{ Translate_menuPlayers('Player ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.user_id') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('Username') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=gamename">{{ Translate_menuPlayers('Playing Game') }} <i class="fa fa-sort{{ iconsorting('gamename') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=tablename">{{ Translate_menuPlayers('Table') }}<i class="fa fa-sort{{ iconsorting('tablename') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=seat_id">{{ Translate_menuPlayers('Seat') }}<i class="fa fa-sort{{ iconsorting('seat_id') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=hand_card_round">{{ Translate_menuPlayers('Hand card') }}<i class="fa fa-sort{{ iconsorting('hand_card_round') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=bet">{{ Translate_menuPlayers('Bet') }}<i class="fa fa-sort{{ iconsorting('bet') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=win_lose">{{ Translate_menuPlayers('Win Lose') }}<i class="fa fa-sort{{ iconsorting('win_lose') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=status">{{ Translate_menuPlayers('Status') }}<i class="fa fa-sort{{ iconsorting('status') }}"></i></a></th>
                        <th><a href="{{ route('PlayReport-search') }}?inputPlayer={{ $getusername }}&inputRoundID={{ $getroundid }}&inputGame={{ $getgame  }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=datetime">{{ Translate_menuPlayers('Timestamp') }}<i class="fa fa-sort{{ iconsorting('datetime') }}"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($player_history as $history)
                        <tr>
                          <td><a href="" class="delete{{ $history->round_id }}" id="roundid_detail" data-pk="{{ $history->round_id }}" data-toggle="modal"data-target="#roundid-modal{{ $history->round_id }}">{{ $history->round_id }}</a></td>
                          <td>{{ $history->user_id }}</td>
                          <td>{{ $history->username }}</td>
                          <td>{{ $history->gamename }}</td>
                          <td>{{ $history->tablename }}</td>
                          <td>{{ $history->seat_id }}</td>
                          <td>
                            @if (isset($_GET['inputGame']))
                                @if($_GET['inputGame'] === 'Texas Poker')
                                @elseif($_GET['inputGame'] === 'Big Two')      
                                @php 
                                $a = '{"start":{"stake":4000,"turn":-1,"players":[{"uid":371680,"username":"killia9","seat":0,"avatar":null,"hand":[37],"chip":397200},{"uid":240888,"username":"killia1","seat":1,"avatar":"56.jpg","hand":[18,33,20],"chip":156000}]},"acts":[{"seat":1,"act":5,"type":0,"card":[18],"left":3},{"seat":0,"act":6,"type":0,"card":[],"left":1},{"seat":1,"act":5,"type":0,"card":[20],"left":2},{"seat":0,"act":6,"type":0,"card":[],"left":1},{"seat":1,"act":5,"type":0,"card":[33],"left":1}],"end":{"players":[{"seat":0,"stat":0,"val":4000,"fee":200,"hand":[37],"chip":393200},{"seat":1,"stat":1,"val":3600,"fee":200,"hand":[],"chip":159600}]}}';
                                $jsondecode = json_decode($a);
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
                                @elseif($_GET['inputGame'] === 'Domino Susun')
                                @endif
                            @endif
                            
                            {{-- {{ $history->hand_card_round }} --}}
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
                          {{-- <td>{{ $history->countryname }}</td> --}}
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
@foreach ($player_history as $history)
<div class="modal fade" tabindex="-1" style="width:100%;" id="roundid-modal{{ $history->round_id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog1 modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i>{{ Translate_menuPlayers('Detail round ID') }}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

            <header>
                <div class="widget-header">	
                    <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                    <h2>{{ Translate_menuPlayers('Round ID') }}{{ $history->round_id }}</h2>
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
                                    <th>{{ Translate_menuPlayers('Sit') }}</th>
                                    <th>{{ Translate_menuPlayers('Username') }}</th>
                                    <th>{{ Translate_menuPlayers('Action') }}</th>
                                    <th>{{ Translate_menuPlayers('Chip') }}</th>
                                    <th>{{ Translate_menuPlayers('Card') }}</th>
                                </tr>
                            </thead>
                            {{ $history->gameplay_log }}
                            @if($history->gameplay_log)
                            @php 
                            $bgt_gameplaylog = json_decode($history->gameplay_log);
                            @endphp
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                            @endif
                        </table>  
                    @elseif($history->gamename === 'Texas Poker') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>{{ Translate_menuPlayers('Sit') }}</th>
                                    <th>{{ Translate_menuPlayers('Username') }}</th>
                                    <th>{{ Translate_menuPlayers('Action') }}</th>
                                    <th>{{ Translate_menuPlayers('Bet') }}</th>
                                    <th>{{ Translate_menuPlayers('Chip') }}</th>
                                    <th>{{ Translate_menuPlayers('Card') }}</th>
                                    <th>{{ Translate_menuPlayers('Card Table') }}</th>
                                </tr>
                            </thead>
                            {{-- {{ dd(empty($history1->gameplay_log)) }} --}}
                            @if(!empty($history->gameplay_log))
                            <tbody>                                
                            </tbody>
                            @endif
                        </table>     
                    @elseif($history->gamename === 'Domino QQ') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>{{ Translate_menuPlayers('Sit') }}</th>
                                    <th>{{ Translate_menuPlayers('Username') }}</th>
                                    <th>{{ Translate_menuPlayers('Action') }}</th>
                                    <th>{{ Translate_menuPlayers('Chip') }}</th>
                                    <th>{{ Translate_menuPlayers('Bet') }}</th>
                                    <th>{{ Translate_menuPlayers('Card') }}</th>
                                </tr>
                            </thead>
                            @if($history->gameplay_log)
                            <tbody>               
                            </tbody>
                            @endif
                    </table>     
                    @elseif($history->gamename === 'Domino Susun') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>			                
                            <tr>
                                <th>{{ Translate_menuPlayers('Sit') }}</th>
                                <th>{{ Translate_menuPlayers('Username') }}</th>
                                <th>{{ Translate_menuPlayers('Action') }}</th>
                                <th>{{ Translate_menuPlayers('Chip') }}</th>
                                <th>{{ Translate_menuPlayers('Domino') }}</th>
                            </tr>
                        </thead>
                        @if($history->gameplay_log)
                        <tbody>
            
                        </tbody>
                        @endif
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
        "ordering"  : false;
        "order": [[ 9, "desc" ]],
        "paging": false,
        "bLengthChange": false,
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