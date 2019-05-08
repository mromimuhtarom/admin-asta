@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
<div class="menugame">
  @include('menu.nama_game')
</div>
    <div class="table-aii">
        <div class="table-header">
                Jackpot Paytable
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Multiplier</th>
                <th class="th-sm">Win Type</th>
                <th class="th-sm">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($jackpot_paytable as $pay)
                <tr>
                    <td></td>
                    <td>{{ $pay->title }}</td>
                    <td>{{ $pay->multiplier }}</td>
                    <td>{{ $pay->key }}</td>
                    <td>Delete</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>   
@endsection