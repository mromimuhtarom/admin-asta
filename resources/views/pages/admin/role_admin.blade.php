@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
    <link rel="stylesheet" href="/css/admin.css">

      <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="margin-top:5%;">
        <h5 class="modal-title" id="exampleModalLabel">Create Role Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        {{  csrf_field() }}
      <div class="modal-body">
        <input type="text" name="rolename" placeholder="Role Name" required>
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
            <input type="hidden" name="roleid" id="roleid" value="">
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
        <div class="table-header">
          <span>User Admin</span>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
            <i class="fas fa-plus-circle"></i><span>Create Role Admin</span>
          </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Role</th>
                <th class="th-sm">Action</th>
                <th style="width:2px;"></th>
              </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $role->role_id }}"></td>
                    <td></td>
                    <td>{{ $role->name }}</td>
                    <td><a href="#" class="myButton">View & Edit</a></td>
                    <td><a href="#" style="color:red;" class="delete{{ $role->role_id }}" id="delete" data-pk="{{ $role->role_id }}" data-toggle="modal" data-target="#delete"><i class="fas fa-times"></i></a></td>
                </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th>Name
                    </th>
                    <th>Position
                    </th>
                    <th>Office
                    </th>
                    <th colspan="2">Age
                    </th>
                    <th colspan="2">Start date
                    </th>
                </tr>
            </tfoot> --}}
          </table>
         
      </div>    

      <script>
      $(document).ready(function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        // $('#selecctall').click(function(event) { 
        //       if(this.checked) { // check select status
        //         $('.deletepermission').each(function() { 
        //           this.checked = true;  //select all 
        //         });
        //       }else{
        //         $('.deletepermission').each(function() { 
        //           this.checked = false; //deselect all             
        //         });        
        //       }
        // });
      
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

              @php
                  foreach($roles as $role) {
                    echo'$(".delete'.$role->role_id.'").hide();';
                    echo'$(".deletepermission'.$role->role_id.'").on("click", function() {';
                      echo 'if($( ".deletepermission'.$role->role_id.':checked" ).length > 0)';
                      echo '{';
                        echo '$(".delete'.$role->role_id.'").show();';
                      echo'}';
                      echo'else';
                      echo'{';
                        echo'$(".delete'.$role->role_id.'").hide();';
                      echo'}';
          
                    echo '});';
                
                  echo'$(".delete'.$role->role_id.'").click(function(e) {';
                    echo'e.preventDefault();';

                    echo"var id = $(this).attr('data-pk');";
                    echo'var test = $("#roleid").val(id);';
                  echo'});';
                }
              @endphp

              $('.usertext').editable({
                mode :'popup'
              });
             
              $('.category').editable({
                //value: 'drink',
                source: [
                  {value: 'drink', text: 'Drink'},
                  {value: 'food', text: 'Food'},
                  {value: 'emoji', text: 'Emoji'},
                ]
              }); 
    
          }
      });
</script>

      
@endsection