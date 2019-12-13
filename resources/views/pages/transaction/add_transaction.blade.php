@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i
            class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a
        href="{{ route('Banking_Transactions') }}">{{ translate_MenuTransaction('Transaction') }}</a></li>
<li class="breadcrumb-item"><a
        href="{{ route('Banking_Transactions') }}">{{ translate_MenuTransaction('Banking Transaction') }}</a></li>
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
        <form action="{{ route('TransactionPlayers-search')}}">
            <div class="row h-100 w-100">
                <div class="col">
                     <input type="text" name="inputPlayer" class="left" placeholder="username/Player ID">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if (Request::is('Players/Transaction_Players/Banking-search*'))
{{-- @if ($time == "today") --}}
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false"
    data-widget-editbutton="false">

    <header>
        <div class="widget-header">
            <h2><strong>{{ translate_MenuTransaction('Bank Transaction') }} {{ ucwords($lang_id) }}</strong></h2>
        </div>
    </header>

    <div>
        <div class="widget-body">
            <div class="custom-scroll table-responsive">

                <div class="table-outer">
                    <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover"
                        width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                               <td></td>
                               <td></td>
                               <td></td>
                           </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- End daily gift transactions -->

<script>
    $(document).ready(function () {
        $('table.table').dataTable({
            "lengthMenu": [
                [20, 25, 50, -1],
                [20, 25, 50, "All"]
            ],
            "order": [
                [5, "desc"]
            ]
        });
    });

    $('form input[type="date"]').prop("disabled", true);
    $("#time").click(function (e) {
        e.preventDefault();

        if ($(this).val() == 'today') {
            @php
            echo 'var minDate = $("#minDate").val("'.$datenow.
            '");';
            echo 'var maxDate = $("#maxDate").val("'.$datenow.
            '");';
            @endphp
            $('form input[type="date"]').prop("readonly", true);
            $('form input[type="date"]').prop("disabled", false);

        } else if ($(this).val() == 'week') {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("disabled", true);

        } else if ($(this).val() == 'month') {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("disabled", true);

        } else if ($(this).val() == '') {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("disabled", true);

        } else {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("readonly", false);
            $('form input[type="date"]').prop("disabled", false);
        }
    });

    table = $('table.table').dataTable({
        "sDom": "t" + "<'dt-toolbar-footer d-flex test'>",
        "autoWidth": true,
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

        },
        responsive: false
    });

</script>
@endif

<script>
    // $('#time').change(function(){
    //   if($(this).val() == 'today'){ // or this.value == 'volvo'
    // 		// $("#minDate").disa();
    // 		$('form input[type="date"]').prop("disabled", true);
    //   }
    // });

    $('form input[type="date"]').prop("disabled", true);
    $("#time").click(function (e) {
        e.preventDefault();

        if ($(this).val() == 'today') {
            @php
            echo 'var minDate = $("#minDate").val("'.$datenow.
            '");';
            echo 'var maxDate = $("#maxDate").val("'.$datenow.
            '");';
            @endphp
            $('form input[type="date"]').prop("readonly", true);
            $('form input[type="date"]').prop("disabled", false);

        } else if ($(this).val() == 'week') {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("disabled", true);

        } else if ($(this).val() == 'month') {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("disabled", true);

        } else if ($(this).val() == '') {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("disabled", true);

        } else {
            var minDate = $("#minDate").val("");
            var maxDate = $("#maxDate").val("");
            $('form input[type="date"]').prop("readonly", false);
            $('form input[type="date"]').prop("disabled", false);
        }
    });

</script>
@endsection
