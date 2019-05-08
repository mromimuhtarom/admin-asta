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
                Tournament
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Type</th>
                <th class="th-sm">Start Time</th>
                <th class="th-sm">Buy In</th>
                <th class="th-sm">Entry fee</th>
                <th class="th-sm">Min Players</th>
                <th class="th-sm">Max Players</th>
                <th class="th-sm">Rebuys</th>
                <th class="th-sm">Late Entry</th>
                <th class="th-sm">Structure</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Registered</th>
                <th class="th-sm">Playing</th>
                <th class="th-sm">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($tournaments as $tournament)
                <tr>
                    <td></td>
                    <td>{{ $tournament->title }}</td>
                    <td>{{ $tournament->strGameType() }}</td>
                    <td>{{ $tournament->timeLabel }}</td>
                    <td>{{ $tournament->buyIn }}</td>
                    <td>{{ $tournament->entryFee }}</td>
                    <td>{{ $tournament->minPlayers }}</td>
                    <td>{{ $tournament->maxPlayers }}</td>
                    <td>{{ $tournament->rebuys }}</td>
                    <td>{{ $tournament->lateEntry }}</td>
                    <td>{{ $tournament->structureId }}</td>
                    <td>{{ $tournament->strStatus }}</td>
                    <td>{{ $tournament->registeredPlayers }}</td>
                    <td>{{ $tournament->activePlayers }}</td>
                    <td>view detail</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>   
@endsection