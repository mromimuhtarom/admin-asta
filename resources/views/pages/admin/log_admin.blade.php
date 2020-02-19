@extends('index')


@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Log_Admin') }}">{{ translate_MenuContentAdmin('L_ADMIN') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Log_Admin') }}">{{ translate_MenuContentAdmin('Log Admin') }}</a></li>
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
        <form action="{{ route('Log-search') }}">
            <div class="row h-100 w-100">
                @if(Request::is('Admin/Log_Admin/Log-search*'))
                    <div class="col">
                        <input type="text" name="username" class="left" placeholder="username / Admin ID" value="{{ $searchUser }}">
                    </div>
                    <div class="col">
                        <select name="action" id="" class="form-control">
                            <option value="">{{ translate_MenuContentAdmin('L_CHOOSE_ACTION') }}</option>
                            @foreach($actionSearch as $action)
                            <option value="{{ $action->id }}" @if($inputAction == $action->id) selected @endif;>{{ translate_MenuContentAdmin($action->action) }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    <div class="col">
                        <input type="date" class="form-control" name="dari" value="{{ $minDate }}">
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="sampai" value="{{ $maxDate }}">
                    </div>
                @else
                <div class="col">
                    <input type="text" name="username" class="left" placeholder="username / Admin ID">
                </div>
                <div class="col">
                    <select name="action" id="" class="form-control">
                        <option value="">{{ translate_MenuContentAdmin('L_CHOOSE_ACTION') }}</option>
                        @foreach($actionSearch as $action)
                        <option value="{{ $action->id}}">{{ translate_MenuContentAdmin($action->action) }}</option>
                        @endforeach
                    </select>
                </div>   
                <div class="col">
                    <input type="date" class="form-control" name="dari" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="sampai" value="{{ $datenow->toDateString() }}">
                </div>
                @endif
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i>{{ translate_MenuContentAdmin('L_SEARCH') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


@if(Request::is('Admin/Log_Admin/Log-search*'))
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">

    <header>
        <div class="widget-header">
            <span class="widget-icon"> <i class="fa fa-history"></i> </span>
            <h2>{{ translate_MenuContentAdmin('Log Admin') }}</h2>
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
                        <th>{{ translate_MenuContentAdmin('L_ADMIN_ID') }}</th>
                        <th>{{ translate_MenuContentAdmin('L_USERNAME') }}</th>
                        <th>{{ translate_MenuContentAdmin('L_ACTION') }}</th>
                        <th>{{ translate_MenuContentAdmin('L_DATE') }}</th>
                        <th>{{ translate_MenuContentAdmin('L_DESCRIPTION') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->op_id }}</td>
                        <td>{{ $log->username }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->datetime }}</td>
                        <td>{{ $log->desc }}</td>
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
        tablet: 1024,
        phone: 480
    };

    $('#dt_basic').dataTable({
        "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'>r>" +
            "t" +
            "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
        "autoWidth": true,
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
        },
        "lengthMenu": [
            [20, 25, 50, -1],
            [20, 25, 50, "All"]
        ],
        "pagingType": "full_numbers",
        "order": [
            [2, "desc"]
        ],
        classes: {
            sWrapper: "dataTables_wrapper dt-bootstrap4"
        },
        responsive: false
    });

</script>
@endif
@endsection
