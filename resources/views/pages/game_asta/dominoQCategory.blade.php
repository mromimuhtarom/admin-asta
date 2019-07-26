@extends('index')



@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Category_Domino_QQ') }}">Games > Domino QQ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Category_Domino_QQ') }}">Category</a></li>
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

  <!-- Form Category -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-puzzle-piece"></i> Domino QQ Table</strong></h2>				
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
                <i class="fa fa-plus"><span> Create New Category</span></i>
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
                  <th></th>
                  @endif
                  <th class="th-sm">Room Name</th>
                  <th class="th-sm">Stake</th>
                  <th class="th-sm">Min Buy</th>
                  <th class="th-sm">Max Buy</th>
                  <th class="th-sm">Timer</th>
                  @if($menu && $mainmenu && $submenu)
                  <th class="th-sm">Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($category as $kt)
                @if($menu && $mainmenu && $submenu)
                <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $kt->room_id }}"></td>
                    <td><a href="#" class="usertext" data-title="Room Name" data-name="name" data-pk="{{ $kt->room_id }}" data-type="text" data-url="{{ route('DominoQCategory-update')}}">{{ $kt->name }}</a></td>
                    <td><a href="#" class="usertext" data-title="Stake" data-name="stake" data-pk="{{ $kt->room_id }}" data-type="number" data-url="{{ route('DominoQCategory-update')}}">{{ $kt->stake }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="min_buy" data-pk="{{ $kt->room_id }}" data-type="number" data-url="{{ route('DominoQCategory-update') }}">{{ $kt->min_buy }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="max_buy" data-pk="{{ $kt->room_id }}" data-type="number" data-url="{{ route('DominoQCategory-update') }}">{{ $kt->max_buy }}</a></td>
                    {{-- <td>{{ $kt->min_buy }}</td>
                    <td>{{ $kt->max_buy }}</td> --}}
                    <td><a href="#" class="usertext" data-title="Timer" data-name="timer" data-pk="{{ $kt->room_id }}" data-type="number" data-url="{{ route('DominoQCategory-update') }}">{{ $kt->timer }}</a></td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $kt->room_id }}" id="delete" data-pk="{{ $kt->room_id }}" data-toggle="modal" data-target="#delete-category"><i class="fa fa-times"></i></a></td>
                </tr>
                @else 
                <tr>
                    <td><{{ $kt->name }}</td>
                    <td>{{ $kt->stake }}</td>
                    <td>{{ $kt->min_buy }}</td>
                    <td>{{ $kt->max_buy }}</td>
                    <td>{{ $kt->timer }}</td>
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
  <!-- End Form Category -->

  <!-- Modal create data -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Category</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('DominoQCategory-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="categoryName" placeholder="Name Category" required="">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="stake" name="stake" placeholder="Stake" required>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="minbuy" name="minbuy" placeholder="Min Buy" required="">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="maxbuy" name="maxbuy" placeholder="Max Buy" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary">
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
  <div class="modal fade" id="delete-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
          <button  style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          Are You Sure Want To Delete It
          <form action="{{ route('DominoQCategory-delete') }}" method="post">
            {{ method_field('delete')}}
            @csrf
            <input type="hidden" name="categoryid" id="categoryid" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <!-- End Modal delete data -->

  <!-- Script -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('table.table').dataTable( {
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
      });
    });

    // $('#stake').keyup(function(e) {
    //   e.preventDefault();
    //     var a = $(this).val();
    //     var countminbuy = a * 10;
    //     var countmaxbuy = countminbuy * 2;
    //     $('#minbuy').val(countminbuy);
    //     $('#maxbuy').val(countmaxbuy);

    // });

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
          foreach($category as $kt) {
            echo'$(".delete'.$kt->room_id.'").hide();';
            echo'$(".deletepermission'.$kt->room_id.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$kt->room_id.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$kt->room_id.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$kt->room_id.'").hide();';
              echo'}';

            echo '});';
        
            echo'$(".delete'.$kt->room_id.'").click(function(e) {';
              echo'e.preventDefault();';

              echo"var id = $(this).attr('data-pk');";
              echo'var test = $("#categoryid").val(id);';
            echo'});';
          }
        @endphp

        $('.usertext').editable({
          mode : 'inline'
        });
      },
      responsive: true
    });
    
  </script>  
  <!-- End Script -->

@endsection