@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')

  <!-- Response Status -->
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
  <!-- End Response Status -->

  {{-- <h1>{{ $season }}</h1> --}}

  <!-- Form Tournament -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong>Asta Poker Tournament</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"><span> Create New Tournament</span></i>
              </button>
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>
        
        <div class="custom-scroll table-responsive" style="max-height:600px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="th-sm"></th>
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
                  <th class="th-sm"></th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach($tournaments as $tournament)
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
                @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  <!-- End Form Season -->

  <!-- Modal create data -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create New Tournament</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        {{-- <form action="{{ route('Tournament-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="titleTournament" placeholder="Title Tournamen" required>
                </div>
                <div class="form-group row">
                  <div class="col-md-10">
                    <select class="form-control" name="category">
                      <option>Select Category</option>
                      <option value="Pot Limit">Pot Limit</option>
                      <option value="No Limit">No Limit</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type="date" class="form-control" name="startTime" placeholder="Start TIme" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn sa-btn-primary">
              Save
            </button>
          </div>
        </form> --}}
      </div>
    </div>
  </div>
  <!-- End Modal -->



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
        {{-- <form action="" method="POST">
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
        </form> --}}
      </div>
    </div>
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
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
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