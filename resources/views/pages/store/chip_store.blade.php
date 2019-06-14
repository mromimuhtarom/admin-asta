@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('ChipStore-view') }}">Store</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ChipStore-view') }}">Chip Store</a></li>
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
  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong>Chip Store</strong></h2>				
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
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createChipStore">
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
                <th class="th-sm">Title</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Chip Awarded</th>
                <th class="th-sm">Gold Cost</th>
                <th class="th-sm">Active</th>
                @if($menu)
                  <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($items as $itm)
                @if($menu)
                  <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $itm->id }}"></td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Chip" data-pk="{{ $itm->id }}" data-type="text" data-url="{{ route('ChipStore-update') }}">{{ $itm->name }}</a></td>
                    <td>{{ $itm->category }}</td>
                    <td><a href="#" class="usertext" data-name="chipAwarded" data-title="Title Chip" data-pk="{{ $itm->id }}" data-type="number" data-url="{{ route('ChipStore-update') }}">{{ $itm->chipAwarded }}</a></td>
                    <td><a href="#" class="usertext" data-name="goldCost" data-title="Title Chip" data-pk="{{ $itm->id }}" data-type="number" data-url="{{ route('ChipStore-update') }}">{{ $itm->goldCost }}</a></td>
                    <td><a href="#" class="stractive" data-name="active" data-title="Title Chip" data-pk="{{ $itm->id }}" data-type="select" data-url="{{ route('ChipStore-update') }}">{{ strEnabledDisabled($itm->active) }}</a></td>
                    <td>
                      <a href="#" style="color:red;" class="delete{{ $itm->id }}" 
                        id="delete" 
                        data-pk="{{ $itm->id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @else 
                  <tr>
                    <td>{{ $itm->name }}</td>
                    <td>{{ $itm->category }}</td>
                    <td>{{ $itm->chipAwarded }}</td>
                    <td>{{ $itm->goldCost }}</td>
                    <td>{{ strEnabledDisabled($itm->active) }}</td>
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
<!-- end Table -->




      <!-- Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              × 
            </button>
          </div>
          <div class="modal-body">
            Are You Sure Want To Delete It
            <form action="{{ route('ChipStore-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes">Yes</button>
            <button type="button" class="button_example-no" data-dismiss="modal">No</button>
          </div>
            </form>
        </div>
      </div>
    </div>





<!-- Modal -->
<div class="modal fade" id="createChipStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Create New Chip Store</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <form action="{{ route('ChipStore-create') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="number" name="chipawarded" class="form-control" id="basic-url" placeholder="chip awarded">
          </div>
          <div class="form-grsoup">
            <input type="number" name="goldcost" class="form-control" id="basic-url" placeholder="gold cost">
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

<!-- Script -->
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

      $('.stractive').editable({
        value: '',
        mode :'inline',
				source: [
                  {value: '', text: 'choose for activation'},
				          {value: '1', text: 'Enabled'},
					        {value: '0', text: 'Disabled'},
        ]
      });


      @php
          foreach($items as $itm) {
              echo'$(".delete'.$itm->id.'").hide();';
              echo'$(".deletepermission'.$itm->id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$itm->id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$itm->id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$itm->id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$itm->id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
          }
      @endphp

    },
    responsive: true
  });
</script>
@endsection