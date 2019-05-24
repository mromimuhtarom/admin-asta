@extends('index')

@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection

@section('content')

<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Bot</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Bots-create') }}" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="text" name="username" placeholder="username" required>
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
          <form action="{{ route('UserAdmin-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="userid" id="userid" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="button_example-yes">Yes</button>
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
                    <i class="fas fa-plus-circle"></i>Create Bots
                 </button>
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
        <thead class="th-table">
          <tr>
            <th></th>
            <th class="th-sm">Username</th>
            <th class="th-sm">Bank Account</th>
            <th class="th-sm">Rank</th>
            <th class="th-sm">Gold</th>
            <th class="th-sm">Country</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach($bots as $bot)
            <tr>
                <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $bot->user_id }}"></td>
                <td>{{ $bot->username }}</td>
                <td><a href="#" class="usertext" data-title="Bank Account" data-name="chip" data-pk="{{ $bot->user_id }}" data-type="text" data-url="{{ route('Bots-update') }}">{{ $bot->chip }}</td>
                <td>{{ $bot->rank_id}}</td>
                <td>{{ $bot->gold }}</td>
                <td>{{ $bot->name }}</td>
                <td><a href="#" style="color:red;" class="delete{{ $bot->user_id }}" id="delete" data-pk="{{ $bot->user_id }}" data-toggle="modal" data-target="#delete"><i class="fas fa-times"></i></a></td>
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
                  foreach($bots as $bot) {
                    echo'$(".delete'.$bot->user_id.'").hide();';
                    echo'$(".deletepermission'.$bot->user_id.'").on("click", function() {';
                      echo 'if($( ".deletepermission'.$bot->user_id.':checked" ).length > 0)';
                      echo '{';
                        echo '$(".delete'.$bot->user_id.'").show();';
                      echo'}';
                      echo'else';
                      echo'{';
                        echo'$(".delete'.$bot->user_id.'").hide();';
                      echo'}';
          
                    echo '});';
                
                  echo'$(".delete'.$bot->user_id.'").click(function(e) {';
                    echo'e.preventDefault();';

                    echo"var id = $(this).attr('data-pk');";
                    echo'var test = $("#userid").val(id);';
                  echo'});';
                }
              @endphp

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
  });
</script> 
@endsection