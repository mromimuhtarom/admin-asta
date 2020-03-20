@extends('index')

@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Store_reseller_report') }}">{{ translate_menu('L_STORE_RESELLER') }}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Store_reseller_report') }}">{{ translate_menu('L_STORE_RESELLER_REPORT') }}</a></li>
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

@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif


<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom: 2%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('StoreResellerReport-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                @if (Request::is('Reseller/Store_Reseller/Store_reseller_report/StoreResellerReport-view'))
                <div class="col">
                    <input type="text" name="inputUsernameReseller" class="form-control" placeholder="username / Reseller ID">
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                </div>
                @else
                <div class="col">
                  <input type="text" name="inputUsernameReseller" class="form-control" value="{{ $usernameReseller }}" placeholder="username / Reseller ID">
                </div>
                <div class="col" style="padding-left:3%;">
                  <input type="date" class="form-control" name="inputMinDate" value="{{ $minDate }}">
                </div>
                <div class="col" style="padding-left:3%;">
                  <input type="date" class="form-control" name="inputMaxDate" value="{{ $maxDate }}">
                </div>
                @endif
                <div class="col" style="padding-left:3%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i>{{ TranslateReseller('L_SEARCH')}}</button>
                </div>
            </div>
        </form>
    </div>
</div> 
<!--- End Content Search --->   


@if (Request::is('Reseller/Store_Reseller/Store_reseller_report/StoreResellerReport-search'))
<!-- Table 1 -->
<div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    
        <header>
            <div class="widget-header">	
                <h2><strong>{{ translate_menu('L_STORE_RESELLER_REPORT') }}</strong></h2>				
            </div>
        </header>
    
        <div>
            <div class="widget-body">
                <div class="custom-scroll table-responsive" style="height:800px;">
                    
                    <div class="table-outer">
                        <div class="row">
                            <!-- Button tambah bot baru -->
                            <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                                {{ Translate_menuPlayers('L_TOTAL_RECORD') }} {{ $transactions->total() }}
                            </div>
                                        <!-- End Button tambah bot baru -->
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="th-sm">{{ TranslateReseller('L_ORDER_TRANSACTION') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_DATE_BUY_SELL') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_RESELLER_ID') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_USERNAME_RESELLER') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_ACTION') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_QUANTITY') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_STATUS_TRANSACTION') }}</th>
                                    <th class="th-sm">{{ TranslateReseller('L_INFORMATION_DETAIL') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                @php 
                                $buy = DB::table('store_transaction_hist')->where('')
                                @endphp
                                <tr>
                                    <td>{{ $transaction->order_id }}</td>
                                    <td>{{ $transaction->transaction_date }}</td>
                                    <td>{{ $transaction->reseller_id }}</td>
                                    <td>{{ $transaction->reseller_username}}</td>
                                    <td></td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>{{ $transaction->transaction_status }}</td>
                                    <td><button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo nanti">{{ translate_MenuTransaction('L_DETAIL_INFO') }}</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="display: flex;justify-content: center;">{{ $transactions->links() }}</div>                    
            
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- End Table 1 -->
@endif



<!-- Modal detail info -->
{{-- @foreach ($transactions as $transaction)
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
@endforeach --}}



<script>
    $(document).ready(function() {
      $('table.table').dataTable( {
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
        "paging":false,
        "bInfo":false,
        "ordering":false,
        "bLengthChange": false,
        "searching": false,
      });
    });
  
    table = $('table.table').dataTable({
      "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
      "autoWidth" : true,
      "ordering":false,
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