@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">{{ TranslateMenuToko('Store')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">{{ TranslateMenuToko('Chip store')}}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/imageinsertedit.css">

<script>
    function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#blah').attr('src', e.target.result);
           };
           reader.readAsDataURL(input.files[0]);
       }
   }

   function readURL1(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#blah3').attr('src', e.target.result);
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
  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong><i class="fa fa-columns"></i>{{ TranslateMenuToko('Chip store')}}</strong></h2>				
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
                <i class="fa fa-plus"></i>{{ TranslateMenuToko('Create new chip store')}}
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
                  <th class="th-sm"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp; {{ TranslateMenuItem('Select All') }}</th>
                @endif
                <th>{{ TranslateMenuToko('Order')}}</th>
                <th style="width:10px;">{{ TranslateMenuToko('Image')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Title')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Category')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Chip Awarded')}}</th>
                <th class="th-sm">Item Bonus</th>
                <th class="th-sm">Gambar Item Bonus</th>
                <th class="th-sm">Item Bonus yang didapat</th>
                <th class="th-sm">{{ TranslateMenuToko('Gold Cost')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Active')}}</th>
                @if($menu && $mainmenu)
                  <th>{{ TranslateMenuGame('Action')}}
                    <a href="#" style="color:red;font-weight:bold;"
                        class="delete"
                        id="trash"
                        data-toggle="modal"
                        data-target="#deleteAll"><i class="fa fa-trash-o"></i>
                    </a>
                  </th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($items as $itm)
                @if($menu && $mainmenu)
                  @if($itm->status === 0)
                    <tr>
                      <td><input type="checkbox" name="deletepermission[]" data-pk="{{ $itm->item_id }}" data-name="unity-asset/store/chip/{{ $itm->item_id }}.png" data-bonus="unity-asset/store/chip/{{ $itm->item_id }}-2.png" class="deletepermission{{ $itm->item_id }} deleteIdAll"></td>
                      <td><a href="#" class="usertext" data-name="order" data-title="Orders" data-pk="{{ $itm->item_id }}" data-type="number" data-url="{{ route('ChipStore-update') }}">{{ $itm->order }}</a></td>
                      <td>
                        <div class="media-container">
                            <form method="POST" action="{{ route('ChipStore-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay-wtr med-ovlay{{ $itm->item_id}}">
                                  <input type="hidden" name="pk" value="{{ $itm->item_id }}">
                                  <input type="file" name="file" id="media-input-wtr" class="upload{{ $itm->item_id }}" accept="image/*">
                                  <i class="fa fa-edit media-icon-wtr"></i>
                                  <p class="nav-name">{{ TranslateMenuToko('Main Image')}}</p>
                              </span>
                              <span class="media-overlay-wtr1 med-ovlay{{ $itm->item_id }}">
                                  <input type="hidden" name="pk" value="{{ $itm->item_id }}">
                                  <input type="file" name="file1" id="media-input-wtr1" class="upload1{{ $itm->item_id }}">
                                  <i class="fa fa-edit media-icon-wtr1"></i>
                                  <div class="nav-name">Watermark</div>
                              </span>
                              <figure class="media-object">
                                <img class="img-object-normal imgupload{{ $itm->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$itm->item_id.'.png'}}?{{ $timenow }}" style="  display: block;margin-left: auto;margin-right: auto;">
                                <img class="img-object-wtr1 imgupload1{{ $itm->item_id }}" src="http://placehold.jp/80x100.png">
                                <img class="img-object-wtr2 imgupload2{{ $itm->item_id }}" src="http://placehold.jp/80x100.png">
                              </figure>
                            </div>
                            <div class="media-control" align="center" style="margin-top:-1%">
                              <button class="save-profile{{ $itm->item_id }} btn btn-primary"><i class="fa fa-save"></i>{{ TranslateMenuToko('Save Image')}}</button>
                            </form>
                              <button class="cancel-upload{{ $itm->item_id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuGame('Cancel')}}</button>
                              <button class="edit-profile{{ $itm->item_id }} btn btn-primary"><i class="fa fa-edit"></i>{{ TranslateMenuToko('Edit')}}</button>
                        </div>
                      </td>
                      <td><a href="#" class="usertext" data-name="name" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="text" data-url="{{ route('ChipStore-update') }}">{{ $itm->name }}</a></td>
                      <td>{{ $itm->strItemType() }}</td>
                      <td><a href="#" class="usertext" data-name="item_get" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="number" data-url="{{ route('ChipStore-update') }}">{{ $itm->item_get }}</a></td>
                      <td><a href="#" class="bontypeActive" data-name="bonus_type" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="select" data-url="{{ route('ChipStore-update') }}">{{ strItemBonType($itm->bonus_type) }}</a></td>
                      <td>
                        <div class="media-container" align="center">
                          <form method="POST" action="{{ route('ChipStore-updateimageBonus') }}" enctype="multipart/form-data">
                            {{  csrf_field() }}
                            <span class="media-overlay-wtrAva med-ovlayBonus{{ $itm->item_id }}">
                              <input type="hidden" name="pk" value="{{ $itm->item_id }}">
                              <input type="file" name="fileImageBonus" id="media-input-wtr" class="uploadBonus{{ $itm->item_id }}" accept="image/*">
                              <i class="fa fa-edit media-icon-wtr"></i>
                              <p class="nav-name">Main image</p>
                            </span>
                            <figure class="media-object">
                              <img class="img-object uploadBonusImg{{ $itm->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$itm->item_id.'-2.png' }}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;">
                              <img class="img-object-wtr1Ava uploadBonusImg1{{ $itm->item_id }}" src="http://placehold.jp/80x100.png">
                            </figure>
                           
                          </div>
                          <div class="media-control" align="center" style="margin-top:-1%">
                            <button class="save-ImgBonus{{ $itm->item_id }} btn btn-primary"><i class="fa fa-save"></i>{{ Translate_menuPlayers('Save') }}</button>
                          </form>
                            <button class="cancel-ImgBonus{{ $itm->item_id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}</button>
                            <button class="edit-ImgBonus{{ $itm->item_id }} btn btn-primary"><i class="fa fa-edit"></i>{{ Translate_menuPlayers('Edit') }}</button>
                        </div>
                      </td>
                      <td><a href="#" class="usertext" data-name="bonus_get" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="number" data-url="{{ route('ChipStore-update')}}">{{ $itm->bonus_get }}</a></td>
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
                      <td></td>
                      <td>{{ $itm->order }}</td>
                      <td>
                        <div class="media-container">
                              <figure class="media-object">
                                {{-- <img class="img-object imgupload{{ $itm->item_id }}" src="{{ route('imageItemChip', $itm->item_id) }}?{{ $timenow }}" style="  display: block;margin-left: auto;margin-right: auto;"> --}}
                                <img class="img-object imgupload{{ $itm->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$itm->item_id.'.png'}}?{{ $timenow }}" style="display: block;margin-left: auto;margin-right: auto;">
                                <img class="img-object-wtr1 imgupload1{{ $itm->item_id }}" src="http://placehold.jp/80x100.png">
                                <img class="img-object-wtr2 imgupload2{{ $itm->item_id }}" src="http://placehold.jp/80x100.png">
                              </figure>      
                        </div>
                      </td>
                      <td>{{ $itm->name }}</td>
                      <td>{{ $itm->strItemType() }}</td>
                      <td>{{ $itm->item_get }}</td>
                      <td>{{ strItemBonType($itm->bonus_type)}}</td>
                      <td>
                        <div class="media-container">
                          <figure class="media-object">
                              <img class="img-object uploadBonus{{ $itm->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$itm->item_id.'-2.png'}}?{{ $timenow }}" style="margin-left: auto;margin-right: auto;">
                          </figure>
                        </div>                        
                      </td>
                      <td>{{ $itm->bonus_get  }}</td>
                      <td>{{ $itm->price }}</td>
                      <td><a href="#" class="stractive" data-name="status" data-title="Title Chip" data-pk="{{ $itm->item_id }}" data-type="select" data-url="{{ route('ChipStore-update') }}">{{ strEnabledDisabled($itm->status) }}</a></td>
                      <td></td>
                    </tr>
                  @endif
                @else 
                  <tr>
                    <td>{{ $itm->order }}</td>
                    <td>
                        <div class="media-container">
                            <figure class="media-object">
                              <img class="img-object-normal imgupload{{ $itm->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$itm->item_id.'.png'}}?{{ $timenow }}" style="  display: block;margin-left: auto;margin-right: auto;">
                            </figure>
                        </div>
                    </td>
                    <td>{{ $itm->name }}</td>
                    <td>{{ $itm->strItemType() }}</td>
                    <td>{{ $itm->item_get }}</td>
                    <td>{{ strItemBonType($itm->bonus_type) }}</td>
                    <td>
                        <div class="media-container">
                          <figure class="media-object">
                              <img class="img-object uploadBonus{{ $itm->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/chip/'.$itm->item_id.'-2.png'}}?{{ $timenow }}" style="margin-left: auto;margin-right: auto;">
                          </figure>
                        </div>                        
                    </td>
                    <td>{{ $itm->bonus_get}}</td>
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
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuGame('Delete Data')}}</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i> 
            </button>
          </div>
          <div class="modal-body">
            {{ TranslateMenuGame('Are you sure')}}
            <form action="{{ route('ChipStore-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuGame('Yes')}}</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuGame('No')}}</button>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuToko('Create new chip store')}}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('ChipStore-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
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
           
          </div>
          <div class="form-group">
              <input type="text" name="order" class="form-control" id="basic-url" placeholder="Order">
          </div>
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="number" name="chipawarded" class="form-control" id="basic-url" placeholder="chip awarded">
          </div>
          <div class="form-group">
            <input type="number" name="goldcost" class="form-control" id="basic-url" placeholder="gold cost">
          </div>
          
          <div class="form-group">
            <p>
              <a href="#" width="200px" class="btn btn-primary mainmenu" role="button" 
                  data-toggle="" aria-expanded="false" aria-controls="collapseExample">
                Add item bonus
              </a>
            </p>
          
            <div class="form-collaps" id="collapseExample">
                <div class="sub-form">
                    <select name="BonusType" class="form-control" id="">
                        <option value="">Select type</option>
                        <option value="{{ $bontype[0] }}">{{ $bontype[1] }}</option>
                        <option value="{{ $bontype[2] }}">{{ $bontype[3] }}</option>
                        <option value="{{ $bontype[4] }}">{{ $bontype[5] }}</option>
                    </select>
                </div>
                <br class="sub-form">
                        
                <div class="form-group sub-form" align="center">
                    <table width="100%;" height="auto">
                        <tr>
                            <td align="center">
                                <div style="border-radius:10px;border:1px solid black;width:198px;height:100px;position: relative;display: inline-block;">
                                  <img id="blah3" src="http://placehold.jp/150x50.png" alt="your image" style="margin-top: 1px; display: block;border-radius:10px;" width="auto" height="97px" />
                                </div>
                                  <br>
                                  <input type='file' class="main-imageBonus" name="filebonus" onchange="readURL1(this);"/>
                            </td>
                        </tr>
                    </table>
                </div>
                      
                <div class="form-group sub-form">              
                  <input type="text" name="itemAwarded" class="form-control" id="basic-url" placeholder="item awarded">
                </div>
        
            </div>
        </div>

          <div class="form-group">
            <select name="status_item" class="form-control" id="">
              <option value="">Select status</option>
                <option value="{{ $endis[0]}}">{{ $endis[1] }}</option>
            <option value="{{ $endis[2]}}">{{ $endis[3] }}</option>
            </select>
          </div>
      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i>{{ Translate_MenuContentAdmin('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i>{{ Translate_MenuContentAdmin('Cancel')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->

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
        <form action="{{ route('ChipStore-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
          <input type="hidden" name="imageid" id="idDeleteAllimage" value="">
          <input type="hidden" name="imageidBonus" id="idDeleteAllBonus" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes') }}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No') }}</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Script -->
<script>
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

            //HIDE SHOW FORM BONUS
    $('.sub-form').hide();
    $(".mainmenu").on("click", function(e) {
      $('.sub-form').toggle();
      e.preventDefault();
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

      $('.stractive').editable({
        value: '',
        mode :'inline',
        success: function success() {
          location.reload();
        },
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
				source: [
                  {value: '', text: 'choose for activation'},
                  @php
                      echo '{value:"'.$endis[0].'", text: "'.$endis[1].'"}, ';
                      echo '{value:"'.$endis[2].'", text: "'.$endis[3].'"}, ';
                  @endphp
        ]        
      });

      $('.bontypeActive').editable({  
        value: '',
        mode :'inline',
        success: function success() {
          location.reload();
        },
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
				source: [
                  {value: '', text: 'choose type bonus'},
                  @php
                      echo '{value:"'.$bontype[0].'", text: "'.$bontype[1].'"}, ';
                      echo '{value:"'.$bontype[2].'", text: "'.$bontype[3].'"}, ';
                      echo '{value:"'.$bontype[4].'", text: "'.$bontype[5].'"}, ';
                  @endphp
        ]        
      });


      @php
          foreach($items as $itm) {
              echo '$(".delete'.$itm->item_id.'").hide();';
              echo '$(".deletepermission'.$itm->item_id.'").on("click", function() {';
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

      @php
              foreach($items as $itm) {
                echo'$(".save-profile'.$itm->item_id.'").hide(0);';
                  echo'$(".med-ovlay'.$itm->item_id.'").hide(0);';
                  echo'$(".imgupload'.$itm->item_id.'").show();';
                  echo'$(".imgupload1'.$itm->item_id.'").hide(0);';
                  echo'$(".imgupload2'.$itm->item_id.'").hide(0);';
                  echo'$(".cancel-upload'.$itm->item_id.'").hide(0);';

                  echo'$(".edit-profile'.$itm->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".imgupload'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".imgupload1'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".imgupload2'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".med-ovlay'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".save-profile'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".cancel-upload'.$itm->item_id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".save-profile'.$itm->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".cancel-upload'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".imgupload'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$itm->item_id.'").fadeOut(300);';
                  echo'});';

                  echo'$(".cancel-upload'.$itm->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".imgupload'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".save-profile'.$itm->item_id.'").hide(0);';
                  echo'});';

                  echo'$(".upload'.$itm->item_id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload1'.$itm->item_id.'").attr("src", e.target.result);';
                      echo'};';
		
                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
                echo'$(".upload1'.$itm->item_id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';

                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload2'.$itm->item_id.'").attr("src", e.target.result);';
                      echo'};';

                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';


                //JS BAGIAN IMAGE BONUS
                echo'$(".save-ImgBonus'.$itm->item_id.'").hide(0);';
                  echo'$(".med-ovlayBonus'.$itm->item_id.'").hide(0);';
                  echo'$(".uploadBonusImg'.$itm->item_id.'").show();';
                  echo'$(".uploadBonusImg1'.$itm->item_id.'").show(0);';
                  echo'$(".cancel-ImgBonus'.$itm->item_id.'").hide(0);';

                  echo'$(".edit-ImgBonus'.$itm->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".uploadBonusImg'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".uploadBonusImg1'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".med-ovlayBonus'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".save-ImgBonus'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".cancel-ImgBonus'.$itm->item_id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".save-ImgBonus'.$itm->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlayBonus'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".edit-ImgBonus'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".cancel-ImgBonus'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".uploadBonusImg'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".uploadBonusImg1'.$itm->item_id.'").fadeOut(300);';
                  echo'});';

                  echo'$(".cancel-ImgBonus'.$itm->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlayBonus'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".uploadBonusImg'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".uploadBonusImg1'.$itm->item_id.'").fadeOut(300);';
                    echo'$(".edit-ImgBonus'.$itm->item_id.'").fadeIn(300);';
                    echo'$(".save-ImgBonus'.$itm->item_id.'").hide(0);';
                  echo'});';

                //JS MAIN IMAGE BONUS
                echo'$(".uploadBonus'.$itm->item_id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".uploadBonusImg1'.$itm->item_id.'").attr("src", e.target.result);';
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

          var allimage = [];
            $(".deleteIdAll:checked").each(function() {
              allimage.push($(this).attr('data-name'));
              var join_selected_image = allimage.join(",");
              $('#idDeleteAllimage').val(join_selected_image);
              
          });
          
          var allBonus = [];
            $(".deleteIdAll:checked").each(function() {
              allBonus.push($(this).attr('data-bonus'));
              var join_selected_bonus = allBonus.join(",");
              $('#idDeleteAllBonus').val(join_selected_bonus);
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