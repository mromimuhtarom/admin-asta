@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
{{-- <div class="menugame border-bottom border-dark">
  @include('menu.nama_game')
</div> --}}



  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Tournament</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="text" name="title" placeholder="Title Tournament" required><br>
          <select name="type">
            <option>Pilih Type</option>
            <option value=""></option>
          </select><br>
          <input type="date" name="starttime">  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
 
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all as $error)
          <li>{{$error}}</li>  
          @endforeach
      </ul>
  </div>
      
  @endif
  
  @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{\Session::get('success')}}</p>
      </div>
      
  @endif



    <div class="table-aii" style=" display: table; width: auto;">
        <div class="table-header">
                Tournament  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                              <i class="fas fa-plus-circle"></i>Create Tournament
                            </button>
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
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $tournament->tournamentId }}" data-type="text" data-url="{{ route('Tournament-update') }}">{{ $tournament->title }}</a></td>
                    <td><a href="#" class="gametype" data-title="Type" data-name="gameType" data-pk="{{ $tournament->tournamentId }}" data-type="select" data-url="{{ route('Tournament-update') }}">{{ $tournament->strGameType() }}</td>
                    <td>{{ $tournament->timeLabel }}</td>
                    <td><a href="#" class="usertext" data-title="Buy In" data-name="buyIn" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->buyIn }}</a></td>
                    <td><a href="#" class="usertext" data-title="Entry Fee" data-name="entryFee" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->entryFee }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Players" data-name="minPlayers" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->minPlayers }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Players" data-name="maxPlayers" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->maxPlayers }}</a></td>
                    <td><a href="#" class="usertext" data-title="rebuys" data-name="rebuys" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->rebuys }}</a></td>
                    <td><a href="#" class="usertext" data-title="Late Entry" data-name="lateEntry" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->lateEntry }}</a></td>
                    <td><a href="#" class="usertext" data-title="Late Entry" data-name="structureId" data-pk="{{ $tournament->tournamentId }}" data-type="number" data-url="{{ route('Tournament-update') }}">{{ $tournament->structureId }}</a></td>
                    <td><a href="#" class="status" data-title="Status" data-name="status" data-pk="{{ $tournament->tournamentId }}" data-type="select" data-url="{{ route('Tournament-update') }}" data-value="{{ $tournament->status }}">{{ $tournament->strStatus }}</a></td>
                    <td>{{ $tournament->registeredPlayers }}</td>
                    <td>{{ $tournament->activePlayers }}</td>
                    <td>view detail</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div> 
    <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
  
      });
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
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });


              $('.gametype').editable({
                mode :'inline',
                value: 'POT',
                source: [
                  {value: 'NL', text: 'No Limit'},
                  {value: 'POT', text: 'Pot Limit'}
                ]
              });

              $('.status').editable({
                mode: 'inline',
                value: 0,
                source: [
                  {value: 'A', text: 'Announced'},
                  {value: 'R', text: 'Registering'},
                  {value: 'P', text: 'Playing'},
                  {value: 'F', text: 'Finished'},
                  {value: 'C', text: 'Cancelled'}
               ]
              });
    
          }
      });
  </script>   
@endsection