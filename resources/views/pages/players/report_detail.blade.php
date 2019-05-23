@extends('index')

@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection


@section('content')
    <div class="table-aii">
        <div class="table-header">
            <form action="{{ route('Report-search') }}" method="get" role="search">
                <div class="row">
                    <div class="col">
                        <input type="text" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col">
                        <select name="inputGame">
                            <option>Choose Game</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}">{{ $gm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="date" name="inputMinDate">
                    </div>
                    <div class="col">
                        <input type="date" name="inputMaxDate">
                    </div>
                    <div class="col">
                        <button class="myButton" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>     
    
        <div class="table-aii" style=" display: table; width: auto;">
            <div class="table-header">
                    Report
            </div>
             <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Username</th>
                    <th class="th-sm">Playing Game</th>
                    <th class="th-sm">Table</th>
                    <th class="th-sm">Seat</th>
                    <th class="th-sm">Card</th>
                    <th class="th-sm">Table Card</th>
                    <th class="th-sm">Bet</th>
                    <th class="th-sm">Win Amount</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">Time Stamp</th>
                    <th class="th-sm">Country</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($player_history as $history)
                    <tr>
                      <td></td>
                      <td>{{ $history->username }}</td>
                      <td>{{ $history->gamename }}</td>
                      <td>{{ $history->tablename }}</td>
                      <td>{{ $history->seat }}</td>
                      <td>{{ $history->cards }}</td>
                      <td>{{ $history->tablecards }}</td>
                      <td>{{ $history->bet }}</td>
                      <td>{{ $history->winAmount }}</td>
                      <td>{{ $history->status }}</td>
                      <td>{{ $history->ts }}</td>
                      <td>{{ $history->countryname }}</td>
                      <td></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
             
        </div>
<script>
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
      });
</script>
@endsection