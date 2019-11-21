@extends('index')

@section('pages')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">Settings</a></li> 
    <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">General Setting</a></li>
@endsection

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

@section('content')
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
<div class="settings-table">
    <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                    <h2><strong>Android</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                        <div class="widget-body-toolbar">

                                <div class="row">
                        
                                  <!-- Button tambah bot baru -->
                                  <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                      @if($menu)
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalAssetAdr">
                                        <i class="fa fa-plus"></i> Create new asset
                                      </button>
                                      @endif
                                    </div>
                                  </div>
                                  <!-- End Button tambah bot baru -->
                        
                                </div>
                        
                              </div>
                    <div class="custom-scroll table-responsive" style="height:420px;">
                        
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    <th></th>
                                    <th>File</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Link</th>
                                    <th>Version</th>
                                    @if($menu)
                                      <th style="width:10px;"></th>
                                    @endif
                                </thead>
                                <tbody>
                                @foreach ($xml_andro->children() as $key => $xl)
                                    @if ($menu)
                                    <tr>
                                        <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $xl['name'].'1' }}"></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#ModalAssetAndro{{ $xl['name'] }}" style="width: 100%"><i class="fa fa-edit"></i>Edit asset</button></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="name" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl['name'] }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->ver }}</a></td>
                                        <td>
                                          <a href="#" style="color:red;" class="delete{{ $xl['name'].'1' }}" 
                                              id="delete"
                                              data-pk="{{ $xl['name'] }}"
                                              data-name="{{ $key }}"
                                              data-link1="{{ $xl->link }}"
                                              data-toggle="modal"
                                              data-target="#delete-modal">
                                                <i class="fa fa-times"></i>
                                          </a>
                                      </td>
                                    </tr>
                                    @else 
                                    <tr>
                                        <td>{{ $xl['name'] }}</td>
                                        <td>{{ $xl->type }}</td>
                                        <td>{{ $xl->link }}</td>
                                        <td>{{ $xl->file}}</td>
                                        <td>{{ $xl->ver }}</td>
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
    </div>

    <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                    <h2><strong>IOS</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                        <div class="widget-body-toolbar">

                                <div class="row">
                        
                                  <!-- Button tambah asset baru -->
                                  <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                      @if($menu)
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalAssetIos">
                                        <i class="fa fa-plus"></i> Create new asset
                                      </button>
                                      @endif
                                    </div>
                                  </div>
                                  <!-- End Button tambah asset baru -->
                        
                                </div>
                        
                              </div>
                    <div class="custom-scroll table-responsive" style="height:420px">
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>File</td>
                                        <td>Name</td>
                                        <td>Type</td>
                                        <td>Link</td>
                                        <td>Version</td>
                                        @if($menu)
                                          <td style="width:10px;"></td>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($xml_ios->children() as $key => $xl_ios)
                                    @if ($menu)
                                    <tr>
                                        <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $xl_ios['name'].'2' }}"></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#ModalAssetIos{{ $xl_ios['name'] }}"><i class="fa fa-edit"></i>Edit asset</button></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="name" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios['name'] }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->ver }}</a></td>
                                        <td>
                                          <a href="#" style="color:red;" class="delete{{ $xl_ios['name'].'2' }}" 
                                              id="delete"
                                              data-pk="{{ $xl_ios['name']}}"
                                              data-name="{{ $key }}"
                                              data-link="{{ $xl_ios->link }}"
                                              data-toggle="modal"
                                              data-target="#deleteIOS">
                                                <i class="fa fa-times"></i>
                                          </a>
                                      </td>
                                      </tr>
                                    @else 
                                    <tr>
                                        <td>{{ $xl_ios['name'] }}</td>
                                        <td>{{ $xl_ios->type }}</td>
                                        <td>{{ $xl_ios->link }}</td>
                                        <td>{{ $xl_ios->file }}</td>
                                        <td>{{ $xl_ios->ver }}</td>
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
    </div>
</div>


<!-- ==================================================================== MODAL CREATE ASSET ======================================================================== -->
<!-- Modal create new asset android -->
<div class="modal fade" id="ModalAssetAdr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create new asset</h4>
              <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-remove"></i>
              </button>
            </div>
            <form action="{{ route('VersionAssetApkAndroid-create') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group" align="center"><br>
                        <div class="form-group">
                            <input type="file" name="file" id="file" class="input-file">
                            <label for="file" class="btn btn-tertiary js-labelFile">
                              <i class="icon fa fa-check"></i>
                              <span class="js-fileName">Choose a file</span>
                            </label>
                          </div>
                        <br>
                        <br>
                        <input class="form-control" name="Name" placeholder="Name"><br>
                          <select name="Type" class="form-control">
                            <option>Type</option>
                            <option value="Audio">Audio</option>
                            <option value="Image">Image</option>
                          </select>
                        <br>
                          <input class="form-control" name="Link" placeholder="Link"><br>
                          <input class="form-control" name="Version" placeholder="Version"><br>
                          <input class="form-control" name="FolderName" placeholder="Folder name"><br>
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


