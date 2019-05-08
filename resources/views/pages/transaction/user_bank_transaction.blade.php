@extends('index')


@section('sidebarmenu')
@include('menu.menutransaction')    
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="table-aii">
            <div class="table-header">
                Request Transactions
            </div>
            <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th class="th-sm"></th>
                </tr>
                </thead>
                <tbody>
                        {{-- @foreach($admin as $adm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <div class="col">
            <div class="table-aii">
                <div class="table-header">
                    Request Transaction
                </div>
                <table id="dt-material-checkbox" class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="th-sm"></th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($admin as $adm) --}}
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection