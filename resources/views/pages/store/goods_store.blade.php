@extends('index')


@section('page')
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Goods_Store') }}">{{ TranslateMenuToko('L_STORE')}}</a></li>
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Goods_Store') }}">{{ TranslateMenuToko('L_GOODS_STORE')}}</a></li>
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
      <h2><strong><i class="fa fa-columns"></i> {{ TranslateMenuToko('L_GOODS_STORE')}}</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah best offer baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu && $mainmenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createGoods">
                <i class="fa fa-plus"></i>{{ TranslateMenuToko('L_CREATE_NEW_GOODS_STORE')}}
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah best offer baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="height:800px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if ($menu && $mainmenu)
                <th><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ TranslateMenuItem('L_SELECT_ALL') }}</th>
                @endif
                <th>{{ TranslateMenuToko('L_ORDER')}}</th>
                <th style="width:10px;">{{ TranslateMenuToko('L_IMAGE')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_TITLE')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_PRICE_POINT')}}</th>
                <th class="th-sm">{{ translate_menuTransaction('L_QUANTITY')}}</th>
                {{-- <th class="th-sm">Pay Transaction</th> --}}
                <th class="th-sm">{{ TranslateMenuItem('L_STATUS')}}</th>
                @if ($menu && $mainmenu)
                  <th class="th-sm">{{ Translate_menuPlayers('L_ACTION')}}
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
              @foreach($itemGood as $goods)
              @if($menu && $mainmenu)
                @if($goods->status === 0)
                  <tr>
                    <td align="center"><input type="checkbox" name="deletepermission[]" data-username="{{ $goods->name }}" data-pk="{{ $goods->item_id }}" data-name="unity-asset/store/goods/{{ $goods->item_id }}.png" class="deletepermission{{ $goods->item_id }} deleteIdAll"></td>
                    <td><a href="#" class="usertext" data-name="order" data-title="order" data-pk="{{ $goods->item_id }}" data-type="number" data-url="{{ route('GoodsStore-update') }}">{{ $goods->order }}</a></td>
                    <td>
                      <div class="media-container">
                          <form method="POST" action="{{ route('GoodsStore-updateimage') }}" enctype="multipart/form-data">
                            {{  csrf_field() }}
                            <span class="media-overlay-wtr med-ovlay{{ $goods->item_id}}">
                                <input type="hidden" name="pk" value="{{ $goods->item_id }}">
                                <input type="file" name="file" id="media-input-wtr" class="upload{{ $goods->item_id }}" accept="image/*">
                                <i class="fa fa-edit media-icon-wtr"></i>
                                <p class="nav-name">{{ TranslateMenuToko('L_MAIN_IMAGE')}}</p>
                            </span>
                            <span class="media-overlay-wtr1 med-ovlay{{ $goods->item_id }}">
                                <input type="hidden" name="pk" value="{{ $goods->item_id }}">
                                <input type="file" name="file1" id="media-input-wtr1" class="upload1{{ $goods->item_id }}">
                                <i class="fa fa-edit media-icon-wtr1"></i>
                                <div class="nav-name">Watermark</div>
                            </span>
                            <figure class="media-object">
                              {{-- <img src="{{ route('imageItemGold', $goods->item_id) }}?{{ $timenow }}" class="img-object-wtr imgupload{{ $goods->item_id }}" style="margin-left: auto; margin-right: auto;"> --}}
                             <img src="{{ route('imageItemGoods', $goods->item_id) }}?{{ $timenow }}" class="img-object-normal imgupload{{ $goods->item_id }}" style="margin-left: auto; margin-right: auto;">
                              <img class="img-object-wtr1 imgupload1{{ $goods->item_id }}" src="http://placehold.jp/80x100.png">
                              <img class="img-object-wtr2 imgupload2{{ $goods->item_id }}" src="http://placehold.jp/80x100.png">
                            </figure>
                          </div>
                          <div class="media-control" align="center" style="margin-top:-1%">
                            <button class="save-profile{{ $goods->item_id }} btn btn-primary"><i class="fa fa-save"></i>{{ TranslateMenuToko('L_SAVE_IMAGE')}}</button>
                          </form>
                            <button class="cancel-upload{{ $goods->item_id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuGame('L_CANCEL')}}</button>
                            <button class="edit-profile{{ $goods->item_id }} btn btn-primary"><i class="fa fa-edit"></i>{{ TranslateMenuToko('L_EDIT')}}</button>
                      </div>
                    </td>
                    <td><a href="#" class="usertext" data-name="name" data-pk="{{ $goods->item_id }}" data-type="text" data-url="{{ route('GoodsStore-update') }}">{{ $goods->name }}</a></td>
                    <td><a href="#" class="usertext" data-name="price" data-pk="{{ $goods->item_id }}" data-type="text" data-url="{{ route('GoodsStore-update') }}">{{ number_format($goods->price, 2) }}</a></td>
                    <td><a href="#" class="usertext" data-name="qty" data-pk="{{ $goods->item_id }}" data-type="text" data-url="{{ route('GoodsStore-update') }}">{{ number_format($goods->qty) }}</a></td>
                    {{-- <td><a href="#" class="transactionType" data-name="trans_type" data-pk="{{ $goods->item_id }}" data-type="select" data-url="{{ route('GoodsStore-update') }}">{{  strTypeTransaction($goods->trans_type) }}</a></td> --}}
                    <td><a href="#" class="strEnable" data-name="status" data-pk="{{ $goods->item_id }}" data-type="select" data-url="{{ route('GoodsStore-update') }}">{{ ConfigTextTranslate(strEnabledDisabled($goods->status)) }}</a></td>
                    <td>
                      <a href="#" style="color:red;" class="delete{{ $goods->item_id }}" 
                        id="delete" 
                        data-pk="{{ $goods->item_id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @else 
                  <tr>
                    <td></td>
                    <td>{{ $goods->order }}</td>
                    <td>
                      <div class="media-container">
                        <figure class="media-object">
                            <img class="img-object uploadBonus{{ $goods->item_id }}" src="{{ route('imageItemGoods', $goods->item_id) }}?{{ $timenow }}" style="margin-left: auto;margin-right: auto;">
                        </figure>
                      </div> 
                    </td>
                    <td>{{ $goods->name }}</td>
                    <td>{{ number_format($goods->price, 2) }}</td>
                    <td>{{ number_format($goods->qty) }}</td>
                    {{-- <td><a href="#" class="transactionType" data-name="trans_type" data-pk="{{ $goods->item_id }}" data-type="select" data-url="{{ route('GoodsStore-update') }}">{{  strTypeTransaction($goods->trans_type) }}</a></td> --}}
                    <td><a href="#" class="strEnable" data-name="status" data-pk="{{ $goods->item_id }}" data-type="select" data-url="{{ route('GoodsStore-update') }}">{{ ConfigTextTranslate(strEnabledDisabled($goods->status)) }}</a></td>
                    <td></td>
                  </tr>
                @endif
              @else 
              <tr>
                  <td>{{ $goods->order }}</td>
                  <td>
                      <div class="media-container">
                        <figure class="media-object">
                          <img class="img-object imgupload{{ $goods->item_id }}" src="{{ route('imageItemGoods', $goods->item_id) }}?{{ $timenow }}" style="  display: block;margin-left: auto;margin-right: auto;">
                        </figure>
                      </div>
                  </td>
                  <td>{{ $goods->name }}</td>
                  <td>{{ number_format($goods->price, 2) }}</td>
                  <td>{{ number_format($goods->qty) }}</td>
                  {{-- <td>{{  strTypeTransaction($goods->trans_type) }}</td> --}}
                  <td>{{ ConfigTextTranslate(strEnabledDisabled($goods->status)) }}</td>
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

