@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Table_Asta_Poker') }}">Games > Asta Poker</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Table_Asta_Poker') }}">Table</a></li>
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
        <h2><strong><i class="fa fa-table"></i> Table Player</strong></h2>				
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
                @if($menu && $mainmenu && $submenu)
                <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-plus"> Create New Table</i>
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
                  <th></th>
                  @endif
                  <th class="th-sm">Nama Table</th>
                  <th class="th-sm">Group</th>
                  <th class="th-sm">Max Player</th>
                  <th class="th-sm">Small Blind</th>
                  <th class="th-sm">Big Blind</th>
                  <th class="th-sm">Jackpot</th>
                  <th class="th-sm">Min Buy</th>
                  <th class="th-sm">Max Buy</th>
                  <th class="th-sm">Timer</th>
                  @if($menu && $mainmenu && $submenu)
                  <th class="th-sm">action</th>
                  @endif
                </tr>
              </thead>
              <tbody>                      
                @foreach($tables as $tb)
                @if($menu && $mainmenu && $submenu)
                  <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $tb->table_id }}"></td>
                    <td><a href="#" class="usertext" data-title="Table Name" data-name="name" data-pk="{{ $tb->table_id }}" data-type="text" data-url="{{ route('Table-update')}}">{{ $tb->name }}</a></td>
                    <td><a href="#" class="room" data-title="Table Name" data-name="room_id" data-pk="{{ $tb->table_id }}" data-type="select" data-url="{{ route('Table-update')}}">{{ $tb->roomname }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Player" data-name="max_player" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update')}}">{{ $tb->max_player }}</a></td>
                    <td><a href="#" class="usertext" data-title="Small Blind" data-name="small_blind" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->small_blind }}</a></td>
                    <td><a href="#" class="usertext" data-title="Big Blind" data-name="big_blind" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->big_blind }}</a></td>
                    <td><a href="#" class="usertext" data-title="Jackpot" data-name="jackpot" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->jackpot }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="min_buy" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->min_buy }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="max_buy" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->max_buy }}</a></td>
                    <td><a href="#" class="usertext" data-title="Timer" data-name="timer" data-pk="{{ $tb->table_id }}" data-type="number" data-url="{{ route('Table-update') }}">{{ $tb->timer }}</a></td>
                    <td><a href="#" style="color:red;" class="delete{{ $tb->table_id }}" id="delete" data-pk="{{ $tb->table_id }}" data-toggle="modal" data-target="#delete-table"><i class="fa fa-times"></i></a></td>
                  </tr>
                  @else 
                  <tr>
                      <td>{{ $tb->name }}</td>
                      <td>{{ $tb->roomname }}</td>
                      <td>{{ $tb->max_player }}</td>
                      <td>{{ $tb->small_blind }}</td>
                      <td>{{ $tb->big_blind }}</td>
                      <td>{{ $tb->jackpot }}</td>
                      <td>{{ $tb->min_buy }}</td>
                      <td>{{ $tb->max_buy }}</td>
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
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Table</h4>
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
                  <select class="custom-select" id="category" name="category">
                    <option>Select Category</option>
                    @foreach ($category as $ct)
                    <option value="{{ $ct->room_id }}" data-pk="{{ $ct->min_buy }}">{{ $ct->name }} {{ $ct->min_buy }} - {{ $ct->max_buy }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="minbuy" name="minbuy" placeholder="Min Buy" required="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="maxbuy" name="maxbuy" placeholder="Max Buy" required="">
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
              <i class="fa fa-save"></i> Save
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i> Cancel
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
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          Are You Sure Want To Delete It
          <form action="{{ route('Table-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="tableid" id="tableid" value="">
        </div>
        <div class="modal-footer"> 
          <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i> Yes</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <!-- End Modal delete data -->
      
    <script type="text/javascript">
      $(document).ready(function() {
        $('table.table').dataTable( {
          "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
          "pagingType": "full_numbers",
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
          value: '',
          mode: 'inline',
          source: [
            {value: '', text: 'Choose Category'},
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

          
        },
        responsive: false
      });
    
    </script>
@endsection