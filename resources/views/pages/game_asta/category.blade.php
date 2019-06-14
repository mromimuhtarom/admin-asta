@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Category-view') }}">Games > Asta Poker</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Category-view') }}">Category</a></li>
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
        <h2><strong>Asta Poker Table</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"><span> Create New Category</span></i>
              </button>
              @endif
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>
        
        <div class="custom-scroll table-responsive" style="max-height:600px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  @if($menu)
                  <th></th>
                  @endif
                  <th class="th-sm">Title</th>
                  <th class="th-sm">Min Buy</th>
                  <th class="th-sm">Max Buy</th>
                  <th class="th-sm">Blind</th>
                  <th class="th-sm">Timer</th>
                  @if($menu)
                  <th class="th-sm">Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($category as $kt)
                @if($menu)
                <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $kt->roomid }}"></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="name" data-pk="{{ $kt->roomid }}" data-type="text" data-url="{{ route('Category-update')}}">{{ $kt->name }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="min_buy" data-pk="{{ $kt->roomid }}" data-type="number" data-url="{{ route('Category-update')}}">{{ $kt->min_buy }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="max_buy" data-pk="{{ $kt->roomid }}" data-type="number" data-url="{{ route('Category-update')}}">{{ $kt->max_buy }}</a></td>
                    <td><a href="#" class="usertext" data-title="Blind" data-name="stake" data-pk="{{ $kt->roomid }}" data-type="number" data-url="{{ route('Category-update') }}">{{ $kt->stake }}</a></td>
                    <td><a href="#" class="usertext" data-title="Timer" data-name="timer" data-pk="{{ $kt->roomid }}" data-type="number" data-url="{{ route('Category-update') }}">{{ $kt->timer }}</a></td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $kt->roomid }}" id="delete" data-pk="{{ $kt->roomid }}" data-toggle="modal" data-target="#delete-category"><i class="fa fa-times"></i></a></td>
                </tr>
                @else 
                <tr>
                    {{-- <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $kt->roomid }}"></td> --}}
                    <td>{{ $kt->name }}</td>
                    <td>{{ $kt->min_buy }}</td>
                    <td>{{ $kt->max_buy }}</td>
                    <td>{{ $kt->stake }}</td>
                    <td>{{ $kt->timer }}</td>
                    {{-- <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $kt->roomid }}" id="delete" data-pk="{{ $kt->roomid }}" data-toggle="modal" data-target="#delete-category"><i class="fa fa-times"></i></a></td> --}}
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
          <h4 class="modal-title" id="myModalLabel">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        <form action="{{ route('Category-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="categoryName" placeholder="Name Category" required="">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="minbuy" placeholder="Min Buy" required="">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="maxbuy" placeholder="Max Buy" required="">
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
  <!-- End Modal -->

  <!-- Modal delete data -->
  <div class="modal fade" id="delete-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="{{ route('Category-delete') }}" method="post">
            {{ method_field('delete')}}
            @csrf
            <input type="hidden" name="categoryid" id="categoryid" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes">Yes</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
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
      });
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
          foreach($category as $kt) {
            echo'$(".delete'.$kt->roomid.'").hide();';
            echo'$(".deletepermission'.$kt->roomid.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$kt->roomid.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$kt->roomid.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$kt->roomid.'").hide();';
              echo'}';
  
            echo '});';
        
            echo'$(".delete'.$kt->roomid.'").click(function(e) {';
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


    
    // table = $('#dt-material-checkbox').dataTable({
    //     columnDefs: [{
    //     orderable: false,
    //     className: 'select-checkbox',
    //     targets: 0
    //     }],
    //     "pagingType": "full_numbers",
    //     "bInfo" : false,
    //     "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
    //     select: {
    //     style: 'os',
    //     selector: 'td:first-child'
    //     },
    //     "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
    //         $.ajaxSetup({
    //           headers: {
    //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //           }
    //         });

    //         @php
    //             foreach($category as $kt) {
    //               echo'$(".delete'.$kt->roomid.'").hide();';
    //               echo'$(".deletepermission'.$kt->roomid.'").on("click", function() {';
    //                 echo 'if($( ".deletepermission'.$kt->roomid.':checked" ).length > 0)';
    //                 echo '{';
    //                   echo '$(".delete'.$kt->roomid.'").show();';
    //                 echo'}';
    //                 echo'else';
    //                 echo'{';
    //                   echo'$(".delete'.$kt->roomid.'").hide();';
    //                 echo'}';
        
    //               echo '});';
              
    //             echo'$(".delete'.$kt->roomid.'").click(function(e) {';
    //               echo'e.preventDefault();';

    //               echo"var id = $(this).attr('data-pk');";
    //               echo'var test = $("#categoryid").val(id);';
    //             echo'});';
    //           }
    //         @endphp

    //         $('.usertext').editable({
    //           mode :'popup'
    //         });
            
    //         $('.category').editable({
    //           //value: 'drink',
    //           source: [
    //             {value: 'drink', text: 'Drink'},
    //             {value: 'food', text: 'Food'},
    //             {value: 'emoji', text: 'Emoji'},
    //           ]
    //         }); 
  
    //     }
    // });
  </script>  
  <!-- End Script -->

@endsection