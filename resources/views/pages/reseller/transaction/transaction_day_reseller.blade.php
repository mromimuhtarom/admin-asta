@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day_Reseller') }}">{{ translate_menu('L_RESELLER') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day_Reseller') }}">{{ translate_menu('L_RESELLER_TRANSACTION') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day_Reseller') }}">{{ translate_menu('L_TRANSACTION_DAY_RESELLER') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
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
  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif


<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
		<form action="{{ route('Transaction_Day_Reseller-search')}}">
            <div class="row h-100 w-100">

                    @if (Request::is('Reseller/Reseller-Transaction/Transaction_Day_Reseller/TransactionDayReseller-search*'))
                        <div class="col">
                            <select name="choose_time" id="time" class="form-control">
                                <option value="">{{ translate_MenuTransaction('Choose Time') }}</option>
                                    <option value="Day" @if($time == 'Day') selected @endif>{{ translate_MenuTransaction('Day') }}</option>
                                    <option value="Week" @if($time == 'Week') selected @endif>{{ translate_MenuTransaction('Week') }}</option>
                                    <option value="Month" @if($time == 'Month') selected @endif>{{ translate_MenuTransaction('Month') }}</option>
                                    <option value="All time" @if($time == 'All time') selected @endif>{{ translate_MenuTransaction('All time') }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="minDate" name="inputMinDate" value="{{ $minDate }}">
                        </div>
                        <div class="col">
                                <input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="{{ $maxDate }}">
                        </div>
                        <div class="col">
                                <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    @else 
                        <div class="col">
                            <select name="choose_time" id="time" class="form-control">
                                <option value="">{{ translate_MenuTransaction('Choose Time') }}</option>
                                <option value="Day">{{ translate_MenuTransaction('Day') }}</option>
                                <option value="Week">{{ translate_MenuTransaction('Week') }}</option>
                                <option value="Month">{{ translate_MenuTransaction('Month') }}</option>
                                <option value="All time">{{ translate_MenuTransaction('All time') }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="minDate" name="inputMinDate" value="{{ $datenow }}">
                        </div>
                        <div class="col">
                                <input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="{{ $datenow }}">
                        </div>
                        <div class="col">
                                <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </div>										
                    @endif
            </div>
        </form>
    </div>
</div>
<!--- End Content Search ---> 
@if(Request::is('Reseller/Reseller-Transaction/Transaction_Day_Reseller/TransactionDayReseller-search*'))
{{-- @if ($time == "today") --}}
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
	<header>
		<div class="widget-header">	
			<h2><strong>{{ translate_MenuTransaction('Transaction Day') }}</strong></h2>				
		</div>
	</header>

	<div>
		<div class="widget-body">
			<div class="custom-scroll table-responsive">
				
				<div class="table-outer">
					<div class="row">
						<div class="col" style="font-style:italic;color:#969696;font-weight:bold;">
							{{ Translate_menuPlayers('Total Record Entries is') }} {{ $history->total() }}
						</div>
					</div>
					<table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
						<thead>
							<tr>
                                @if($time == "Day" || $time == "Week" || $time == "Month" || $time == "All time")
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reseller_transaction_day.date_created">{{ TranslateReseller('Date Created') }} <i class="fa fa-sort{{ iconsorting('reseller_transaction_day.date_created') }}"></i></a></td>
                                @endif
                                @if($time == "All time" )
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reseller_transaction_day.reseller_id">{{ TranslateReseller('Reseller ID') }} <i class="fa fa-sort{{ iconsorting('reseller_transaction_day.reseller_id') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reseller.username">{{ TranslateReseller('Username') }} <i class="fa fa-sort{{ iconsorting('reseller.username') }}"></i></a></td>
                                @endif
                                @if($time == "Day" || $time == "Week" || $time == "Month" || $time == "All time")
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=buy_gold">{{ TranslateReseller('Buy Gold') }} <i class="fa fa-sort{{ iconsorting('buy_gold') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=buy_amount">{{ TranslateReseller('Buy Amount') }} <i class="fa fa-sort{{ iconsorting('buy_amount') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=sell_gold">{{ TranslateReseller('Sell Gold') }} <i class="fa fa-sort{{ iconsorting('sell_gold') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reward_gold">{{ TranslateReseller('Reward Gold') }} <i class="fa fa-sort{{ iconsorting('reward_gold') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=correction_gold">{{ TranslateReseller('Correction Gold') }} <i class="fa fa-sort{{ iconsorting('correction_gold') }}"></i></a></td>
                                @elseif($time == "Detail")
                                 <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller_transaction_day.date_created">{{ TranslateReseller('Date Created') }} <i class="fa fa-sort{{ iconsorting('asta_db.reseller_transaction_day.date_created') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reseller_transaction_day.reseller_id">{{ TranslateReseller('Reseller ID') }} <i class="fa fa-sort{{ iconsorting('reseller_transaction_day.reseller_id') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reseller.username">{{ TranslateReseller('Username') }} <i class="fa fa-sort{{ iconsorting('reseller.username') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=buy_gold">{{ TranslateReseller('Buy Gold') }} <i class="fa fa-sort{{ iconsorting('buy_gold') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=buy_amount">{{ TranslateReseller('Buy Amount') }} <i class="fa fa-sort{{ iconsorting('buy_amount') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=sell_gold">{{ TranslateReseller('Sell Gold') }} <i class="fa fa-sort{{ iconsorting('sell_gold') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=reward_gold">{{ TranslateReseller('Reward Gold') }} <i class="fa fa-sort{{ iconsorting('reward_gold') }}"></i></a></td>
                                <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=correction_gold">{{ TranslateReseller('Correction Gold') }} <i class="fa fa-sort{{ iconsorting('correction_gold') }}"></i></a></td>
                                @endif
							</tr>
						</thead>
						<tbody>
							@if($time == "All time" || $time == "Detail")
								@foreach ($history as $trns_day)
								<tr>
                                    <td>{{ $trns_day->date_created }}</td>
                                    <td>{{ $trns_day->reseller_id }}</td>
                                    <td>{{ $trns_day->username }}</td>
                                    <td>{{ number_format($trns_day->buy_gold, 2) }}</td>
                                    <td>{{ number_format($trns_day->buy_amount, 2) }}</td>
                                    <td>{{ number_format($trns_day->sell_gold, 2) }}</td>
                                    <td>{{ number_format($trns_day->reward_gold, 2) }}</td>  
                                    <td>{{ number_format($trns_day->correction_gold, 2) }}</td>                                    
								</tr>
								@endforeach
							@elseif($time == "Day" || $time == "Week" || $time == "Month")
								@foreach($history as $trns_day)
								<tr>
                                    <td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $trns_day->minDate }}&inputMaxDate={{ $trns_day->maxDate }}">{{ $trns_day->minDate }} - {{ $trns_day->maxDate }}</a></td>
                                    <td>{{ number_format($trns_day->buy_gold, 2) }}</td>
                                    <td>{{ number_format($trns_day->buy_amount, 2) }}</td>
                                    <td>{{ number_format($trns_day->sell_gold, 2) }}</td>
                                    <td>{{ number_format($trns_day->reward_gold, 2) }}</td>  
                                    <td>{{ number_format($trns_day->correction_gold, 2) }}</td>
								</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>

				<div style="display: flex;justify-content: center;">{{ $history->links() }}</div>  		
			</div>
		
		</div>
	</div>
</div>
<!-- End daily gift transactions -->

<script>

$(document).ready(function() {
	$('table.table').dataTable( {
		"lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
		"order": [[5, "desc"]],
		'searching':false,
		'ordering': false,
		'paging':false,
		'bInfo':false
	});
});
  

	table = $('table.table').dataTable({
		"sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
		"autoWidth" : true,
		"paging": false,
		'ordering': false,
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
     
    },
    responsive: false
  });
</script>
@endif
@endsection