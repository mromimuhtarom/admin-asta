@extends('index')


@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Point_Players') }}">{{ Translate_menuPlayers('L_PLAYERS') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Point_Players') }}">{{ Translate_menuPlayers('L_POINT_PLAYERS') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!--- Warning Alert --->
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
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
<!--- End Warning Alert --->

<!--- Content Search --->
    <div class="search bg-blue-dark" style="margin-bottom:3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Point-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                     @if (Request::is('Players/Point_Players/Point-search*') || Request::is('Players/Point_Players/Point-all*'))
                        <div class="col" style="padding-right:-10%">
                        <input type="text" name="inputPlayer" style="width:95%;" class="form-control" placeholder="username / Player ID" value="{{ $getUsername }}">
                        </div>
                        <div class="col" >
                            <select name="inputGame" class="form-control">
                                <option value=""@if($getGame == NULL) selected @endif>{{ Translate_menuPlayers('L_ALLGAMES') }}</option>
                                <option value="0" @if($getGame == '0') selected @endif>{{ Translate_menuPlayers('L_MAIN') }}</option>
                                @foreach ($game as $gm)
                                <option value="{{ $gm->id }}" @if($getGame == $gm->id) selected @endif>{{ $gm->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col date-min" style="padding-left:1%;">
                            <input type="date" name="inputMinDate" class="form-control" value="{{ $minDate }}">
                        </div>
                        <div class="col date-max" style="padding-left:1%;">
                            <input type="date" name="inputMaxDate" class="form-control" value="{{ $maxDate }}">
                        </div>
                    @else
                        <div class="col" style="padding-right:-10%">
                            <input type="text" name="inputPlayer" style="width:95%;" class="form-control" placeholder="username / Player ID">
                        </div>
                        <div class="col" >
                            <select name="inputGame" class="form-control">
                                <option value="">{{ Translate_menuPlayers('L_ALLGAMES') }}</option>
                                <option value="0">{{ Translate_menuPlayers('L_MAIN') }}</option>
                                @foreach ($game as $gm)
                                <option value="{{ $gm->id }}">{{ $gm->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col date-min" style="padding-left:1%;">
                            <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                        </div>
                        <div class="col date-max" style="padding-left:1%;">
                            <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
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
@if (Request::is('Players/Point_Players/Point-search*') || Request::is('Players/Point_Players/Point-all*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-database"></i> </span>
            <h2>{{ Translate_menuPlayers('L_POINT_PLAYERS') }}</h2>
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
                        {{ Translate_menuPlayers('Total Record Entries is') }} {{ $balancedetails->total() }}
                    </div>
                                <!-- End Button tambah bot baru -->
                </div>
            </div>                     
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			           
                    @if (Request::is('Players/Point_Players/Point-search*'))
                        <tr>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.user_id">{{ Translate_menuPlayers('L_PLAYER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.user_id') }}"></i></a></th>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('L_USERNAME') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                            <th>
                                <a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=gamename">
                                    @if($getGame == '0')
                                        {{ Translate_menuPlayers('L_MAIN') }}
                                    @else
                                        {{ Translate_menuPlayers('L_GAME') }}
                                    @endif
                                    <i class="fa fa-sort{{ iconsorting('gamename') }}"></i>
                                </a>
                            </th>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.action_id">{{ Translate_menuPlayers('L_ACTION') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.action_id') }}"></i></a></th>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.debit">{{ Translate_menuPlayers('L_DEBIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.debit') }}"></i></a></th>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.credit">{{ Translate_menuPlayers('L_CREDIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.credit') }}"></i></a></th>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.balance">{{ Translate_menuPlayers('L_TOTAL') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.balance') }}"></i></a></th>
                            <th><a href="{{ route('Point-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.datetime">{{ Translate_menuPlayers('L_TIMESTAMP') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.datetime') }}"></i></a></th>
                        </tr>
                    @else 
                        <tr>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.user_id">{{ Translate_menuPlayers('L_PLAYER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.user_id') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('L_USERNAME') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=gamename">{{ Translate_menuPlayers('L_GAME') }}<i class="fa fa-sort{{ iconsorting('gamename') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.action_id">{{ Translate_menuPlayers('L_ACTION') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.action_id') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.debit">{{ Translate_menuPlayers('L_DEBIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.debit') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.credit">{{ Translate_menuPlayers('L_CREDIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.credit') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.balance">{{ Translate_menuPlayers('L_TOTAL') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.balance') }}"></i></a></th>
                            <th><a href="{{ route('point_detail') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_point.datetime">{{ Translate_menuPlayers('L_TIMESTAMP') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_point.datetime') }}"></i></a></th>
                        </tr>
                    @endif     

                </thead>
                
                <tbody>
                    @foreach ($balancedetails as $bd)
                    @php
                        if($bd->gamename != NULL):
                            $gamename = $bd->gamename;
                        else:
                            $gamename = Translate_menuPlayers('L_LOBBY');
                        endif;
                    @endphp
                    <tr class="gradeX">
                        <td>{{ $bd->user_id }}</td>
                        <td>{{ $bd->username }}</td>
                        <td>{{ $gamename }}</td>
                        @if($bd->action_id == NULL)
                        <td></td>
                        @else 
                        <td>{{ ConfigTextTranslate($actblnc[$bd->action_id]) }}</td>
                        @endif
                        <td>{{ number_format($bd->debit, 2) }}</td>
                        <td>{{ number_format($bd->credit, 2) }}</td>
                        <td>{{ number_format($bd->balance, 2) }}</td>
                        <td>{{ date("d-m-Y H:i:s", strtotime($bd->datetime)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
        <div style="display: flex;justify-content: center;">{{ $balancedetails->links() }}</div>                    
    </div>
    <!-- end widget div -->
                    
</div>
    <!-- end widget -->
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
        "paging":false,
        "bInfo":false,
        "ordering":false,
        "bLengthChange": false,
        "searching": false,
        "order": [[ 6, "desc" ]],
        "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
        },
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