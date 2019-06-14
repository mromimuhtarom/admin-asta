@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('BigTwoTable-view') }}">Games > Big Two</a></li>
        <li class="breadcrumb-item"><a href="{{ route('BigTwoTable-view') }}">Table</a></li>
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
        <h2><strong>Asta Big Two Table</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"> Create New Table</i>
              </button>
              @endif
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>
        
        <div class="custom-scroll table-responsive" style="max-height:600px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  @if($menu)
                  <th></th>
                  @endif
                  <th class="th-sm">Nama Table</th>
                  <th class="th-sm">Group</th>
                  <th class="th-sm">Max Player</th>
                  <th class="th-sm">Turn</th>
                  <th class="th-sm">Total Bet</th>
                  @if($menu)
                  <th class="th-sm">action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($tables as $tb)
                @if($menu)
                  <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $tb->tableid }}"></td>
                    <td><a href="#" class="usertext" data-title="Table Name" data-name="name" data-pk="{{ $tb->tableid }}" data-type="text" data-url="{{ route('BigTwoTable-update')}}">{{ $tb->name }}</a></td>
                    <td><a href="#" class="room" data-title="Room name" data-name="roomid" data-pk="{{ $tb->tableid }}" data-type="select" data-url="{{ route('BigTwoTable-update')}}">{{ $tb->roomname }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Player" data-name="max_player" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('BigTwoTable-update')}}">{{ $tb->max_player }}</a></td>
                    <td><a href="#" class="usertext" data-title="Turn" data-name="turn" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('BigTwoTable-update')}}">{{ $tb->turn }}</a></td>
                    <td><a href="#" class="usertext" data-title="Total Bet" data-name="total_bet" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('BigTwoTable-update')}}">{{ $tb->total_bet }}</a></td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $tb->tableid }}" id="delete" data-pk="{{ $tb->tableid }}" data-toggle="modal" data-target="#delete-table"><i class="fa fa-times"></i></a></td>
                  </tr>
                  @else 
                  <tr>
                      <td>{{ $tb->name }}</td>
                      <td>{{ $tb->roomname }}</td>
                      <td>{{ $tb->max_player }}</td>
                      <td>{{ $tb->turn }}</td>
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
          <h4 class="modal-title" id="myModalLabel">Create Table</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        <form action="{{ route('BigTwoTable-create') }}" method="post">
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
                      <option value="{{ $ct->roomid }}">{{ $ct->name }} &nbsp; &nbsp; &nbsp; Min-Max Buy {{ $ct->min_buy }} - {{ $ct->max_buy }}</option>
                    @endforeach
                  </select>
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
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal -->

  <!-- Modal delete data -->
  <div class="modal fade" id="delete-table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            ×
          </button>
        </div>
        <div class="modal-body">
          Are You Sure Want To Delete It
          <form action="{{ route('BigTwoTable-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="tableid" id="tableid" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes">Yes</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
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
            echo'$(".delete'.$tb->tableid.'").hide();';
            echo'$(".deletepermission'.$tb->tableid.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$tb->tableid.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$tb->tableid.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$tb->tableid.'").hide();';
              echo'}';

            echo '});';
          
            echo'$(".delete'.$tb->tableid.'").click(function(e) {';
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
            echo '{value:"'.$ct->roomid.'", text: "'.$ct->name.' Min Max Buy '.$ct->min_buy.' - '.$ct->max_buy.'" },';
            }
            @endphp
          ]
        });
      },
      responsive: true
    });
    
  </script>
@endsection