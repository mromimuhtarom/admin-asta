@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Add_Transaction_Reseller') }}">{{ translate_menu('L_RESELLER') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Add_Transaction_Reseller') }}">{{ translate_menu('L_RESELLER_TRANSACTION') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Add_Transaction_Reseller') }}">{{ translate_menu('L_ADD_TRANSACTION_RESELLER') }}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!----------- Warning Alert ---------->
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

@if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>  
@endif
<!--------End Warning Alert ---------->

<!---- Content Search ---->
<div class="searchguest bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('Add_Transaction_Reseller-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                @if (Request::is('Reseller/Reseller-Transaction/Add_Transaction_Reseller/AddTransactionReseller-search*'))
                <div class="col" align="right">
                    <input type="text" id="username" class="form-control" name="inputPlayer" placeholder="{{ TranslateReseller('Username / Reseller ID') }}" value="{{ $getUsername }}">
                </div>
                @else
                <div class="col" align="right">
                    <input type="text" id="username" class="form-control" name="inputPlayer" placeholder="{{ TranslateReseller('Username / Reseller ID') }}">
                </div> 
                @endif;
                <div class="col" style="padding-left:2%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!---- End Content Search ----->

@if (Request::is('Reseller/Reseller-Transaction/Add_Transaction_Reseller/AddTransactionReseller-search*'))
{{-- @if ($time == "today") --}}
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false"
    data-widget-editbutton="false">

    <header>
        <div class="widget-header">
            <h2><strong> Add Transaction </strong></h2>
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
                                <th><a href="{{ route('Add_Transaction_Reseller-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller.reseller_id">{{ TranslateReseller('L_RESELLER_ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.reseller.reseller_id') }}"></i></a></th>
                                <th><a href="{{ route('Add_Transaction_Reseller-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller.username">{{ Translate_menuPlayers('Username') }}<i class="fa fa-sort{{ iconsorting('asta_db.reseller.username') }}"></i></a></th>
                                <th width="20%"><a href="{{ route('AddTransaction-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.reseller.gold">{{ TranslateReseller('Gold') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.chip') }}"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($add_transaction as $transaction)
                            <tr>
                                <td>{{ $transaction->reseller_id }}</td>
                                <td>{{ $transaction->username }}</td>
                                <td>
                                    <a href="#"data-toggle="modal" data-target="#modalChip{{ $transaction->reseller_id }}">{{ number_format($transaction->gold, 2) }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="display: flex;justify-content: center;">{{ $add_transaction->links() }}</div>
            </div>

        </div>
    </div>
</div>
<!-- End daily gift transactions -->


@foreach ($add_transaction as $transaction)

<!-- Modal Insert -->
<div class="modal fade" id="modalChip{{ $transaction->reseller_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i
                    class="fa fa-plus-square"></i>{{ TranslateReseller('Add Transaction Gold') }}</h4>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
            <form action="{{ route('Add_Transaction_Reseller-update') }}" method="post">
                @csrf
                <div class="modal-body">
                    <table width="100%" border="1" style="margin-bottom:25px;">
                        <tr>
                            <td width="20%">{{ TranslateReseller('L_RESELLER_ID') }}</td>
                            <td width="5%">:</td>
                            <td width="75%">{{ $transaction->reseller_id }}</td>
                        </tr>
                        <tr>
                            <td>{{ TranslateReseller('L_USERNAME') }}</td>
                            <td>:</td>
                            <td>{{ $transaction->username }}</td>
                        </tr>
                        <tr>
                            <td>{{ TranslateReseller('Gold') }}</td>
                            <td>:</td>
                            <td>{{ $transaction->gold }}</td>
                        </tr>
                    </table>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="operator_aritmatika" value="+">
                                <input type="hidden" name="agen_id" value="{{ $transaction->reseller_id }}">
                                <input type="hidden" name="columnname" value="chip">
                                <input type="number" name="currency" placeholder="{{ TranslateReseller('Gold') }}" class="form-control" required><br>
                                <select name="type" class="form-control" id="">
                                    @foreach ($actblnc as $key => $act)
                                        <option value="{{ $key }}">{{ ConfigTextTranslate($act) }}</option>
                                    @endforeach
                                </select><br>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="{{ TranslateReseller('Reason Gold') }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn sa-btn-primary submit-data">
                        <i class="fa fa-save"></i> {{ Translate_menuPlayers('Save') }}
                    </button>
                    <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                        <i class="fa fa-remove"></i> {{ Translate_menuPlayers('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Insert -->
   
@endforeach

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


    table = $('table.table').dataTable({
        "sDom": "t" + "<'dt-toolbar-footer d-flex test'>",
        "autoWidth": true,
        "paging": false,
        "ordering": false,
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
@endsection
