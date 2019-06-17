@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('ResellerTransaction-view') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ResellerTransaction-view') }}">Reseller Transaction</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="search bg-blue-dark" style="margin-bottom: 2%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('ResellerTransaction-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col">
                    <input type="text" name="inputUsername" class="form-control" placeholder="username" required>
                </div>
                <div class="col" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMinDate">
                </div>
                <div class="col" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMaxDate">
                </div>
                <div class="col" style="padding-left:1%;">
                    <button class="myButton" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>    



<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Reseller Transaction</h2>
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
                        <th>Username</th>
                        <th>Price</th>
                        <th>Gold</th>
                        <th>Gold Bonus</th>
                        <th>TimeStamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tr)
                    <tr>
                        <td>{{ $tr->username }}</td>
                        <td>{{ $tr->price }}</td>
                        <td>{{ $tr->gold }}</td>
                        <td>{{ $tr->gold_bonus }}</td>
                        <td>{{ $tr->timestamp }}</td>
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
		classes: {
		    sWrapper:      "dataTables_wrapper dt-bootstrap4"
		},
		responsive: true
	});
</script>
@endsection