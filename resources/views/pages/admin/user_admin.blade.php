@extends('index')



@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
  <li class="breadcrumb-item"><a href="{{ route('User_Admin') }}">{{ translate_MenuContentAdmin('Admin') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('User_Admin') }}">{{ translate_MenuContentAdmin('User Admin')}}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
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

    @if (\Session::has('alert'))
        <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
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
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> {{ translate_MenuContentAdmin('Create User Admin')}} </h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('UserAdmin-create') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="nama pengguna" required><br>
                  <input type="text" class="form-control" name="fullname" placeholder="nama lengkap" required><br>
                  <select name="role" class="form-control" required>
                    <option>{{ translate_MenuContentAdmin('Choose Role')}}</option>
                    @foreach($role as $rl)
                    <option value="{{ $rl->role_id}}">{{ $rl->name}}</option>
                    @endforeach
                  </select><br>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i> {{ translate_MenuContentAdmin('Save')}}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i> {{ translate_MenuContentAdmin('Cancel')}}
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
        <h2><strong><i class="fa fa-user"></i> {{ translate_MenuContentAdmin('User Admin')}}</strong></h2>				
      </div>
    </header>
  
    <div>
      
      <div class="jarviswidget-editbox">
        <input class="form-control" type="text">
        <span class="note"><i class="fa fa-check text-success"></i> {{ translate_MenuContentAdmin('Change title to update and save instantly!')}}</span>
        
      </div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          
          <div class="row">
            
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              <div class="input-group">
                @if($menu && $mainmenu)
                  <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-plus"></i> {{ translate_MenuContentAdmin('Create New User')}}
                  </button>
                  @endif
              </div>
            </div>
            <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
              
              
            </div>
            
          </div>
          
            
  
        </div>
        
        <div id="frm-testing" class="custom-scroll table-responsive" style="height:800px;">
          
          <div class="table-outer">
            <table id="testing" class="table table-bordered">
              <thead>
                <tr>
                    @if($menu && $mainmenu)
                    <th width="100px"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ translate_MenuContentAdmin('Select All')}}</th>
                    @endif
                    <th class="th-sm">{{ translate_MenuContentAdmin('Username')}}</th>
                    <th class="th-sm">{{ translate_MenuContentAdmin('Full Name')}}</th>
                    <th class="th-sm">{{ translate_MenuContentAdmin('Role Type')}}</th>
                    @if($menu && $mainmenu)
                    <th class="th-sm">{{ translate_MenuContentAdmin('Reset Password')}}</th>
                    <th align="center" ">
                        <a  href="#" style="color:red;font-weight:bold;" 
                        class="delete" 
                        id="trash" 
                        data-toggle="modal" 
                        data-target="#deleteAll">
                              <i class="fa  fa-trash-o"></i>
                          </a>
                        </th> 

                      @endif
                </tr>
              </thead>
              <tbody>                      
                @foreach($admin as $adm)
                @if($menu && $mainmenu)
                <tr>
                    <td align="center"><input type="checkbox" name="deletepermission[]" id="deletepermission[]"data-pk="{{ $adm->op_id }}" class="deletepermission{{ $adm->op_id }} deleteIdAll"></td>
                    <td><a href="#" class="usertext" data-name="username" data-title="Username" data-pk="{{ $adm->op_id }}" data-type="text" data-url="{{ route('UserAdmin-update') }}">{{ $adm->username }}</a></td>
                    <td><a href="#" class="usertext" data-name="fullname" data-title="Full Name" data-pk="{{ $adm->op_id }}" data-type="text" data-url="{{ route('UserAdmin-update') }}">{{ $adm->fullname }}</a></td>
                    <td><a href="#" class="role" data-name="role_id" data-title="Role" data-pk="{{ $adm->op_id }}" data-type="select" data-url="{{ route('UserAdmin-update') }}">{{ $adm->name }}</a></td>
                    <td><a href="#" class="password{{ $adm->op_id }} btn btn-primary" id="password" data-pk="{{ $adm->op_id }}" data-toggle="modal" data-target="#reset-password"><i class="fa fa-key"></i> {{ translate_MenuContentAdmin('Reset Password')}}</a></td>
                    <td align="center"> 
                      <a  href="#" style="color:red;" class="delete{{ $adm->op_id }}" 
                        id="delete" 
                        data-pk="{{ $adm->op_id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                      </a>
                        </td>
                </tr>
                @else 
                <tr>
                    <td>{{ $adm->username }}</td>
                    <td>{{ $adm->fullname }}</td>
                    <td>{{ $adm->name }}</td>
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

  <!-- Modal DELETE -->
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> {{ translate_MenuContentAdmin('Delete Data')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            {{ translate_MenuContentAdmin('Are You Sure Want To Delete It?')}}
            <form action="{{ route('UserAdmin-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="userid" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('No')}}</button>
          </div>
            </form>
        </div>
      </div>
    </div>


    <!-- Modal DELETE ALL-->
    <div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ translate_MenuContentAdmin('Delete all selected Data')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            {{ translate_MenuContentAdmin('Are You Sure Want To Delete all selected?')}}
            <form action="{{ route('UserAdmin-DeleteAllSelected') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
                  <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success delete_all"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> {{ translate_MenuContentAdmin('No')}}</button>
          </div>
            </form>
        </div>
      </div>
    </div>

  {{-- reset password --}}
  <div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> {{ translate_MenuContentAdmin('Reset Password')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('UserAdmin-updatepassword') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="userid" id="userid" value="">
              <input type="password" class="form-control" name="password" placeholder="Password" value="" required/>
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-primary submit-data"><i class="fa fa-key"></i>{{ translate_MenuContentAdmin('Reset Password')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('No')}}</button>
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
        "pagingType": "full_numbers",
      });

      $("#trash").hide();
      //CHECK ALL
      $('#checkAll').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".deleteIdAll").prop('checked', true);
                $("#trash").show();  
            } else {  
                $(".deleteIdAll").prop('checked',false);
                $("#trash").hide();  
            }  
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
          mode :'inline',
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          }
        });

        $('.role').editable({
          mode:'inline',
          source: [
                {value: '', text: 'Choose Role Type'},
                  @php
                    $roles = DB::table('asta_db.adm_role')->get();
                    foreach($roles as $role) {
                      echo '{value:"'.$role->role_id.'", text: "'.$role->name.'"}, ';
                    }
                  @endphp
          ],
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          }
        });

        @php 
            foreach($admin as $adm) {            
            echo'$(".password'.$adm->op_id.'").click(function(e) {';
              echo'e.preventDefault();';
  
              echo"var id = $(this).attr('data-pk');";
              echo'var test = $("#userid").val(id);';
            echo'});';
          }
        @endphp
        
        @php
            foreach($admin as $adm) {
            echo'$(".delete'.$adm->op_id.'").hide();';
            echo'$(".deletepermission'.$adm->op_id.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$adm->op_id.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$adm->op_id.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$adm->op_id.'").hide();';
              echo'}';
  
            echo '} );';
          
            echo'$(".delete'.$adm->op_id.'").click(function(e) {';
              echo'e.preventDefault();';
  
              echo"var id = $(this).attr('data-pk');";
              echo'var test = $("#id").val(id);';
            echo'});';
          }
        @endphp

        $('.delete').click(function(e) {
          e.preventDefault();
              var allVals = []; 
              $(".deleteIdAll:checked").each(function() {  
                  allVals.push($(this).attr('data-pk'));
                  var join_selected_values = allVals.join(","); 
                  $("#idDeleteAll").val(join_selected_values);
                  console.log('dfjvhdfk');
              }); 
        }); 
        
        $("#trash").hide();
        $(".deleteIdAll").click(function(e) {
          if( $(".deleteIdAll:checked").length > 1) {
            $("#trash").show();
          } else {
            $("#trash").hide();
          }
        });
      },
      responsive: false
    });
  
  </script>
@endsection