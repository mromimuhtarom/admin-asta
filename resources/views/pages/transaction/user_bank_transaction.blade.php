@extends('index')


@section('sidebarmenu')
@include('menu.menutransaction')    
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all as $error)
        <li>{{$error}}</li>  
        @endforeach
    </ul>
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
									@foreach ($rewardRequest as $reward)
									
									<tr>
											<td>
												<div class="user-transaction-dates">
													<div>
														<p>Date {{ $reward->date_buy }}</p> 
													</div>
													<div>
														<p>Buy in Best Offer</p>
													</div>
												</div>
												<div class="user-transaction-users">
													<div>
														<img src="/images/gifts/41.png" alt="" class="img-profile-reward">
													</div>
													<div class="user-transaction-user-name">
														<div>
															<h3>{{ $reward->username }}</h3>
														</div>
														<div>
															<h5>Buy {{ $reward->qty }} {{ $reward->reward_name }} Using Bank Transfer</h5>
														</div>
													</div>
												</div>
												<div class="transactions-user-button">
													<div>
														<input type="button" value="View Detail" class="btn btn-xs btn-info" data-toggle="modal" data-target="#view-detail{{ $reward->id }}">
													</div>
													<div>
														<input type="button" value="Decline" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#decline{{ $reward->id }}">
													</div>
													<div>
														<input type="button" value="Approve" class="btn btn-xs btn-success" data-toggle="modal" data-target="#approve{{ $reward->id }}">
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


	<!-- Table 2 -->
	<div>
		<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
		
			<header>
				<div class="widget-header">	
					<h2><strong>Approved Transactions</strong></h2>				
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
									</tr>
								</thead>
								<tbody>
									{{-- @foreach ($rewardRequest as $reward) --}}
									<tr>
											<td>
												<div class="user-transaction-dates">
													<div>
														<p>Date 14-03-2019 03:36:10</p> 
													</div>
													<div>
														<p>Buy in Best Offer</p>
													</div>
												</div>
												<div class="user-transaction-users">
													<div>
														<img src="/images/gifts/41.png" alt="" class="img-profile-reward">
													</div>
													<div class="user-transaction-user-name">
														<div>
															<h3>Elliot</h3>
														</div>
														<div>
															<h5>Buy 300 Gold Coins Using Bank Transfer</h5>
														</div>
													</div>
												</div>
												<div class="transaction-user-approve">
													<div class="transactions-user-button">
														<div>
															<input type="button" value="View Detail" class="btn btn-xs btn-info" data-toggle="modal" data-target="#view-detail-approved{{ $reward->id }}">
														</div>
														<div>
															<input type="button" value="Completed" class="btn btn-xs btn-success" data-toggle="modal" data-target="#completed{{ $reward->id }}">
														</div>
													</div>
													<div>
														<p>Approved by Perkasa</p>
													</div>
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
	<!-- End Table 2 -->
</div>

<!-- Modal before approved -->
@foreach ($rewardRequest as $reward)
<div class="modal fade" id="view-detail{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-transaction-user-detail">
					<div class="modal-transaction-user-detail-top">
						<div>
								<img src="/images/gifts/41.png" alt="image" class="img-profile-reward">
						</div>
						<div>
							<h3><strong>JOHN DOE</strong></p>
							<em>johndoe123321</em>
							<p>JohnDoe@gmail.com</p>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>From</p>
						</div>
						<div>
							<strong>: &nbsp; Best Offer</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Date</p>
						</div>
						<div>
							<strong>: &nbsp; 14-03-2019 / 03:36:10</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Buying</p>
						</div>
						<div>
							<strong>: &nbsp; 300 Coin Gold</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Price</p>
						</div>
						<div>
							<strong>: &nbsp; Rp 990.000</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Payment</p>
						</div>
						<div>
							<strong>: &nbsp; Bank Transfer</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Status</p>
						</div>
						<div>
							<strong>: &nbsp; <span style="color:#1e90ff;"> Sukses Transfer Bank BCA</span></strong>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal before approved -->

<!-- Modal decline -->
@foreach ($rewardRequest as $reward)
<div class="modal fade" id="decline{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="margin-top:5%;">
				<h5 class="modal-title" id="exampleModalLabel">Decline Transaction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				Are you sure want to Decline this Transaction ?
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal decline -->

<!-- Modal approve transaction -->
@foreach ($rewardRequest as $reward)
<div class="modal fade" id="approve{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="margin-top:5%;">
				<h5 class="modal-title" id="exampleModalLabel">Decline Transaction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				Are you sure want to Approve this Transaction ?
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal approve transaction -->


<!-- Modal approved -->
@foreach ($rewardRequest as $reward)
<div class="modal fade" id="view-detail-approved{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				<div class="modal-transaction-user-detail">
					<div class="modal-transaction-user-detail-top">
						<div>
								<img src="/images/gifts/41.png" alt="image" class="img-profile-reward">
						</div>
						<div>
							<h3><strong>JOHN DOE</strong></p>
							<em>johndoe123321</em>
							<p>JohnDoe@gmail.com</p>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>From</p>
						</div>
						<div>
							<strong>: &nbsp; Best Offer</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Date</p>
						</div>
						<div>
							<strong>: &nbsp; 14-03-2019 / 03:36:10</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Buying</p>
						</div>
						<div>
							<strong>: &nbsp; 300 Coin Gold</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Price</p>
						</div>
						<div>
							<strong>: &nbsp; Rp 990.000</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Payment</p>
						</div>
						<div>
							<strong>: &nbsp; Bank Transfer</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Status</p>
						</div>
						<div>
							<strong>: &nbsp; <span style="color:#1e90ff;"> Sukses Transfer Bank BCA</span></strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Approved</p>
						</div>
						<div>
							<strong>: &nbsp; Admin Satu</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Completed</p>
						</div>
						<div>
							<strong>: &nbsp; Admin Dua</strong>
						</div>
					</div>
					<div class="modal-transaction-user-detail-bottom">
						<div>
							<p>Decline</p>
						</div>
						<div>
							<strong>: &nbsp; -</strong>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal approved -->

