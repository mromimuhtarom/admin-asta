@extends('index')


@section('sidebarmenu')
@include('menu.menuslide')    
@endsection


@section('content')

      {{-- <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Create Slide Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            {{  csrf_field() }}
          <div class="modal-body">
            <input type='file' onchange="readURL(this);" /><br><br>
            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
            <textarea name="caption" cols="30" rows="5" placeholder="caption"></textarea><br>
            <select name="action">
              <option>Pilih Action</option>
              <option value=""></option>
            </select>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    
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


    <div class="table-aii">
        <div class="footer-table">
                              <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                                <i class="fas fa-plus-circle"></i>Create Slide Banners
                              </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Caption</th>
                <th class="th-sm">Action</th>
                <th class="th-sm">Active</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
          </table>
         
    </div>
<script>
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
      });
</script> --}}



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
      <h2><strong>Slide Banner</strong></h2>				
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
                <th class="th-sm">Image</th>
                <th class="th-sm">Caption</th>
                <th class="th-sm">Action</th>
                <th class="th-sm">Active</th>
                @if($menu)
                  <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
              {{-- @foreach($items as $itm) --}}
                @if($menu)
                  <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission nanti"></td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Chip" data-pk="" data-type="text" data-url=""></a></td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Chip" data-pk="" data-type="text" data-url=""></a></td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Chip" data-pk="" data-type="text" data-url=""></a></td>
                    <td><a href="#" class="stractive" data-name="name" data-title="Title Chip" data-pk="" data-type="text" data-url=""></a></td>
                    <td>
                      <a href="#" style="color:red;" class="delete nanti" 
                        id="delete" 
                        data-pk="nanti" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @else 
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                @endif
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
            <form action="" method="post">
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
        <h4 class="modal-title" id="myModalLabel">Create New Slide Banner</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <form action="" method="post">
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


      // @php
      //     foreach($items as $itm) {
      //         echo'$(".delete'.$itm->id.'").hide();';
      //         echo'$(".deletepermission'.$itm->id.'").on("click", function() {';
      //           echo 'if($( ".deletepermission'.$itm->id.':checked" ).length > 0)';
      //           echo '{';
      //             echo '$(".delete'.$itm->id.'").show();';
      //           echo'}';
      //           echo'else';
      //           echo'{';
      //             echo'$(".delete'.$itm->id.'").hide();';
      //           echo'}';
    
      //         echo '});';
            
      //         echo'$(".delete'.$itm->id.'").click(function(e) {';
      //           echo'e.preventDefault();';
    
      //           echo"var id = $(this).attr('data-pk');";
      //           echo'var test = $("#id").val(id);';
      //         echo'});';
      //     }
      // @endphp

    },
    responsive: true
  });
</script>





@endsection