@extends('index')

@section('page')
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
                    @if($menu && $mainmenu)
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalLevel">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create player level') }}
                        </button>
                      </div>
                    </div>
                    @endif
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ translate_MenuContentAdmin('L_SELECT_ALL')}}</th>
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
                      @if($menu && $mainmenu)
                        <tr>
                          <td><input type="checkbox" name="deletepermission[]" id="deletepermission[]"data-pk="{{ $level->level }}" data-username="{{ $level->level }}" class="deleteplayerslevel{{ $level->level }} deleteIdAll"></td>
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
                      @else  
                        <tr>
                          <td></td>
                          <td>{{ $level->level}}</td>
                          <td>{{ number_format($level->experience)}}</td>
                          <td></td>
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
                    @if($menu && $mainmenu)
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalRank">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create Rank Player') }}
                        </button>
                      </div>
                    </div>
                    @endif
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    @if($menu && $mainmenu)
                      <th><input id="checkAllrank" type="checkbox" name="deletepermissionrank" class="deletepermissionrank">&nbsp; &nbsp;{{ translate_MenuContentAdmin('L_SELECT_ALL')}}</th>
                    @endif
                    <th class="th-sm">ID</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Players level') }}</th>
                    <th class="th-sm">{{ Translate_menuPlayers('Level') }}</th>
                    @if($menu && $mainmenu)
                      <th>
                        <a  href="#" style="color:red;font-weight:bold;" 
                          class="deleterank" 
                          id="trashrank" 
                          data-toggle="modal" 
                          data-target="#deleteAllrank">
                          <i class="fa  fa-trash-o"></i>
                        </a>
                      </th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach ($playersrank as $rank)
                      @if($menu && $mainmenu)
                        <tr>
                          <td><input type="checkbox" name="deletepermissionrank[]" data-username="{{ $rank->name }}" id="deletepermissionrank[]"data-pk="{{ $rank->id }}" class="deleteplayersrank{{ $rank->id }} deleteIdAllrank"></>
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
                      @else
                        <tr>
                          <td>{{ $rank->id }}</td>
                          <td>{{ $rank->name }}</td>
                          <td>{{ $rank->level }}</td>
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
  </div>

  
</div>

<!-- MODAL CREATE PLAYER LEVEL -->
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
                <input type="text" class="form-control required" name="level" placeholder="Level" required=""><br>
                <input type="text" class="form-control required" name="experience" placeholder="Experience" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="submit" class="btn sa-btn-primary submit-data btn-create toggle-disabled" disabled onclick="LoadingFunctionCreate()">
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


<!-- MODAL CREATE PLAYER RANK -->
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
                <input type="text" class="form-control playerrank" name="name" placeholder="Name Rank" required=""><br>
                <input type="text" class="form-control playerrank" name="level"  placeholder="Level" requeired=""">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="submit" class="btn sa-btn-primary submit-data btn-create btn-disabled" disabled onclick="LoadingFunctionCreate()">
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> {{ translate_MenuContentAdmin('L_DELETE_DATA')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            {{ translate_MenuContentAdmin('L_QUESTION_DELETE_ALL')}}
            <form action="{{ route('playerslevel_delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="level" id="level" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('L_YES')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('L_NO')}}</button>
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> {{ translate_MenuContentAdmin('L_DELETE_DATA')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            {{ translate_MenuContentAdmin('L_QUESTION_DELETE')}}
            <form action="{{ route('playersrank_delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" id="rank" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('L_YES')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ translate_MenuContentAdmin('L_NO')}}</button>
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ translate_MenuContentAdmin('L_STATEMENT_DELETE_ALL')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            {{ translate_MenuContentAdmin('L_QUESTION_DELETE_ALL')}}
            <form action="{{ route('playerslevel_deleteall') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
                  <input type="hidden" name="levelAll" id="levelAll" value="">
                  <input type="hidden" name="usernameAll" id="userDeleteAll" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success delete_all"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('L_YES')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> {{ translate_MenuContentAdmin('L_NO')}}</button>
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ translate_MenuContentAdmin('L_STATEMENT_DELETE_ALL')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <div class="modal-body">
            {{ translate_MenuContentAdmin('L_QUESTION_DELETE_ALL')}}
            <form action="{{ route('playersrank_deleteall') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
                  <input type="hidden" name="id" id="id" value="">
                  <input type="hidden" name="usernameAll" id="userAll" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success delete_all"><i class="fa fa-check"></i> {{ translate_MenuContentAdmin('L_YES')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> {{ translate_MenuContentAdmin('L_NO')}}</button>
          </div>
            </form>
        </div>
      </div>
    </div>

<script>
  //DISABLE BUTTON SAVE SEBELUM TERISI FIELD
  //MODAL CREATE PLAYER LEVEL
 $(document).on('change keyup', '.required', function(e){
   let Disabled = true;
    $(".required").each(function() {
      let value = this.value
      if ((value)&&(value.trim() != ''))
      {
        Disabled = false
      }else{
        Disabled = true
        return false
      }
    });
    
    if(Disabled){
      $('.toggle-disabled').prop('disabled', true);
    }else{
      $('.toggle-disabled').prop('disabled', false);
    }
 })

 //MODAL CREATE PLAYER RANK
 $(document).on('change keyup', '.playerrank', function(e){
   let Disabled = true;
    $(".playerrank").each(function() {
      let value = this.value
      if ((value)&&(value.trim() != ''))
      {
        Disabled = false
      }else{
        Disabled = true
        return false
      }
    });
    
    if(Disabled){
      $('.btn-disabled').prop('disabled', true);
    }else{
      $('.btn-disabled').prop('disabled', false);
    }
 })

 //loading button sesudah submit
 function LoadingFunctionCreate(){
   $('.btn-create').text("Loading");
   $(this).submit('loading').delay(1000).queue(function() {
   }); 
 }
</script>

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
              var allUsername = [];
              $(".deleteIdAll:checked").each(function() {  
                  allVals.push($(this).attr('data-pk'));
                  var join_selected_values = allVals.join(","); 
                  $("#levelAll").val(join_selected_values);

                  //untuk get nama ketika multiple delete
                  allUsername.push($(this).attr('data-username'));
                  var join_selected_username = allUsername.join(",");
                  $("#userDeleteAll").val(join_selected_username);
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
              var allUsername = [];
              $(".deleteIdAllrank:checked").each(function() {  
                  allVals.push($(this).attr('data-pk'));
                  var join_selected_values = allVals.join(","); 
                  $("#id").val(join_selected_values);

                  //untuk get name ketika delete multiple
                  allUsername.push($(this).attr('data-username'));
                  var join_selected_username = allUsername.join(",");
                  $("#userAll").val(join_selected_username);
                 
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