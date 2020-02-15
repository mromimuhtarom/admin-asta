@extends('index')

@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Store_reseller_report') }}">{{ translate_menu('L_STORE_RESELLER') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Store_reseller_report') }}">{{ translate_menu('L_STORE_RESELLER_REPORT') }}</a></li>
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
                                    <th class="th-sm">ID Order</th>
                                    <th class="th-sm">Tgl & waktu disetujui</th>
                                    <th class="th-sm">ID Agen</th>
                                    <th class="th-sm">Username</th>
                                    <th class="th-sm">Nama Item</th>
                                    <th class="th-sm">Jumlah Item</th>
                                    @if ($menu && $mainmenu && $submenu)
                                    <th class="th-sm">{{ translate_menuTransaction('Confirm request') }}</th>
                                    @endif
                                    <th class="th-sm">Deskripsi</th>
                                    <th class="th-sm">Harga barang</th>
                                    <th class="th-sm">Informasi status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                
                                <tr>
                                    @if ($menu && $mainmenu && $submenu)
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->datetime }}</td>
                                    <td>{{ $transaction->reseller_id }}</td>
                                    <td>{{ $transaction->username }}</td>
                                    <td>{{ $transaction->item_name }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>
                                      @if($transaction->item_type == 1)
                                          <span style="color:green">{{ TranslateMenuToko('Success') }}</span>
                                      @elseif($transaction->item_type == 2)
                                          @if($transaction->status == 1)
                                              <span style="color:green">{{ TranslateMenuToko('Success') }}</span>
                                          @elseif($transaction->status == 2)
                                              <span style="color:red">{{ TranslateMenuToko('Decline') }}</span>
                                          @endif
                                      @elseif($transaction->item_type == 3)
                                          @if($transaction->status == 1)
                                              <span style="color:green">{{ TranslateMenuToko('Received And Sent') }}</span>
                                          @elseif($transaction->status == 2)
                                              <span style="color:red">{{ TranslateMenuToko('Decline') }}</span>
                                          @endif
                                      @endif
                                  </td> 
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->item_price }}</td>
                                    <td>
                                      <button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $transaction->id }}">{{ translate_MenuTransaction('Detail Info') }}</button>
                                    </td>
                                    
                                    @else
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->datetime }}</td>
                                    <td>{{ $transaction->userid }}</td>
                                    <td>{{ $transaction->username }}</td>
                                    <td>{{ $transaction->item_name }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>{{ translate_menuTransaction('Pending') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->item_price }}</td>
                                    <td>
                                      <button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $transaction->id }}">{{ translate_MenuTransaction('Detail Info') }}</button>
                                    </td>
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


<!-- Modal detail info -->
@foreach ($transactions as $transaction)
<div class="modal fade" id="detailinfo{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('Detail Info') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
			</div>
			<div class="modal-body">
                @if($transaction->item_type == 2)
                    @if($transaction->payment_id == 23)
                        <label for="tgl_pembelian">
                            {{ TranslateMenuToko('Date Request') }}
                        </label>
                        <input type="text" class="form-control" name="" id="tgl_pembelian" value="{{ $transaction->datetime }}" disabled>
                        <label for="tipe_pembayaran">
                            {{ TranslateMenuToko('Payment Type')}}
                        </label>
                        <input type="text" name="" id="tipe_pembayaran" class="form-control" value="{{ $transaction->paymentname }}" disabled>
                    @else 
                        <label for="tgl_pembelian">
                            {{ TranslateMenuToko('Date Request') }}
                        </label>
                        <input type="text" class="form-control" name="" id="tgl_pembelian" value="{{ $transaction->datetime }}" disabled>
                        <label for="tgl_disetujui">
                            {{ TranslateMenuToko('Date approve and Decline')}}
                        </label>
                        <input type="text" name="" id="tgl_disetujui" class="form-control" value="{{ $transaction->action_date }}" disabled>
                        <label for="tipe_pembayaran">
                            {{ TranslateMenuToko('Payment Type')}}
                        </label>
                        <input type="text" name="" id="tipe_pembayaran" class="form-control" value="{{ $transaction->paymentname }}" disabled>
                    @endif
                @endif
			</div> 
		</div>
	</div>
</div>
@endforeach



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