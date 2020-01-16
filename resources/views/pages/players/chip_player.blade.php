@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Chip_Players') }}">{{ Translate_menuPlayers('Players') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Chip_Players') }}">{{ Translate_menuPlayers('Chip Players') }}</a></li>
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
    <div class="search bg-blue-dark" style="margin-bottom:3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Chip-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col" style="padding-right:-10%">
                        <input type="text" name="inputPlayer" style="width:95%;" class="left" placeholder="username / player ID">
                    </div>
                    <div class="col" >
                        <select name="inputGame" class="form-control">
                            <option value="">{{ Translate_menuPlayers('Choose Game') }}</option>
                            <option value="0">Utama</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}">{{ $gm->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (Request::is('Players/Chip_Players/Chip-search*') || Request::is('Players/Chip_Players/Chip-all*'))
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $getMindate }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $getMaxdate }}">
                    </div>
                    @else 
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    @endif
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!--------- End Content Search ------->


<!--------- Show after search ------->
@if (Request::is('Players/Chip_Players/Chip-search*') || Request::is('Players/Chip_Players/Chip-all*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-database"></i> </span>
            <h2>{{ Translate_menuPlayers('Chip Players') }}</h2>
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
                    <tr>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_chip.user_id">{{ Translate_menuPlayers('Player ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_chip.user_id') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('Username') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=gamename">{{ Translate_menuPlayers('Game') }}<i class="fa fa-sort{{ iconsorting('gamename') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_chip.action_id">{{ Translate_menuPlayers('Action') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_chip.action_id') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_chip.debit">{{ Translate_menuPlayers('Debit') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_chip.debit') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_chip.credit">{{ Translate_menuPlayers('Credit') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_chip.credit') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_chip.balance">{{ Translate_menuPlayers('Total') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_chip.balance') }}"></i></a></th>
                        <th><a href="{{ route('Chip-search') }}?inputPlayer={{ $getUsername }}&inputGame={{ $getGame }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.balance_chip.datetime">{{ Translate_menuPlayers('Timestamp') }}<i class="fa fa-sort{{ iconsorting('asta_db.balance_chip.datetime') }}"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($balancedetails as $bd)
                    @php
                        if($bd->gamename != NULL):
                            $gamename = $bd->gamename;
                        else:
                            $gamename = 'Utama';
                        endif;
                    @endphp
                    <tr class="gradeX">
                        <td>{{ $bd->user_id }}</td>
                        <td>{{ $bd->username }}</td>
                        <td>{{ $gamename }}</td>
                        <td>{{ $actblnc[$bd->action_id] }}</td>
                        <td>{{ number_format($bd->debit, 2) }}</td>
                        <td>{{ number_format($bd->credit, 2) }}</td>
                        <td>{{ number_format($bd->balance, 2) }}</td>
                        <td>{{ $bd->datetime }}</td>
                    </tr>
    
    
                    @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
        <div style="display: flex;justify-content: center;">{{ $balancedetails->links() }}</div>
                    
    </div>`
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
<!--------- End Show after search ------->
@endsection