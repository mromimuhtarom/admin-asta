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


<style>
  .media-container {
    position: relative;
    display: inline-block;
    margin: auto;
    border-radius: 10px;
    border: 1px solid black;
    overflow: hidden;
    width: 200px;
    height: 100px;
    /* vertical-align: middle */
  }
    .media-overlay {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(180, 180, 180, 0.6);
    }
      #media-input {
        display: block;
        width: 100%;
        height: 100%;
        line-height: 100%;
        opacity: 0;
        position: relative;
        z-index: 9;
      }
      .media-icon {
        /* display: sticky; */
        transform: translate(-1%,-90%);
        color: #ffffff;
        font-size: 2em;
        height: 100%;
        line-height: 100px;
        position: absolute;
        z-index: 0;
        width: 100%;
        text-align: center;
      }
    .media-object {}
      .img-object {
        border-radius: 10px;
        width: auto;
        height: 100px;
        display: block;
      }
  
  .media-control {
    margin-top: 30px;
  }
    .edit-profile {}
    .save-profile {}
  
</style>
<script>
  function readURL(input) {
     if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function (e) {
             $('#blah')
                 .attr('src', e.target.result);
         };

         reader.readAsDataURL(input.files[0]);
     }
 }
</script>



@if (\Session::has('alert'))
<div class="alert alert-danger">
    {{-- <div class="alert alert-danger"> --}}
        <div>{{Session::get('alert')}}</div>
    {{-- </div> --}}
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
                <th style="width:10px;">Image</th>
                <th class="th-sm">Caption</th>
                <th class="th-sm">Action</th>
                <th class="th-sm">Active</th>
                @if($menu)
                  <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($slide_banner as $banner)
                @if($menu)
                  <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $banner->id }}"></td>
                    <td>
                      <div class="media-container">
                        <form method="POST" action="{{ route('SlideBanner-updateimage') }}" enctype="multipart/form-data">
                          {{  csrf_field() }}
                          <span class="media-overlay med-ovlay{{ $banner->id }}">
                            <input type="hidden" name="pk" value="{{ $banner->id }}">
                            <input type="file" name="file" id="media-input" class="upload{{ $banner->id }}" accept="image/*" >
                            {{-- <i class="fas fa-edit media-icon"></i> --}}
                            <i class="fa fa-edit media-icon"></i>
                          </span>
                          <figure class="media-object">
                            <img class="img-object imgupload{{ $banner->id }}" src="/images/SlideBanner/{{ $banner->image }}" style="display: block;margin-left: auto;margin-right: auto;">
                          </figure>
                        </div>
                        <div class="media-control" align="center" style="margin-top:-1%">
                          <button class="save-profile{{ $banner->id }}">Save Gift</button>
                        </form>
                          <button class="edit-profile{{ $banner->id }}">Edit Gift</button>
                        </div>
                    </td>
                    <td><a href="#" class="usertext" data-name="caption" data-pk="{{ $banner->id }}" data-type="text" data-url="{{ route('SlideBanner-update') }}">{{ $banner->caption }}</a></td>
                    <td><a href="#" class="usertext" data-name="url" data-pk="{{ $banner->id }}" data-type="text" data-url="{{ route('SlideBanner-update') }}">{{ $banner->url }}</a></td>
                    <td><a href="#" class="stractive" data-name="active" data-pk="{{ $banner->id }}" data-type="text" data-url="{{ route('SlideBanner-update') }}">{{ strEnabledDisabled($banner->active) }}</a></td>
                    <td>
                    <a href="#" style="color:red;" class="delete{{ $banner->id }}" 
                        id="delete" 
                        data-pk="{{ $banner->id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @else 
                  <tr>
                    <td>{{ $banner->image }}</td>
                    <td>{{ $banner->caption }}</td>
                    <td>{{ $banner->url }}</td>
                    <td>{{ strEnabledDisabled($banner->active) }}</td>
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
            <form action="{{ route('SlideBanner-delete') }}" method="post">
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
      <form action="{{ route('SlideBanner-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group" align="center">
            <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
              <img id="blah" src="http://placehold.jp/150x50.png" alt="your image" width="auto" height="98px" style="border-radius:10px;" />
            </div><br><br>
            <input type='file' name="file" onchange="readURL(this);"/>
          </div>
          <div class="form-group">
            <textarea name="caption" id="" rows="10" class="form-control" placeholder="Caption"></textarea>
          </div>
          <div class="form-grsoup">
            <input type="text" name="url" class="form-control" id="basic-url" placeholder="Action">
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
      "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
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
          foreach($slide_banner as $banner) {
              echo'$(".delete'.$banner->id.'").hide();';
              echo'$(".deletepermission'.$banner->id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$banner->id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$banner->id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$banner->id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$banner->id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
          }
      @endphp
      @php
              foreach($slide_banner as $banner) {
                echo'$(".save-profile'.$banner->id.'").hide(0);';
                  echo'$(".med-ovlay'.$banner->id.'").hide(0);';

                  echo'$(".edit-profile'.$banner->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$banner->id.'").fadeIn(300);';
                    echo'$(".save-profile'.$banner->id.'").fadeIn(300);';
                  echo'});';
                  echo'$(".save-profile'.$banner->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$banner->id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$banner->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".upload'.$banner->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload'.$banner->id.'").attr("src", e.target.result);';
                      echo'};';
		
                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
              }
            @endphp

    },
    responsive: true
  });
</script>





@endsection