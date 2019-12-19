@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('Item') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('Table Gift') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<link rel="stylesheet" href="/css/imageinsertedit.css">

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
      <h2><strong><i class="fa fa-columns"></i>{{ TranslateMenuItem('Table Gift') }}</strong></h2>
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
                <i class="fa fa-plus"></i>{{ TranslateMenuItem('Create New Gift') }}
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah bot baru -->

        </div>

      </div>

      <div class="custom-scroll table-responsive" style="height:900px;">

        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu && $mainmenu)
                <th style="width:100px;"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ TranslateMenuItem('Select All') }}</th>
                @endif
                <th style="width:10px;">{{ TranslateMenuItem('Image') }}</th>
                <th class="th-sm">{{ TranslateMenuItem('Title') }}</th>
                <th class="th-sm">{{ TranslateMenuItem('Price') }}</th>
                <th class="th-sm">{{ TranslateMenuItem('Category') }}</th>
                <th class="th-sm">{{ TranslateMenuItem('Status') }}</th>
                @if($menu && $mainmenu)
                <th align="center" style="width:10px;">
                  <a  href="#" style="color:red;font-weight:bold;" 
                        class="delete" 
                        id="trash" 
                        data-toggle="modal" 
                        data-target="#deleteAll"><i class="fa  fa-trash-o"></i>
                  </a>  
                </th>
                @endif
              </tr>
            </thead>
            <tbody>
                @foreach($gifts as $gf)
                @if($menu && $mainmenu)
                <tr>
                  <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $gf->id }}" class="deletepermission{{ $gf->id }} deleteIdAll"></td>
                    <td >
                          <div class="media-container">
                            <form method="POST" action="{{ route('TableGift-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay-wtr med-ovlay{{ $gf->id }}">
                                <input type="hidden" name="pk" value="{{ $gf->id }}">
                                <input type="file" name="file" id="media-input-wtr" class="upload{{ $gf->id }}" accept="image/*">
                                <i class="fa fa-edit media-icon-wtr"></i>
                                <p class="nav-name">Main image</p>
                                
                              </span>
                              <span class="media-overlay-wtr1 med-ovlay{{ $gf->id }}">
                                <input type="hidden" name="pk" value="{{ $gf->id }}">
                                <input type="file" name="file1" id="media-input-wtr1" class="upload1{{ $gf->id }}">
                                <i class="fa fa-edit media-icon-wtr1"></i>
                                <div class="nav-name">Watermark</div>
                              </span>
                              <figure class="media-object">
                                {{-- <img class="img-object-wtr imgupload{{ $gf->id }}" src="{{ route('imageshowgift', $gf->id) }}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;"> --}}
                                <img class="img-object-wtr imgupload{{ $gf->id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/gift/'.$gf->id.'.png'}}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;">
                                <img class="img-object-wtr1 imgupload1{{ $gf->id }}" src="http://placehold.jp/80x100.png">
                                <img class="img-object-wtr2 imgupload2{{ $gf->id }}" src="http://placehold.jp/80x100.png">
                              </figure>
                              <figure>
                                
                              </figure>
                            </div>
                            <div class="media-control" align="center" style="margin-top:-1%">
                              <button class="save-profile{{ $gf->id }} btn btn-primary"><i class="fa fa-save"></i>{{ TranslateMenuItem('Save Gift') }}</button>
                            </form>
                              <button class="cancel-upload{{ $gf->id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}</button>
                              <button class="edit-profile{{ $gf->id }} btn btn-primary"><i class="fa fa-edit"></i>{{ TranslateMenuItem('Edit Gift') }}</button>
                            </div>
                    </td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Gift" data-pk="{{ $gf->id }}" data-type="text" data-url="{{ route('TableGift-update') }}">{{ $gf->name }}</a></td>
                    <td><a href="#" class="usertext" data-name="price" data-title="Chip Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('TableGift-update') }}">{{ $gf->price }}</a></td>
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
                                <img class="img-object imgupload{{ $gf->id }}" src="{{ route('imageshowgift', $gf->id) }}?{{ $timenow }}" style="display: block;margin-left: auto;margin-right: auto;">
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

                  <table width="100%;" height="auto">
                    <tr>
                      <td align="center">
                        <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
                          <img id="blah" src="http://placehold.jp/150x50.png" alt="your image" style="display: block;border-radius:10px;" width="auto" height="98px" />
                        </div><br>
                          <input type='file' class="main-image" name="file" onchange="readURL(this);"/>
                      </td>
                      <td align="center">
                        <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
                          <img id="blah1" src="http://placehold.jp/150x50.png" alt="your image" style="display: block;border-radius:10px;" width="auto" height="98px" />
                        </div><br>
                          <input type='file' class="watermark-image" name="file1" />
                      </td>
                    </tr>
                  </table>
                  
                  <input type="text" class="form-control" name="title" placeholder="Name"><br>
                  <input type="number" class="form-control" name="price" placeholder="Price"><br>
                  <select name="category" class="form-control">
                    <option>{{ TranslateMenuItem('Category') }}</option>
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
            <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
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
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash">{{ TranslateMenuItem('DeleteData') }}</i></h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuItem('Are you sure want to delete it') }}
          <form action="{{ route('TableGift-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes') }}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No') }}</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- MODAL DELETE ALL SELECTED -->