<!-- Modal create new asset IOS -->
<div class="modal fade" id="ModalAssetIos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create new asset</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkIos-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                  <div class="form-group">
                      <input type="file" name="file2" id="file2" class="input-file">
                      <label for="file2" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-check"></i>
                        <span class="js-fileName">Choose a file</span>
                      </label>
                    </div>
                  <br>
                  <br>
                  <input class="form-control" name="Name" placeholder="Name"><br>
                    <select name="Type" class="form-control">
                      <option>Type</option>
                      <option value="Audio">Audio</option>
                      <option value="Image">Image</option>
                    </select>
                  <br>
                    <input class="form-control" name="Link" placeholder="Link"><br>
                    <input class="form-control" name="Version" placeholder="Version"><br>
                    <input class="form-control" name="FolderName" placeholder="Folder name"><br>
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


<!-- ==================================================================== MODAL EDIT ASSET ======================================================================== -->
<!-- Modal edit asset android -->
@foreach ($xml_andro->children() as $xl)
<div class="modal fade" id="ModalAssetAndro{{ $xl['name'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Edit asset andorid</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkAndroid-updateAsset') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                  <input type="hidden" value="{{ $xl['name'] }}" name="pk">
                  <div class="form-group">
                      <input type="file" name="fileEditADR" id="file3{{ $xl['name'] }}" class="input-file">
                      <label for="file3{{ $xl['name'] }}" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-check"></i>
                        <span class="js-fileName">Choose a file</span>
                      </label>
                    </div>
                  <br>
                  <br>
                  <input value="{{ $xl['name'] }}" class="form-control" name="Name" placeholder="Name"><br>
                    <select disabled name="Type" class="form-control">
                      <option>Type</option>
                      <option @if( $xl->type == 'Audio' ) selected @endif value="Audio">Audio </option>
                      <option @if( $xl->type == 'Image' ) selected @endif value="Image">Image</option>
                    </select>
                  <br>
                  <input readonly value="{{ $xl->link }}" class="form-control" name="Link" placeholder="Link"><br>
                  <input value="{{ $xl->ver }}" class="form-control" name="Version" placeholder="Version"><br>
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
@endforeach


<!-- Modal edit asset IOS -->
@foreach ($xml_ios->children() as $xl_ios)
<div class="modal fade" id="ModalAssetIos{{ $xl_ios['name'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Edit asset IOS</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkIOS-updateAsset') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                <input type="hidden" value="{{ $xl_ios['name'] }}" name="pk">
                <div class="form-group">
                    <input type="file" name="fileEditIOS" id="file4{{ $xl_ios['name'] }}" class="input-file">
                    <label for="file4{{ $xl_ios['name'] }}" class="btn btn-tertiary js-labelFile">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">Choose a file</span>
                    </label>
                  </div>
                  <br>
                  <br>
                  <input value="{{ $xl_ios['name'] }}" class="form-control" name="Name" placeholder="Name"><br>
                    <select disabled name="Type" class="form-control">
                      <option>Type</option>
                      <option @if( $xl_ios->type == 'Audio' ) selected @endif value="Audio">Audio </option>
                      <option @if( $xl_ios->type == 'Image' ) selected @endif value="Image">Image</option>
                    </select>
                  <br>
                  <input readonly value="{{ $xl_ios->link }}" class="form-control" name="Link" placeholder="Link"><br>
                  <input value="{{ $xl_ios->ver }}" class="form-control" name="Version" placeholder="Version"><br>
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
@endforeach


{{-- ============================================ POP UP CONFIRMATION DELETE ASSET ANDROID ===================================================  --}}
 
