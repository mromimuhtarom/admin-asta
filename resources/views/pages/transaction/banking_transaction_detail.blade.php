@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Banking_Transactions') }}">Transaction</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Banking_Transactions') }}">Banking Transaction</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="search bg-blue-dark" style="margin-bottom:1%;">
        <div class="table-header w-100 h-100">
                <form action="{{ route('Banking-search')}}">
                <div class="row h-100 w-100">
                    <div class="col">
                        <select name="time" id="time" class="form-control">
                                                    <option value="">Choose Time</option>
                                                    <option value="today">today</option>
                                                    <option value="week">Week</option>
                                                    <option value="month">Month</option>
                                                    <option value="all time">All Time</option>
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
                </div>
            </form>
        </div>
    </div>

<!-- Daily gift transactions -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
	<header>
		<div class="widget-header">	
			<h2><strong>Bank Transaction</strong></h2>				
		</div>
	</header>

	<div>
		<div class="widget-body">
			<div class="custom-scroll table-responsive">
				
				<div class="table-outer">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="th-sm">Username</th>
								<th class="th-sm">Game</th>
								<th class="th-sm">Win</th>
								<th class="th-sm">Lose</th>
                                <th class="th-sm">Turn Over</th>
                                <th class="th-sm">Fee</th>
                                <th class="th-sm">Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach($history as $hst)
							<tr>
                                    <td>{{ $hst->username }}</td>
									<td>{{ $hst->desc }}</td>
									<td>{{ $hst->win }}</td>
									<td>{{ $hst->lose }}</td>
									<td>{{ $hst->turnover }}</td>
                                    <td>{{ $hst->fee }}</td>
                                    <td>{{ $hst->date_created }}</td>
							</tr>
                            @endforeach
						</tbody>
					</table>
				</div>
		
			</div>
		
		</div>
	</div>
</div>
<!-- End daily gift transactions -->

<script>
	$(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 10, 20, -1], [20, 10, 20, "All"]],
    });
  });

  $("#time").click(function(e) {
   e.preventDefault();
    
	 if($(this).val() == 'today'){ 
		@php
   	echo'var minDate = $("#minDate").val("'.$datenow.'");';
		echo'var maxDate = $("#maxDate").val("'.$datenow.'");';
		@endphp
		$('form input[type="date"]').prop("readonly", true);
  } else if($(this).val() == 'week'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	} else if($(this).val() == 'month'){
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
    "paging": false,
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
    responsive: true
  });
</script>
@endsection