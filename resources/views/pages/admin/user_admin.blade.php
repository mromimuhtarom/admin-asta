@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
    
    @if (\Session::has('alert'))
    <div class="alert alert-danger">
        <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
        </div>
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
        <form action="{{ route('UserAdmin-create') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="username" required><br>
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required><br>
                  <select name="role" class="form-control" required>
                    <option>Pilih Role</option>
                    @foreach($role as $rl)
                    <option value="{{ $rl->role_id}}">{{ $rl->name}}</option>
                    @endforeach
                  </select><br>
                  {{-- <input type='file' onchange="readURL(this);" /><br><br>
                  <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /> --}}
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
  {{-- end create --}}


  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong>User Admin</strong></h2>				
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
                    <th class="th-sm"></th>
                    <th class="th-sm">Image</th>
                    <th class="th-sm">Username</th>
                    <th class="th-sm">Full Name</th>
                    <th class="th-sm">Role Type</th>
                    <th class="th-sm">Reset Password</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>                      
                @foreach($admin as $adm)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $adm->operator_id }}"></td>
                    <td></td>
                    <td><a href="#" class="usertext" data-name="username" data-title="Username" data-pk="{{ $adm->operator_id }}" data-type="text" data-url="{{ route('UserAdmin-update') }}">{{ $adm->username }}</a></td>
                    <td><a href="#" class="usertext" data-name="fullname" data-title="Full Name" data-pk="{{ $adm->operator_id }}" data-type="text" data-url="{{ route('UserAdmin-update') }}">{{ $adm->fullname }}</a></td>
                    <td><a href="#" class="role" data-name="role_id" data-title="Role" data-pk="{{ $adm->operator_id }}" data-type="select" data-url="{{ route('UserAdmin-update') }}">{{ $adm->name }}</a></td>
                    <td><a href="#" class="password{{ $adm->operator_id }} btn btn-primary" id="password" data-pk="{{ $adm->operator_id }}" data-toggle="modal" data-target="#reset-password">Reset Password</a></td>
                    <td> 
                      <a href="#" style="color:red;" class="delete{{ $adm->operator_id }}" 
                        id="delete" 
                        data-pk="{{ $adm->operator_id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                        </td>
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
            <form action="{{ route('UserAdmin-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="userid" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes">Yes</button>
            <button type="button" class="button_example-no" data-dismiss="modal">No</button>
          </div>
            </form>
        </div>
      </div>
    </div>


  {{-- reset password --}}
  <div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              × 
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('UserAdmin-updatepassword') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="userid" id="userid" value="">
              <input type="password" class="form-control" name="password" placeholder="Password" value="" required/>
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes">Reset Password</button>
            <button type="button" class="button_example-no" data-dismiss="modal">No</button>
          </div>
            </form>
        </div>
      </div>
    </div>

  
  {{-- end reset password --}}
      
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

          $('.role').editable({
                    mode:'inline',
                    value: 2,
                    source: [
                        @php
                        $roles = DB::table('adm_role')->get();
                        foreach($roles as $role) {
                            echo '{value:"'.$role->role_id.'", text: "'.$role->name.'"}, ';
                        }
                        @endphp
                    ]
          });

          @php
              foreach($admin as $adm) {            
              echo'$(".password'.$adm->operator_id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#userid").val(id);';
              echo'});';
            }
          @endphp

          @php
              foreach($admin as $adm) {
              echo'$(".delete'.$adm->operator_id.'").hide();';
              echo'$(".deletepermission'.$adm->operator_id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$adm->operator_id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$adm->operator_id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$adm->operator_id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$adm->operator_id.'").click(function(e) {';
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