<!-- Modal Pop up delete confirm Android -->
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
          <form action="{{ route('VersionAssetApkAndroid-deleteAsset') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="name" id="id" value="">
            <input type="hidden" name="id" id="name" value="">
            <input type="hidden" name="Link" id="Link" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>


  <!-- Modal Pop up delete confirm IOS -->
 <div class="modal fade" id="deleteIOS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="{{ route('VersionAssetApkIOS-deleteAsset') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="name" id="id1" value="">
            <input type="hidden" name="id" id="name1" value="">
            <input type="hidden" name="link" id="link1" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<script>

// ==================== choose file button Android ======================= //
(function() {
  
  'use strict';

  $('.input-file').each(function() {
    var $input = $(this),
        $label = $input.next('.js-labelFile'),
        labelVal = $label.html();
    
   $input.on('change', function(element) {
      var fileName = '';
      if (element.target.value) fileName = element.target.value.split('\\').pop();
      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
   });
  });

})();



</script>


<script>
    $(document).ready(function() {
      $('table.table').dataTable( {
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
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
  
        $('.inlineSetting').editable({
              mode :'inline',
              validate: function(value) {
                if($.trim(value) == '') {
                  return 'This field is required';
                }
              }
        });
       
      },
      responsive: false
    });

    
    /* =========================== CHECK DELETE PERMISSION ============================== */
    // checkbox delete permission android
    @php
            $a = 1;
            foreach($xml_andro->children() as $xl) {
              echo'$(".delete'.$xl['name'].$a.'").hide();';
              echo'$(".deletepermission'.$xl['name'].$a.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$xl['name'].$a.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$xl['name'].$a.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$xl['name'].$a.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$xl['name'].$a.'").click(function(e) {';
                echo'e.preventDefault();';

                echo"var id    = $(this).attr('data-pk');";
                echo"var name  = $(this).attr('data-name');";
                echo"var link  = $(this).attr('data-link1');";
                echo'var test  = $("#id").val(id);';
                echo'var test2 = $("#name").val(name);';
                echo'var test3 = $("#Link").val(link);';
              echo'});';
            }
      @endphp
    
    //checkbox delete permission IoS
    @php
            $b = 2;
            foreach($xml_ios->children() as $xl_ios) {
              echo'$(".delete'.$xl_ios['name'].$b.'").hide();';
              echo'$(".deletepermission'.$xl_ios['name'].$b.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$xl_ios['name'].$b.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$xl_ios['name'].$b.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$xl_ios['name'].$b.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$xl_ios['name'].$b.'").click(function(e) {';
                echo'e.preventDefault();';
                  
                echo"var id   = $(this).attr('data-pk');";
                echo"var name = $(this).attr('data-name');";
                echo"var link = $(this).attr('data-link');";
                echo'var test = $("#id1").val(id);';
                echo'var test2= $("#name1").val(name);';
                echo'var test3= $("#link1").val(link);';
              echo'});';
            }

    @endphp
    



    /* ========================= CREATE ASSET ============================== */

    // create asset adr upload file name
    var input = document.getElementById( 'inputFile' );
    var infoArea = document.getElementById( 'file-upload-filename' );

    input.addEventListener( 'change', showFileName );

    function showFileName( event ) {
  
          // the change event gives us the input it occurred in 
          var input = event.srcElement;
  
          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;
  
          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = ''+ fileName;
    }


    // create asset IOS upload file name
    var inputIOS = document.getElementById( 'inputFile2' );
    var infoAreaIOS = document.getElementById( 'uploadFilename2' );

    inputIOS.addEventListener( 'change', showFileName2 );

    function showFileName2( event ) {
  
          // the change event gives us the input it occurred in 
          var inputIOS = event.srcElement;
  
          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileNameIOS = inputIOS.files[0].name;
  
          // use fileName however fits your app best, i.e. add it into a div
          infoAreaIOS.textContent = ''+ fileNameIOS;
    }


    /* ======================== EDIT ASSET ============================== */

    // Edit asset adr upload file name
    var inputE = document.getElementById( 'inputGroupFile3' );
    var infoArea = document.getElementById( 'file-upload-filename3' );

    input.addEventListener( 'change', showFileName );

    function showFileName( event ) {
  
          // the change event gives us the input it occurred in 
          var input = event.srcElement;
  
          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;
  
          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = ''+ fileName;
    }

    // // Edit asset IOS upload file name
    // var input = document.getElementById( 'inputFile' );
    // var infoArea = document.getElementById( 'file-upload-filename' );

    // input.addEventListener( 'change', showFileName );

    // function showFileName( event ) {
  
    //       // the change event gives us the input it occurred in 
    //       var input = event.srcElement;
  
    //       // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    //       var fileName = input.files[0].name;
  
    //       // use fileName however fits your app best, i.e. add it into a div
    //       infoArea.textContent = ''+ fileName;
    // }

  </script>
@endsection