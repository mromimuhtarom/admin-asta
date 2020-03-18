@extends('index')


@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Report_Store') }}">{{ TranslateMenuToko('L_STORE')}}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Report_Store') }}">{{ TranslateMenuToko('L_REPORT_STORE')}}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
  @if (\Session::has('alert'))
  <div class="alert alert-danger">
    <p>{{\Session::get('alert')}}</p>
  </div>
@endif
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
  <div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
      <form action="{{ route('ReportStore-search') }}">
            <div class="row h-100 w-100">
                <div class="col">
                    <input type="text" name="username" class="form-control" placeholder="username /Player ID">
                </div>
                {{-- @if(Request::is('Store/Report_Store/ReportStore-search*'))
                <div class="col">
                    <select style="width: 150px;" name="choosedate" id="" class="form-control">
                        <option value="request" @if( $choosedate == 'request' ) selected @endif>{{ TranslateMenuToko('Date Request')}}</option>
                        <option value="approvedecline" @if( $choosedate == 'approvedecline') selected @endif>{{ TranslateMenuToko('Date approve and Decline')}}</option>
                    </select>
                </div>
                @else
                <div class="col">
                    <select style="width: 150px;" name="choosedate" id="" class="form-control">
                        <option value="request">{{ TranslateMenuToko('Date Request')}}</option>
                        <option value="approvedecline">{{ TranslateMenuToko('Date approve and Decline')}}</option>
                    </select>
                </div>
                @endif --}}

                @if(Request::is('Store/Report_Store/ReportStore-search*'))
                <div class="col">
                    <select name="chooseitem" id="" class="form-control">
                        <option value="">Pilih item</option>
                        <option value="{{ $type[0] }}" @if( $chooseitem == $type[0] ) selected @endif>{{ ConfigTextTranslate($type[1]) }}</option>
                        <option value="{{ $type[2] }}" @if( $chooseitem == $type[2] ) selected @endif>{{ ConfigTextTranslate($type[3]) }}</option>
                        <option value="{{ $type[4] }}" @if( $chooseitem == $type[4] ) selected @endif>{{ ConfigTextTranslate($type[5]) }}</option>
                    </select>
                </div>
                @else
                <div class="col">
                    <select name="chooseitem" id="" class="form-control">
                        <option value="">Pilih item</option>
                        <option value="{{ $type[0] }}">{{ ConfigTextTranslate($type[1]) }}</option>
                        <option value="{{ $type[2] }}">{{ ConfigTextTranslate($type[3]) }}</option>
                        <option value="{{ $type[4] }}">{{ ConfigTextTranslate($type[5]) }}</option>
                    </select>
                </div>
                @endif

                @if(Request::is('Store/Report_Store/ReportStore-search*'))
                <div class="col date-min">
                    <input type="date" class="form-control" name="dari" value="{{ $minDate }}">
                </div>
                <div class="col date-max">
                    <input type="date" class="form-control" name="sampai" value="{{ $maxDate }}">
                </div>
                @else
                <div class="col date-min">
                    <input type="date" class="form-control" name="dari" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col date-max">
                    <input type="date" class="form-control" name="sampai" value="{{ $datenow->toDateString() }}">
                </div>
                @endif
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
  </div>


