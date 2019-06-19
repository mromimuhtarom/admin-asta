@extends('index')



@section('content')

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all as $error)
      <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>
      
@endif
  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong>Daily Gift</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah chip store baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createGoldStore">
                <i class="fa fa-plus"></i>
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah chip store baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="max-height:600px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">Title Gift</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Quantity</th>
                <th class="th-sm">Status</th>
                @if($menu)
                  <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              {{-- @foreach($guests as $gs) --}}
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      
      </div>
    
    </div>
  </div>
</div>
<!-- end Table -->

<!-- Modal -->
<div class="modal fade" id="createGoldStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Create New Daily Gift</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <form action="{{ route('GoldStore-create') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title" required>
          </div>
          <div class="form-group">
            <input type="number" name="quantity" class="form-control" id="basic-url" placeholder="quantity" required>
          </div>
          <div class="form-group">
            <select class="custom-select">
              <option selected>Select Action</option>
              <option value="1">Chip</option>
              <option value="2">Gold</option>
            </select>
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
<!-- end Modal -->

<!-- delete Modal -->
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
        {{-- <form action="{{ route('GoldStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes">Yes</button>
        <button type="button" class="button_example-no" data-dismiss="modal">No</button>
      </div>
        </form> --}}
    </div>
  </div>
</div>
<!-- End delete Modal -->
  
<!-- script -->
<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
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

      $('.usertext').editable({
        mode :'inline'
      });

      // delete gold store
      // @php
      //   foreach($getGolds as $gold) {
      //     echo'$(".delete'.$gold->id.'").hide();';
      //     echo'$(".deletepermission'.$gold->id.'").on("click", function() {';
      //       echo 'if($( ".deletepermission'.$gold->id.':checked" ).length > 0)';
      //       echo '{';
      //         echo '$(".delete'.$gold->id.'").show();';
      //       echo'}';
      //       echo'else';
      //       echo'{';
      //         echo'$(".delete'.$gold->id.'").hide();';
      //       echo'}';

      //     echo '});';
        
      //     echo'$(".delete'.$gold->id.'").click(function(e) {';
      //       echo'e.preventDefault();';

      //       echo"var id = $(this).attr('data-pk');";
      //       echo'var test = $("#userid").val(id);';
      //     echo'});';
      //   }
      // @endphp
    },
    responsive: true
  });
</script>
<!-- end script -->
@endsection