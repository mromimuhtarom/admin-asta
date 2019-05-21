@extends('index')

@section('sidebarmenu')
    @include('menu.menuplayer')
@endsection


@section('content')
<div class="row">
    <div class="col">
        <div class="table-aii" style=" display: table; width: auto;">
          <div class="table-header">
              Players Online
          </div>
          <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">User Player</th>
                <th class="th-sm">Rank</th>
                <th class="th-sm">Chip</th>
                <th class="th-sm">Gold Coins</th>
                <th class="th-sm">From</th>
                <th class="th-sm">Playing Games</th>
                <th class="th-sm">Table</th>
                <th class="th-sm">Device</th>
                <th class="th-sm">Date</th>
                <th class="th-sm">Time</th>                
              </tr>
            </thead>
            <tbody>
                @foreach($online as $ol)
                <tr>
                    <td></td>
                    <td>{{ $ol->username }}</td>
                    <td>{{ $ol->rank_id }}</td>
                    <td>{{ $ol->chip }}</td>
                    <td>{{ $ol->gold }}</td>
                    @php
                    if($ol->user_type === 2) {
                        $user_type = 'Guest';
                    } else if($ol->facebook_id !== ''){
                        $user_type = 'Facebook';
                    } else if($ol->user_type === 1) {
                        $user_type = 'Register';
                    }
                    @endphp
                    <td>{{ $user_type }}</td>
                    <td>{{ $ol->game_name }}</td>
                    <td></td>
                    <td>{{ $ol->devicename }}</td>
                    @php
                    $date = new DateTime($ol->date_login);                        
                    @endphp
                    <td>{{  $date->format("Y-m-d") }}</td>
                    @php
                    $time = strtotime($ol->date_login)    
                    @endphp
                    <td>{{ date("H:i:s", $time)}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>      
    </div>
    <div class="col">
        <div class="table-aii" style=" display: table; width: auto;">
          <div class="table-header">
              Players Offline
          </div>
          <table id="dt-material-checkbox" class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">User Player</th>
                <th class="th-sm">Rank</th>
                <th class="th-sm">Chip</th>
                <th class="th-sm">Gold Coins</th>
                <th class="th-sm">From</th>
                <th class="th-sm">Table</th>
                <th class="th-sm">Device</th>
                <th class="th-sm">Date</th>
                <th class="th-sm">Time</th>                
              </tr>
            </thead>
            <tbody>
                @foreach($offline as $of)
                <tr>
                    <td></td>
                    <td>{{ $of->username }}</td>
                    <td>{{ $of->rank_id }}</td>
                    <td>{{ $of->chip }}</td>
                    <td>{{ $of->gold }}</td>
                    @php
                    if($of->user_type === 2) {
                        $user_type = 'Guest';
                    } else if($of->facebook_id !== ''){
                        $user_type = 'Facebook';
                    } else if($of->user_type === 1) {
                        $user_type = 'Register';
                    }
                    @endphp
                    <td>{{ $user_type }}</td>
                    <td></td>
                    <td>{{ $of->name }}</td>
                    @php
                    $date = new DateTime($of->date_login);                        
                    @endphp
                    <td>{{  $date->format("Y-m-d") }}</td>
                    @php
                    $time = strtotime($of->date_login)    
                    @endphp
                    <td>{{ date("H:i:s", $time)}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div> 
    </div>
</div>
<script>
      table = $('table.table').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
      });
</script>    
@endsection