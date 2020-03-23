@extends('index')

@section('page')
	<li class="breadcrumb-item menunameheader"><a href="{{ route('Reward_Transaction') }}">{{ translate_MenuTransaction('L_TRANSACTION') }}</a></li>
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Reward_Transaction') }}">{{ translate_MenuTransaction('L_REWARD_TRANSACTION') }}</a></li>
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
					<h2><strong>{{ translate_MenuTransaction('L_REWARD_TRANSACTION') }}</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive" style="height:800px;">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="th-sm">{{ translate_MenuTransaction('L_TIME_STAMP') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_USERNAME') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_ITEM') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_QUANTITY') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_PRICE') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_CONFIRM_REQUEST') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_DELIVERY_CONFIRM') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_DELIVERY_STATUS') }}</th>
										<th class="th-sm">{{ translate_MenuTransaction('L_ITEM_STATUS') }}</th>
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
													{{ translate_MenuTransaction('L_REQUEST') }}
												@elseif($trns->description == 'on process')
													<Span style="color:#739e73">{{ translate_MenuTransaction('L_APPROVE') }}</Span>
												@elseif($trns->description == 'sent')
													<Span style="color:#739e73">{{ translate_MenuTransaction('L_APPROVE') }}</Span>
												@endif
											</td>
											<td>
												<button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $trns->strtrnsid }}">{{ translate_MenuTransaction('L_DETAIL_INFO') }}</button>
											</td>
											<td>
												@if($trns->description == 'pending')
													{{ translate_MenuTransaction('L_PENDING') }}
												@elseif($trns->description == 'on process')
													<Span style="color:blue">{{ translate_MenuTransaction('L_ON_PROCESS') }}</Span>
												@elseif($trns->description == 'Sent')
													<Span style="color:#739e73">{{ translate_MenuTransaction('L_APPROVE') }}</Span>
												@endif
											</td>
											@if ($menu && $mainmenu)

											@endif
											<td>{{ translate_MenuTransaction(ucwords($trns->description)) }}</td>
											<td>
												<div>
													@if($trns->description == 'pending')
														<button type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline{{ $trns->strtrnsid }}"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('L_DECLINE') }}</button>
														<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $trns->strtrnsid }}"><i class="fa fa-check"></i> {{ translate_MenuTransaction('L_APPROVE') }}</button>
													@elseif($trns->description == 'on process')
															<button type="button" class="btn btn-xs text-white" style="background-color:blue;" data-toggle="modal" data-target="#process{{ $trns->strtrnsid }}">{{ translate_MenuTransaction('L_ON_PROCESS') }}</button>		
													@elseif($trns->description == 'Sent')	
														<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $trns->strtrnsid }}"><i class="fa fa-check"></i> {{ translate_MenuTransaction('L_COMPLETED') }}</button>											
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
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('L_APPROVE_TRANS') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
      			</div>
            <form action="{{ route('RewardTransaction-Approve')}}" method="POST">
            @csrf
			    <div class="modal-body" align="center">
						{{ translate_MenuTransaction('L_QUESTION_APPROVE_TRANS') }}
						<input type="hidden" name="description" value="On Process">
          				<input type="hidden" name="approveId" value="{{ $transaction->strtrnsid }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>{{ translate_MenuTransaction('L_YES') }}</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('L_NO') }}</button>
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
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('L_DECLINE_TRANS') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RewardTransaction-Decline')}}" method="POST">
            @csrf
                <div class="modal-body" align="center">
										<textarea name="description" id="" cols="30" rows="5" placeholder="Description"></textarea><br>
										{{ translate_MenuTransaction('L_QUESTION_DECLINE_TRANS') }}
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
				    			<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>{{ translate_MenuTransaction('L_YES') }}</button>
				    			<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('L_NO') }}</button>
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
					<h5>{{ translate_MenuTransaction('L_REQ_DELIVERY_STS') }}</h5>
					{{ translate_MenuTransaction('L_IF_THE_ITEM_HAS_BEEN_SENT') }}
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
								<td width="20%">{{ translate_MenuTransaction('L_DATE_SENT') }}</td>
								<td width="5%">:</td>
								<td width="75%"><input type="date" name="date_send" class="form-control" required></td>
							</tr>
							<tr>
								<td width="20%">{{ translate_MenuTransaction('L_ITEM_NAME') }}</td>
								<td width="5%">:</td>
								<td width="75%"><input type="text" name="item_name" class="form-control" required></td>
							</tr>
							<tr>
								<td width="20%">{{ translate_MenuTransaction('L_TYPE_OF_SHIPMENT') }}</td>
								<td width="5%">:</td>
								<td width="75%"><input type="text" name="item_name" class="form-control" required></td>
							</tr>
							<tr>
								<td width="20%">{{ translate_MenuTransaction('L_SHIPPING_CODE') }}</td>
								<td width="5%">:</td>
								<td width="75%"><input type="text" name="item_name" class="form-control" required></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-create toggle-disabled" id="submit" onclick="FunctionBtnLoading()"><i class="fa fa-check"></i>{{ translate_MenuTransaction('L_YES') }}</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuTransaction('L_NO') }}</button>
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
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('L_DETAIL_INFO') }}</h5>
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
						<td width="30%">{{ translate_MenuTransaction('L_FULL_NAME') }}</td>
						<td width="10%">:</td>
						<td width="60%">
								<input type="text" value="{{ $transaction->username }}" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('L_EMAIL') }}</td>
						<td>:</td>
						<td>
								<input type="text" value="{{ decryptaes256($transaction->email) }}" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('L_PHONE') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="{{-- decryptaes256($user_info->phone) --}}{{ $transaction->phone }}" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td valign="top">{{ translate_MenuTransaction('L_ADDRESS') }}</td>
						<td valign="top">:</td>
						<td>
							<textarea class="form-control" disabled>{{ $transaction->address }}</textarea>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('L_PROVINCE') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="" class="form-control" disabled>
						</td>
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('L_CITY') }}</td>
						<td>:</td>
						<td>
							<input type="text" value="" class="form-control" disabled>
						</td> 
					</tr>
					<tr>
						<td>{{ translate_MenuTransaction('L_POSTAL_CODE') }}</td>
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

	function FunctionBtnLoading(){
		$('.btn-create').text("Loading...");
		$('this').submit('loading').delay(1000).queue(function () {
		});
	}

	// @foreach($transaction as $trns)
	//  $(document).on('change keyup', '.required', function(e){
	// 	let Disabled = true;

	// 	$(".required").each(function() {
	// 	let value = this.value
	// 		if ((value)&&(value.trim() !='')){
	// 			console.log('abc');
	// 			Disabled = false
	// 		}else{
	// 			Disabled = true
	// 			return false
	// 		}
	// 	});
		
	// 	if(Disabled){
	// 		$('.toggle-disabled').prop("disabled", true);
	// 	}else{
	// 		$('.toggle-disabled').prop("disabled", false);
	// 	}
	//  })
	//  @endforeach
</script>
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