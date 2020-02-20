@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">{{ Translate_menu('L_STORE')}}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">{{ Translate_menu('L_GOLD_STORE')}}</a></li>
@endsection



@section('content')

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

@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong><i class="fa fa-columns"></i>{{ Translate_menu('L_GOLD_STORE')}}</strong></h2>				
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
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createGoldStore">
                <i class="fa fa-plus"></i>{{ TranslateMenuToko('Create new gold store')}}
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
                  <th class="th-sm"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ TranslateMenuItem('Select All') }}</th>
                @endif
                <th>{{ TranslateMenuToko('Order')}}</th>
                <th style="width:10px;">{{ TranslateMenuToko('Image')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Title')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Gold Awarded')}}</th>
                <th class="th-sm">Item Bonus</th>
                <th class="th-sm">Gambar Item Bonus</th>
                <th class="th-sm">Item Bonus yang didapat</th>
                <th class="th-sm">{{ TranslateMenuToko('Price cash')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Item type')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Pay Transaction')}}</th>
                <th class="th-sm">Google Key</th>
                <th class="th-sm">{{ TranslateMenuItem('Status')}}</th>
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
              @foreach($getGolds as $gold)
              @if($menu && $mainmenu)
                @if($gold->status === 0)
                  <tr>
                  <td style="text-align:center;"><input type="checkbox" name="deletepermission[]" data-username="{{ $gold->name }}" data-pk="{{ $gold->item_id }}" data-name="unity-asset/store/gold/{{ $gold->item_id }}.png" data-bonus="unity-asset/store/gold/{{ $gold->item_id }}-2.png" class="deletepermission{{ $gold->item_id }} deleteIdAll"></td>
                    <td><a href="#" class="usertext" data-name="order" data-title="order" data-pk="{{ $gold->item_id }}" data-type="number" data-url="{{ route('GoldStore-update') }}">{{ $gold->order }}</a></td>
                    <td>
                      <div class="media-container">
                          <form method="POST" action="{{ route('GoldStore-updateimage') }}" enctype="multipart/form-data">
                            {{  csrf_field() }}
                            <span class="media-overlay-wtr med-ovlay{{ $gold->item_id}}">
                                <input type="hidden" name="pk" value="{{ $gold->item_id }}">
                                <input type="file" name="file" id="media-input-wtr" class="upload{{ $gold->item_id }}" accept="image/*">
                                <i class="fa fa-edit media-icon-wtr"></i>
                                <p class="nav-name">{{ TranslateMenuToko('Main Image')}}</p>
                            </span>
                            <span class="media-overlay-wtr1 med-ovlay{{ $gold->item_id }}">
                                <input type="hidden" name="pk" value="{{ $gold->item_id }}">
                                <input type="file" name="file1" id="media-input-wtr1" class="upload1{{ $gold->item_id }}">
                                <i class="fa fa-edit media-icon-wtr1"></i>
                                <div class="nav-name">Watermark</div>
                            </span>
                            <figure class="media-object">
                              {{-- <img src="{{ route('imageItemGold', $gold->item_id) }}?{{ $timenow }}" class="img-object-wtr imgupload{{ $gold->item_id }}" style="margin-left: auto; margin-right: auto;"> --}}
                              <img src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'.png'}}?{{ $timenow }}" class="img-object-normal imgupload{{ $gold->item_id }}" style="margin-left: auto; margin-right: auto;">
                              <img class="img-object-wtr1 imgupload1{{ $gold->item_id }}" src="http://placehold.jp/80x100.png">
                              <img class="img-object-wtr2 imgupload2{{ $gold->item_id }}" src="http://placehold.jp/80x100.png">
                            </figure>
                          </div>
                          <div class="media-control" align="center" style="margin-top:-1%">
                            <button class="save-profile{{ $gold->item_id }} btn btn-primary"><i class="fa fa-save"></i>{{ TranslateMenuToko('Save Image')}}</button>
                          </form>
                            <button class="cancel-upload{{ $gold->item_id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuGame('Cancel')}}</button>
                            <button class="edit-profile{{ $gold->item_id }} btn btn-primary"><i class="fa fa-edit"></i>{{ TranslateMenuToko('Edit')}}</button>
                      </div>
                    </td>
                    <td><a href="#" class="usertext" data-title="Name" data-name="name" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('GoldStore-update') }}">{{ $gold->name }}</a></td>
                    <td><a href="#" class="usertext" data-title="Gold Awarded" data-name="item_get" data-pk="{{ $gold->item_id }}" data-type="number" data-url="{{ route('GoldStore-update') }}">{{ $gold->item_get }}</a></td>
                    <td><a href="#" class="bontypeActive" data-name="bonus_type" data-title="title gold" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('GoldStore-update') }}">{{ ConfigTextTranslate(strItemBonType($gold->bonus_type)) }}</a></td>
                    <td>
                      <div class="media-container" align="center">
                        <form method="POST" action="{{ route('GoldStore-updateimageBonus') }}" enctype="multipart/form-data">
                          {{  csrf_field() }}
                          <span class="media-overlay-wtrAva med-ovlayBonus{{ $gold->item_id }}">
                            <input type="hidden" name="pk" value="{{ $gold->item_id }}">
                            <input type="file" name="fileImageBonus" id="media-input-wtr" class="uploadBonus{{ $gold->item_id }}" accept="image/*">
                            <i class="fa fa-edit media-icon-wtr"></i>
                            <p class="nav-name">Main image</p>
                          </span>
                          <figure class="media-object">
                            <img class="img-object uploadBonusImg{{ $gold->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'-2.png' }}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;">
                            <img class="img-object-wtr1Ava uploadBonusImg1{{ $gold->item_id }}" src="http://placehold.jp/80x100.png">
                          </figure>
                         
                        </div>
                        <div class="media-control" align="center" style="margin-top:-1%">
                          <button class="save-ImgBonus{{ $gold->item_id }} btn btn-primary"><i class="fa fa-save"></i>{{ Translate_menuPlayers('Save') }}</button>
                        </form>
                          <button class="cancel-ImgBonus{{ $gold->item_id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}</button>
                          <button class="edit-ImgBonus{{ $gold->item_id }} btn btn-primary"><i class="fa fa-edit"></i>{{ Translate_menuPlayers('Edit') }}</button>
                      </div>
                    </td>
                    <td><a href="#" class="usertext" data-name="bonus_get" data-title="title gold" data-pk="{{ $gold->item_id }}" data-type="number" data-url="{{ route('GoldStore-update') }}">{{ $gold->bonus_get }}</a></td>
                    <td><a href="#" class="usertext" data-title="Price" data-name="price" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('GoldStore-update') }}">{{ $gold->price }}</a></td>
                    <td>{{ ConfigTextTranslate($gold->strItemType()) }}</td>
                    <td><a href="#" class="transactionType" data-title="Price" data-name="trans_type" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('GoldStore-update') }}">{{ strTypeTransaction($gold->trans_type) }}</a></td>
                    <td><a href="#" class="usertext" data-title="Google Key" data-name="google_key" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('GoldStore-update') }}">{{ $gold->google_key }}</a></td>
                    <td><a href="#" class="strEnable" data-title="Active" data-name="status" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('GoldStore-update') }}">{{ ConfigTextTranslate(strEnabledDisabled($gold->status)) }}</a></td>
                    <td style="text-align:center;">
                      <a href="#" style="color:red;" class="delete{{ $gold->item_id }}" 
                        id="delete" 
                        data-pk="{{ $gold->item_id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @else
                  <tr>
                    <td style="text-align:center;"></td>
                    <td>{{ $gold->order }}</td>
                    <td>
                      <div class="media-container">
                        <figure class="media-object">
                            <img class="img-object uploadBonus{{ $gold->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'.png' }}?{{ $timenow }}" style="margin-left: auto;margin-right: auto;">
                        </figure>
                      </div> 
                    </td>
                    <td>{{ $gold->name }}</td>
                    <td>{{ $gold->item_get }}</td>
                    <td>{{ ConfigTextTranslate(strItemBonType($gold->bonus_type)) }}</td>
                    <td>
                      <div class="media-container">
                        <figure class="media-object">
                            <img class="img-object uploadBonus{{ $gold->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'-2.png'}}?{{ $timenow }}" style="margin-left: auto;margin-right: auto;">
                        </figure>
                      </div> 
                    </td>
                    <td>{{ $gold->bonus_get }}</td>
                    <td>{{ $gold->price }}</td>
                    <td>{{ ConfigTextTranslate($gold->strItemType()) }}</td>
                    <td>{{ strTypeTransaction($gold->trans_type) }}</td>
                    <td>{{ $gold->google_key }}</td>
                    <td><a href="#" class="strEnable" data-title="Active" data-name="status" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('GoldStore-update') }}">{{ ConfigTextTranslate(strEnabledDisabled($gold->status)) }}</a></td>
                    <td style="text-align:center;"></td>
                  </tr> 
                @endif
              @else 
              <tr>
                <td>{{ $gold->order }}</td>
                <td>
                  <div class="media-container">
                      <figure class="media-object">
                        <img class="img-object-normal imgupload{{ $gold->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'.png'}}?{{ $timenow }}" style="  display: block;margin-left: auto;margin-right: auto;">
                      </figure>
                  </div>
                </td>
                <td>{{ $gold->name }}</td>
                <td>{{ $gold->item_get }}</td>
                <td>{{ ConfigTextTranslate(strItemBonType($gold->bonus_type)) }}</td>
                <td>
                  <div class="media-container">
                      <figure class="media-object">
                         <img class="img-object uploadBonusImg{{ $gold->item_id }}" src="{{ 'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'-2.png' }}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;">
                      </figure>
                  </div>
                </td>
                <td>{{ $gold->bonus_get}}</td>
                <td>{{ $gold->price }}</td>
                <td>{{ ConfigTextTranslate($gold->strItemType()) }}</td>
                <td>{{ ConfigTextTranslate(strTypeTransaction($gold->transaction_type)) }}</td>
                <td>{{ $gold->google_key }}</td>
                <td>{{ ConfigTextTranslate(strEnabledDisabled($gold->active)) }}</td>
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
<div class="modal fade" id="createGoldStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuToko('Create new gold store')}}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('GoldStore-create') }}" method="post" enctype="multipart/form-data">
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
            <input type="text" name="order" class="form-control" id="basic-url" placeholder="order">
          </div>
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="number" name="goldAwarded" class="form-control" id="basic-url" placeholder="gold awarded">
          </div>
          <div class="form-group">
            <input type="number" name="priceCash" class="form-control" id="basic-url" placeholder="price cash">
          </div>
          <div class="form-group">
            <input type="text" name="googleKey" class="form-control" id="basic-url" placeholder="google key">
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
                    <option value="">Pilih tipe</option>
                    <option value="{{ $bontype[0] }}">{{ ConfigTextTranslate($bontype[1]) }}</option>
                    <option value="{{ $bontype[2] }}">{{ ConfigTextTranslate($bontype[3]) }}</option>
                    <option value="{{ $bontype[4] }}">{{ ConfigTextTranslate($bontype[5]) }}</option>
                  </select>
                </div>
              <br class="sub-form">
                
              <div class="form-group sub-form" align="center">
                <table width="100%;" height="auto">
                    <tr>
                      <td align="center">
                        <div style="border-radius:10px;border:1px solid black;width:198px;height:100px;position: relative;display: inline-block;">
                          <img id="blah3" src="http://placehold.jp/150x50.png" alt="your image" style="margin-top: 1px; display: block;border-radius:10px;" width="auto" height="97px" />
                        </div><br>
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

          <div class="form-group ">
            <select name="status_item" class="form-control" id="">
              <option value="">Pilih status</option>
              <option value="{{ $endis[0] }}">{{ ConfigTextTranslate($endis[1]) }}</option>
              <option value="{{ $endis[2] }}">{{ ConfigTextTranslate($endis[3]) }}</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i> {{ TranslateMenuGame('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuGame('Cancel')}}
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
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ Translate_MenuContentAdmin('L_DELETE_DATA')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are U Sure')}}
        <form action="{{ route('GoldStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ Translate_menuTransaction('Yes')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ Translate_menuTransaction('No')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End delete Modal -->

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
        <form action="{{ route('GoldStore-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
          <input type="hidden" name="imageid" id="idDeleteAllimage" value="">
          <input type="hidden" name="imageidBonus" id="idDeleteAllBonus" value="">
          <input type="text" name="usernameAll" id="userDeleteAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes') }}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No') }}</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- script -->
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
      "order": [[ 1, "asc" ]]
    });

    //HIDE SHOW FORM BONUS
    $('.sub-form').hide();
    $(".mainmenu").on("click", function(e) {
      $('.sub-form').toggle();
      // $('.form-collaps').toggle();
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

      $('.strEnable').editable({
        mode: 'inline',
        value: '',
        success: function success() {
          location.reload();
        },
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
        source: [
          {value: '', text: 'Pilih untuk aktivasi'},
          @php            
              // $endis = preg_split( "/ :|, /", $atv->value );
              echo '{value:"'.$endis[0].'", text: "'.ConfigTextTranslate($endis[1]).'"}, ';
              echo '{value:"'.$endis[2].'", text: "'.ConfigTextTranslate($endis[3]).'"}, ';
          @endphp
        ]
      });

      $('.transactionType').editable({
				value: '',
        mode: 'inline',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
				source: [
            {value: '', text: 'Pilih tipe transaksi'},
					  {value: 1, text: 'Bank Transfer'},
					  {value: 2, text: 'Internet Banking'},
					  {value: 3, text: 'Cash Digital'},
					  {value: 4, text: 'Toko'},
					  {value: 5, text: 'Akulaku'},
					  {value: 6, text: 'Credit Card'},
					  {value: 7, text: 'Google Play'}
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
                  {value: '', text: 'pilih tipe bonus'},
                  @php
                      echo '{value:"'.$bontype[0].'", text: "'.ConfigTextTranslate($bontype[1]).'"}, ';
                      echo '{value:"'.$bontype[2].'", text: "'.ConfigTextTranslate($bontype[3]).'"}, ';
                      echo '{value:"'.$bontype[4].'", text: "'.ConfigTextTranslate($bontype[5]).'"}, ';
                  @endphp
        ]        
      });

      // delete gold store
      @php
        foreach($getGolds as $gold) {
          echo'$(".delete'.$gold->item_id.'").hide();';
          echo'$(".deletepermission'.$gold->item_id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$gold->item_id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$gold->item_id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$gold->item_id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$gold->item_id.'").click(function(e) {';
            echo'e.preventDefault();';

            echo"var id = $(this).attr('data-pk');";
            echo'var test = $("#userid").val(id);';
          echo'});';
        }
      @endphp


      @php
      foreach($getGolds as $gold) {
        echo'$(".save-profile'.$gold->item_id.'").hide(0);';
        echo'$(".med-ovlay'.$gold->item_id.'").hide(0);';
        echo'$(".cancel-upload'.$gold->item_id.'").hide(0);';
        echo'$(".imgupload'.$gold->item_id.'").show();';
        echo'$(".imgupload1'.$gold->item_id.'").hide(0);';
        echo'$(".imgupload2'.$gold->item_id.'").hide(0);';

        echo'$(".edit-profile'.$gold->item_id.'").on("click", function() {';
          echo'$(this).hide(0);';
          echo'$(".med-ovlay'.$gold->item_id.'").fadeIn(300);';
          echo'$(".save-profile'.$gold->item_id.'").fadeIn(300);';
          echo'$(".cancel-upload'.$gold->item_id.'").fadeIn(300);';
          echo'$(".imgupload'.$gold->item_id.'").fadeOut(300);';
          echo'$(".imgupload1'.$gold->item_id.'").fadeIn(300);';
          echo'$(".imgupload2'.$gold->item_id.'").fadeIn(300);';
        echo'});';

        echo'$(".save-profile'.$gold->item_id.'").on("click", function() {';
          echo'$(this).hide(0);';
          echo'$(".med-ovlay'.$gold->item_id.'").fadeOut(300);';
          echo'$(".edit-profile'.$gold->item_id.'").fadeIn(300);';
          echo'$(".cancel-upload'.$gold->item_id.'").fadeOut(300);';
          echo'$(".imgupload'.$gold->item_id.'").fadeIn(300);';
          echo'$(".imgupload1'.$gold->item_id.'").fadeOut(300);';
          echo'$(".imgupload2'.$gold->item_id.'").fadeOut(300);';
        echo'});';

        echo'$(".cancel-upload'.$gold->item_id.'").on("click", function() {';
          echo'$(this).hide(0);';
          echo'$(".med-ovlay'.$gold->item_id.'").fadeOut(300);';
          echo'$(".imgupload'.$gold->item_id.'").fadeIn(300);';
          echo'$(".imgupload1'.$gold->item_id.'").fadeOut(300);';
          echo'$(".imgupload2'.$gold->item_id.'").fadeOut(300);';
          echo'$(".edit-profile'.$gold->item_id.'").fadeIn(300);';
          echo'$(".save-profile'.$gold->item_id.'").hide(0);';
        echo'});';

        echo'$(".upload'.$gold->item_id.'").change(function() {';
          echo'if (this.files && this.files[0]) {';
            echo'var reader = new FileReader();';
		
            echo'reader.onload = function(e) {';
              echo'$(".imgupload1'.$gold->item_id.'").attr("src", e.target.result);';
            echo'};';
		
            echo'reader.readAsDataURL(this.files[0]);';
          echo'}';
        echo'});';
        echo'$(".upload1'.$gold->item_id.'").change(function() {';
          echo'if (this.files && this.files[0]) {';
            echo'var reader = new FileReader();';

            echo'reader.onload = function(e) {';
              echo'$(".imgupload2'.$gold->item_id.'").attr("src", e.target.result);';
            echo'};';

            echo'reader.readAsDataURL(this.files[0]);';
          echo'}';
        echo'});';

        //JS BAGIAN IMAGE BONUS
        echo'$(".save-ImgBonus'.$gold->item_id.'").hide(0);';
          echo'$(".med-ovlayBonus'.$gold->item_id.'").hide(0);';
          echo'$(".uploadBonusImg'.$gold->item_id.'").show();';
          echo'$(".uploadBonusImg1'.$gold->item_id.'").show(0);';
          echo'$(".cancel-ImgBonus'.$gold->item_id.'").hide(0);';

          echo'$(".edit-ImgBonus'.$gold->item_id.'").on("click", function() {';
            echo'$(this).hide(0);';
            echo'$(".uploadBonusImg'.$gold->item_id.'").fadeOut(300);';
            echo'$(".uploadBonusImg1'.$gold->item_id.'").fadeIn(300);';
            echo'$(".med-ovlayBonus'.$gold->item_id.'").fadeIn(300);';
            echo'$(".save-ImgBonus'.$gold->item_id.'").fadeIn(300);';
            echo'$(".cancel-ImgBonus'.$gold->item_id.'").fadeIn(300);';
          echo'});';

          echo'$(".save-ImgBonus'.$gold->item_id.'").on("click", function() {';
            echo'$(this).hide(0);';
            echo'$(".med-ovlayBonus'.$gold->item_id.'").fadeOut(300);';
            echo'$(".edit-ImgBonus'.$gold->item_id.'").fadeIn(300);';
            echo'$(".cancel-ImgBonus'.$gold->item_id.'").fadeOut(300);';
            echo'$(".uploadBonusImg'.$gold->item_id.'").fadeIn(300);';
            echo'$(".uploadBonusImg1'.$gold->item_id.'").fadeOut(300);';
          echo'});';

          echo'$(".cancel-ImgBonus'.$gold->item_id.'").on("click", function() {';
            echo'$(this).hide(0);';
            echo'$(".med-ovlayBonus'.$gold->item_id.'").fadeOut(300);';
            echo'$(".uploadBonusImg'.$gold->item_id.'").fadeIn(300);';
            echo'$(".uploadBonusImg1'.$gold->item_id.'").fadeOut(300);';
            echo'$(".edit-ImgBonus'.$gold->item_id.'").fadeIn(300);';
            echo'$(".save-ImgBonus'.$gold->item_id.'").hide(0);';
          echo'});';

        //JS MAIN IMAGE BONUS
        echo'$(".uploadBonus'.$gold->item_id.'").change(function() {';
            echo'if (this.files && this.files[0]) {';
              echo'var reader = new FileReader();';

              echo'reader.onload = function(e) {';
                echo'$(".uploadBonusImg1'.$gold->item_id.'").attr("src", e.target.result);';
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
          var allUsername = [];
            $(".deleteIdAll:checked").each(function() {
              allVals.push($(this).attr('data-pk'));
              var join_selected_values = allVals.join(",");
              $('#idDeleteAll').val(join_selected_values);
          
              //untuk get username ketika multiple delete
              allUsername.push($(this).attr('data-username'));
              var join_selected_username = allUsername.join(",");
              $('#userDeleteAll').val(join_selected_username);
          });

          var allimage = [];
            $(".deleteIdAll:checked").each(function() {
              allimage.push($(this).attr('data-name'));
              var join_selected_image = allimage.join(",");
              $('#idDeleteAllimage').val(join_selected_image);
          });

          var allBonus = [];
            $('.deleteIdAll:checked').each(function() {
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
<!-- end script -->
@endsection