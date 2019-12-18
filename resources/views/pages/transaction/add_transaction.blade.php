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
        <p>{{\Session::get('success')}}</p>
    </div>  
@endif
<!--------End Warning Alert ---------->

<!---- Content Search ---->
<div class="searchguest bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('AddTransaction-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col" align="right">
                    <input type="text" id="username" class="left" name="inputPlayer" placeholder="username / Player ID">
                </div>
                <div class="col" style="padding-left:2%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!---- End Content Search ----->

@if (Request::is('Transaction/Add_Transaction/AddTrasanction-search*'))
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
                                <th><a href="{{ route('AddTransaction-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.user_id">{{ Translate_menuPlayers('Player ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.user_id') }}"></i></a></th>
                                <th><a href="{{ route('AddTransaction-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('Username') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
                                <th width="20%"><a href="{{ route('AddTransaction-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.chip">{{ Translate_menuPlayers('Chip') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.chip') }}"></i></a></th>
                                <th width="20%"><a href="{{ route('AddTransaction-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.point">{{ Translate_menuPlayers('Point') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.point') }}"></i></a></th>
                                <th width="20%"><a href="{{ route('AddTransaction-search') }}?inputPlayer={{ $getUsername }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.gold">{{ Translate_menuPlayers('Gold Coins') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.gold') }}"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($add_transaction as $transaction)
                            <tr>
                                <td>{{ $transaction->user_id }}</td>
                                <td>{{ $transaction->username }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col">{{ number_format($transaction->chip, 2) }} </div>
                                        <div class="col" align="right">
                                            <button class="btn sa-btn-primary rounded-circle btn-xs" data-toggle="modal"
                                                data-target="#modalChip{{ $transaction->user_id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">{{ number_format($transaction->point, 2) }}</div>
                                        <div class="col" align="right">
                                            <button class="btn sa-btn-primary rounded-circle btn-xs" data-toggle="modal"
                                                data-target="#modalPoint{{ $transaction->user_id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">{{ number_format($transaction->gold, 2) }}</div>
                                        <div class="col" align="right">
                                            <button class="btn sa-btn-primary rounded-circle btn-xs" data-toggle="modal"
                                                data-target="#modalGold{{ $transaction->user_id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
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
<div class="modal fade" id="modalChip{{ $transaction->user_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i
                        class="fa fa-plus-square"></i>Add Transaction Chip</h4>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
            <form action="{{ route('AddTransaction-update') }}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                                <input type="hidden" name="columnname" value="chip">
                                <input type="number" name="currency" placeholder="Chip" class="form-control" required><br>
                                <select name="type" class="form-control" id="">
                                    <option value="">Select Type</option>
                                    @foreach ($actblnc as $key => $act)
                                        <option value="{{ $key }}"> {{ $act }}</option>
                                    @endforeach
                                </select>
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

<!-- Modal Insert -->
<div class="modal fade" id="modalPoint{{ $transaction->user_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>Add Transaction Point</h4>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
            <form action="{{ route('AddTransaction-update') }}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                                <input type="hidden" name="columnname" value="point">
                                <input type="number" name="currency" placeholder="Point" class="form-control" required><br>
                                <select name="type" class="form-control" id="">
                                    <option value="">Select Type</option>
                                    @foreach ($actblnc as $key => $act)
                                        <option value="{{ $key }}"> {{ $act }}</option>
                                    @endforeach
                                </select>
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


<!-- Modal Insert -->
<div class="modal fade" id="modalGold{{ $transaction->user_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i
                        class="fa fa-plus-square"></i>Add Transaction Gold</h4>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
            <form action="{{ route('AddTransaction-update') }}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{ $transaction->user_id }}">
                                <input type="hidden" name="username" value="{{ $transaction->username }}">
                                <input type="hidden" name="columnname" value="gold">
                                <input type="number" name="currency" placeholder="Gold" class="form-control" required><br>
                                <select name="type" class="form-control" id="">
                                    <option value="">Select Type</option>
                                    @foreach ($actblnc as $key => $act)
                                        <option value="{{ $key }}"> {{ $act }}</option>
                                    @endforeach
                                </select>
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

<script>
    // $('#time').change(function(){
    //   if($(this).val() == 'today'){ // or this.value == 'volvo'
    // 		// $("#minDate").disa();
    // 		$('form input[type="date"]').prop("disabled", true);
    //   }
    // });

</script>
@endsection