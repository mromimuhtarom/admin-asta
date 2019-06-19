@extends('index')



@section('content')
{{-- <div class="menugame border-bottom border-dark">
  @include('menu.nama_game')
</div> --}}
    <div class="table-aii">
        <div class="table-header">
                Find Room
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Table Name</th>
                <th class="th-sm">Originated</th>
                <th class="th-sm">Game Type</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Min Buy</th>
                <th class="th-sm">Max Buy</th>
                <th class="th-sm">Seat</th>
                <th class="th-sm">Speed</th>
                <th class="th-sm">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                {{-- @foreach ($jackpot_paytable as $pay) --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
          </table>
         
    </div>   
@endsection