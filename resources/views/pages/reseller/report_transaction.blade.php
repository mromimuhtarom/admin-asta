@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Transaction') }}">{{ translate_menu('Reseller')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Transaction') }}">{{ translate_menu('Reseller-Transaction')}}</a></li>
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
                    <input type="text" name="inputUsername" class="left" placeholder="username / Reseller ID" required>
                </div>
                <div class="col" style="padding-left:3%;">
                    <select name="choosedate" id="" class="form-control">
                        <option value="">{{ TranslateMenuToko('Choose type date')}}</option>
                        <option value="approvedecline">{{ TranslateMenuToko('Date approve and Decline')}}</option>
                        <option value="request">{{ TranslateMenuToko('Date Request')}}</option>
                    </select>
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                </div>
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
                        <th>Koin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td><a href="{{ route('detailResellerTransaction', [$tr->monthnumber,$tr->year]) }}">{{ $tr->monthname }} {{ $tr->year }}</a></td>
                        <td>{{ $tr->totalgold }}</td>
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
                        <th>{{ TranslateReseller('Reseller ID')}}</th>
                        <th>{{ Translate_menuPlayers('Username')}}</th>
                        <th>{{ translate_menu('Item')}}</th>
                        <th>{{ translate_menuTransaction('Quantity')}}</th>
                        <th>{{ TranslateMenuItem('Price')}}</th>
                        {{-- <th>Gold</th> --}}
                        {{-- <th>Gold Bonus</th> --}}
                        <th>{{ TranslateMenuToko('Bonus Item')}}</th>
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
                        <td>{{ $tr->item_price }}</td>
                        {{-- <td>{{ $tr->gold }}</td> --}}
                        <td></td>
                        @php
                        if($tr->status == 2)
                        {
                            $status = 'Approve';
                        } else if($tr->status == 0)
                        {
                            $status = "Decline";
                        }
                        @endphp
                        <td>{{ $status }}</td>
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