<!-- MODAL CREATE -->
<div class="modal fade" id="createGoods" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuToko('L_CREATE_NEW_GOODS_STORE')}}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <form action="{{ route('GoodsStore-create') }}" method="post" enctype="multipart/form-data">
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
              <input type="number" name="order" class="form-control required" id="order" placeholder="Order" min="0">
          </div>
          <div class="form-group">
            <input type="text" name="title" class="form-control required" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="number" name="price" class="form-control required" id="basic-url" min="0" placeholder="price" min="0">
          </div>
          <div class="form-group">
            <input type="number" name="qty" class="form-control required" id="basic-url" min="0" placeholder="Quantity" min="0">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data btn-create toggle-disabled" disabled onclick="FunctionLoadBtn()">
            <i class="fa fa-save"></i> {{ TranslateMenuGame('L_SAVE')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuGame('L_CANCEL')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->


<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuGame('L_DELETE_DATA')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('L_ARE_U_SURE')}}
        <form action="{{ route('GoodsStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('L_YES')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_NO')}}</button>
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('L_DELETE_ALL_SELECTED_DATA') }}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('L_ARE_U_SURE') }}
        <form action="{{ route('GoodsStore-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
          <input type="hidden"  name="imageid" id="idDeleteAllimage" value="">
          <input type="hidden" name="usernameAll" id="userDeleteAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('L_YES') }}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_NO') }}</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- script -->
