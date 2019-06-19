@extends('index')


@section('content')
<div class="bank-transactions">

	<!-- Money transactions -->
	<div>
		<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
			<header>
				<div class="widget-header">	
					<h2><strong>Money Transactions</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th></th>
										<th class="th-sm">Best Offers</th>
										<th class="th-sm">Gold</th>
										<th class="th-sm">Chips</th>
										<th class="th-sm">Goods</th>
										<th class="th-sm"></th>
									</tr>
								</thead>
								<tbody>
									{{-- @foreach($admin as $adm) --}}
									<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
									</tr>
									{{-- @endforeach --}}
								</tbody>
							</table>
						</div>
				
					</div>
				
				</div>
			</div>
		</div>
	</div>
	<!-- End Money transactions -->

	<!-- Player transactions -->
	<div>
		<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
			<header>
				<div class="widget-header">	
					<h2><strong>Player Transactions</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th></th>
										<th class="th-sm">Best Offers</th>
										<th class="th-sm">Gold</th>
										<th class="th-sm">Chips</th>
										<th class="th-sm">Goods</th>
										<th class="th-sm"></th>
									</tr>
								</thead>
								<tbody>
									{{-- @foreach($admin as $adm) --}}
									<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
									</tr>
									{{-- @endforeach --}}
								</tbody>
							</table>
						</div>
				
					</div>
				
				</div>
			</div>
		</div>
	</div>
	<!-- End Player transactions -->

</div>

<!-- Daily gift transactions -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
			
	<header>
		<div class="widget-header">	
			<h2><strong>Daily Gift Transactions</strong></h2>				
		</div>
	</header>

	<div>
		<div class="widget-body">
			<div class="custom-scroll table-responsive">
				
				<div class="table-outer">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th class="th-sm">Best Offers</th>
								<th class="th-sm">Gold</th>
								<th class="th-sm">Chips</th>
								<th class="th-sm">Goods</th>
								<th class="th-sm"></th>
							</tr>
						</thead>
						<tbody>
							{{-- @foreach($admin as $adm) --}}
							<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
							</tr>
							{{-- @endforeach --}}
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
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
    });
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

      $('.inlineSetting').editable({
            mode :'inline'
        });

      $('.popUpSetting').editable({
        mode: 'inline',
        value: 0,
        source: [
          {value: 0, text: 'Off'},
          {value: 1, text: 'On'}
        ]
      });
     
    },
    responsive: true
  });
</script>
@endsection