@extends('index')

@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Balance_Reseller') }}">{{ translate_menu('L_RESELLER')}}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Balance_Reseller') }}">{{ translate_menu('L_BALANCE_RESELLER')}}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
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
<!--- End Warning Alert --->

<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('BalanceReseller-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col">
                    <input type="text" name="inputUsername" class="left" placeholder="username">
                </div>
                @if (Request::is('Reseller/Balance_Reseller/BalanceReseller-search*'))
                <div class="col">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $startDate }}">
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $endDate }}">
                </div>
                @else
                <div class="col">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                </div>
                @endif
                <div class="col" style="padding-left:3%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>    
<!--- End Content Search --->


<!--- Show After Search --->
@if (Request::is('Reseller/Balance_Reseller/BalanceReseller-search*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>{{ translate_menu('L_BALANCE_RESELLER')}}</h2>
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
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.reseller_id">{{ TranslateReseller('L_RESELLER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.reseller_balance.reseller_id') }}"></i></a></th>
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.username">{{ Translate_menuPlayers('Username')}}<i class="fa fa-sort{{ iconsorting('asta_db.reseller_balance.username') }}"></i></a></th>
                        {{-- <th>Description</th> --}}
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.debet">{{ Translate_menuPlayers('Debit') }}<i class="fa fa-sort"{{ iconsorting('asta_db.reseller_balance.debet') }}"></i></a></th>
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.credit">{{ Translate_menuPlayers('Credit') }}<i class="fa fa-sort"{{ iconsorting('asta_db.reseller_balance.credit') }}"></i></a></th>
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.balance">{{ TranslateReseller('Balance') }}<i class="fa fa-sort{{ iconsorting('asta_db.reseller_balance.balance') }}"></i></a></th>
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.action_id">{{ TranslateMenuItem('Category') }}<i class="fa fa-sort{{ iconsorting('asta_db.reseller_balance.action_id') }}"></i></a></th>
                        <th><a href="{{ route('BalanceReseller-search') }}?inputPlayer={{ $searchUsername }}&inputMinDate={{ $startDate }}&inputMaxDate={{ $endDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_balance.datetime">{{ Translate_menuPlayers('Timestamp') }}<i class=" fa fa-sort{{ iconsorting('asta_db.reseller_balance.datetime') }}"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($balancedetails as $bd)
                    <tr>
                        <td>{{ $bd->reseller_id }}</td>
                        <td>{{ $bd->username }}</td>
                        {{-- <td></td> --}}
                        <td>{{ number_format($bd->debet, 2) }}</td>
                        <td>{{ number_format($bd->credit, 2) }}</td>
                        <td>{{ number_format($bd->balance, 2) }}</td>
                        <td>{{ ConfigTextTranslate($actblnc[$bd->action_id]) }}</td> 
                        <td>{{ $bd->datetime }}</td>
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
<!--- End Show After Serach --->
@endsection