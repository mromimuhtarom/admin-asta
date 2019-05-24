@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')


  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Table-create') }}" method="POST">
          {{  csrf_field() }}
          <div class="modal-body">
            <input type="text" name="tableName" placeholder="Table Name"><br>
            <select name="category">
              <option>Select Category</option>
              @foreach ($category as $ct)
              <option value="{{ $ct->roomid }}">{{ $ct->name }} &nbsp; &nbsp; &nbsp; Min-Max Buy {{ $ct->min_buy }} - {{ $ct->max_buy }}</option>
              @endforeach
            </select>
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



  <!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="margin-top:5%;">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are You Sure Want To Delete It
        <form action="{{ route('Table-delete') }}" method="post">
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
  {{-- end delete notification --}}




    <div class="table-aii">
        <div class="footer-table">
                     <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                        <i class="fas fa-plus-circle"></i>Create Table
                      </button>
        </div>


          <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th></th>
                <th class="th-sm">Nama Table</th>
                <th class="th-sm">Group</th>
                <th class="th-sm">Max Player</th>
                <th class="th-sm">Small Blind</th>
                <th class="th-sm">Big Blind</th>
                <th class="th-sm">Jackpot</th>
                <th></th>
              </tr>
            </thead>   
            <tbody>
                @foreach($tables as $tb)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $tb->tableid }}"></td>
                    <td><a href="#" class="usertext" data-title="Table Name" data-name="name" data-pk="{{ $tb->tableid }}" data-type="text" data-url="{{ route('Table-update')}}">{{ $tb->name }}</a></td>
                    <td><a href="#" class="room" data-title="Table Name" data-name="roomid" data-pk="{{ $tb->tableid }}" data-type="select" data-url="{{ route('Table-update')}}">{{ $tb->roomname }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Player" data-name="max_player" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('Table-update')}}">{{ $tb->max_player }}</a></td>
                    <td><a href="#" class="usertext" data-title="Small Blind" data-name="small_blind" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->small_blind }}</a></td>
                    <td><a href="#" class="usertext" data-title="Big Blind" data-name="big_blind" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->big_blind }}</a></td>
                    <td><a href="#" class="usertext" data-title="Jackpot" data-name="jackpot" data-pk="{{ $tb->tableid }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->jackpot }}</a></td>
                    <td><a href="#" style="color:red;" class="delete{{ $tb->tableid }}" id="delete" data-pk="{{ $tb->tableid }}" data-toggle="modal" data-target="#delete"><i class="fas fa-times"></i></a></td>
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
                mode :'popup'
              });
              
              $('.room').editable({
  				      value: '',
  				      source: [
                  {value: '', text: 'Choose Category'},
                  @php
                  foreach($category as $ct) {
                  echo '{value:"'.$ct->roomid.'", text: "'.$ct->name.' Min Max Buy '.$ct->min_buy.' - '.$ct->max_buy.'" },';
                  }
                  @endphp
  				      ]
              });
              // $('.role').editable({
              //       value: 2,
              //       source: [
              //           @php
              //           $roles = DB::table('adm_role')->get();
              //           foreach($roles as $role) {
              //               echo '{value:"'.$role->role_id.'", text: "'.$role->name.'"}, ';
              //           }
              //           @endphp
              //       ]
              //   });
          }
      });
  </script>
@endsection