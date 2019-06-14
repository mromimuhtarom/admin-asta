@extends('index')


@section('sidebarmenu')
@include('menu.menuplayer');
@endsection

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Chip-view') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Chip-view') }}">Chip Player</a></li>
@endsection

@section('content')
    <div class="searching bg-blue-dark">
        
        <!-- widget content -->
        <div class="widget-body">

            <form class="form" action="{{ route('Chip-search') }}" method="get" role="search">
                <div class="btn-input-group">
                    <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                </div>
                <div class="btn-input-group">
                    <input type="date" name="inputMinDate" class="form-control">
                </div>
                <div class="btn-input-group">
                    <input type="date" name="inputMaxDate" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>

            </form>

        </div>
        <!-- end widget content -->
    </div>

<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Chip Players </h2>
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
                        <th>Action</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Total</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($balancedetails as $bd)

                    <tr class="gradeX">
                        <td>{{ $bd->username }}</td>
                        <td>{{ $bd->action }}</td>
                        <td>{{ $bd->debit }}</td>
                        <td>{{ $bd->credit }}</td>
                        <td>{{ $bd->total }}</td>
                        <td>{{ $bd->timestamp }}</td>
                    </tr>
    
    
                    @endforeach
                </tbody>
            </table>
    
        </div>
        <!-- end widget content -->
                    
    </div>`
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
        "sDom": "<'dt-toolbar d-flex'<'ml-auto hidden-xs show-control'l>r>"+
            "t"+
            "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
            "autoWidth" : true,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
        },
        classes: {
            sWrapper:      "dataTables_wrapper dt-bootstrap4"
        },
        responsive: true
    });
</script>
@endsection