@extends('index')

@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Play_Report') }}">{{ Translate_menuPlayers('L_PLAYERS') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Play_Report') }}">{{ Translate_menuPlayers('L_PLAY_REPORT') }}</a></li>
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
                          <td><a href="#" class="delete{{ $history->round_id }}" id="roundid_detail" data-pk="{{ $history->round_id }}" data-toggle="modal"data-target="#roundid-modal{{ $history->round_id }}">{{ $history->round_id }}</a></td>
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
                                    @endphp        
                                    @foreach ($jsondecode->start->players as $start)
                                        @if($start->uid == $history->user_id)  
                                            @foreach($jsondecode->end->players as $end)
                                                @if($end->seat == $start->seat)
                                                    @for($i=0; $i<count($end->combo); $i++)
                                                        @if($i == 0)
                                                        {{$end->combo[$i]}} :
                                                        @else
                                                        {{$end->combo[$i]}}
                                                        @endif
                                                        
                                                    @endfor
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
                                                   {{ count($end->hand) }} {{ Translate_menuPlayers('L_CARD')}} = {{ $end->total }}
                                                @endif
                                            @endforeach 
                                        @endif                                 
                                    @endforeach 
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
                    <h2>{{ Translate_menuPlayers('L_ROUND_ID') }}{{ $history->round_id }}</h2>
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
                                    <th>{{ Translate_menuPlayers('L_SIT') }}</th>
                                    <th>{{ Translate_menuPlayers('L_USERNAME') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CHIP_PLAYERS') }}</th>
                                    <th>{{ Translate_menuPlayers('L_ACTION') }}</th>
                                    <th>{{ Translate_menuPlayers('L_BET') }}</th>
                                    <th>{{ Translate_menuPlayers('L_COUNT_CARD') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_HAND') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_OUT') }}</th>
                                </tr>
                            </thead>
                            @if($history->gameplay_log)
                                @php 
                                $bgt_gameplaylog = json_decode($history->gameplay_log);
                                @endphp
                                <tbody>
                                    @foreach($bgt_gameplaylog->start->players as $start)
                                    <tr>
                                        <td>{{ $start->seat }}</td>
                                        <td>{{ $start->username }}</td>
                                        <td>{{ number_format($start->chip) }}</td>
                                        <td>{{ Translate_menuPlayers('L_NEW_ROUND') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @foreach($bgt_gameplaylog->start->players as $start)
                                    <tr>
                                        <td>{{ $start->seat }}</td>
                                        <td>{{ $start->username }}</td>
                                        <td></td>
                                        <td>{{ Translate_menuPlayers('L_DIVIDED_CARD') }}</td>
                                        <td></td>
                                        <td>{{ count($start->hand) }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @php 
                                    $arraycardbgt = array();
                                    @endphp
                                    @foreach($bgt_gameplaylog->acts as $action)
                                        <tr>
                                            <td>{{ $action->seat }}</td>
                                            <td>
                                                @foreach($bgt_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)
                                                        {{ $start->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td></td>
                                            <td>{{ $action->left }}</td>
                                            <td>
                                                @foreach($bgt_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)                                                        
                                                        @for($i=0; $i<count($action->card); $i++)
                                                        @php
                                                        $arraycardbgt[] = $action->card[$i];
                                                        @endphp
                                                            {{-- <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ bgtcard($action->card)[$i] }}.png" alt=""> --}}
                                                        @endfor

                                                        @for($a=0; $a<count($start->hand); $a++)
                                                            @if(!in_array((int)$start->hand[$a], $arraycardbgt))
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ bgtcard($start->hand)[$a] }}.png" alt="">
                                                            @endif
                                                        @endfor
                                                    @endif
                                                @endforeach
                                        
                                            </td>
                                            <td>
                                                @for($i=0; $i<count($action->card); $i++)
                                                    <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ bgtcard($action->card)[$i] }}.png" alt="">
                                                @endfor
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach($bgt_gameplaylog->end->players as $end)
                                        <tr>
                                            <td>{{ $end->seat }}</td>
                                            <td>
                                                @foreach($bgt_gameplaylog->start->players as $start)
                                                    @if($start->seat == $end->seat)
                                                        {{ $start->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($end->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(statusgameplaylog($end->stat)) }}</td>
                                            <td>
                                                {{ number_format($end->val) }} <br> 
                                                (fee:{{ number_format($end->fee) }})
                                            </td>
                                            <td>{{ count($end->hand) }}</td>
                                            <td>
                                                @for($a=0; $a<count($end->hand); $a++)
                                                    <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ bgtcard($end->hand)[$a] }}.png" alt="">
                                                @endfor
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            @endif
                        </table>  
                    @elseif($history->gamename === 'Texas Poker') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>{{ Translate_menuPlayers('L_SIT') }}</th>
                                    <th>{{ Translate_menuPlayers('L_USERNAME') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CHIP_PLAYERS') }}</th>
                                    <th>{{ Translate_menuPlayers('L_ACTION') }}</th>
                                    <th>{{ Translate_menuPlayers('L_BET') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_TYPE') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_HAND') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_TABLE') }}</th>
                                </tr>
                            </thead>
                            {{-- {{ dd(empty($history1->gameplay_log)) }} --}}
                            @if(!empty($history->gameplay_log))
                                @php 
                                $tpk_gameplaylog = json_decode($history->gameplay_log);
                                @endphp
                                <tbody> 
                                    @foreach($tpk_gameplaylog->start->players as $start)
                                    <tr>
                                        <td>{{ $start->seat }}</td>
                                        <td>
                                            @foreach($player_username as $plyr)
                                                @if($start->uid == $plyr->user_id)
                                                    {{ $plyr->username }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ number_format($start->chip) }}</td>
                                        <td>{{ Translate_menuPlayers('L_NEW_ROUND') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach  
                                    <!-- untuk dealer  -->
                                    @foreach($tpk_gameplaylog->start->players as $start)
                                    @if($start->seat == $tpk_gameplaylog->start->turn)
                                    <tr>
                                        <td>{{ $start->seat }}</td>
                                        <td>
                                            @foreach($player_username as $plyr)
                                                @if($start->uid == $plyr->user_id)
                                                    {{ $plyr->username }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ number_format($start->chip) }}</td>
                                        <td>{{ Translate_menuPlayers('L_DEALER') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            @if(!empty($start->hand))
                                                @for($a=0; $a<count($start->hand); $a++)
                                                    <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($start->hand)[$a] }}.png" alt="">
                                                @endfor
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    <!-- end untuk dealer -->
                                    @php 
                                    $b = 1;
                                    @endphp
                                    @foreach($tpk_gameplaylog->acts as $action)
                                        @if($action->act == 7 || $action->act == 8)
                                        <tr>
                                            <td>{{ $action->seat }}</td>
                                            <td>
                                                @foreach($tpk_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat )
                                                        @foreach($player_username as $plyr)
                                                            @if($start->uid == $plyr->user_id)
                                                                {{ $plyr->username }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($action->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td>{{ number_format($action->bet) }}</td>
                                            <td></td>
                                            <td>
                                                @foreach ($tpk_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)
                                                        @if(!empty($start->hand))
                                                            @for($a=0; $a<count($start->hand); $a++)
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($start->hand)[$a] }}.png" alt="">
                                                            @endfor
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td></td>
                                        </tr>
                                        @elseif($action->act == 9)
                                        <tr>
                                            <td></td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                @if(!empty($tpk_gameplaylog->start->table_card))
                                                    @if($b == 1)
                                                    @for($a=0; $a<3; $a++)
                                                        {{-- {{$a}} --}}
                                                        <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($tpk_gameplaylog->start->table_card)[$a] }}.png" alt="">
                                                    @endfor
                                                    @elseif($b == 2)
                                                    @for($a=0; $a<4; $a++)
                                                        {{-- {{$tpk_gameplaylog->start->table_card[$a]}} --}}
                                                        <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($tpk_gameplaylog->start->table_card)[$a] }}.png" alt="">
                                                    @endfor
                                                    @elseif($b == 3)
                                                    @for($a=0; $a<5; $a++)
                                                        <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($tpk_gameplaylog->start->table_card)[$a] }}.png" alt="">
                                                    @endfor
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @php 
                                        $b++
                                        @endphp
                                        @else
                                        <tr>
                                            <td>{{ $action->seat }}</td>
                                            <td>
                                                @foreach($tpk_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat )
                                                        @foreach($player_username as $plyr)
                                                            @if($start->uid == $plyr->user_id)
                                                                {{ $plyr->username }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($action->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td>{{ number_format($action->bet) }}</td>
                                            <td></td>
                                            <td>
                                                @if($action->act == 4)
                                                 <!--  null -->
                                                @else 
                                                    @foreach($tpk_gameplaylog->start->players as $start)
                                                        @if($start->seat == $action->seat)
                                                            @if(!empty($start->hand))
                                                                @for($a=0; $a<count($start->hand); $a++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($start->hand)[$a] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr> 
                                        @endif
                                    @endforeach   
                                    
                                    @foreach($tpk_gameplaylog->end->players as $end)
                                        <tr>
                                            <td>{{ $end->seat }}</td>
                                            <td>
                                                @foreach($tpk_gameplaylog->start->players as $start)
                                                    @if($start->seat == $end->seat )
                                                        @foreach($player_username as $plyr)
                                                            @if($start->uid == $plyr->user_id)
                                                                {{ $plyr->username }}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($end->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(statusgameplaylog($end->stat)) }}</td>
                                            <td>
                                                {{ number_format($end->val) }} <br> 
                                                (fee:{{ number_format($end->fee) }})
                                            </td>
                                            <td>{{ Translate_menuPlayers(typeCardGamepLayLogBgtTpk($end->type)) }}</td>
                                            <td>
                                                @if($end->type !== null)
                                                    <!------- untuk ada status action --------->
                                                    @foreach($tpk_gameplaylog->start->players as $start)
                                                        @if($start->seat == $end->seat)

                                                            @for($a=0; $a<count($start->hand); $a++)
                                                                @if(!empty($start->hand))
                                                                    @if(in_array((int)$start->hand[$a], $end->hand, false))
                                                                        <img style="width:38px;height:auto;border:3px solid yellow;" src="/assets/img/card_bgt_tpk/{{ tpkcard($start->hand)[$a] }}.png" alt="">
                                                                    @else
                                                                        <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($start->hand)[$a] }}.png" alt="">
                                                                    @endif
                                                                @endif
                                                            @endfor

                                                        @endif
                                                    @endforeach
                                                    <!------- end untuk ada status --------->
                                                @else
                                                    <!------- untuk tidak ada status action --------->
                                                    @foreach($tpk_gameplaylog->start->players as $start)
                                                        @if($start->seat == $end->seat)
                                                            @if(!empty($start->hand))
                                                                @for($a=0; $a<count($start->hand); $a++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($start->hand)[$a] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if($end->hand)
                                                    @for($a=0; $a<count($tpk_gameplaylog->start->table_card); $a++)
                                                        @if(!empty($tpk_gameplaylog->start->table_card))
                                                            @if(in_array((int)$tpk_gameplaylog->start->table_card[$a], $end->hand, false))
                                                                <img style="width:38px;height:auto;border:3px solid yellow;" src="/assets/img/card_bgt_tpk/{{ tpkcard($tpk_gameplaylog->start->table_card)[$a] }}.png" alt="">
                                                            @else
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ tpkcard($tpk_gameplaylog->start->table_card)[$a] }}.png" alt="">
                                                            @endif
                                                        @endif
                                                    @endfor
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>     
                    @elseif($history->gamename === 'Domino QQ') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>{{ Translate_menuPlayers('L_SIT') }}</th>
                                    <th>{{ Translate_menuPlayers('L_USERNAME') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CHIP_PLAYERS') }}</th>
                                    <th>{{ Translate_menuPlayers('L_ACTION') }}</th>
                                    <th>{{ Translate_menuPlayers('L_BET') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_VALUE') }}</th>
                                    <th>{{ Translate_menuPlayers('L_CARD_HAND') }}</th>
                                </tr>
                            </thead>
                            @if($history->gameplay_log)
                                @php 
                                $dmq_gameplaylog = json_decode($history->gameplay_log);
                                @endphp
                                <tbody>  
                                    @foreach($dmq_gameplaylog->start->players as $start)
                                        <tr>
                                            <td>{{ $start->seat }}</td>
                                            <td>
                                                @foreach($player_username as $plyr)
                                                    @if($start->uid == $plyr->user_id)
                                                        {{ $plyr->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($start->chip) }}</td>
                                            <td>{{ Translate_menuPlayers('L_NEW_ROUND') }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach  
                                    
                                    <!-------- Card divided ------->
                                    @foreach($dmq_gameplaylog->start->players as $start)
                                        <tr>
                                            <td>{{ $start->seat }}</td>
                                            <td>{{ $start->username }}</td>
                                            <td>
                                                @foreach($dmq_gameplaylog->acts as $action)
                                                    @if($action->act == 9 && $action->seat == $start->seat)
                                                    {{ number_format($action->chip) }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ Translate_menuPlayers('L_DIVIDED_CARD') }}</td>
                                            <td>{{ number_format($dmq_gameplaylog->start->stake) }}</td>
                                            <td></td>
                                            <td>
                                                @for($a=0; $a<3; $a++)
                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$a] }}.png" alt="">
                                                @endfor
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-------- End Card divided ------->

                                    <!-------- Action -------->
                                    @php 
                                    $a = 0;
                                    $draw = array_count_values(array_column($dmq_gameplaylog->acts, 'act'))[9];
                                    @endphp
                                    
                                    @foreach($dmq_gameplaylog->acts as $action)
                                        @if($action->act == 9)
                                        <tr>
                                            <td>{{ $action->seat }}</td>
                                            <td>
                                                @foreach($dmq_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)
                                                        {{ $start->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($action->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td>{{ number_format($action->bet) }}</td>
                                            <td></td>
                                            <td>
                                                @if($draw == 2)
                                                    @foreach($dmq_gameplaylog->start->players as $start)
                                                        @if($start->seat == $action->seat)
                                                            @for($i=0; $i<3; $i++)
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                            @endfor
                                                        @endif
                                                    @endforeach
                                                @elseif($draw == 3)
                                                    @foreach($dmq_gameplaylog->start->players as $start)
                                                        @if($start->seat == $action->seat)
                                                            @for($i=0; $i<3; $i++)
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                            @endfor
                                                        @endif
                                                    @endforeach
                                                @elseif($draw == 5)
                                                    @foreach($dmq_gameplaylog->start->players as $start)
                                                        @if($start->seat == $action->seat)
                                                            @for($i=0; $i<3; $i++)
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                            @endfor
                                                        @endif
                                                    @endforeach
                                                @elseif($draw == 7)
                                                    @foreach($dmq_gameplaylog->start->players as $start)
                                                        @if($start->seat == $action->seat)
                                                            @for($i=0; $i<3; $i++)
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                            @endfor
                                                        @endif
                                                    @endforeach
                                                @elseif($draw == 4)
                                                    @if($a == 0 || $a == 1)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<3; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @elseif($a == 4 || $a == 5)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<4; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @elseif($draw == 6)
                                                    @if($a == 0 || $a == 1 || $a == 2)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<3; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @elseif($a == 6 || $a == 7 || $a == 8)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<4; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @elseif($draw == 8)
                                                    @if($a == 0 || $a == 1 || $a == 2 || $a == 3)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<3; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @elseif($a == 8 || $a == 9 || $a == 10 || $a == 11)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<4; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @elseif($draw == 10)
                                                    @if($a == 0 || $a == 1 || $a == 2 || $a == 3 || $a == 4)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<3; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @elseif($a == 10 || $a == 11 || $a == 12 || $a == 13 || $a == 14)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<4; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @elseif($draw == 12)
                                                    @if($a == 0 || $a == 1 || $a == 2 || $a == 3 || $a == 4 || $a == 5)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<3; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @elseif($a == 12 || $a == 13 || $a == 14 || $a == 15 || $a == 16 || $a = 17)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<4; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @elseif($draw == 14)
                                                    @if($a == 0 || $a == 1 || $a == 2 || $a == 3 || $a == 4 || $a == 5 || $a == 6)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<3; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @elseif($a == 13 || $a == 14 || $a == 15 || $a == 16 || $a == 17 || $a = 18 || $a ==19)
                                                        @foreach($dmq_gameplaylog->start->players as $start)
                                                            @if($start->seat == $action->seat)
                                                                @for($i=0; $i<4; $i++)
                                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$i] }}.png" alt="">
                                                                @endfor
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif                                            
                                                {{-- @foreach($dmq_gameplaylog->start->players as $start)
                                                @if($start->seat == $action->seat)
                                                {{$a}}
                                                @endif
                                                @endforeach --}}
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>{{ $action->seat }}</td>
                                            <td>
                                                @foreach($dmq_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)
                                                        {{ $start->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($action->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td>{{ number_format($action->bet) }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                        @php 
                                        $a++
                                        @endphp
                                    @endforeach                                    
                                    <!-------- End Action ---------->

                                    @foreach($dmq_gameplaylog->end->players as $end)
                                        <tr>
                                            <td>{{ $end->seat }}</td>
                                            <td>
                                                @foreach($dmq_gameplaylog->start->players as $start)
                                                    @if($start->seat == $end->seat)
                                                        {{ $start->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($end->chip) }}</td>
                                            <td>{{ Translate_menuPlayers(statusgameplaylog($end->stat)) }}</td>
                                            <td>
                                                {{ number_format($end->val) }} <br> 
                                                (fee:{{ number_format($end->fee) }})
                                            </td>
                                            <td>
                                                    @for($i=0; $i<count($end->combo); $i++)
                                                        @if($i == 0)
                                                        {{$end->combo[$i]}} :
                                                        @else
                                                        {{$end->combo[$i]}}
                                                        @endif
                                                        
                                                    @endfor
                                            </td>
                                            <td>
                                                @if($end->hand)
                                                @for($a=0; $a<count($end->hand); $a++)
                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($end->hand)[$a] }}.png" alt="">
                                                @endfor
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                    </table>     
                    @elseif($history->gamename === 'Domino Susun') 
                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>			                
                            <tr>
                                <th>{{ Translate_menuPlayers('L_SIT') }}</th>
                                <th>{{ Translate_menuPlayers('L_USERNAME') }}</th>
                                <th>{{ Translate_menuPlayers('L_CHIP_PLAYERS') }}</th>
                                <th>{{ Translate_menuPlayers('L_ACTION') }}</th>
                                <th>{{ Translate_menuPlayers('L_BET') }}</th>
                                <th>{{ Translate_menuPlayers('L_COUNT_CARD') }}</th>
                                <th>{{ Translate_menuPlayers('L_CARD_HAND') }}</th>
                                <th>{{ Translate_menuPlayers('L_CARD_OUT') }}</th>
                            </tr>
                        </thead>
                        @if($history->gameplay_log)
                            @php 
                            $dms_gameplaylog = json_decode($history->gameplay_log);
                            @endphp
                            <tbody>
                                @foreach($dms_gameplaylog->start->players as $start)
                                    <tr>
                                        <td>{{ $start->seat }}</td>
                                        <td>
                                            @foreach($player_username as $plyr)
                                                @if($start->uid == $plyr->user_id)
                                                    {{ $plyr->username }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ number_format($start->chip) }}</td>
                                        <td>{{ Translate_menuPlayers('L_NEW_ROUND') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach    
                                <!-------- Card divided ------->
                                @foreach($dms_gameplaylog->start->players as $start)
                                    <tr>
                                        <td>{{ $start->seat }}</td>
                                        <td>{{ $start->username }}</td>
                                        <td>
                                            @foreach($dms_gameplaylog->acts as $action)
                                                @if($action->act == 9 && $action->seat == $start->seat)
                                                {{ number_format($action->chip) }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ Translate_menuPlayers('L_DIVIDED_CARD') }}</td>
                                        <td>{{ number_format($dms_gameplaylog->start->stake) }}</td>
                                        <td>{{ count($start->hand) }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                <!-------- End Card divided ------->
                                @php 
                                    $arraycarddms = array();
                                @endphp
                                @foreach($dms_gameplaylog->acts as $action)
                                    @if($action->act != 9)
                                        <tr>
                                            <td>{{ $action->seat }}</td>
                                            <td>
                                                @foreach($dms_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)
                                                        {{ $start->username }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td>{{ Translate_menuPlayers(actiongameplaylog($action->act)) }}</td>
                                            <td></td>
                                            <td>
                                                @foreach($dms_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)                                                        
                                                        @for($i=0; $i<count($action->card); $i++)
                                                        @php
                                                        $arraycarddms[] = $action->card[$i];
                                                        @endphp
                                                            {{-- <img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/{{ bgtcard($action->card)[$i] }}.png" alt=""> --}}
                                                        @endfor
                                                        {{ count(array_diff($start->hand, $arraycarddms))}}
                                                        {{-- @for($a=0; $a<count($start->hand); $a++)
                                                            @if(!in_array((int)$start->hand[$a], $arraycarddms))
                                                                
                                                            @endif
                                                        @endfor --}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($dms_gameplaylog->start->players as $start)
                                                    @if($start->seat == $action->seat)                                                        


                                                        @for($a=0; $a<count($start->hand); $a++)
                                                            @if(!in_array((int)$start->hand[$a], $arraycarddms))
                                                                <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($start->hand)[$a] }}.png" alt="">
                                                            @endif
                                                        @endfor
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @for($i=0; $i<count($action->card); $i++)
                                                    <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($action->card)[$i] }}.png" alt="">
                                                @endfor
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                @foreach($dms_gameplaylog->end->players as $end)
                                    <tr>
                                        <td>{{ $end->seat }}</td>
                                        <td>
                                            @foreach($dms_gameplaylog->start->players as $start)
                                                @if($start->seat == $end->seat)
                                                    {{ $start->username }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ number_format($end->chip) }}</td>
                                        <td>{{ Translate_menuPlayers(statusgameplaylog($end->stat)) }}</td>
                                        <td>
                                            {{ number_format($end->val) }} <br> 
                                            (fee:{{ number_format($end->fee) }})
                                        </td>
                                        <td>{{ count($end->hand) }}</td>
                                        <td>
                                            @for($a=0; $a<count($end->hand); $a++)
                                                <img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/{{ dmscard($end->hand)[$a] }}.png" alt="">
                                            @endfor
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                      
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
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ Translate_menuPlayers('L_EXIT') }}</button>
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