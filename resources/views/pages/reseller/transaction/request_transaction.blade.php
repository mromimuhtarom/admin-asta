@extends('index')


@section('page')
	<li class="breadcrumb-item"><a href="{{ route('Request_Transaction') }}">{{ translate_menu('L_RESELLER') }}</a></li>
  	<li class="breadcrumb-item"><a href="{{ route('Request_Transaction') }}">{{ translate_menu('L_REQUEST_TRANSACTION') }}</a></li>
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

{{-- <div class="user-transactions"> --}}
	
	<!-- Table 1 -->
	<div>
		<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
		
			<header>
				<div class="widget-header">	
					<h2><strong>{{ translate_menu('L_REQUEST_TRANSACTION') }}</strong></h2>				
				</div>
			</header>
		
			<div>
				<div class="widget-body">
					<div class="custom-scroll table-responsive" style="height:800px;">
						
						<div class="table-outer">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="th-sm">{{ TranslateTransaksiAgen('ID Order') }}</th>
										<th class="th-sm">{{ TranslateTransaksiAgen('Purchase Date') }}</th>
										<th class="th-sm">{{ TranslateTransaksiAgen('User ID') }}</th>
										<th class="th-sm">{{ Translate_menuPlayers('Username') }}</th>
										<th class="th-sm">{{ translate_menuTransaction('Item') }}</th>
										<th class="th-sm">{{ translate_menuTransaction('Quantity') }}</th>
										<th class="th-sm">{{ translate_menuTransaction('Price') }}</th>
										<th class="th-sm">{{ TranslateTransaksiAgen('Transaction Type') }}</th>
										@if ($menu && $mainmenu && $submenu)
										<th class="th-sm">{{ translate_menuTransaction('Confirm request') }}</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach ($transactions as $transaction)
									
									<tr>
										@if ($menu && $mainmenu && $submenu)
										<td>{{ $transaction->id }}</td>
										<td>{{ date("d-m-Y H:i:s", strtotime($transaction->datetime)) }}</td>
										<td>{{ $transaction->reseller_id }}</td>
										<td>{{ $transaction->username }}</td>
										@if ( $transaction->item_type == 1 )
											@foreach ($item_gold as $chip)
											@if ($transaction->item_id == $chip->item_id)
												<td>{{ $chip->name }}</td>
											@endif
											@endforeach
										@elseif($transaction->item_type == 2)
											@foreach ($item_cash as $gold)
											@if ($transaction->item_id == $gold->item_id)
												<td>{{ $gold->name }}</td>
											@endif
											@endforeach
										@elseif($transaction->item_type == 3)
											@foreach ($item_point as $goods)
											@if ($transaction->item_id == $goods->item_id)
												<td>{{ $goods->name }}</td>
											@endif
											@endforeach
										@endif
										<td>{{ $transaction->quantity }}</td>
										<td>{{ $transaction->item_price }}</td>
										<td>{{ $transaction->bankname }}{{ translate_menuTransaction('Bank Manual Transfer') }}</td>
										<td>
											<div>
												<button type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline{{ $transaction->id }}"><i class="fa fa-remove"></i>{{ translate_menuTransaction('Decline') }}</button>
										  {{-- </div>
											<div> --}}
												<button type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $transaction->id }}"><i class="fa fa-check"></i>{{ translate_menuTransaction('Approve') }}</button>
											</div>
										</td>
										@else
										<td>{{ $transaction->id }}</td>
										<td>{{ date("d-m-Y H:i:s", strtotime($transaction->datetime)) }}</td>
										<td>{{ $transaction->userid }}</td>
										<td>{{ $transaction->username }}</td>
										@if ( $transaction->item_type == 1 )
											@foreach ($item_gold as $chip)
											@if ($transaction->item_id == $chip->item_id)
												<td>{{ $chip->name }}</td>
											@endif
											@endforeach
										@elseif($transaction->item_type == 2)
											@foreach ($item_cash as $gold)
											@if ($transaction->item_id == $gold->item_id)
												<td>{{ $gold->name }}</td>
											@endif
											@endforeach
										@elseif($transaction->item_type == 3)
											@foreach ($item_point as $goods)
											@if ($transaction->item_id == $goods->item_id)
												<td>{{ $goods->name }}</td>
											@endif
											@endforeach
										@endif
										<td>{{ $transaction->quantity }}</td>
										<td>{{ $transaction->item_price }}</td>
										<td>{{ $transaction->bankname }} {{ translate_menuTransaction('Bank Manual Transfer') }}</td>
										<td>{{ translate_menuTransaction('Pending') }}</td>
										@endif
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


