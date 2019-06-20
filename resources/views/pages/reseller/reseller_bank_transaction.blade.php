@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Reseller_Bank_Transaction') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Reseller_Bank_Transaction') }}">Reseller Bank Transaction</a></li>
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

<div class="user-transactions">
	
	<!-- Table 1 -->
	<div>
		<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
		
			<header>
				<div class="widget-header">	
					<h2><strong>Request Transactions</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="th-sm">User</th>
										<th class="th-sm">Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($transactions as $transaction)
									
									<tr>
											<td>
												<div class="user-transaction-dates">
													<div>
														<p>Date {{ $transaction->timestamp }}</p> 
													</div>
													{{-- <div>
														<p>Buy in Best Offer</p>
													</div> --}}
												</div>
												<div class="user-transaction-users">
													<div>
														<img src="/images/gifts/41.png" alt="" class="img-profile-reward">
													</div>
													<div class="user-transaction-user-name">
														<div>
															<h3>{{ $transaction->username }}</h3>
														</div>
														<div>
															<h5>{{ $transaction->username }} Buy {{ $transaction->item_name }} Using {{ strtoupper($transaction->bank_name) }} Manual Transfer</h5>
														</div>
													</div>
												</div>
												<div class="transactions-user-button">
													{{-- <div>
														<input type="button" value="View Detail" class="btn btn-xs btn-info" data-toggle="modal" data-target="#view-detail{{ $reward->id }}">
													</div> --}}
													<div>
														<input type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline{{ $transaction->order_id }}">
													</div>
													<div>
														<input type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $transaction->order_id }}">
													</div>
												</div>

											</td>
											<td>
												<div class="user-transaction-status">
													<p>Pending</p>
												</div>
											</td>

									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
				
					</div>
				
				</div>
			</div>
		</div>
	</div>
	<!-- End Table 1 -->


	{{-- yg hilang --}}
</div>


<!-- Modal decline -->
@foreach ($transactions as $transaction)
<div class="modal fade" id="decline{{ $transaction->order_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Decline Transaction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
            </div>
            <form action="{{ route('ResellerBankTransaction-Decline')}}" method="POST">
            @csrf
                <div class="modal-body">
                    Are you sure want to Decline this Transaction ?
                    <input type="hidden" name="declineId" value="{{ $transaction->order_id }}">
                    <input type="hidden" name="resellerId" value="{{ $transaction->reseller_id }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary">Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal decline -->

<!-- Modal approve transaction -->
@foreach ($transactions as $transaction)
<div class="modal fade" id="approve{{ $transaction->order_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Decline Transaction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
            </div>
            <form action="{{ route('ResellerBankTransaction-Approve')}}" method="POST">
            @csrf
			    <div class="modal-body">
                    Are you sure want to Approve this Transaction ?
                    <input type="hidden" name="goldAwarded" value="{{ $transaction->goldAwarded }}">
                    <input type="hidden" name="approveId" value="{{ $transaction->order_id }}">
                    <input type="hidden" name="resellerId" value="{{ $transaction->reseller_id }}">
                    <input type="hidden" name="price" value="{{ $transaction->amount }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary">Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal approve transaction -->


<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
      "pagingType": "full_numbers",
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