@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
    <link rel="stylesheet" href="/css/admin.css">

      {{-- <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!-- end delete notification -->




    <div class="table-aii">
        <div class="footer-table">
              <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                  <i class="fas fa-plus-circle"></i>Create Role Admin
              </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
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
          </table>
         
      </div>    

      <script>
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
</script> --}}




    
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Create Push Notification</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        ×
      </button>
    </div>
    <form action="" method="post">
      @csrf
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="Title" required=""><br>
              <textarea name="message" id="" class="form-control" cols="30" rows="10">Please Enter The message</textarea><br>
              {{-- <select name="game" class="form-control">
                <option value="">Select Game</option>
                @foreach ($game as $gm)
                <option value="{{ $gm->id }}">{{ $gm->name }}</option>
                @endforeach
              </select><br> --}}
              {{-- <select name="game" class="form-control">
                  <option value="">Select Type</option>
                  @foreach ($game as $gm)
                  <option value="{{ $gm->id }}">{{ $gm->name }}</option>
                  @endforeach
              </select> --}}
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


<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
<header>
  <div class="widget-header">	
    <h2><strong>Push Notification</strong></h2>				
  </div>
</header>

<div>
  
  <div class="jarviswidget-editbox">
    <input class="form-control" type="text">
    <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
    
  </div>
  
  <div class="widget-body">
    <div class="widget-body-toolbar">
      
      <div class="row">
        
        <div class="col-9 col-sm-5 col-md-5 col-lg-5">
          <div class="input-group">
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"></i>
              </button>
          </div>
        </div>
        <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
          
          {{-- <button class="btn sa-btn-success">
            <i onclick="addBots()" class="fa fa-plus"></i> <span class="hidden-mobile">Add New Row</span>
          </button> --}}
          
        </div>
        
      </div>
      
        

    </div>
    
    <div class="custom-scroll table-responsive" style="height:800px;">
      
      <div class="table-outer">
        <table class="table table-bordered">
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
                <td><a href="#" style="color:red;" class="delete{{ $role->role_id }}" id="delete" data-pk="{{ $role->role_id }}" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a></td>
                {{-- <td>
                  <a href="#" style="color:red;" class="delete{{ $notification->id }}" 
                  id="delete" 
                  data-pk="{{ $notification->id }}" 
                  data-toggle="modal" 
                  data-target="#delete-modal">
                    <i class="fa fa-times"></i>
                  </a>
                </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    
    </div>
  
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form action="" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes">Yes</button>
        <button type="button" class="button_example-no" data-dismiss="modal">No</button>
      </div>
        </form>
    </div>
  </div>
</div>
  
<script type="text/javascript">
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
    });
  });

  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
    "paging": false,
    "autoWidth" : true,
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

      $('.usertext').editable({
        mode :'inline'
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
            echo'var test = $("#id").val(id);';
          echo'});';
        }
      @endphp
    },
    responsive: true
  });

</script>

      
@endsection