<!-- Modal approve transaction -->
@foreach ($rewardRequest as $reward)
<div class="modal fade" id="completed{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="margin-top:5%;">
				<h5 class="modal-title" id="exampleModalLabel">Completed Transaction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				Is this Transaction is Completed?
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Yes</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
@endforeach
<!-- End Modal approve transaction -->

<!-- Modal -->
{{-- <div class="modal fade" id="view-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="margin-top:5%;">
				<h5 class="modal-title" id="exampleModalLabel">Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post">
					@csrf
			</div>
			<div class="modal-footer">
				<button type="button" class="button_example-no" data-dismiss="modal">Close</button>
				<button type="submit" class="button_example-yes">Save Changes</button>
			</div>
				</form>
		</div>
	</div>
</div> --}}
<!-- End Modal -->


{{-- <div class="row">
    <div class="col">
        <div class="table-aii">
            <div class="footer-table">
                <div class="add-btn-smt">
                    Request Transactions
                </div>
            </div>
            <table id="dt-material-checkbox" class="table" style="margin-left:1px;margin-top:-10%;" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th class="th-sm"></th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($rewardRequest as $reward)
                        <!-- Modal -->
                            <div class="modal fade" id="view-detail{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-top:5%;">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            {{  csrf_field() }}
                                        <div class="modal-body">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="decline{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-top:5%;">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            {{  csrf_field() }}
                                        <div class="modal-body">
                                            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
                                            <input type='file' onchange="readURL(this);" /><br><br>
                                            <input type="text" name="title" placeholder="Title Gift" required><br>
                                            <input type="number" name="expire" placeholder="expire" required><br>
                                            <select name="transaction">
                                                <option>Category</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="approve{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-top:5%;">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            {{  csrf_field() }}
                                        <div class="modal-body">
                                            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
                                            <input type='file' onchange="readURL(this);" /><br><br>
                                            <input type="text" name="title" placeholder="Title Gift" required><br>
                                            <input type="number" name="expire" placeholder="expire" required><br>
                                            <select name="transaction">
                                                <option>Category</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <tr>
                        <td></td>
                        <td>


                            <div class="row">
                                <div class="col">{{ $reward->date_buy }}</div>
                                <div class="col" align="right">Buy in Best Offer</div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="media-profile-reward">
                                        <img src="/images/gifts/41.png" alt="" class="img-profile-reward">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row no-gutters" style="margin-left:2%;">
                                        <div class="col"><h4><a href="#">{{ $reward->username }}</a></h4></div>
                                    </div>
                                    <div class="row no-gutters" style="margin-left:2%;">
                                        <div class="col"><h4>Buy {{ $reward->qty }} {{ $reward->reward_name }} Using Bank Transfer</h4></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-2"><input type="button" value="View Detail" class="detail-banktransaction" data-toggle="modal" data-target="#view-detail{{ $reward->id }}"></div>
                                <div class="col-2"><input type="button" value="Decline" class="decline-banktransaction" data-toggle="modal" data-target="#decline{{ $reward->id }}"></div>
                                <div class="col-2"><input type="button" value="Approve" class="approve-banktransaction" data-toggle="modal" data-target="#approve{{ $reward->id }}""></div>
                                <div class="col" align="right">Pending</div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="col">
            <div class="table-aii">
                <div class="footer-table">
                    <div class="add-btn-smt">
                        Request Transaction
                    </div>
                </div>
                <table id="dt-material-checkbox" class="table display" style="margin-left:1px;margin-top:-10%;" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="th-sm"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                    <div class="row">
                                        <div class="col">14-03-2019  03:36:10</div>
                                        <div class="col" align="right">Buy in Best Offer</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="media-profile-reward">
                                                <img src="/images/gifts/41.png" alt="" class="img-profile-reward">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row no-gutters" style="margin-left:2%;">
                                                <div class="col"><h4 style="font-size:100%;">Eliot</h4></div>
                                            </div>
                                            <div class="row no-gutters" style="margin-left:2%;">
                                                <div class="col"><h4 style="font-size:100%;">Buy 300 Gold Coins Using Bank Transfer</h4></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-2"><input type="button" value="View Detail" class="detail-banktransaction"></div>
                                        <div class="col-2"><input type="button" value="Completed" class="approve-banktransaction"></div>
                                        <div class="col" align="right">Approve by Perkasa</div>
                                    </div>
        
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" style="margin-top:5%;">
				<h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					× 
				</button>
			</div>
			<div class="modal-body">
				Are You Sure Want To Delete It
				<form action="{{ route('Bots-delete') }}" method="post">
					{{ method_field('delete')}}
					{{ csrf_field() }}
					<input type="hidden" name="userid" id="userid" value="">
			</div>
			<div class="modal-footer">
				<button type="submit" class="button_example-yes">Yes</button>
				<button type="button" class="button_example-no" data-dismiss="modal">No</button>
			</div>
				</form>
		</div>
	</div>
</div> --}}


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