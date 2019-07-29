@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">Store</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">Chip Store</a></li>
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
      <h2><strong><i class="fa fa-columns"></i> Chip Store</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah chip store baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu && $mainmenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createChipStore">
                <i class="fa fa-plus"></i> Create New Chip Store
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah chip store baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="height:800px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu && $mainmenu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">Title</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Chip Awarded</th>
                <th class="th-sm">Gold Cost</th>
                <th class="th-sm">Active</th>
                @if($menu && $mainmenu)
                  <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($items as $itm)
                @if($menu && $mainmenu)
                  <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $itm->item_id }}"></td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="text" data-url="{{ route('ChipStore-update') }}">{{ $itm->name }}</a></td>
                    <td>{{ $itm->strItemType() }}</td>
                    <td><a href="#" class="usertext" data-name="item_get" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="number" data-url="{{ route('ChipStore-update') }}">{{ $itm->item_get }}</a></td>
                    <td><a href="#" class="usertext" data-name="price" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="number" data-url="{{ route('ChipStore-update') }}">{{ $itm->price }}</a></td>
                    <td><a href="#" class="stractive" data-name="status" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="select" data-url="{{ route('ChipStore-update') }}">{{ strEnabledDisabled($itm->status) }}</a></td>
                    <td>
                      <a href="#" style="color:red;" class="delete{{ $itm->item_id }}" 
                        id="delete" 
                        data-pk="{{ $itm->item_id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @else 
                  <tr>
                    <td>{{ $itm->name }}</td>
                    <td>{{ $itm->strItemType() }}</td>
                    <td>{{ $itm->item_get }}</td>
                    <td>{{ $itm->price }}</td>
                    <td>{{ strEnabledDisabled($itm->status) }}</td>
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i> 
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
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create New Chip Store</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
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
<!-- end Modal -->

<!-- Script -->
<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
      "pagingType": "full_numbers",
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
				          // {value: '1', text: 'Enabled'},
                  @php
                        // $endis = preg_split( "/ :|, /", $atv->value );
                      echo '{value:"'.$endis[0].'", text: "'.$endis[1].'"}, ';
                      echo '{value:"'.$endis[2].'", text: "'.$endis[3].'"}, ';
                  @endphp
        ]
      });


      @php
          foreach($items as $itm) {
              echo'$(".delete'.$itm->item_id.'").hide();';
              echo'$(".deletepermission'.$itm->item_id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$itm->item_id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$itm->item_id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$itm->item_id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$itm->item_id.'").click(function(e) {';
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