@extends('index')

@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Report_Transaction') }}">{{ translate_menu('L_RESELLER')}}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Report_Transaction') }}">{{ translate_menu('L_RESELLER_TRANSACTION')}}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!--- Warning Alert --->
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
<!--- End Warning Alert --->

<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom: 2%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('ResellerTransaction-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col">
                    <input type="text" name="inputUsername" class="form-control" placeholder="username / Reseller ID">
                </div>
                <div class="col" style="padding-left:3%;">
                    <select name="choosedate" id="" class="form-control" required>
                        <option value="">{{ TranslateMenuToko('L_CHOOSE_TYPE_DATE')}}</option>
                        <option value="approvedecline">{{ TranslateMenuToko('L_DATE_AND_APPROVE')}}</option>
                        <option value="request">{{ TranslateMenuToko('L_DATE_REQUEST')}}</option>
                    </select>
                </div>
                @if (Request::is('Reseller/Reseller-Transaction/Report_Transaction/ReportTransaction-view'))
                <div class="col date-min" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col date-max" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                </div>
                @else
                <div class="col date-min" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $startDate }}">
                </div>
                <div class="col date-max" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $endDate }}">
                </div>
                @endif
                <div class="col" style="padding-left:3%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div> 
<!--- End Content Search --->   

<!--- Show After Serach --->
@if (Request::is('Reseller/Reseller-Transaction/Report_Transaction/ReportTransaction-view'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>{{ TranslateReseller('Report Transaction')}} </h2>
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
                        <th>{{ translate_menuTransaction('Date')}}</th>
                        <th>{{ Translate_menuPlayers('Gold Coins')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td><a href="{{ route('detailResellerTransaction', [$tr->monthnumber,$tr->year]) }}">{{ $tr->monthname }} {{ $tr->year }}</a></td>
                        <td>{{ number_format($tr->totalgold, 2) }}</td>
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
			"oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
		},
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: true
	});
</script>
<!--- End Show After Serach --->

<!--- Show After Click Month --->
@elseif(Request::is('Reseller/Reseller-Transaction/Report_Transaction/ReportTransaction-search*'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>{{ TranslateReseller('Report Transaction')}}</h2>
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
                        <th>{{ TranslateReseller('L_ORDER_ID') }}</th>
                        <th>{{ TranslateReseller('L_USERNAME') }}</th>
                        <th>{{ TranslateReseller('L_ITEM_NAME') }}</th>
                        <th>{{ TranslateReseller('L_QUANTITY') }}</th>
                        <th>{{ TranslateReseller('L_PRICE_ITEM') }}</th>
                        <th>{{ TranslateReseller('L_BONUS_ITEM') }}</th>
                        <th>{{ TranslateReseller('L_CONFIRMATION_REQUEST') }}</th>
                        <th>{{ TranslateReseller('L_DATE_REQUEST') }}</th>
                        <th>{{ TranslateReseller('L_DATE_APPROVE_DECLINE') }}</th>
                        <th>{{ TranslateReseller('L_INFORMATION_DETAIL') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td>{{ $tr->user_id }}</td>
                        <td>{{ $tr->username }}</td>
                        <td>{{ $tr->item_name }}</td>
                        <td>{{ $tr->quantity }}</td>
                        <td>{{ $tr->item_price }}</td>
                        {{-- <td>{{ $tr->gold }}</td> --}}
                        <td></td>
                        <td>
                            @if($tr->status == 2)
                                <span style="color:green">{{ TranslateMenuToko('Success') }}</span>
                            @elseif($tr->status == 0)
                                <span style="color:red">{{ TranslateMenuToko('Decline') }}</span>
                            @endif
                        </td>
                        <td>{{ date("d-m-Y H:i:s", strtotime($tr->datetime)) }}</td>
                        <td>{{ date("d-m-Y H:i:s", strtotime($tr->action_date)) }}</td>
                        <td>
                            <button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $tr->id }}">{{ translate_MenuTransaction('Detail Info') }}</button>
                        </td>
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
        "bSort" : false,
		"autoWidth" : true,
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
<!--- End Show After Click Month --->
@endsection