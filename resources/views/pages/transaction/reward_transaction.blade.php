@extends('index')

@section('page')
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
										<th class="th-sm">{{ translate_MenuTransaction('Confirm request') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Delivery Confirmation') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Delivery Status') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('Item Status') }}</th>
										@if ($menu && $mainmenu)
										<th class="th-sm"></th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach ($transaction as $trns)
										<tr>
											<td>{{ date("d-m-Y H:i:s", strtotime($trns->datetime)) }}</td>
											<td>{{ $trns->username }}</td>
											<td>{{ $trns->item_name }}</td>	
											<td>{{ $trns->quantity }}</td>
											<td>{{ number_format($trns->item_price, 2) }}</td>
											<td>
												@if($trns->description == 'pending')
													{{ translate_MenuTransaction('Request') }}
												@elseif($trns->description == 'On Process')
													<Span style="color:#739e73">{{ translate_MenuTransaction('Approve') }}</Span>
												@elseif($trns->description == 'sent')
													<Span style="color:#739e73">{{ translate_MenuTransaction('Approve') }}</Span>
												@endif
											</td>
											<td>
												<button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $trns->strtrnsid }}">{{ translate_MenuTransaction('Detail Info') }}</button>
											</td>
											<td>
												@if($trns->description == 'pending')
													{{ translate_MenuTransaction('Pending') }}
												@elseif($trns->description == 'On Process')
													<Span style="color:blue">{{ translate_MenuTransaction('On Process') }}</Span>
												@elseif($trns->description == 'Sent')
													<Span style="color:#739e73">{{ translate_MenuTransaction('Approve') }}</Span>
												@endif
											</td>
											@if ($menu && $mainmenu)

											@endif
											<td>{{ translate_MenuTransaction(ucwords($trns->description)) }}</td>
											<td>
												<div>
													@if($trns->description == 'pending')
														<button type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline{{ $trns->strtrnsid }}"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('Decline') }}</button>
														<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $trns->strtrnsid }}"><i class="fa fa-check"></i> {{ translate_MenuTransaction('Approve') }}</button>
													@elseif($trns->description == 'On Process')
															<button type="button" class="btn btn-xs text-white" style="background-color:blue;" data-toggle="modal" data-target="#process{{ $trns->strtrnsid }}">{{ translate_MenuTransaction('On Process') }}</button>		
													@elseif($trns->description == 'Sent')	
														<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $trns->strtrnsid }}"><i class="fa fa-check"></i> {{ translate_MenuTransaction('Completed') }}</button>											
													@endif
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
						{{ translate_MenuTransaction('Are you sure want to Approve this Transaction?') }}
						<input type="hidden" name="description" value="On Process">
          				<input type="hidden" name="approveId" value="{{ $transaction->strtrnsid }}">
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




<!-- Modal Process -->
<div class="modal fade" id="process{{ $transaction->strtrnsid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title" id="exampleModalLabel">
					<h5>{{ translate_MenuTransaction('Required Delivery Status') }}</h5>
					{{ translate_MenuTransaction('If The Item Has Been Sent') }}
				</div>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RewardTransaction-DeliveryProgress')}}" method="POST">
						@csrf
								<input type="hidden" name="idstore" value="{{ $transaction->id }}">
                <div class="modal-body" align="center">
									<table width="100%">
										<tr>
											<td width="20%">{{ translate_MenuTransaction('Date Sent') }}</td>
											<td width="5%">:</td>
											<td width="75%"><input type="date" name="date_send" class="form-control" required></td>
										</tr>
										<tr>
											<td width="20%">{{ translate_MenuTransaction('Item Name') }}</td>
											<td width="5%">:</td>
											<td width="75%"><input type="text" name="item_name" class="form-control" required></td>
										</tr>
										<tr>
											<td width="20%">{{ translate_MenuTransaction('Type Of Shipment') }}</td>
											<td width="5%">:</td>
											<td width="75%"><input type="text" name="item_name" class="form-control" required></td>
										</tr>
										<tr>
											<td width="20%">{{ translate_MenuTransaction('Shipping Code') }}</td>
											<td width="5%">:</td>
											<td width="75%"><input type="text" name="item_name" class="form-control" required></td>
										</tr>
									</table>
			    			</div>
			    			<div class="modal-footer">
				    			<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>{{ translate_MenuTransaction('Yes') }}</button>
				    			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('No') }}</button>
          			</div>
          	</form>
		</div>
	</div>
</div>



<!-- Modal detail info -->
<div class="modal fade" id="detailinfo{{ $transaction->strtrnsid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('Detail Info') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
			</div>
			{{-- @php 
			$user_info = DB::table('user_info')
									 ->leftJoin('country', 'country.iso_code_2', '=', 'user_info.country_code')
									 ->leftJoin('province', 'province.province_code', '=', 'user_info.province_code')
									 ->leftJoin('region', 'region.id', '=', 'user_info.region_id')
									 ->select(
										 'country.name as countryname',
										 'user_info.*',
										 'region.city as cityname',
										 'province.province_name'
									 )
									 ->where('user_id', '=', $transaction->user_id)
									 ->first();
			@endphp --}}
			<div class="modal-body" align="center">
				<table width="100%"">
					<tr>
						<td width="30%">{{ translate_MenuTransaction('Full Name') }}</td>
						<td width="10%">:</td>
						<td width="60%">
								<input type="text" value="{{ $transaction->username }}" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('Email') }}</td>
						<td>:</td>
						<td>
								<input type="text" value="{{ decryptaes256($transaction->email) }}" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('Phone') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="{{-- decryptaes256($user_info->phone) --}}{{ $transaction->phone }}" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td valign="top">{{ translate_MenuTransaction('Address') }}</td>
						<td valign="top">:</td>
						<td>
							<textarea class="form-control" disabled>{{ $transaction->address }}</textarea>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('Province') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('City') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('Postal Code') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="{{ $transaction->zip_code }}" class="form-control" disabled>
						</td>
					</tr>
				</table>
			</div> 
		</div>
	</div>
</div>
@endforeach
<!-- End Modal detail info -->


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