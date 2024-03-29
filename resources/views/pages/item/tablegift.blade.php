@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">Item</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">Table Gift</a></li>
@endsection


@section('content')

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
  input[type=file] {
  cursor: pointer;
  width: 180px;
  height: 34px;
  overflow: hidden;
}



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
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
  <header>
    <div class="widget-header">
      <h2><strong><i class="fa fa-columns"></i> Table Gift</strong></h2>
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">

        <div class="row">

          <!-- Button tambah bot baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu && $mainmenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i> Create New Gift
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah bot baru -->

        </div>

      </div>

      <div class="custom-scroll table-responsive" style="height:870px;">

        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu && $mainmenu)
                <th style="width:10px;"></th>
                @endif
                <th style="width:10px;">Image</th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Price</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Status</th>
                @if($menu && $mainmenu)
                <th style="width:10px;"></th>
                @endif
              </tr>
            </thead>
            <tbody>
                @foreach($gifts as $gf)
                @if($menu && $mainmenu)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $gf->id }}"></td>
                    <td >
                          <div class="media-container">
                            <form method="POST" action="{{ route('TableGift-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay med-ovlay{{ $gf->id }}">
                                <input type="hidden" name="pk" value="{{ $gf->id }}">
                                <input type="file" name="file" id="media-input" class="upload{{ $gf->id }}" accept="image/*">
                                <i class="fa fa-edit media-icon"></i>
                              </span>
                              <figure class="media-object">
                                <img class="img-object imgupload{{ $gf->id }}" src="/upload/gifts/{{ $gf->image_url }}" style="display: block;margin-left: auto;margin-right: auto;">
                              </figure>
                            </div>
                            <div class="media-control" align="center" style="margin-top:-1%">
                              <button class="save-profile{{ $gf->id }} btn btn-primary"><i class="fa fa-save"></i> Save Gift</button>
                            </form>
                              <button class="edit-profile{{ $gf->id }} btn btn-primary"><i class="fa fa-edit"></i> Edit Gift</button>
                            </div>
                    </td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Gift" data-pk="{{ $gf->id }}" data-type="text" data-url="{{ route('TableGift-update') }}">{{ $gf->name }}</a></td>
                    <td><a href="#" class="usertext" data-name="chipsPrice" data-title="Chip Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('TableGift-update') }}">{{ $gf->price }}</a></td>
                    <td><a href="#" class="category" data-name="category_id" data-pk="{{ $gf->id }}" data-type="select" data-value="{{ $gf->category_id }}" data-url="{{ route('TableGift-update') }}" data-title="Select type">{{ $gf->strCategory() }}</a></td>
                    <td><a href="#" class="status" data-name="status" data-pk="{{ $gf->id }}" data-type="select" data-value="{{ $gf->status }}" data-url="{{ route('TableGift-update') }}" data-title="Select type">{{ strEnabledDisabled($gf->status)}}</a></td>
                    <td>
                        <a href="#" style="color:red;" class="delete{{ $gf->id }}" 
                            id="delete"
                            data-pk="{{ $gf->id }}"
                            data-toggle="modal"
                            data-target="#delete-modal">
                              <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
                @else
                <tr>
                    <td >
                          <div class="media-container">
                              <figure class="media-object">
                                <img class="img-object imgupload{{ $gf->id }}" src="/upload/gifts/{{ $gf->image_url }}" style="display: block;margin-left: auto;margin-right: auto;">
                              </figure>
                          </div>
                    </td>
                    <td>{{ $gf->name }}</td>
                    <td>{{ $gf->price }}</td>
                    <td>{{ $gf->strCategory() }}</td>
                    <td>{{ strEnabledDisabled($gf->status) }}</td>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Gift Store</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('TableGift-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center">
                <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
                  <img id="blah" src="http://placehold.jp/150x50.png" alt="your image" style="display: block;border-radius:10px;" width="auto" height="98px" />
                </div><br>
                  <input type='file' name="file" onchange="readURL(this);"/><br><br>
                  <input type="text" class="form-control" name="title" placeholder="Name"><br>
                  <input type="number" class="form-control" name="price" placeholder="Price"><br>
                  <select name="category" class="form-control">
                    <option>Category</option>
                    <option value="1">Makanan</option>
                    <option value="2">Minuman</option>
                    <option value="3">Item</option>
                  </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data" >
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
          <form action="{{ route('TableGift-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i> Yes</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<script type="text/javascript">
	$(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
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
        mode :'inline',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        }
      });

      $('.category').editable({
        mode :'inline',
        value: '',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
				source: [
                {value: '', text: 'Choose Category Gift'},
                @php 
				          echo '{value: "'.$category[0].'", text: "'.$category[1].'"},';
					        echo '{value: "'.$category[2].'", text: "'.$category[3].'"},';
					        echo '{value: "'.$category[4].'", text: "'.$category[5].'"},';
                @endphp
        ]
      });

      $('.status').editable({
        mode :'inline',
        value: '',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
				source: [
                  {value: '', text: 'Choose for activation'},
                  @php
                  echo '{value:"'.$endis[0].'", text: "'.$endis[1].'"}, ';
                  echo '{value:"'.$endis[2].'", text: "'.$endis[3].'"}, ';
                  @endphp
        ]
      });

      @php
            foreach($gifts as $gf) {
              echo'$(".delete'.$gf->id.'").hide();';
              echo'$(".deletepermission'.$gf->id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$gf->id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$gf->id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$gf->id.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$gf->id.'").click(function(e) {';
                echo'e.preventDefault();';

                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
            }
      @endphp

            @php
              foreach($gifts as $gf) {
                echo'$(".save-profile'.$gf->id.'").hide(0);';
                  echo'$(".med-ovlay'.$gf->id.'").hide(0);';

                  echo'$(".edit-profile'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeIn(300);';
                    echo'$(".save-profile'.$gf->id.'").fadeIn(300);';
                  echo'});';
                  echo'$(".save-profile'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$gf->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".upload'.$gf->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';

                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload'.$gf->id.'").attr("src", e.target.result);';
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
