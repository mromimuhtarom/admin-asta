@extends('index')


@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Gold_Players') }}">{{ Translate_menuPlayers('L_PLAYERS') }}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Gold_Players') }}">{{ Translate_menuPlayers('L_GOLD_PLAYERS') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!--------- Warning Alert ------->
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
<!--------- End Warning Alert ------->

<!--------- Content Search ------->
    <div class="search bg-blue-dark" style="margin-bottom: 3%;">
        <div class="table-header w-100 h-100" style="padding-right:2%;">
            <form action="{{ route('Gold-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    @if (Request::is('Players/Gold_Players/Gold-search*') || Request::is('Players/Gold_Players/Gold-all*'))
                    <div class="col" align="left">
                        <input type="text" name="inputPlayer" style="width:95%;" class="form-control" placeholder="username / Player ID" value=" {{ $getusername }}">
                    </div>
                    <div class="col date-min" align="left" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $getMindate }}">
                    </div>
                    <div class="col date-max" align="left" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $getMaxdate }}">
                    </div>
                    @else 
                    <div class="col" align="left">
                        <input type="text" name="inputPlayer" style="width:95%;" class="form-control" placeholder="username / Player ID">
                    </div>
                    <div class="col date-min" align="left" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col date-max" align="left" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    @endif
                    <div class="col" align="left" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
<!--------- End Content Search -------> 

<!--------- Show after search ------->
@if (Request::is('Players/Gold_Players/Gold-search*') || Request::is('Players/Gold_Players/Gold-all*'))
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

        <header>
            <div class="widget-header">	
                <span class="widget-icon"> <i class="fa fa-cubes"></i> </span>
                <h2>{{ Translate_menuPlayers('L_GOLD_PLAYERS') }}</h2>
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
                            {{ Translate_menuPlayers('L_TOTAL_RECORD') }} {{ $balancedetails->total() }}
                        </div>
                        <!-- End Button tambah bot baru -->
                    </div>
                </div>                          
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>		
                        @if (Request::is('Players/Gold_Players/Gold-search*'))
                            <tr>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.user_id">{{ Translate_menuPlayers('L_PLAYER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.user_id') }}"></i></a></th>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('L_USERNAME') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.action_id">{{ Translate_menuPlayers('L_ACTION') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.action_id') }}"></i></a></th>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.debit">{{ Translate_menuPlayers('L_DEBIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.debit') }}"></i></a></th>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.credit">{{ Translate_menuPlayers('L_CREDIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.credit') }}"></i></a></th>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.balance">{{ Translate_menuPlayers('L_TOTAL') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.balance') }}"></i></a></th>
                                <th><a href="{{ route('Gold-search') }}?inputPlayer={{ $getusername }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.datetime">{{ Translate_menuPlayers('L_TIMESTAMP') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.datetime') }}"></i></a></th>
                            </tr>
                        @else 
                            <tr>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.user_id">{{ Translate_menuPlayers('L_PLAYER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.user_id') }}"></i></a></th>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('L_USERNAME') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.action_id">{{ Translate_menuPlayers('L_ACTION') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.action_id') }}"></i></a></th>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.debit">{{ Translate_menuPlayers('L_DEBIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.debit') }}"></i></a></th>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.credit">{{ Translate_menuPlayers('L_CREDIT') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.credit') }}"></i></a></th>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.balance">{{ Translate_menuPlayers('L_TOTAL') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.balance') }}"></i></a></th>
                                <th><a href="{{ route('gold_detail') }}?inputPlayer={{ $getusername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_gold.datetime">{{ Translate_menuPlayers('L_TIMESTAMP') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_gold.datetime') }}"></i></a></th>
                            </tr>
                        @endif	                
                    </thead>
                    <tbody>
                            @foreach ($balancedetails as $bd)
                            <tr>
                                <td>{{ $bd->user_id }}</td>
                                <td>{{ $bd->username }}</td>
                                @if ($bd->action_id == NULL)
                                <td>{{ var_dump($bd->action_id) }}</td>
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
            "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'>f>"+
                "t"+
                "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
            "autoWidth" : true,
            "paging":false,
            "bInfo":false,
            "ordering": false,
            "bLengthChange": false,
            "searching": false,
            "order": [[ 5, "desc" ]],
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
<!--------- End Show after search ------->
@endsection