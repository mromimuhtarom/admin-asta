@extends('index')

@section('page')
    <li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></>
    <li class="breadcrumb-item"><a href="{{ route('Players_Level') }}">{{ Translate_menuPlayers('Players level') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Players_Level') }}">{{ Translate_menuPlayers('Players level') }}</a></li>
@endsection

@section('content')

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

<div class="settings-table">
  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>{{ Translate_menuPlayers('Players level') }}</strong></h2>	
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:700px;">
            
            <div class="table-outer">
                <div class="widget-body-toolbar">
        
                  <div class="row">
                    
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalLevel">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create player level') }}
                        </button>
                      </div>
                    </div>
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ translate_MenuContentAdmin('Select All')}}</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Players level') }}</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Experience') }} (Xp)</th>
                    <th align="center">
                      <a  href="#" style="color:red;font-weight:bold;" 
                        class="delete" 
                        id="trash" 
                        data-toggle="modal" 
                        data-target="#deleteAll">
                        <i class="fa fa-trash-o"></i>
                      </a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($playerslevel as $level)
                        <tr>
                          <td><input type="checkbox" name="deletepermission[]" id="deletepermission[]"data-pk="{{ $level->level }}" class="deleteplayerslevel{{ $level->level }} deleteIdAll"></td>
                          <td><a href="#" class="inlinelevel" data-name="level" data-title="level" data-pk="{{ $level->level }}" data-type="text" data-url="{{ route('playerslevel_update') }}">{{ $level->level}}</a></td>
                          <td><a href="#" class="inlinelevel" data-name="experience" data-title="experience" data-pk="{{ $level->level }}" data-type="text" data-url="{{ route('playerslevel_update') }}">{{ number_format($level->experience)}}</a></td>
                          <td>
                            <a  href="#" style="color:red;" class="delete{{ $level->level }}" 
                              id="delete" 
                              data-pk="{{ $level->level }}" 
                              data-toggle="modal" 
                              data-target="#deletelevel-modal">
                              <i class="fa fa-times"></i>
                            </a>
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
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>{{ Translate_menuPlayers('Player Rank') }}</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:700px;">
            
            <div class="table-outer">

                <div class="row">
                    
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalRank">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create Rank Player') }}
                        </button>
                      </div>
                    </div>
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th><input id="checkAllrank" type="checkbox" name="deletepermissionrank" class="deletepermissionrank">&nbsp; &nbsp;{{ translate_MenuContentAdmin('Select All')}}</th>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Players level') }}</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Level') }}</th>
                    <th>
                      <a  href="#" style="color:red;font-weight:bold;" 
                        class="deleterank" 
                        id="trashrank" 
                        data-toggle="modal" 
                        data-target="#deleteAllrank">
                        <i class="fa  fa-trash-o"></i>
                      </a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($playersrank as $rank)
                        <tr>
                          <td><input type="checkbox" name="deletepermissionrank[]" id="deletepermissionrank[]"data-pk="{{ $rank->id }}" class="deleteplayersrank{{ $rank->id }} deleteIdAllrank"></td>
                          <td>{{ $rank->id }}</td>
                          <td><a href="#" class="inlinelevel" data-name="name" data-title="name" data-pk="{{ $rank->id }}" data-type="text" data-url="{{ route('playersrank_update') }}">{{ $rank->name }}</a></td>
                          <td><a href="#" class="inlinelevel" data-name="level" data-title="level" data-pk="{{ $rank->id }}" data-type="text" data-url="{{ route('playersrank_update') }}">{{ $rank->level }}</a></td>
                          <td>
                            <a  href="#" style="color:red;" class="deleterank{{ $rank->id }}" 
                              id="deleterank" 
                              data-pk="{{ $rank->id }}" 
                              data-toggle="modal" 
                              data-target="#deleterank-modal">
                              <i class="fa fa-times"></i>
                            </a>
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
  </div>

  
</div>

<!-- Modal -->
<div class="modal fade" id="ModalLevel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ Translate_menuPlayers('Create player level') }}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('playerslevel_create') }}" method="post">
        @csrf
        <div class="modal-body">
  
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" name="level" placeholder="Level" required=""><br>
                <input type="text" class="form-control" name="experience" placeholder="Experience" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i> {{ Translate_menuPlayers('Save') }}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ Translate_menuPlayers('Cancel') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Create Modal -->