<div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('Delete all selected data') }}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are U Sure') }}
        <form action="{{ route('TableGift-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes') }}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No') }}</button>
      </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$(".watermark-image").change(function() {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $("#blah1").attr("src", e.target.result);
    };

    reader.readAsDataURL(this.files[0]);
  }
});
	$(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
      "pagingType": "full_numbers",
    });

    $("#trash").hide();
    //CHECK ALL
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
                  echo'$(".imgupload'.$gf->id.'").show();';
                  echo'$(".imgupload1'.$gf->id.'").hide(0);';
                  echo'$(".imgupload2'.$gf->id.'").hide(0);';
                  echo'$(".cancel-upload'.$gf->id.'").hide(0);';

                  echo'$(".edit-profile'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".imgupload'.$gf->id.'").fadeOut(300);';
                    echo'$(".imgupload1'.$gf->id.'").fadeIn(300);';
                    echo'$(".imgupload2'.$gf->id.'").fadeIn(300);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeIn(300);';
                    echo'$(".cancel-upload'.$gf->id.'").fadeIn(300);';
                    echo'$(".save-profile'.$gf->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".save-profile'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".cancel-upload'.$gf->id.'").fadeOut(300);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeOut(300);';
                    echo'$(".imgupload'.$gf->id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$gf->id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$gf->id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$gf->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".cancel-upload'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeOut(300);';
                    echo'$(".imgupload'.$gf->id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$gf->id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$gf->id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$gf->id.'").fadeIn(300);';
                    echo'$(".save-profile'.$gf->id.'").hide(0);';
                  echo'});';

                  echo'$(".upload'.$gf->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';

                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload1'.$gf->id.'").attr("src", e.target.result);';
                      echo'};';

                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
                echo'$(".upload1'.$gf->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';

                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload2'.$gf->id.'").attr("src", e.target.result);';
                      echo'};';

                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
              }
            @endphp
            
            //DELETE ALL SELECTED MODAL 
            $('.delete').click(function(e) {
              e.preventDefault();
              var allVals = [];
                $(".deleteIdAll:checked").each(function() {
                  allVals.push($(this).attr('data-pk'));
                  var join_selected_values = allVals.join(",");
                  $('#idDeleteAll').val(join_selected_values);
              });
            });

            //HIDE SHOW ICON DELETE ALL
            $('#trash').hide();
            $(".deleteIdAll").click(function(e) {
              if($(".deleteIdAll:checked").length > 1) {
                $('#trash').show();
              }else{
                $("#trash").hide();
              }
            });
    },
    responsive: false
  });

</script>


@endsection
