@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i
            class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Active_Players') }}">{{ Translate_menuPlayers('Players') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('Active_Players') }}">{{ Translate_menuPlayers('Active Players') }}</a></li>
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
<!--- End Warnign Alert --->

<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('ActivePlayers-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                @if (Request::is('Players/Active_Players/Active-search*'))
                    <div class="col">
                        <input type="text" class="left" name="inputPlayer" placeholder="username/Player ID" value="{{ $inputPlayer }}">
                    </div>
                    <div class="col">
                        <select name="inputRegisterType" class="form-control">
                            <option value="">{{ Translate_menuPlayers('Choose Register Type') }}</option>
                            <option value="{{ $explodetype[0]}}"@if($registerType == $explodetype[0]) selected @endif;>{{ Translate_menuPlayers($explodetype[1]) }}</option>
                            <option value="{{ $explodetype[2]}}"@if($registerType == $explodetype[2]) selected @endif;>{{ Translate_menuPlayers($explodetype[3]) }}</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:3%;">
                        <select name="inputGame" class="form-control">
                            <option value="">{{ Translate_menuPlayers('Choose Game') }}</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}" @if($inputGame == $gm->id) selected @endif;>{{ $gm->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                @else 
                    <div class="col">
                        <input type="text" class="left" name="inputPlayer" placeholder="username/Player ID">
                    </div>
                    <div class="col">
                        <select name="inputRegisterType" class="form-control">
                            <option value="">{{ Translate_menuPlayers('Choose Register Type') }}</option>
                            <option value="{{ $explodetype[0]}}">{{ Translate_menuPlayers($explodetype[1]) }}</option>
                            <option value="{{ $explodetype[2]}}">{{ Translate_menuPlayers($explodetype[3]) }}</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:3%;">
                        <select name="inputGame" class="form-control">
                            <option value="">{{ Translate_menuPlayers('Choose Game') }}</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}">{{ $gm->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="col" style="padding-left:1%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--- End Content Search ---> 

@if (Request::is('Players/Active_Players/Active-search*'))


<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
    <header>
        <div class="widget-header">
            <span class="widget-icon"> <i class="fa fa-group"></i> </span>
            <h2></i>{{ Translate_menuPlayers('Players Online') }}</h2>
        </div>

        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
        </div>
    </header>

    <!-- widget div-->
    <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->

        <!-- widget content -->
        <div class="widget-body p-0">
            <div class="custom-scroll table-responsive" style="max-height: 600px;">
                <div class="table-outer">

                    <table id="online-players" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>{{ Translate_menuPlayers('Player ID') }}</th>
                                <th>{{ Translate_menuPlayers('Playername') }}</th>
                                <th>{{ Translate_menuPlayers('Level') }}</th>
                                <th>{{ Translate_menuPlayers('Chip') }}</th>
                                <th>{{ Translate_menuPlayers('Gold Coins') }}</th>
                                <th>{{ Translate_menuPlayers('From') }}</th>
                                <th>{{ Translate_menuPlayers('Playing Games') }}</th>
                                <th>{{ Translate_menuPlayers('Table Name') }}</th>
                                <th>{{ Translate_menuPlayers('Timestamp') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activePlayer as $ol)
                            <tr>
                                <td>{{ $ol->user_id }}</td>
                                <td>{{ $ol->username }}</td>
                                <td>{{ $ol->rank_name }}</td>
                                <td>{{ number_format($ol->chip, 2) }}</td>
                                <td>{{ number_format($ol->gold, 2) }}</td>
                                <td>{{ $ol->strUser_type() }}</td>
                                <td>{{ $ol->game_name }}</td>
                                @php
                                $tpktable = App\TpkTable::where('table_id', '=', $ol->table_id)->select('name as tablename')->first();
                                $bgttable = App\BigTwoTable::where('table_id', '=', $ol->table_id)->select('name as tablename')->first();
                                $dmstable = App\DominoSusunTable::where('table_id', '=', $ol->table_id)->select('name as tablename')->first();
                                $dmqtable = App\DominoQTable::where('table_id', '=', $ol->table_id)->select('name as tablename')->first();
                                @endphp
                                @if ($ol->game_id == 101)

                                <td>{{ $tpktable['tablename'] }}</td>

                                @elseif($ol->game_id == 102)

                                <td>{{ $bgttable['tablename'] }}</td>

                                @elseif($ol->game_id == 103)

                                <td>{{ $dmstable['tablename'] }}</td>

                                @elseif($ol->game_id == 104)

                                <td>{{ $dmqtable['tablename'] }}</td>

                                @else
                                <td>Null</td>
                                @endif
                                <td>{{ $ol->date_login}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end widget content -->
    </div>
    <!-- end widget div -->
</div>


<script type="text/javascript">
    table = $('table.table').dataTable({
        "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'f>r>" +
            "t" +
            "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
        "lengthMenu": [
            [20, 25, 50, -1],
            [20, 25, 50, "All"]
        ],
        "pagingType": "full_numbers",
        "autoWidth": true,
        "searching": false,
        "classes": {
            "sWrapper": "dataTables_wrapper dt-bootstrap4"
        },
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
        },
        buttons: [{
            extend: 'colvis',
            text: 'Show / hide columns',
            className: 'btn btn-default',
            columnText: function (dt, idx, title) {
                return title;
            }
        }],
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
