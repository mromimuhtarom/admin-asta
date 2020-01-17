@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Store') }}">{{ TranslateMenuToko('Store')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Store') }}">{{ TranslateMenuToko('Report store')}}</a></li>
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
                @if(Request::is('Store/Report_Store/ReportStore-search*'))
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
                @endif

                @if(Request::is('Store/Report_Store/ReportStore-search*'))
                <div class="col">
                    <select name="chooseitem" id="" class="form-control">
                        <option value="">Choose item</option>
                        <option value="{{ $type[0] }}" @if( $chooseitem == $type[0] ) selected @endif>{{ $type[1] }}</option>
                        <option value="{{ $type[2] }}" @if( $chooseitem == $type[2] ) selected @endif>{{ $type[3] }}</option>
                        <option value="{{ $type[4] }}" @if( $chooseitem == $type[4] ) selected @endif>{{ $type[5] }}</option>
                    </select>
                </div>
                @else
                <div class="col">
                    <select name="chooseitem" id="" class="form-control">
                        <option value="">Choose item</option>
                        <option value="{{ $type[0] }}">{{ $type[1] }}</option>
                        <option value="{{ $type[2] }}">{{ $type[3] }}</option>
                        <option value="{{ $type[4] }}">{{ $type[5] }}</option>
                    </select>
                </div>
                @endif

                @if(Request::is('Store/Report_Store/ReportStore-search*'))
                <div class="col">
                    <input type="date" class="form-control" name="dari" value="{{ $minDate }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="sampai" value="{{ $maxDate }}">
                </div>
                @else
                <div class="col">
                    <input type="date" class="form-control" name="dari" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
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
                        <th>{{ Translate_menuPlayers('Player ID')}}</th>
                        <th>{{ Translate_menuPlayers('Username')}}</th>
                        <th>{{ translate_menu('Item')}}</th>
                        <th>{{ Translate_menuTransaction('Quantity')}}</th>
                        <th>{{ translate_MenuContentAdmin('Description')}}</th>
                        <th>{{ translate_menuTransaction('Price')}}</th>
                        {{-- <th>Bonus Item</th> --}}
                        <th>{{ Translate_menuPlayers('Status')}}</th>
                        <th>{{ TranslateMenuToko('Date Request')}}</th>
                        <th>{{ TranslateMenuToko('Date approve and Decline')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td>{{ $tr->user_id }}</td>
                        <td>{{ $tr->username }}</td>
                        <td>{{ $tr->item_name }}</td>
                        <td>{{ $tr->quantity }}</td>
                        <td>{{ $tr->description }}</td>
                        @if ($tr->item_type == 1)
                        <td>{{ $tr->item_price }}</td>
                        @elseif($tr->item_type == 2)
                        <td> {{ number_format($tr->item_price) }}</td>
                        @elseif($tr->item_type == 3)
                        <td>{{ $tr->item_price }} Point</td>
                        @endif
                        {{-- <td></td> --}}
                        <td>{{ strStatusApdec($tr->status) }}</td>
                        <td>{{ $tr->datetime }}</td>
                        <td>{{ $tr->action_date }}</td>
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