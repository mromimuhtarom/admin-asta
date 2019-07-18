@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Table_Domino_QQ') }}">Games > Domino QQ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Table_Domino_QQ') }}">Table</a></li>
@endsection


@section('content')

  <!-- Response Status -->
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
  <!-- End Response Status -->

  <!-- Form Table -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-table"></i> Asta Domino QQ Table</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              @if($menu && $mainmenu && $submenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"> Create New Table</i>
              </button>
              @endif
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>
        
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  @if($menu && $mainmenu && $submenu)
                  <th></th>
                  @endif
                  <th class="th-sm">Nama Table</th>
                  <th class="th-sm">Group</th>
                  <th class="th-sm">Max Player</th>
                  <th class="th-sm">Game State</th>
                  <th class="th-sm">Current Turn Seat ID</th>
                  <th class="th-sm">Total Bet</th>
                  @if($menu && $mainmenu && $submenu)
                  <th class="th-sm">Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($tables as $tb)
                @if($menu && $mainmenu && $submenu)
                  <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $tb->table_id }}"></td>
                    <td><a href="#" class="usertext" data-title="Table Name" data-name="name" data-pk="{{ $tb->table_id }}" data-type="text" data-url="{{ route('DominoQTable-update')}}">{{ $tb->name }}</a></td>
                    <td><a href="#" class="room" data-title="Room name" data-name="room_id" data-pk="{{ $tb->table_id }}" data-type="select" data-url="{{ route('DominoQTable-update')}}">{{ $tb->roomname }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Player" data-name="max_player" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoQTable-update')}}">{{ $tb->max_player }}</a></td>
                    <td><a href="#" class="usertext" data-title="Game State" data-name="game_state" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoQTable-update')}}">{{ $tb->game_state }}</a></td>
                    <td><a href="#" class="usertext" data-title="Current Turn Seat ID" data-name="current_turn_seat_id" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoQTable-update')}}">{{ $tb->current_turn_seat_id }}</a></td>
                    <td><a href="#" class="usertext" data-title="Total Bet" data-name="total_bet" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoQTable-update')}}">{{ $tb->total_bet }}</a></td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $tb->table_id }}" id="delete" data-pk="{{ $tb->table_id }}" data-toggle="modal" data-target="#delete-table"><i class="fa fa-times"></i></a></td>
                  </tr>
                  @else 
                  <tr>
                      <td>{{ $tb->name }}</td>
                      <td>{{ $tb->roomname }}</td>
                      <td>{{ $tb->max_player }}</td>
                      <td>{{ $tb->game_state }}</td>
                      <td>{{ $tb->current_turn_seat_id }}</td>
                      <td>{{ $tb->total_bet }}</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  <!-- End Form Table -->

  <!-- Modal create data -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Table</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('DominoQTable-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="tableName" placeholder="Table Name" required="">
                </div>
                <div class="form-group">
                  <select class="custom-select" name="category">
                    <option selected>Select Category</option>
                    @foreach ($category as $ct)
                      <option value="{{ $ct->room_id }}">{{ $ct->name }} &nbsp; &nbsp; &nbsp; Min-Max Buy {{ $ct->min_buy }} - {{ $ct->max_buy }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary">
              <i class="fa fa-save"></i> Save
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i> Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal -->

  <!-- Modal delete data -->
  <div class="modal fade" id="delete-table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          Are You Sure Want To Delete It
          <form action="{{ route('DominoQTable-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="tableid" id="tableid" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <!-- End Modal delete data -->

  <!-- Script -->
  <script type="text/javascript">

    $(document).ready(function() {
        $('table.table').dataTable( {
          "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
          "pagingType": "full_numbers",
        });
      });

    table = $('table.table').dataTable({
      "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
      "autoWidth" : true,
      "paging": false,
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

        @php
          foreach($tables as $tb) {
            echo'$(".delete'.$tb->table_id.'").hide();';
            echo'$(".deletepermission'.$tb->table_id.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$tb->table_id.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$tb->table_id.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$tb->table_id.'").hide();';
              echo'}';

            echo '});';
          
            echo'$(".delete'.$tb->table_id.'").click(function(e) {';
              echo'e.preventDefault();';

              echo"var id = $(this).attr('data-pk');";
              echo'var test = $("#tableid").val(id);';
            echo'});';
          }
        @endphp

        $('.usertext').editable({
          mode :'inline'
        });

        $('.room').editable({
          value: '',
          mode: 'inline',
          source: [
            {value: '', text: 'Choose Category'},
            @php
            foreach($category as $ct) {
            echo '{value:"'.$ct->room_id.'", text: "'.$ct->name.' Min Max Buy '.$ct->min_buy.' - '.$ct->max_buy.'" },';
            }
            @endphp
          ]
        });
      },
      responsive: true
    });
    
  </script>
@endsection