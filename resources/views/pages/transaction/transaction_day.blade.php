@extends('index')

@section('page')
	<li class="breadcrumb-item"><a href="{{ route('Transaction_Day') }}">{{ translate_MenuTransaction('Transaction') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day') }}">{{ translate_MenuTransaction('Banking Transaction') }}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">

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
<!-- Search -->
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
			<form action="{{ route('TransactionDay-search')}}">
            <div class="row h-100 w-100">

								@if (Request::is('Transaction/Transaction_Day/Transaction_Day-search*'))
									<div class="col">
										<select name="choose_time" id="time" class="form-control">
												<option value="All time" @if($time == 'All time') selected @endif>{{ translate_MenuTransaction('All time') }}</option>
												<option value="Day" @if($time == 'Day') selected @endif>{{ translate_MenuTransaction('Day') }}</option>
												<option value="Week" @if($time == 'Week') selected @endif>{{ translate_MenuTransaction('Week') }}</option>
												<option value="Month" @if($time == 'Month') selected @endif>{{ translate_MenuTransaction('Month') }}</option>
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
											<option value="All time">{{ translate_MenuTransaction('All time') }}</option>
											<option value="Day">{{ translate_MenuTransaction('Day') }}</option>
											<option value="Week">{{ translate_MenuTransaction('Week') }}</option>
											<option value="Month">{{ translate_MenuTransaction('Month') }}</option>
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
<!-- End Search -->


@if (Request::is('Transaction/Transaction_Day/Transaction_Day-search*'))
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
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=date">{{ translate_MenuTransaction("Date") }} <i class="fa fa-sort{{ iconsorting('date') }}"></i></a></td>
								@endif
								@if($time == "All time")
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.user_id">{{ translate_MenuTransaction("ID Player") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.user_id') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ translate_MenuTransaction("Username") }} <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></td>
								@endif
								@if($time == "Detail")
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=date">{{ translate_MenuTransaction("Date") }} <i class="fa fa-sort{{ iconsorting('date') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.user_id">{{ translate_MenuTransaction("ID Player") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.user_id') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ translate_MenuTransaction("Username") }} <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.debet">{{ translate_MenuTransaction("Cash Debit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.debet') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.credit">{{ translate_MenuTransaction("Cash Credit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.credit') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.gold_debet">{{ translate_MenuTransaction("Gold Debit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.gold_debet') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.gold_credit">{{ translate_MenuTransaction("Gold Credit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.gold_credit ') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.chip_debet">{{ translate_MenuTransaction("Chip Debit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.chip_debet') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.chip_credit">{{ translate_MenuTransaction("Chip Credit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.chip_credit') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.reward_gold">{{ translate_MenuTransaction("Reward Gold") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.reward_gold') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.reward_chip">{{ translate_MenuTransaction("Reward Chip") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.reward_chip') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.reward_point">{{ translate_MenuTransaction("Reward Point") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.reward_point') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.correction_gold">{{ translate_MenuTransaction("Correction Gold") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.correction_gold') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.correction_chip">{{ translate_MenuTransaction("Correction Chip") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.correction_chip') }}"></i></a></td>
								<td><a href="{{ route('Transaction_Day_Reseller-detail') }}?inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.correction_point">{{ translate_MenuTransaction("Correction Point") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.correction_point') }}"></i></a></td>
								@endif
								@if($time == "Day" || $time == "Week" || $time == "Month" || $time == "All time")
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.debet">{{ translate_MenuTransaction("Cash Debit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.debet') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.credit">{{ translate_MenuTransaction("Cash Credit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.credit') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.gold_debet">{{ translate_MenuTransaction("Gold Debit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.gold_debet') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.gold_credit">{{ translate_MenuTransaction("Gold Credit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.gold_credit') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.chip_debet">{{ translate_MenuTransaction("Chip Debit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.chip_debet') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.chip_credit">{{ translate_MenuTransaction("Chip Credit") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.chip_credit') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.reward_gold">{{ translate_MenuTransaction("Reward Gold") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.reward_gold') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.reward_chip">{{ translate_MenuTransaction("Reward Chip") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.reward_chip') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.reward_point">{{ translate_MenuTransaction("Reward Point") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.reward_point') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.correction_gold">{{ translate_MenuTransaction("Correction Gold") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.correction_gold') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.correction_chip">{{ translate_MenuTransaction("Correction Chip") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.correction_chip') }}"></i></a></td>
								<td><a href="{{ route('TransactionDay-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.correction_point">{{ translate_MenuTransaction("Correction Point") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.correction_point') }}"></i></a></td>
								@endif
							</tr> 
						</thead>
						<tbody>
							@if($time == "All time" || $time == "Detail")
								@foreach ($history as $trns_day)
								<tr>
									<td>{{ date("d-m-Y H:i:s", strtotime($trns_day->date_created)) }}</td>
									<td>{{ $trns_day->user_id }}</td>
									<td>{{ $trns_day->username }}</td>
									<td>{{ number_format($trns_day->debet, 2) }}</td>
									<td>{{ number_format($trns_day->credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->gold_debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->gold_credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->chip_debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->chip_credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_goldtransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_chiptransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_pointtransaction, 2) }}</td>
									<td>{{ number_format($trns_day->correction_gold, 2) }}</td>
									<td>{{ number_format($trns_day->correction_chip, 2) }}</td>
									<td>{{ number_format($trns_day->correction_point, 2) }}</td>
								</tr>
								@endforeach
							@elseif($time == "Month"):
								@foreach($history as $trns_day)
								<tr>
									<td><a href="{{ route('detailTransactionDay') }}?minDate={{ $trns_day->minDate }}&maxDate={{ $trns_day->maxDate }}">{{ $trns_day->groupdate }} {{ $trns_day->year }}</a></td>
									<td>{{ number_format($trns_day->debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->gold_debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->gold_credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->chip_debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->chip_credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_goldtransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_chiptransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_pointtransaction, 2) }}</td>
									<td>{{ number_format($trns_day->correction_gold, 2) }}</td>
									<td>{{ number_format($trns_day->correction_chip, 2) }}</td>
									<td>{{ number_format($trns_day->correction_point, 2) }}</td>
								</tr>
								@endforeach
							@elseif($time == "Day" || $time == "Week")
								@foreach($history as $trns_day)
								<tr>
									<td><a href="{{ route('detailTransactionDay') }}?minDate={{ $trns_day->minDate }}&maxDate={{ $trns_day->maxDate }}">{{ $trns_day->minDate }} - {{ $trns_day->maxDate }}</a></td>
									<td>{{ number_format($trns_day->debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->gold_debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->gold_credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->chip_debettransaction, 2) }}</td>
									<td>{{ number_format($trns_day->chip_credittransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_goldtransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_chiptransaction, 2) }}</td>
									<td>{{ number_format($trns_day->reward_pointtransaction, 2) }}</td>
									<td>{{ number_format($trns_day->correction_gold, 2) }}</td>
									<td>{{ number_format($trns_day->correction_chip, 2) }}</td>
									<td>{{ number_format($trns_day->correction_point, 2) }}</td>
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