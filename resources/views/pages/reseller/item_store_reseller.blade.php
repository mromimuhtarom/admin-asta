@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Item_Store_Reseller') }}">{{ translate_menu('Reseller')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Item_Store_Reseller') }}">{{ translate_menu('Item_Store_Reseller')}}</a></li>
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

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong><i class="fa fa-columns"></i>{{ translate_menu('Item_Store_Reseller')}}</strong></h2>				
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
                <i class="fa fa-plus"></i> Buat baru {{ translate_menu('Item_Store_Reseller')}}
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah chip store baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="height:900px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu && $mainmenu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">{{ TranslateMenuToko('Order')}}</th>
                <th style="width:10px;">{{ TranslateMenuToko('Image')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Title')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Item awarded')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Price cash')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Item type')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('Pay Transaction')}}</th>
                <th class="th-sm">Google Key</th>
                <th class="th-sm">{{ TranslateMenuItem('Status')}}</th>
                @if($menu && $mainmenu)
                  <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($getItems as $gold)
              @if($menu && $mainmenu)
              <tr>
                <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $gold->item_id }}"></td>
                <td><a href="#" class="usertext" data-title="Name" data-name="order" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('ItemStore-update') }}">{{ $gold->order }}</a></td>
                <td>
                    <div class="media-container">
                        <form method="POST" action="{{ route('ItemStoreReseller-updateimage') }}" enctype="multipart/form-data">
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
                            {{-- <img class="img-object-wtr imgupload{{ $gold->item_id }}" src="/upload/Gold/{{ $gold->item_id }}.png?{{ $timenow }}" style="margin-left: auto; margin-right: auto;"> --}}
                            <img class="img-object-wtr imgupload{{ $gold->item_id }}" src= "{{'https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/store/gold/'.$gold->item_id.'.png'}}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;">
                            <img class="img-object-wtr1 imgupload1{{ $gold->item_id }}" src="http://placehold.jp/80x100.png">
                            <img class="img-object-wtr2 imgupload2{{ $gold->item_id }}" src="http://placehold.jp/80x100.png">
                          </figure>
                        </div>
                        <div class="media-control" align="center" style="margin-top:-1%">
                          <button class="save-profile{{ $gold->item_id }} btn btn-primary"><i class="fa fa-save"></i>{{ TranslateMenuToko('Save Image')}}</button>
                        </form>
                          <button class="cancel-upload{{ $gold->item_id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel')}}</button>
                          <button class="edit-profile{{ $gold->item_id }} btn btn-primary"><i class="fa fa-edit"></i>{{ TranslateMenuToko('Edit')}}</button>
                        </div>
                </td>
                <td><a href="#" class="usertext" data-title="Name" data-name="name" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('ItemStore-update') }}">{{ $gold->name }}</a></td>
                <td><a href="#" class="usertext" data-title="Gold Awarded" data-name="item_get" data-pk="{{ $gold->item_id }}" data-type="number" data-url="{{ route('ItemStore-update') }}">{{ $gold->item_get }}</a></td>
                <td><a href="#" class="usertext" data-title="Price" data-name="price" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('ItemStore-update') }}">{{ $gold->price }}</a></td>
                {{-- <td><a href="#" class="itemType" data-title="Price" data-name="trans_type" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('ItemStore-update') }}">{{ $gold->strItemType() }}</a></td> --}}
                <td>{{ translate_menuPlayers('Gold Coins')}}</td>
                <td><a href="#" class="transactionType" data-title="Price" data-name="trans_type" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('ItemStore-update') }}">{{ strTypeTransaction($gold->trans_type) }}</a></td>
                <td><a href="#" class="usertext" data-title="Google Key" data-name="google_key" data-pk="{{ $gold->item_id }}" data-type="text" data-url="{{ route('ItemStore-update') }}">{{ $gold->google_key }}</a></td>
                <td><a href="#" class="strEnable" data-title="Active" data-name="status" data-pk="{{ $gold->item_id }}" data-type="select" data-url="{{ route('ItemStore-update') }}">{{ strEnabledDisabled($gold->status) }}</a></td>
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
                <td>{{ $gold->order }}</td>
                <td>
                    <div class="media-container">
                        <figure class="media-object">
                          <img class="img-object imgupload{{ $gold->item_id }}" src="/upload/Gold/{{ $gold->item_id }}" style="  display: block;margin-left: auto;margin-right: auto;">
                        </figure>
                    </div>
                </td>
                <td>{{ $gold->name }}</td>
                <td>{{ $gold->item_get }}</td>
                <td>{{ $gold->price }}</td>
                {{-- <td>{{ $gold->strItemType() }}</td> --}}
                <td>{{ translate_menuPlayers('Gold Coins')}}</td>
                <td>{{ strTypeTransaction($gold->transaction_type) }}</td>
                <td>{{ $gold->google_key }}</td>
                <td>{{ strEnabledDisabled($gold->active) }}</td>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Buat baru {{ translate_menu('Item_Store_Reseller')}}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('ItemStoreReseller-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
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
          
          <div class="form-group">
            <input type="number" name="order" class="form-control" id="basic-url" placeholder="Order">
          </div>
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="number" name="goldAwarded" class="form-control" id="basic-url" placeholder="Item awarded">
          </div>
          <div class="form-group">
            <input type="number" name="priceCash" class="form-control" id="basic-url" placeholder="price cash">
          </div>
          <div class="form-group">
            {{-- <input type="number" name="priceCash" class="form-control" id="basic-url" placeholder="price cash"> --}}
            {{-- <select name="itemType" class="form-control">
              <option value="">Choose Item Type</option>
              <option value="1">Chip</option>
              <option value="2">Gold</option>
              <option value="3">Goods</option>
            </select> --}}
          </div>
          <div class="form-group">
            <input type="text" name="googleKey" class="form-control" id="basic-url" placeholder="google key">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i>{{ TranslateMenuItem('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel')}}
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('DeleteData')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are you sure want to delete it')}}
        <form action="{{ route('ItemStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End delete Modal -->

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

      $('.itemType').editable({
        mode :'inline',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
        source: [
          {value: '', text: 'Choose Item type'},
          @php 
          echo '{value:"'.$item[0].'", text: "'.$item[1].'"},';
          echo '{value:"'.$item[2].'", text: "'.$item[3].'"},';
          echo '{value:"'.$item[4].'", text: "'.$item[5].'"},';
          @endphp
        ]
      })

      $('.strEnable').editable({
        mode: 'inline',
        value: '',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
        source: [
          {value: '', text: 'Choose For Activation'},
          @php            
              // $endis = preg_split( "/ :|, /", $atv->value );
              echo '{value:"'.$endis[0].'", text: "'.$endis[1].'"}, ';
              echo '{value:"'.$endis[2].'", text: "'.$endis[3].'"}, ';
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
            {value: '', text: 'Choose For Transaction Type'},
					  {value: 1, text: 'Bank Transfer'},
					  {value: 2, text: 'Internet Banking'},
					  {value: 3, text: 'Cash Digital'},
					  {value: 4, text: 'Toko'},
					  {value: 5, text: 'Akulaku'},
					  {value: 6, text: 'Credit Card'},
					  {value: 7, text: 'Google Play'}
				   ]
			});

      // delete gold store
      @php
        foreach($getItems as $gold) {
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
              foreach($getItems as $gold) {
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
                    echo'$(".edit-profile'.$gold->item_id.'").fadeIn(300);';
                    echo'$(".save-profile'.$gold->item_id.'").hide(0);';
                    echo'$(".imgupload'.$gold->item_id.'").fadeIn(300);';
                    echo'$(".imgupload1'.$gold->item_id.'").fadeOut(300);';
                    echo'$(".imgupload2'.$gold->item_id.'").fadeOut(300);';
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
              }
      @endphp
    },
    responsive: false
  });
</script>
<!-- end script -->
@endsection