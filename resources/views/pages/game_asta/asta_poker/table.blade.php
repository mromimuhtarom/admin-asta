 @extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Table_Asta_Poker') }}">Asta Poker</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Table_Asta_Poker') }}">{{ TranslateMenuGame('Table') }}</a></li>
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

  {{-- end create --}}


  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-table"></i>{{ TranslateMenuGame('Table Player') }}</strong></h2>				
      </div>
    </header>
  
    <div>
      
      <div class="jarviswidget-editbox">
        <input class="form-control" type="text">
        <span class="note"><i class="fa fa-check text-success"></i>{{ TranslateMenuGame('Change Title') }}</span>
        
      </div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          
          <div class="row">
            
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              <div class="input-group">
                @if($menu && $mainmenu && $submenu)
                <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus">{{ TranslateMenuGame('Create New Table') }}</i>
                </button>
                @endif
              </div>
            </div>
            <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
              
              
            </div>
            
          </div>
          
        </div>
        
        <div class="custom-scroll table-responsive" style="height:800px; margin-right:1%;">
          
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  @if($menu && $mainmenu && $submenu)
                  <th><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ translate_MenuContentAdmin('L_SELECT_ALL')}}</th>
                  @endif
                  <th class="th-sm">{{ TranslateMenuGame('Table Name') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Group') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Max Player') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Small Blind') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Big Blind') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Jackpot') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Min Buy') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Max Buy') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Timer') }}</th>
                  @if($menu && $mainmenu && $submenu)
                  <th class="th-sm">{{ TranslateMenuGame('Action') }}
                    <a href="#" style="color:red;font-weight:bold;"
                      class="delete"
                      id="trash"
                      data-toggle="modal"
                      data-target="#deleteAll">
                      <i class ="fa fa-trash-o"></i>
                    </a>   
                  </th>
                  @endif
                </tr>
              </thead>
              <tbody>                      
                @foreach($tables as $tb)
                @if($menu && $mainmenu && $submenu)
                  <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission[]" id="deletepermission[]" data-pk="{{ $tb->table_id }}" data-username="{{ $tb->name }}" class="deletepermission{{ $tb->table_id }} deleteIdAll"></td>
                    <td><a href="#" class="usertext" data-title="Table Name" data-name="name" data-pk="{{ $tb->table_id }}" data-type="text" data-url="{{ route('Table-update')}}">{{ $tb->name }}</a></td>
                    <td><a href="#" class="room" data-title="Table Name" data-name="room_id" data-pk="{{ $tb->table_id }}" data-type="select" data-url="{{ route('Table-update')}}">{{ $tb->roomname }}</a></td>
                    <td><a href="#" class="seatplayer" data-title="Max Player" data-name="max_player" data-pk="{{ $tb->table_id }}" data-type="select" data-url="{{ route('Table-update')}}">{{ $tb->max_player }}</a></td>
                    <td><a href="#" class="usertext" data-title="Small Blind" data-name="small_blind" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ number_format($tb->small_blind, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Big Blind" data-name="big_blind" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ number_format($tb->big_blind, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Jackpot" data-name="jackpot" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ number_format($tb->jackpot, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="min_buy" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ number_format($tb->min_buy, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="max_buy" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ number_format($tb->max_buy, 2) }}</a></td>
                    <td><a href="#" class="timertable" data-title="Timer" data-name="timer" data-pk="{{ $tb->table_id }}" data-type="select" data-value="{{ $tb->timer }}" data-url="{{ route('Table-update') }}">{{ strNormalFast($tb->timer) }}</a></td>
                    <td><a href="#" style="color:red;" class="delete{{ $tb->table_id }}" id="delete" data-pk="{{ $tb->table_id }}" data-toggle="modal" data-target="#delete-table"><i class="fa fa-times"></i></a></td>
                  </tr>
                  @else 
                  <tr>
                      <td>{{ $tb->name }}</td>
                      <td>{{ $tb->roomname }}</td>
                      <td>{{ $tb->max_player }}</td>
                      <td>{{ number_format($tb->small_blind, 2) }}</td>
                      <td>{{ number_format($tb->big_blind, 2) }}</td>
                      <td>{{ number_format($tb->jackpot, 2) }}</td>
                      <td>{{ number_format($tb->min_buy, 2) }}</td>
                      <td>{{ number_format($tb->max_buy, 2) }}</td>
                      <td>{{ $tb->timer }}</td>
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

  <!-- Modal create data -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuGame('Create Table') }}</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('Table-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="tableName" placeholder="Table Name" required="">
                </div>
                <div class="form-group">
                  <select class="custom-select" id="category_table" name="category">
                    <option>{{ TranslateMenuGame('Select Category') }}</option>
                    @foreach ($category as $ct)
                    <option value="{{ $ct->room_id }}" data-pk="{{ $ct->min_buy }}">{{ $ct->name }} {{ number_format($ct->min_buy) }} - {{ number_format($ct->max_buy) }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="minbuy" name="minbuy" placeholder="Min Buy" required="">
                  <span id="lblErrorminbuy" style="color: red"></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="maxbuy" name="maxbuy" placeholder="Max Buy" required="">
                  <span id="lblErrormaxbuy" style="color: red"></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="sb" name="sb" placeholder="Small Blind" required="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="bb" name="bb" placeholder="Big Blind" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuGame('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuGame('Cancel') }}
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
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuGame('Delete Data') }}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuGame('Are you sure') }}
          <form action="{{ route('Table-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="tableid" id="tableid" value="">
        </div>
        <div class="modal-footer"> 
          <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuGame('Yes') }}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuGame('No') }}</button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <!-- End Modal delete data -->


  <!-- Modal DELETE ALL -->
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
          <form action="{{ route('Table-deleteAllTpk') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="AstaAll" id="AstaAll" value="">
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



      $("#minbuy").keyup(function(e) {
        e.preventDefault();
        var category_val = $('#category_table').val();
        var minbuy = $(this).val();
        @php
        $a = "category_table";
        $b = "minbuy";
        foreach ($category as $ct) {
          echo 'if('.$ct->room_id.' == $("#category_table").val()) {';
              echo 'var minbuyValue = $(this).val();';
              echo 'var countBb = minbuyValue / 10;';
              echo 'var countSb = countBb / 2;';
              echo '$("#sb").val(countSb);';
              echo '$("#bb").val(countBb);';
              echo 'var lblErrorminbuy = document.getElementById("lblErrorminbuy");';

              echo 'if(minbuyValue >= '.$ct->min_buy.') {';
                  echo 'lblErrorminbuy.innerHTML = "";';
              echo '}else{';
                  echo 'lblErrorminbuy.innerHTML = "Min buy table kurang dari min buy di kategori.";';
              echo '}';
          echo '}';
        }
        @endphp
      });



      $("#maxbuy").keyup(function(e) {
        e.preventDefault();
        var maxbuyValue = $(this).val();
        var lblErrormaxbuy = document.getElementById("lblErrormaxbuy");
        @php
          foreach ($category as $ct) {
            echo 'if('.$ct->room_id.' == $("#category_table").val()) {';
              echo 'if( maxbuyValue <= '.$ct->max_buy.') {';
                  echo 'lblErrormaxbuy.innerHTML = "";';
              echo '}else{';
                  echo 'lblErrormaxbuy.innerHTML = "Max buy table harus kurang dari max buy di kategori.";';
              echo '}';
            echo '}';
          }
        @endphp
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

          @php
          foreach($tables as $tb) {
            echo'$(".delete'.$tb->table_id.'").hide();';
            echo'$(".deletepermission'.$tb->table_id.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$tb->table_id.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$tb->table_id.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$tb->table_id.'").hide();';
              echo'}';

            echo '});';
          
            echo'$(".delete'.$tb->table_id.'").click(function(e) {';
              echo'e.preventDefault();';

              echo"var id = $(this).attr('data-pk');";
              echo'var test = $("#tableid").val(id);';
            echo'});';
          }
        @endphp

        $('.usertext').editable({
          mode :'inline',
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          }
        });

        $('.timertable').editable({
          value: '',
          mode :'inline',
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          },
          source: [
            {value: '', text: "{{ TranslateChoices('L_CHOOSE_TIMER') }}"},
            {value: '7', text: 'Fast'},
            {value: '15', text: 'Normal'},
          ]
        });

        $('.seatplayer').editable({
          value: '',
          mode :'inline',
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          },
          source: [
            {value: '', text: "{{ TranslateChoices('L_CHOOSE_SEAT') }}"},
            {value: '5', text: '5'},
            {value: '9', text: '9'},
          ]
        });

        $('.room').editable({
          value: '',
          mode: 'inline',
          source: [
            {value: '', text: "{{ TranslateChoices('L_CHOOSE_CATEGORY') }}" },
            @php
            foreach($category as $ct) {
            echo '{value:"'.$ct->room_id.'", text: "'.$ct->name.' Min Max Buy '.$ct->min_buy.' - '.$ct->max_buy.'" },';
            }
            @endphp
          ],
          validate: function(value) {
            if($.trim(value) == '')
            {
              return 'This field is required';
            }
          }
        });

        //Select all delete
        $('.delete').click(function(e) {
          e.preventDefault();
          var allVals = [];
          var allUsername = [];
          $(".deleteIdAll:checked").each(function() {
            allVals.push($(this).attr('data-pk'));
            var join_selected_values = allVals.join(",");
            $("#AstaAll").val(join_selected_values);
          
            //untuk get username ketika multiple delete
            allUsername.push($(this).attr('data-username'));
            var join_selected_username = allUsername.join(",");
            $('#userDeleteAll').val(join_selected_username);
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