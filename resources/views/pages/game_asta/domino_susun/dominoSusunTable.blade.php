@extends('index')


@section('page')
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Table_Domino_Susun') }}">Domino Susun</a></li>
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Table_Domino_Susun') }}">{{ TranslateMenuGame('L_TABLE') }}</a></li>
@endsection



@section('content')

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
  <!-- End Response Status -->

  <!-- Form Table -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-puzzle-piece"></i>{{ TranslateMenuGame('L_TABLE') }} Asta Domino Susun</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              @if($menu && $mainmenu && $submenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus">{{ TranslateMenuGame('L_CREATE_NEW_TABLE') }}</i>
              </button>
              @endif
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>
        
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  @if($menu && $mainmenu && $submenu)
                  <th><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp; {{translate_MenuContentAdmin('L_SELECT_ALL')}}</th>
                  @endif
                  <th class="th-sm">{{ TranslateMenuGame('L_TABLE_NAME') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_GROUP') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_MAX_PLAYER') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_GAME_STATE') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_TOTAL_BET') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_STAKE') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_MIN_BUY') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_MAX_BUY') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('L_TIMER') }}</th>
                  @if($menu && $mainmenu && $submenu)
                  <th class="th-sm">{{ TranslateMenuGame('L_ACTION') }}
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
                @foreach($tables as $tb)
                @if($menu && $mainmenu && $submenu)
                  <tr>
                    <td style="text-align:center;"><input type="checkbox" data-username="{{ $tb->name }}" name="deletepermission[]" id="deletepermission[]" data-pk="{{ $tb->table_id }}" class="deletepermission{{ $tb->table_id }} deleteIdAll"></td>
                    <td><a href="#" class="usertext" data-title="Table Name" data-name="name" data-pk="{{ $tb->table_id }}" data-type="text" data-url="{{ route('DominoSTable-update')}}">{{ $tb->name }}</a></td>
                    <td><a href="#" class="room" data-title="Room name" data-name="room_id" data-pk="{{ $tb->table_id }}" data-type="select" data-url="{{ route('DominoSTable-update')}}">{{ $tb->roomname }}</a></td>
                    {{-- <td><a href="#" class="usertext" data-title="Max Player" data-name="max_player" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoSTable-update')}}">{{ $tb->max_player }}</a></td> --}}
                    <td>{{ $tb->max_player }}</td>
                    <td><a href="#" class="usertext" data-title="Game State" data-name="game_state" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoSTable-update')}}">{{ $tb->game_state }}</a></td>
                    <td><a href="#" class="usertext" data-title="Total Bet" data-name="total_bet" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoSTable-update')}}">{{ number_format($tb->total_bet, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Stake" data-name="stake" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoSTable-update')}}">{{ number_format($tb->stake, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="min_buy" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoSTable-update')}}">{{ number_format($tb->min_buy, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="max_buy" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('DominoSTable-update')}}">{{ number_format($tb->max_buy, 2) }}</a></td>
                    <td><a href="#" class="timertable" data-title="Timer" data-name="timer" data-pk="{{ $tb->table_id }}" data-type="select" data-url="{{ route('DominoSTable-update')}}">{{ strNormalFast($tb->timer) }}</a></td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $tb->table_id }}" id="delete" data-pk="{{ $tb->table_id }}" data-toggle="modal" data-target="#delete-table"><i class="fa fa-times"></i></a></td>
                  </tr>
                  @else 
                  <tr>
                      <td>{{ $tb->name }}</td>
                      <td>{{ $tb->roomname }}</td>
                      <td>{{ $tb->max_player }}</td>
                      <td>{{ $tb->game_state }}</td>
                      <td>{{ number_format($tb->total_bet, 2) }}</td>
                      <td>{{ number_format($tb->stake, 2) }}</td>
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
  <!-- End Form Table -->

  <!-- Modal create data -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuGame('L_CREATE_TABLE') }}</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('DominoSTable-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control required" name="tableName" placeholder="Table Name" required="">
                </div>
                <div class="form-group">
                  <select class="custom-select required" id="category_table" name="category">
                    <option selected>{{ TranslateMenuGame('L_SELECT_CATEGORY') }}</option>
                    @foreach ($category as $ct)
                    <option value="{{ $ct->room_id }}">{{ $ct->name }} {{ number_format($ct->min_buy) }} - {{ number_format($ct->max_buy) }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control required" id="stake" name="stake" placeholder="Stake" required="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control required" id="minbuy" name="minbuy" placeholder="Min Buy" required="">
                  <span id="lblErrorminbuy" style="color: red"></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control required" id="maxbuy" name="maxbuy" placeholder="Max Buy" required="">
                  <span id="lblErrormaxbuy" style="color: red"></span>
                </div>
               
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data btn-create toggle-disabled" disabled onclick="FunctionLoadingBtn()">
              <i class="fa fa-save"></i>{{ TranslateMenuGame('L_SAVE') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuGame('L_CANCEL') }}
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
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuGame('L_DELETE_DATA') }}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuGame('L_ARE_YOU_SURE') }}
          <form action="{{ route('DominoSTable-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="tableid" id="tableid" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuGame('L_YES') }}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuGame('L_NO') }}</button>
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
          <form action="{{ route('DominoSTable-deleteAllDominoS') }}" method="post">
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


  <script>
    function FunctionLoadingBtn(){
      $(".btn-create").text("Loading..");
      $(this).submit('loading').delay(1000).queue(function() {
      });
    }
    //Disable submit until all formm fullfilled
    $(document).on('change keyup', '.required', function() {
      let Disabled = true;

      $(".required").each(function() {
        let value = this.value
        if((value)&&(value.trim() !=''))
        {
          Disabled = false
        } else {
          Disabled = true
          return false
        }
      });

      if(Disabled){
        $('.toggle-disabled').prop("disabled", true);
      }else{
        $('.toggle-disabled').prop("disabled", false);
      }
    })
  </script>
  <!-- Script -->
  <script type="text/javascript">

    $(document).ready(function() {
        $('table.table').dataTable( {
          "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
          "pagingType": "full_numbers",
        });

        $("#trash").hide();
        //Check all
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

      $("#stake").keyup(function(e) {
        e.preventDefault();
        var category_val = $("#category_table").val();
        var stake = $(this).val();

        @php
        foreach($category as $ct){
          echo 'if('.$ct->room_id.' == $("#category_table").val()) {';
              echo 'var stakevalue = $(this).val();';
              echo 'var countminbuy = stakevalue * 10;';
              echo 'var countmaxbuy = countminbuy * 4;';
              echo 'var lblErrormaxbuy = document.getElementById("lblErrormaxbuy");';
              echo 'var lblErrorminbuy = document.getElementById("lblErrorminbuy");';
                  echo 'if(countminbuy >= '.$ct->min_buy.') {';
                      echo 'var minbuy = $("#minbuy").val(countminbuy);';
                      echo 'lblErrorminbuy.innerHTML = "";';
                  echo '}else{';
                      echo 'var minbuy = $("#minbuy").val(null);';
                      echo 'lblErrorminbuy.innerHTML = "Min buy table kurang dari min buy di kategori.";';
                  echo '}';

                  echo 'if( countmaxbuy <= '.$ct->max_buy.') {';
                      echo 'lblErrormaxbuy.innerHTML = "";';
                      echo 'var maxbuy = $("#maxbuy").val(countmaxbuy);';
                  echo '}else{';
                      echo 'lblErrormaxbuy.innerHTML = "Min buy table kurang dari min buy di kategori.";';
                      echo 'var maxbuy = $("#maxbuy").val(null);';
                  echo '}';
          echo '}';
        }

        @endphp
      });

    table = $('table.table').dataTable({
      "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
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

        $('.room').editable({
          mode: 'inline',
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          },
          source: [
            {value: '', text: "{{ TranslateChoices('L_CHOOSE_CATEGORY') }}"},
            @php
            foreach($category as $ct) {
            echo '{value:"'.$ct->room_id.'", text: "'.$ct->name.' Min Max Buy '.$ct->min_buy.' - '.$ct->max_buy.'" },';
            }
            @endphp
          ]
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
        
        //select all delete
        $('.delete').click(function(e) {
          e.preventDefault();
          var allVals = [];
          var allUsername = [];
          $(".deleteIdAll:checked").each(function() {
            allVals.push($(this).attr('data-pk'));
            var join_selected_values = allVals.join(",");
            $('#AstaAll').val(join_selected_values);

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