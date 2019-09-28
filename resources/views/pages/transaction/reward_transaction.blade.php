@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Reward_Transaction') }}">Transaction</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Reward_Transaction') }}">Reward Transaction</a></li>
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

	
	<!-- Table 1 -->
	<div>
		<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
		
			<header>
				<div class="widget-header">	
					<h2><strong>Reward Transactions</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive" style="height:800px;">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="th-sm">ID Player</th>
										<th class="th-sm">username</th>
										<th class="th-sm">Item</th>
										<th class="th-sm">Awarded</th>
										<th class="th-sm">Type</th>
										<th class="th-sm">Status</th>
										<th class="th-sm">Status Payment</th>
										<th class="th-sm">Confirm request</th>
										<th class="th-sm">Status</th>
									</tr>
								</thead>
								<tbody>
									{{-- @foreach ($transactions as $transaction) --}}
									
									<tr>
										{{-- @if ($menu && $mainmenu) --}}
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td> Bank Manual Transfer</td>
										<td>
											<div>
												<button type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline"><i class="fa fa-remove"></i> Decline</button>
										  {{-- </div>
											<div> --}}
												<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve"><i class="fa fa-check"></i> Approve</button>
											</div>
										</td>
										<td>
											<div class="user-transaction-status">
												<p>Pending</p>
											</div>
										</td>
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
	<!-- End Table 1 -->


	{{-- yg hilang --}}
{{-- </div> --}}


<!-- Modal decline -->
{{-- @foreach ($transactions as $transaction)
<div class="modal fade" id="decline{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Decline Transaction</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RequestTransaction-Decline')}}" method="POST">
            @csrf
                <div class="modal-body">
                    Are you sure want to Decline this Transaction ?
                    <input type="hidden" name="declineId" value="{{ $transaction->id }}">
										<input type="hidden" name="reseller_id" value="{{ $transaction->reseller_id }}">
										<input type="hidden" name="price" value="{{ $transaction->item_price }}">
										<input type="hidden" name="item_name" value="200Gold">
										<input type="hidden" name="desc" value="{{ $transaction->desc }}">
										<input type="hidden" name="quantity" value="{{ $transaction->quantity }}">
										<input type="hidden" name="payment_id" value="{{ $transaction->payment_id }}">
										<input type="hidden" name="datetime" value="{{ $transaction->datetime }}">
										<input type="hidden" name="user_type" value="{{ $transaction->user_type }}">
										<input type="hidden" name="item_type" value="{{ $transaction->item_type }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach --}}
<!-- End Modal decline -->

<!-- Modal approve transaction -->
{{-- @foreach ($transactions as $transaction)
<div class="modal fade" id="approve{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Approve Transaction</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RequestTransaction-Approve')}}" method="POST">
            @csrf
			    <div class="modal-body">
                    Are you sure want to Approve this Transaction ?
                   
										<input type="hidden" name="reseller_id" value="{{ $transaction->reseller_id }}">
										<input type="hidden" name="goldbuy" value="190">
										<input type="hidden" name="price" value="{{ $transaction->item_price }}">
										<input type="hidden" name="item_name" value="200Gold">
										<input type="hidden" name="desc" value="{{ $transaction->desc }}">
										<input type="hidden" name="quantity" value="{{ $transaction->quantity }}">
										<input type="hidden" name="payment_id" value="{{ $transaction->payment_id }}">
										<input type="hidden" name="datetime" value="{{ $transaction->datetime }}">
										<input type="hidden" name="user_type" value="{{ $transaction->user_type }}">
										<input type="hidden" name="item_type" value="{{ $transaction->item_type }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach --}}
<!-- End Modal approve transaction -->


<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
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

      // $('.popUpSetting').editable({
      //   mode: 'inline',
      //   value: 0,
      //   source: [
      //     {value: 0, text: 'Off'},
      //     {value: 1, text: 'On'}
      //   ]
      // });
     
    },
    responsive: false
  });
</script>  
@endsection