<!-- Modal -->
<div class="modal fade" id="ModalRank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ Translate_menuPlayers('Create Rank Player') }}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('playersrank_create') }}" method="post">
        @csrf
        <div class="modal-body">
  
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name Rank" required=""><br>
                <input type="text" class="form-control" name="level"  placeholder="Level" requeired="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i> {{ Translate_menuPlayers('Save') }}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ Translate_menuPlayers('Cancel') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Create Modal -->


  <!-- Modal DELETE level -->
  <div class="modal fade" id="deletelevel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('playerslevel_delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="level" id="level" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('No')}}</button>
          </div>
            </form>
        </div>
      </div>
  </div>
  <!--End modal delete -->

  <!-- Modal DELETE rank -->
  <div class="modal fade" id="deleterank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('playersrank_delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" id="rank" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('No')}}</button>
          </div>
            </form>
        </div>
      </div>
  </div>
  <!--End modal delete -->



    <!-- Modal DELETE ALL Level-->
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
            <form action="{{ route('playerslevel_deleteall') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
                  <input type="hidden" name="levelAll" id="levelAll" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success delete_all"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> {{ translate_MenuContentAdmin('No')}}</button>
          </div>
            </form>
        </div>
      </div>
    </div>


    <!-- Modal DELETE ALL rank-->
    <div class="modal fade" id="deleteAllrank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form action="{{ route('playersrank_deleteall') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
                  <input type="hidden" name="id" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success delete_all"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> {{ translate_MenuContentAdmin('No')}}</button>
          </div>
            </form>
        </div>
      </div>
    </div>


<script>

  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[10, 10, 20, -1], [10, 10, 20, "All"]],
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

    $("#trashrank").hide();
    //CHECK ALL
    $('#checkAllrank').on('click', function(e) {
      if($(this).is(':checked',true))  
      {
        $(".deleteIdAllrank").prop('checked', true);
        $("#trashrank").show();  
      } else {  
        $(".deleteIdAllrank").prop('checked',false);
        $("#trashrank").hide();  
      }  
    });


  });

  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
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

      $('.inlinelevel').editable({
            mode :'inline',
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            }
      });

      @php
        foreach($playerslevel as $level) {
          echo'$(".delete'.$level->level.'").hide();';
          echo'$(".deleteplayerslevel'.$level->level.'").on("click", function() {';
            echo 'if($( ".deleteplayerslevel'.$level->level.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$level->level.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$level->level.'").hide();';
            echo'}';
  
          echo '} );';
          
          echo'$(".delete'.$level->level.'").click(function(e) {';
            echo'e.preventDefault();';
  
            echo"var id = $(this).attr('data-pk');";
            echo'var test = $("#level").val(id);';
          echo'});';
        }
      @endphp

        $('.delete').click(function(e) {
          e.preventDefault();
              var allVals = []; 
              $(".deleteIdAll:checked").each(function() {  
                  allVals.push($(this).attr('data-pk'));
                  var join_selected_values = allVals.join(","); 
                  $("#levelAll").val(join_selected_values);
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


      @php
        foreach($playersrank as $rank) {
          echo'$(".deleterank'.$rank->id.'").hide();';
          echo'$(".deleteplayersrank'.$rank->id.'").on("click", function() {';
            echo 'if($( ".deleteplayersrank'.$rank->id.':checked" ).length > 0)';
            echo '{';
              echo '$(".deleterank'.$rank->id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".deleterank'.$rank->id.'").hide();';
            echo'}';
  
          echo '} );';
          
          echo'$(".deleterank'.$rank->id.'").click(function(e) {';
            echo'e.preventDefault();';
  
            echo"var id = $(this).attr('data-pk');";
            echo'var test = $("#rank").val(id);';
          echo'});';
        }
      @endphp
        $('.deleterank').click(function(e) {
          e.preventDefault();
              var allVals = []; 
              $(".deleteIdAllrank:checked").each(function() {  
                  allVals.push($(this).attr('data-pk'));
                  var join_selected_values = allVals.join(","); 
                  $("#id").val(join_selected_values);
              }); 
        }); 
        
        $("#trashrank").hide();
        $(".deleteIdAllrank").click(function(e) {
          if( $(".deleteIdAllrank:checked").length > 1) {
            $("#trashrank").show();
          } else {
            $("#trashrank").hide();
          }
        });
     
    },
    responsive: false
  });

</script>
@endsection