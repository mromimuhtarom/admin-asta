@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">{{ translate_menu('L_ADMIN') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">{{ translate_menu('L_ROLE_ADMIN') }}</a></li>
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
      <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ translate_MenuContentAdmin('L_CREATE_ROLE_ADMIN') }}</h4>
      <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="fa fa-remove"></i>
      </button>
    </div>
    <form action="{{ route('Role-create') }}" method="post">
      @csrf
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <input type="text" class="form-control" name="rolename" placeholder="Nama Role"><br>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn sa-btn-primary submit-data">
         <i class="fa fa-save"></i>{{ translate_MenuContentAdmin('L_SAVE') }}
        </button>
        <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
          <i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('L_CANCEL') }}
        </button>
      </div>
    </form>
  </div>
</div>
</div>


<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
<header>
  <div class="widget-header">	
    <h2><strong><i class="fa fa-list"></i>{{ translate_MenuContentAdmin('L_ROLE_ADMIN') }}</strong></h2>				
  </div>
</header>

<div>
  
  <div class="widget-body">
    <div class="widget-body-toolbar">
      
      <div class="row">
        
        <div class="col-9 col-sm-5 col-md-5 col-lg-5">
          <div class="input-group">
            @if($menu && $mainmenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"></i>{{ translate_MenuContentAdmin('L_CREATE_ROLE_ADMIN') }}
              </button>
            @endif
          </div>
        </div>
        <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
          
        </div>

      </div>
      
        

    </div>
    
    <div class="custom-scroll table-responsive" style="height:800px;">
      
      <div class="table-outer">
        <table class="table table-bordered">
          <thead>
            <tr>
                @if($menu && $mainmenu)
                <th class="th-sm" width="100px"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp;&nbsp;{{ translate_MenuContentAdmin('L_SELECT_ALL') }}</th>
                @endif
                <th class="th-sm">{{ translate_MenuContentAdmin('L_ROLE_NAME') }}</th>
                @if($menu && $mainmenu)
                <th class="th-sm">{{ translate_MenuContentAdmin('L_ACTION') }}</th>
                <th align="center">
                  <a href="#" style="color:red; font-weight:bold;"
                  class="delete"
                  id="trash"
                  data-toggle="modal"
                  data-target="#deleteAll">
                    <i class="fa fa-trash-o"></i>
                </a>
                </th>
                
                @endif
            </tr>
          </thead>
          <tbody>                      
            @foreach($roles as $role)
            @if($menu && $mainmenu)
            <tr>
                <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $role->role_id }}" data-rolename="{{ $role->name }}" class="deletepermission{{ $role->role_id }} deleteIdAll"></td>
                <td><a href="#" class="usertext" data-name="name" data-pk="{{ $role->role_id }}" data-type="text" data-url="{{ route('Role-update') }}">{{ $role->name }}</a></td>
                <td><a href="{{ route('Role-menu', $role->role_id) }}" class="myButton"><i class="fa fa-eye"></i>{{ translate_MenuContentAdmin('L_VIEW_EDIT') }}</a></td>
                <td align="center">
                  <a href="#" style="color:red" class="delete{{ $role->role_id }}"
                    id="delete"
                    data-pk="{{ $role->role_id }}"
                    data-toggle="modal"
                    data-target="#delete-modal">
                      <i class="fa fa-times"></i>
                  </a>
                </td>
            </tr>
            @else 
            <tr>
                <td>{{ $role->name }}</td>
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

<!-- Modal delete -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ translate_MenuContentAdmin('L_DELETE_DATA') }}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ translate_MenuContentAdmin('L_QUESTION_DELETE') }}
        <form action="{{ route('Role-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ translate_MenuContentAdmin('L_YES') }}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('L_NO') }}</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal delete -->
<div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ translate_MenuContentAdmin('L_STATEMENT_DELETE_ALL') }}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ translate_MenuContentAdmin('L_QUESTION_DELETE_ALL') }}
        <form action="{{ route('Role-DeleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
          <input type="hidden" name="rolenameAll" id="rolenameAll" value="">

      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success delete_all"><i class="fa fa-check"></i>{{ translate_MenuContentAdmin('L_YES') }}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('L_NO') }}</button>
      </div>
        </form>
    </div>
  </div>
</div>
  
<script type="text/javascript">
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
      "pagingType": "full_numbers",
    });

   
   $("#trash").hide();

    //check all
    $('#checkAll').on('click', function(e) {
    
      if($(this).is(':checked', true))
      { 
        $(".deleteIdAll").prop('checked', true);
        $("#trash").show();
      } else {
        $(".deleteIdAll").prop('checked', false);
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

      $('#trash').click(function(e){
          e.preventDefault();
            var allVals = [];
            var allrolenameVals = [];
            $(".deleteIdAll:checked").each(function() {
              allVals.push($(this).attr('data-pk'));
              var join_selected_values = allVals.join(",");
              $("#idDeleteAll").val(join_selected_values);

              allrolenameVals.push($(this).attr('data-rolename'));
              var join_selected_values_rolename = allrolenameVals.join(",");
              $("#rolenameAll").val(join_selected_values_rolename);
            });
      });

      $('#trash').hide()
      $('.deleteIdAll').click(function(e) {
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