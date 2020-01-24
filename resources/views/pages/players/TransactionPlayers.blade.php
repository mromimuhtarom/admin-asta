@extends('index')

@section('page')
	<li class="breadcrumb-item"><a href="{{ route('Banking_Transactions') }}">{{ translate_MenuTransaction('Transaction') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Banking_Transactions') }}">{{ translate_MenuTransaction('Banking Transaction') }}</a></li>
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
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
			<form action="{{ route('TransactionPlayers-search')}}">
            <div class="row h-100 w-100">
							@if (Request::is('Players/Transaction_Players/Banking-search*'))
                <div class="col">
                    <select name="choose_time" id="time" class="form-control">
												<option value="">{{ translate_MenuTransaction('Choose Time') }}</option>
												<option value="today" @if($time == 'today') selected @endif>{{ translate_MenuTransaction('Today') }}</option>
												<option value="week" @if($time == 'week') selected @endif>{{ translate_MenuTransaction('Week') }}</option>
												<option value="month" @if($time == 'month') selected @endif>{{ translate_MenuTransaction('Month') }}</option>
												<option value="all time" @if($time == 'all time') selected @endif>{{ translate_MenuTransaction('All time') }}</option>
                    </select>
								</div>
                <div class="col">
									<input type="date" class="form-control" id="minDate" name="inputMinDate" value=" {{ $minDate }}">
                </div>
                <div class="col">
									<input type="date" class="form-control" id="maxDate" name="inputMaxDate" value=" {{ $maxDate }}">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
								</div>
							@else
							  <div class="col">
                    <select name="choose_time" id="time" class="form-control">
												<option value="">{{ translate_MenuTransaction('Choose Time') }}</option>
												<option value="today">{{ translate_MenuTransaction('Today') }}</option>
												<option value="week">{{ translate_MenuTransaction('Week') }}</option>
												<option value="month">{{ translate_MenuTransaction('Month') }}</option>
												<option value="all time">{{ translate_MenuTransaction('All time') }}</option>
                    </select>
                </div>
                <div class="col">
									<input type="date" class="form-control" id="minDate" name="inputMinDate" value="">
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
								</div> 
							@endif
            </div>
        </form>
    </div>
</div>

@if (Request::is('Players/Transaction_Players/Banking-search*'))
{{-- @if ($time == "today") --}}
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
	<header>
		<div class="widget-header">	
			<h2><strong>{{ translate_MenuTransaction('Bank Transaction') }} {{ ucwords($lang_id) }}</strong></h2>				
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
								@if ($time == "today" || $time == "all time")
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ translate_MenuTransaction('Username') }} <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>	
								@elseif($time == 'detail')
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ translate_MenuTransaction('Username') }} <i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>	
								@elseif($time == "week" || $time == "month")
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=minDate">{{ translate_MenuTransaction('Date') }}<i class="fa fa-sort{{ iconsorting('minDate') }}"></i></a></th>
								@endif
								@if($time != 'detail')
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}@if($time == "today" || $time == "all time")&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}@endif&sorting={{ $sortingorder }}&namecolumn=wintransaction">{{ translate_MenuTransaction('Win') }} <i class="fa fa-sort{{ iconsorting('wintransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}@if($time == "today" || $time == "all time")&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}@endif&sorting={{ $sortingorder }}&namecolumn=losetransaction">{{ translate_MenuTransaction('Lose') }} <i class="fa fa-sort{{ iconsorting('losetransaction') }}"></i></a></th>
                <th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}@if($time == "today" || $time == "all time")&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}@endif&sorting={{ $sortingorder }}&namecolumn=turnovertransaction">{{ translate_MenuTransaction('Turn Over') }} <i class="fa fa-sort{{ iconsorting('turnovertransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}@if($time == "today" || $time == "all time")&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}@endif&sorting={{ $sortingorder }}&namecolumn=feetransaction">{{ translate_MenuTransaction('Fee') }} <i class="fa fa-sort{{ iconsorting('feetransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}@if($time == "today" || $time == "all time")&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}@endif&sorting={{ $sortingorder }}&namecolumn=prizetransaction">{{ translate_MenuTransaction('Jackpot') }} <i class="fa fa-sort{{ iconsorting('prizetransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}@if($time == "today" || $time == "all time")&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}@endif&sorting={{ $sortingorder }}&namecolumn=totalWinLose">{{ translate_MenuTransaction('Win Lose') }} <i class="fa fa-sort{{ iconsorting('totalWinLose') }}"></i></a></th>
								@else
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=wintransaction">{{ translate_MenuTransaction('Win') }} <i class="fa fa-sort{{ iconsorting('wintransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=losetransaction">{{ translate_MenuTransaction('Lose') }} <i class="fa fa-sort{{ iconsorting('losetransaction') }}"></i></a></th>
                <th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=turnovertransaction">{{ translate_MenuTransaction('Turn Over') }} <i class="fa fa-sort{{ iconsorting('turnovertransaction') }}"></a></th>
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=feetransaction">{{ translate_MenuTransaction('Fee') }} <i class="fa fa-sort{{ iconsorting('feetransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=prizetransaction">{{ translate_MenuTransaction('Jackpot') }} <i class="fa fa-sort{{ iconsorting('prizetransaction') }}"></i></a></th>
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=totalWinLose">{{ translate_MenuTransaction('Win Lose') }} <i class="fa fa-sort{{ iconsorting('totalWinLose') }}"></i></a></th>
								@endif
								@if($time == "today" || $time == "all time")
								<th class="th-sm"><a href="{{ route('TransactionPlayers-search') }}?choose_time={{ $time }}&inputMinDate={{ $minDate }}&inputMaxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.transaction_day.date_created">{{ translate_MenuTransaction('Date') }}<i class="fa fa-sort{{ iconsorting('asta_db.transaction_day.date_created') }}"></i></a></th>
								@elseif($time == 'detail')
								<th class="th-sm"><a href="{{ route('detailTransactionDay') }}?minDate={{ $minDate }}&maxDate={{ $maxDate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.transaction_day.date_created">{{ translate_MenuTransaction('Date') }}<i class="fa fa-sort{{ iconsorting('asta_db.transaction_day.date_created') }}"></i></a></th>
								@endif
							</tr>
						</thead>
						<tbody>
							@if ($time == "today" || $time == "all time" || $time == "detail")
							@foreach($history as $hst)
							<tr>
                  <td>{{ $hst->username }}</td>
									<td>{{ number_format($hst->wintransaction, 2) }}</td>
									<td>{{ number_format($hst->losetransaction, 2) }}</td>
									<td>{{ number_format($hst->turnovertransaction, 2) }}</td>
									<td>{{ number_format($hst->feetransaction, 2) }}</td>
									@if ($hst->prizetransaction == NULL)
									<td></td>
									@else
									<td>{{ number_format($hst->prizetransaction, 2) }}</td>
									@endif
									<td>{{ number_format($hst->totalWinLose, 2) }}</td>
                  <td>{{ $hst->date_created }}</td>
							</tr>
							@endforeach
							@elseif($time == "week" || $time == "month")
							@foreach($history as $hst)
							<tr>
								<td><a href="{{ route('detailTransactionDay') }}?minDate={{ $hst->minDate }}&maxDate={{ $hst->maxDate }}">{{ $hst->minDate }} - {{ $hst->maxDate }}</a></td>
							<td>{{ number_format($hst->wintransaction, 2) }} {{ $hst->totalWin }}</td>
								<td>{{ number_format($hst->losetransaction, 2) }}</td>
								<td>{{ number_format($hst->turnovertransaction, 2) }}</td>
								<td>{{ number_format($hst->feetransaction, 2) }}</td>
								@if ($hst->prizetransaction == NULL)
								<td></td>
								@else
								<td>{{ number_format($hst->prizetransaction, 2)}}</td>
								@endif
								<td>{{ number_format($hst->totalWinLose, 2) }}</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
		    <!-- end widget content -->
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
		"searching": false,
		"paging":false,
		"bInfo":false,
		"ordering": false
	});
});
  
  $('form input[type="date"]').prop("disabled", true);
  $("#time").click(function(e) {
   e.preventDefault();
	 
	if($(this).val() == 'today'){ 
		@php
   		echo'var minDate = $("#minDate").val("'.$datenow.'");';
		echo'var maxDate = $("#maxDate").val("'.$datenow.'");';
		@endphp
		$('form input[type="date"]').prop("readonly", true);
		$('form input[type="date"]').prop("disabled", false);
  	
	} else if($(this).val() == 'week'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	
	} else if($(this).val() == 'month'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	
	} else if($(this).val() == ''){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	
	} else {
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("readonly", false);
		$('form input[type="date"]').prop("disabled", false);
	}
   });

	table = $('table.table').dataTable({
		"sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
		"autoWidth" : true,
		"paging":false,
		"bInfo":false,
		"ordering": false,
		"bLengthChange": false,
		"searching": false,
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

<script>
// $('#time').change(function(){
//   if($(this).val() == 'today'){ // or this.value == 'volvo'
// 		// $("#minDate").disa();
// 		$('form input[type="date"]').prop("disabled", true);
//   }
// });

$('form input[type="date"]').prop("disabled", true);
$("#time").click(function(e) {
   e.preventDefault();
	 
	if($(this).val() == 'today'){ 
		@php
   		echo'var minDate = $("#minDate").val("'.$datenow.'");';
		echo'var maxDate = $("#maxDate").val("'.$datenow.'");';
		@endphp
		$('form input[type="date"]').prop("readonly", true);
		$('form input[type="date"]').prop("disabled", false);
  	
	} else if($(this).val() == 'week'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	
	} else if($(this).val() == 'month'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	
	} else if($(this).val() == ''){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	
	} else {
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("readonly", false);
		$('form input[type="date"]').prop("disabled", false);
	}
});



</script>
@endsection