<!-- Modal decline -->
@foreach ($transactions as $transaction)
<div class="modal fade" id="decline{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_menuTransaction('Decline Transaction') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RequestTransaction-Decline')}}" method="POST">
            @csrf
                <div class="modal-body" align="center">
										<textarea name="description" id="" cols="30" rows="5" placeholder="Description"></textarea><br>
                    {{ translate_menuTransaction('Are you sure want to Decline this Transaction') }}
                    <input type="hidden" name="declineId" value="{{ $transaction->id }}">
										<input type="hidden" name="reseller_id" value="{{ $transaction->reseller_id }}">
										<input type="hidden" name="price" value="{{ $transaction->item_price }}">
										
										@if ( $transaction->item_type == 1 )
											@foreach ($item_gold as $chip)
											@if ($transaction->item_id == $chip->item_id)
												<input type="hidden" name="item_name" value="{{ $chip->name }}">
											@endif
											@endforeach
										@elseif($transaction->item_type == 2)
											@foreach ($item_cash as $gold)
											@if ($transaction->item_id == $gold->item_id)
												<input type="hidden" name="item_name" value="{{ $gold->name }}">
											@endif
											@endforeach
										@elseif($transaction->item_type == 3)
											@foreach ($item_point as $goods)
											@if ($transaction->item_id == $goods->item_id)
												<input type="hidden" name="item_name" value="{{ $goods->name }}">
											@endif
											@endforeach
										@endif
										<input type="hidden" name="quantity" value="{{ $transaction->quantity }}">
										<input type="hidden" name="payment_id" value="{{ $transaction->payment_id }}">
										<input type="hidden" name="datetime" value="{{ date("d-m-Y H:i:s", strtotime($transaction->datetime)) }}">
										<input type="hidden" name="shop_type" value="{{ $transaction->shop_type }}">
										<input type="hidden" name="item_type" value="{{ $transaction->item_type }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary submit-data"><i class="fa fa-check"></i> {{ translate_menuTransaction('Yes') }}</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_menuTransaction('No') }}</button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal decline -->

<!-- Modal approve transaction -->
@foreach ($transactions as $transaction)
<div class="modal fade" id="approve{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_menuTransaction('Approve') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
            </div>
            <form action="{{ route('RequestTransaction-Approve')}}" method="POST">
            @csrf
			    <div class="modal-body" align="center">
							<textarea name="description" id="" cols="30" rows="5" placeholder="Description"></textarea><br>
							{{ translate_menuTransaction('Are you want to Approve this Transaction?') }}

										<input type="hidden" name="reseller_id" value="{{ $transaction->reseller_id }}">
										<input type="hidden" name="goldbuy" value="190">
										<input type="hidden" name="price" value="{{ $transaction->item_price }}">
										@if ( $transaction->item_type == 1 )
											@foreach ($item_gold as $chip)
											@if ($transaction->item_id == $chip->item_id)
												<input type="hidden" name="item_name" value="{{ $chip->name }}">
											@endif
											@endforeach
										@elseif($transaction->item_type == 2)
											@foreach ($item_cash as $gold)
											@if ($transaction->item_id == $gold->item_id)
												<input type="hidden" name="item_name" value="{{ $gold->name }}">
											@endif
											@endforeach
										@elseif($transaction->item_type == 3)
											@foreach ($item_point as $goods)
											@if ($transaction->item_id == $goods->item_id)
												<input type="hidden" name="item_name" value="{{ $goods->name }}">
											@endif
											@endforeach
										@endif
										<input type="hidden" name="quantity" value="{{ $transaction->quantity }}">
										<input type="hidden" name="payment_id" value="{{ $transaction->payment_id }}">
										<input type="hidden" name="datetime" value="{{ date("d-m-Y H:i:s", strtotime($transaction->datetime)) }}">
										<input type="hidden" name="shop_type" value="{{ $transaction->shop_type }}">
										<input type="hidden" name="item_type" value="{{ $transaction->item_type }}">
			    </div>
			    <div class="modal-footer">
				    <button type="submit" class="btn btn-primary submit-data"><i class="fa fa-check"></i> {{ translate_menuTransaction('Yes') }}</button>
				    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_menuTransaction('No') }}</button>
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
            mode :'inline',
						validate: function(value) {
							if($.trim(value) == '') {
								return 'This field is required';
							}
						}
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