<script>
  //Loading button submit
  function FunctionLoadBtn(){
    $(".btn-create").text("Loading...");
    $(this).submit('loading').delay(1000).queue(function() {
    })
  }

  //Disable submit button before form fullfilled
  $(document).on('change keyup', '.required', function(e){
    let Disabled = true;

    $(".required").each(function() {
      let value = this.value
      if((value)&&(value.trim() != ''))
      {
        Disabled = false
      } else {
        Disabled = true
        return false
      }
    });

    if(Disabled){
      $('.toggle-disabled').prop('disabled', true);
    }else{
      $('.toggle-disabled').prop('disabled', false);
    }
  })

  // preview image
$(".watermark-image").change(function() {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $("#blah1").attr("src", e.target.result);
    };

    reader.readAsDataURL(this.files[0]);
  }
});
  // end preview image

  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
      "pagingType": "full_numbers",
      "order": [[ 1, "asc" ]]
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
            {value: '', text: 'Pilih untuk tipe transaksi'},
					  {value: 1, text: 'Bank Transfer'},
					  {value: 2, text: 'Internet Banking'},
					  {value: 3, text: 'Cash Digital'},
					  {value: 4, text: 'Toko'},
					  {value: 5, text: 'Akulaku'},
					  {value: 6, text: 'Credit Card'},
					  {value: 7, text: 'Google Play'}
				   ]
			});


      @php
          foreach($itemGood as $goods) {
              echo'$(".delete'.$goods->item_id.'").hide();';
              echo'$(".deletepermission'.$goods->item_id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$goods->item_id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$goods->item_id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$goods->item_id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$goods->item_id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
          }
      @endphp
      @php
              foreach($itemGood as $goods) {
                echo'$(".save-profile'.$goods->item_id.'").hide(0);';
                  echo'$(".med-ovlay'.$goods->item_id.'").hide(0);';
                  echo'$(".cancel-upload'.$goods->item_id.'").hide(0);';
                  echo'$(".imgupload'.$goods->item_id.'").show();';
                  echo'$(".imgupload1'.$goods->item_id.'").hide(0);';
                  echo'$(".imgupload2'.$goods->item_id.'").hide(0);';

                  echo'$(".edit-profile'.$goods->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".save-profile'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".cancel-upload'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".imgupload'.$goods->item_id.'").fadeOut(300);';
                    echo'$(".imgupload1'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".imgupload2'.$goods->item_id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".save-profile'.$goods->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$goods->item_id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".cancel-upload'.$goods->item_id.'").fadeOut(300);';
                    echo'$(".imgupload'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$goods->item_id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$goods->item_id.'").fadeOut(300);';
                  echo'});';

                  echo'$(".cancel-upload'.$goods->item_id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$goods->item_id.'").fadeOut(300);';
                    echo'$(".imgupload'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".edit-profile'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".save-profile'.$goods->item_id.'").hide(0);';
                    echo'$(".imgupload'.$goods->item_id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$goods->item_id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$goods->item_id.'").fadeOut(300);';
                  echo'});';

                  echo'$(".upload'.$goods->item_id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload1'.$goods->item_id.'").attr("src", e.target.result);';
                      echo'};';
		
                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
                echo'$(".upload1'.$goods->item_id.'").change(function() {';
                  echo'if (this.files && this.files[0]) {';
                    echo'var reader = new FileReader();';

                    echo'reader.onload = function(e) {';
                      echo'$(".imgupload2'.$goods->item_id.'").attr("src", e.target.result);';
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