@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Reward_Transaction') }}">{{ translate_MenuTransaction('Transaction') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Reward_Transaction') }}">{{ translate_MenuTransaction('Reward Transaction') }}</a></li>
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
					<h2><strong>{{ translate_MenuTransaction('Reward Transaction') }}</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive" style="height:800px;">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="th-sm">{{ translate_MenuTransaction('Time Stamp') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Username') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Item') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Quantity') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Price') }}</th>
										@if ($menu && $mainmenu)
										<th class="th-sm">{{ translate_MenuTransaction('Confirm request') }}</th>
										@endif
										<th class="th-sm">{{ translate_MenuTransaction('Status') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($transaction as $trns)
										<tr>
											<td>{{ $trns->datetime }}</td>
											<td>{{ $trns->username }}</td>
											<td>{{ $trns->item_name }}</td>	
											<td>{{ $trns->quantity }}</td>
											<td>{{ number_format($trns->item_price, 2) }}</td>
											@if ($menu && $mainmenu)
											<td>
												<div>
													<button type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline{{ $trns->strtrnsid }}"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('Decline') }}</button>
													<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $trns->strtrnsid }}"><i class="fa fa-check"></i> {{ translate_MenuTransaction('Approve') }}</button>
												</div>
											</td>
											@endif
											<td>{{ $trns->description }}</td>
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
{{-- </div> --}}

@foreach ($transaction as $transaction)
<!-- Modal approve transaction -->
<div class="modal fade" id="approve{{ $transaction->strtrnsid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('Approve Transaction') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
      </div>
            <form action="{{ route('RewardTransaction-Approve')}}" method="POST">
            @csrf
			    <div class="modal-body" align="center">
						<textarea name="description" id="" cols="30" rows="5" placeholder="Description"></textarea><br>
						{{ translate_MenuTransaction('Are you sure want to Approve this Transaction?') }}
          <input type="hidden" name="approveId" value="{{ $transaction->strtrnsid }}">
					<input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
					<input type="hidden" name="price" value="{{ $transaction->item_price }}">
					<input type="hidden" name="item_name" value="{{ $transaction->item_name }}">
					<input type="hidden" name="desc" value="{{ $transaction->description }}">
					<input type="hidden" name="quantity" value="{{ $transaction->quantity }}">
					<input type="hidden" name="payment_id" value="{{ $transaction->payment_id }}">
					<input type="hidden" name="datetime" value="{{ $transaction->datetime }}">
					<input type="hidden" name="shop_type" value="{{ $transaction->shop_type }}">
					<input type="hidden" name="item_type" value="{{ $transaction->item_type }}">

			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>{{ translate_MenuTransaction('Yes') }}</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('No') }}</button>
                </div>
            </form>
		</div>
	</div>
</div>
<!-- End Modal approve transaction -->


<!-- Modal decline -->
<div class="modal fade" id="decline{{ $transaction->strtrnsid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('Decline Transaction') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RewardTransaction-Decline')}}" method="POST">
            @csrf
                <div class="modal-body" align="center">
										<textarea name="description" id="" cols="30" rows="5" placeholder="Description"></textarea><br>
										{{ translate_MenuTransaction('Are you sure want to Decline this Transaction?') }}
													<input type="hidden" name="declineId" value="{{ $transaction->strtrnsid }}">
													<input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
													<input type="hidden" name="price" value="{{ $transaction->item_price }}">	
													<input type="hidden" name="item_name" value="{{ $transaction->item_name }}">
													<input type="hidden" name="desc" value="{{ $transaction->description }}">
													<input type="hidden" name="quantity" value="{{ $transaction->quantity }}">
													<input type="hidden" name="payment_id" value="{{ $transaction->payment_id }}">
													<input type="hidden" name="datetime" value="{{ $transaction->datetime }}">
													<input type="hidden" name="shop_type" value="{{ $transaction->shop_type }}">
													<input type="hidden" name="item_type" value="{{ $transaction->item_type }}">
			    			</div>
			    			<div class="modal-footer">
				    			<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>{{ translate_MenuTransaction('Yes') }}</button>
				    			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('No') }}</button>
          			</div>
          	</form>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal decline -->


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
    },
    responsive: false
  });
</script>  
@endsection