@if (Request::is('Store/Report_Store/ReportStore-search*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>{{ TranslateMenuToko('Report store')}}</h2>
        </div>
    
        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
        </div>
    </header>
    <div>
                    
        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->
        </div>
        <!-- end widget edit box -->
        
        <!-- widget content -->
        <div class="widget-body p-0">
                    
            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th>{{ TranslateMenuToko('Date Request')}}</th>
                        <th>{{ TranslateMenuToko('Player ID')}}</th>
                        <th>{{ TranslateMenuToko('Username')}}</th>
                        <th>{{ TranslateMenuToko('Item')}}</th>
                        <th>{{ TranslateMenuToko('Quantity')}}</th>
                        <th>{{ TranslateMenuToko('Description')}}</th>
                        <th>{{ TranslateMenuToko('Price')}}</th>
                        <th>{{ TranslateMenuToko('Confirmation') }}</th>
                        <th>{{ TranslateMenuToko('Status Information') }}</th>
                        <th>{{ TranslateMenuToko('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td>{{ date("d-m-Y H:i:s", strtotime($tr->datetime)) }}</td>
                        <td>{{ $tr->user_id }}</td>
                        <td>{{ $tr->username }}</td>
                        <td>{{ $tr->item_name }}</td>
                        <td>{{ $tr->quantity }}</td>
                        <td>{{ $tr->description }}</td>
                        @if ($tr->item_type == 1)
                        <td>{{ $tr->item_price }} Gold</td>
                        @elseif($tr->item_type == 2)
                        <td> {{ number_format($tr->item_price) }}Cash</td>
                        @elseif($tr->item_type == 3)
                        <td>{{ $tr->item_price }} Point</td>
                        @endif
                        {{-- <td></td> --}}
                        <td>
                            @if($tr->item_type == 1)
                                <span style="color:green">{{ TranslateMenuToko('Success') }}</span>
                            @elseif($tr->item_type == 2)
                                @if($tr->status == 1)
                                    <span style="color:green">{{ TranslateMenuToko('Success') }}</span>
                                @elseif($tr->status == 2)
                                    <span style="color:red">{{ TranslateMenuToko('Decline') }}</span>
                                @endif
                            @elseif($tr->item_type == 3)
                                @if($tr->status == 1)
                                    <span style="color:green">{{ TranslateMenuToko('Received And Sent') }}</span>
                                @elseif($tr->status == 2)
                                    <span style="color:red">{{ TranslateMenuToko('Decline') }}</span>
                                @endif
                            @endif
                        </td> 
                        <td>
                            <button type="button" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $tr->id }}">{{ translate_MenuTransaction('Detail Info') }}</button>
                        </td>
                        <td>{{ TranslateTransactionHist(strStatusApdec($tr->status)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
                    
    </div>
    <!-- end widget div -->
                    
</div>
    <!-- end widget -->


<!-- Modal detail info -->
@foreach ($transactions as $tr)
<div class="modal fade" id="detailinfo{{ $tr->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ translate_MenuTransaction('Detail Info') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
			</div>
			<div class="modal-body">
                @if($tr->item_type == 3)
                    <label for="tgl_pembelian">
                        {{ TranslateMenuToko('Date Request') }}
                    </label>
                    <input type="text" class="form-control" name="" id="tgl_pembelian" value="{{ date("d-m-Y H:i:s", strtotime($tr->datetime)) }}" disabled>
                    <label for="tgl_disetujui">
                        {{ TranslateMenuToko('Date approve and Decline')}}
                    </label>
                    <input type="text" name="" id="tgl_disetujui" class="form-control" value="{{ $tr->action_date }}" disabled>
                    <label for="tgl_dikirim">
                        {{ TranslateMenuToko('Date Sent')}}
                    </label>
                    <input type="text" name="" id="tgl_dikirim" class="form-control">
                    <label for="tgl_diterima">
                        {{ TranslateMenuToko('The Date The Item Was Received')}}
                    </label>
                    <input type="text" name="" id="tgl_diterima" class="form-control">
                    <label for="jenis_pengiriman">
                        {{ TranslateMenuToko('Type Of Delivery')}}
                    </label>
                    <input type="text" name="" id="jenis_pengiriman" class="form-control">
                    <label for="kode_pengiriman">
                        {{ TranslateMenuToko('Code Receipt')}}
                    </label>
                    <input type="text" name="" id="kode_pengiriman" class="form-control">
                @elseif($tr->item_type == 2)
                    @if($tr->payment_id == 23)
                        <label for="tgl_pembelian">
                            {{ TranslateMenuToko('Date Request') }}
                        </label>
                        <input type="text" class="form-control" name="" id="tgl_pembelian" value="{{ date("d-m-Y H:i:s", strtotime($tr->datetime)) }}" disabled>
                        <label for="tipe_pembayaran">
                            {{ TranslateMenuToko('Payment Type')}}
                        </label>
                        <input type="text" name="" id="tipe_pembayaran" class="form-control" value="{{ $tr->paymentname }}" disabled>
                    @else 
                        <label for="tgl_pembelian">
                            {{ TranslateMenuToko('Date Request') }}
                        </label>
                        <input type="text" class="form-control" name="" id="tgl_pembelian" value="{{ date("d-m-Y H:i:s", strtotime($tr->datetime)) }}" disabled>
                        <label for="tgl_disetujui">
                            {{ TranslateMenuToko('Date approve and Decline')}}
                        </label>
                        <input type="text" name="" id="tgl_disetujui" class="form-control" value="{{ $tr->action_date }}" disabled>
                        <label for="tipe_pembayaran">
                            {{ TranslateMenuToko('Payment Type')}}
                        </label>
                        <input type="text" name="" id="tipe_pembayaran" class="form-control" value="{{ $tr->paymentname }}" disabled>
                    @endif
                @elseif($tr->item_type == 1)
                        <label for="tgl_pembelian">
                            {{ TranslateMenuToko('Date Request') }}
                        </label>
                        <input type="text" class="form-control" name="" value="{{ date("d-m-Y H:i:s", strtotime($tr->datetime)) }}" id="tgl_pembelian" disabled>
                @endif
			</div> 
		</div>
	</div>
</div>
@endforeach

<script>
    var responsiveHelper_dt_basic = responsiveHelper_dt_basic || undefined;
			
	var breakpointDefinition = {
	    tablet : 1024,
		phone : 480
	};
	
	$('#dt_basic').dataTable({
	    "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'>r>"+
		    "t"+
			"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
		"autoWidth" : true,
        "bSort" : false,
		"oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
		},
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: false
	});
</script>
@endif
@endsection