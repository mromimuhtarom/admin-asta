@extends('index')

@section('page')
	<li class="breadcrumb-item menunameheader"><a href="{{ route('Transaction_Day') }}">{{ translate_MenuTransaction('L_TRANSACTION') }}</a></li>
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Transaction_Day') }}">{{ translate_MenuTransaction('L_BANKING_TRANS') }}</a></li>
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
		<form action="{{ route('TransactionPoint-search')}}">
            <div class="row h-100 w-100">

				@if (Request::is('Transaction/Transaction_Point/Transaction_Point-search*'))
					<div class="col">
						<select name="choose_time" id="time" class="form-control">
								<option value="All time" @if($time == 'All time') selected @endif>{{ translate_MenuTransaction('L_ALL_TIME') }}</option>
								<option value="Day" @if($time == 'Day') selected @endif>{{ translate_MenuTransaction('L_DAY') }}</option>
								<option value="Week" @if($time == 'Week') selected @endif>{{ translate_MenuTransaction('L_WEEK') }}</option>
								<option value="Month" @if($time == 'Month') selected @endif>{{ translate_MenuTransaction('L_MONTH') }}</option>
						</select>
					</div>
					<div class="col date-min">
						<input type="date" class="form-control" id="minDate" name="inputMinDate" value="{{ $minDate }}">
					</div>
					<div class="col date-max">
							<input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="{{ $maxDate }}">
					</div>
					<div class="col">
							<button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i>{{ translate_MenuTransaction('L_SEARCH') }}</button>
					</div>
				@else 
					<div class="col">
						<select name="choose_time" id="time" class="form-control">
							<option value="All time">{{ translate_MenuTransaction('L_ALL_TIME') }}</option>
							<option value="Day">{{ translate_MenuTransaction('L_DAY') }}</option>
							<option value="Week">{{ translate_MenuTransaction('L_WEEK') }}</option>
							<option value="Month">{{ translate_MenuTransaction('L_MONTH') }}</option>
						</select>
					</div>
					<div class="col date-min">
						<input type="date" class="form-control" id="minDate" name="inputMinDate" value="{{ $datenow }}">
					</div>
					<div class="col date-max">
							<input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="{{ $datenow }}">
					</div>
					<div class="col">
							<button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i>{{ translate_MenuTransaction('L_SEARCH') }}</button>
					</div>										
				@endif
            </div>
        </form>
    </div>
</div>
<!-- End Search -->


@if (Request::is('Transaction/Transaction_Point/Transaction_Point-search*'))
{{-- @if ($time == "today") --}}
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
	<header>
		<div class="widget-header">	
			<h2><strong>{{ translate_menuTransaction('L_TRANSC_DAY') }}</strong></h2>				
		</div>
	</header>

	<div>
		<div class="widget-body">
			<div class="custom-scroll table-responsive">
				
				<div class="table-outer">
					<div class="row">
						<div class="col" style="font-style:italic;color:#969696;font-weight:bold;">
							{{ translate_menuTransaction('L_TOTAL_RECORD') }} {{ $history->total() }}
						</div>
					</div>
					<table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
						<thead>
							<tr>
								@if($time == "Day" || $time == "Week" || $time == "Month" || $time == "All time")
								<td><a href="{{ route('TransactionPoint-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=date">{{ translate_MenuTransaction("L_DATE") }} <i class="fa fa-sort{{ iconsorting('date') }}"></i></a></td>
								@endif
								@if($time == "All time")
								<td><a href="{{ route('TransactionPoint-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.store_transaction_day.user_id">{{ translate_MenuTransaction("L_ID_PLAYER") }} <i class="fa fa-sort{{ iconsorting('asta_db.store_transaction_day.user_id') }}"></i></a></td>
								<td><a href="{{ route('TransactionPoint-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ translate_MenuTransaction("L_USERNAME") }} <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></td>
								@endif
								@if($time == "Detail")
								<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=date">{{ translate_MenuTransaction("L_DATE") }} <i class="fa fa-sort{{ iconsorting('date') }}"></i></a></td>
								<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.user_id">{{ translate_MenuTransaction("L_ID_PLAYER") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.user_id') }}"></i></a></td>
								<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ translate_MenuTransaction("L_USERNAME") }} <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></td>
								<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.point">{{ translate_MenuTransaction("L_POINT_GET") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.point')}}"></i></a></td>
								<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.point_spend">{{ translate_MenuTransaction("L_POINT_SPEND") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.point_spend') }}"></i></a></td>
								<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.point_expired">{{ translate_MenuTransaction("L_POINT_EXPIRED") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.point_expired') }}"></i></a></td>
								@endif
								@if($time == "Day" || $time == "Week" || $time == "Month" || $time == "All time")
								<td><a href="{{ route('TransactionPoint-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.point">{{ translate_MenuTransaction("L_POINT_GET") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.point')}}"></i></a></td>
								<td><a href="{{ route('TransactionPoint-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.point_spend">{{ translate_MenuTransaction("L_POINT_SPEND") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.point_spend') }}"></i></a></td>
								<td><a href="{{ route('TransactionPoint-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_point.point_expired">{{ translate_MenuTransaction("L_POINT_EXPIRED") }} <i class="fa fa-sort{{ iconsorting('asta_db.user_point.point_expired') }}"></i></a></td>
								@endif
							</tr>
						</thead>
						<tbody>
							@if($time == "All time" || $time == "Detail")
								@foreach ($history as $trns_day)
								<tr>
									<td>{{ date("d-m-Y", strtotime($trns_day->date_created)) }}</td>
									<td>{{ $trns_day->user_id }}</td>
									<td>{{ $trns_day->username }}</td>
									<td>{{ number_format($trns_day->point, 2) }}</td>
									<td>{{ number_format($trns_day->point_spend, 2) }}</td>
									<td>{{ number_format($trns_day->expired, 2) }}</td>
								</tr>
								@endforeach
							@elseif($time == "Month")
								@foreach($history as $trns_day)
								<tr>
									<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $trns_day->minDate }}&maxDate={{ $trns_day->maxDate }}">{{ $trns_day->groupdate }} {{ $trns_day->year }}</a></td>
									<td>{{ number_format($trns_day->point, 2) }}</td>
									<td>{{ number_format($trns_day->point_spend, 2) }}</td>
									<td>{{ number_format($trns_day->expired, 2) }}</td>
								</tr>
								@endforeach
							@elseif($time == "Day" || $time == "Week")
								@foreach($history as $trns_day)
								<tr>
									<td><a href="{{ route('detailTransactionPoint') }}?minDate={{ $trns_day->minDate }}&maxDate={{ $trns_day->maxDate }}">{{ $trns_day->minDate }} - {{ $trns_day->maxDate }}</a></td>
									<td>{{ number_format($trns_day->point, 2) }}</td>
									<td>{{ number_format($trns_day->point_spend, 2) }}</td>
									<td>{{ number_format($trns_day->expired, 2) }}</td>
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