@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('L_ITEM') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('L_EMOTICON') }}</a></li>
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
      <h2><strong><i class="fa fa-columns"></i>{{ TranslateMenuItem('L_EMOTICON') }}</strong></h2>
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
                  <i class="fa fa-plus"></i>{{ TranslateMenuItem('L_CREATE_NEW_EMOTICON') }}
                </button>
                @endif
              </div>
            </div>
            <!-- End Button tambah bot baru -->

          </div>

        </div>

        <div class="custom-scroll table-responsive" style="height:900px;">

          <div class="table-outer">
            <div class="row">
                <!-- Button tambah bot baru -->
                <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                    {{ Translate_menuPlayers('L_TOTAL_RECORD') }} {{ $emoticon->total() }}
                </div>
                            <!-- End Button tambah bot baru -->
            </div> 
            <table class="table table-bordered">
              <thead>
                <tr>
                  @if($menu && $mainmenu)
                    <th style="width:100px;"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ TranslateMenuItem('L_SELECT_ALL') }}</th>
                  @endif
                    <th class="th-sm"><a href="{{ route('Emoticon') }}?sorting={{ $sortingorder }}&namecolumn=asta_db.emoticon.id">{{ TranslateMenuItem('L_EMOTICON_ID') }} <i class="fa fa-sort{{ iconsorting('asta_db.emoticon.id') }}"></i></a></th>
                    <th style="width:10px;">{{ TranslateMenuItem('L_IMAGE') }}</th>
                    <th class="th-sm"><a href="{{ route('Emoticon') }}?sorting={{ $sortingorder }}&namecolumn=asta_db.emoticon.name">{{ TranslateMenuItem('L_TITLE') }} <i class="fa fa-sort{{ iconsorting('asta_db.emoticon.name') }}"></i></a></th>
                    <th class="th-sm"><a href="{{ route('Emoticon') }}?sorting={{ $sortingorder }}&namecolumn=asta_db.emoticon.price">{{ TranslateMenuItem('L_PRICE') }} <i class="fa fa-sort{{ iconsorting('asta_db.emoticon.price') }}"></i></a></th>
                    {{-- <th class="th-sm">Category</th> --}}
                    <th class="th-sm"><a href="{{ route('Emoticon') }}?sorting={{ $sortingorder }}&namecolumn=asta_db.emoticon.status">{{ TranslateMenuItem('L_STATUS') }} <i class="fa fa-sort{{ iconsorting('asta_db.emoticon.status') }}"></i></a></th>
                    <th class="th-sm"{{ TranslateMenuItem('L_SEE_DETAIL_IMAGE') }}></th>
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
                @foreach($emoticon as $emot)
                @if($menu && $mainmenu)
                <tr>
                    <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $emot->id }}" data-username="{{ $emot->name }}" data-name="unity-asset/emoticon/{{ $emot->id }}.png" class="deletepermission{{ $emot->id }} deleteIdAll"></td>
                    <td>{{ $emot->id }}</td>
                    <td >
                        <div class="media-container" align="center">
                          <form method="POST" action="{{ route('Emoticon-updateimage') }}" enctype="multipart/form-data">
                            {{  csrf_field() }}
                            <span class="media-overlay-wtrAva med-ovlayBonus{{ $emot->id }}">
                              <input type="hidden" name="pk" value="{{ $emot->id }}">
                              <input type="file" name="file" id="media-input-wtr" class="uploadBonus{{ $emot->id }}" accept="image/*">
                              <i class="fa fa-edit media-icon-wtr"></i>
                              <p class="nav-name">Main image</p>
                            </span>
                            <figure class="media-object">
                              <img class="img-object-wtr imgupload{{ $emot->id }}" src="{{ route('imageshowemoticon', $emot->id) }}?{{ $timenow }}" style="margin-left: auto; margin-right: auto;"> 
                              <img class="img-object-wtr1Ava uploadBonusImg1{{ $emot->id }}" src="http://placehold.jp/80x100.png">
                            </figure>
                           
                          </div>
                          <div class="media-control" align="center" style="margin-top:-1%">
                            <button class="save-ImgBonus{{ $emot->id }} btn btn-primary"><i class="fa fa-save"></i>{{ TranslateMenuItem('L_SAVE') }}</button>
                          </form>
                            <button class="cancel-ImgBonus{{ $emot->id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_CANCEL') }}</button>
                            <button class="edit-ImgBonus{{ $emot->id }} btn btn-primary"><i class="fa fa-edit"></i>{{ TranslateMenuItem('L_EDIT') }}</button>
                        </div>
                    </td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Gift" data-pk="{{ $emot->id }}" data-type="text" data-url="{{ route('Emoticon-update') }}">{{ $emot->name }}</a></td>
                    <td><a href="#" class="usertext" data-name="price" data-title="price" data-pk="{{ $emot->id }}" data-type="number" data-url="{{ route('Emoticon-update') }}">{{ $emot->price }}</a></td>
                    <td><a href="#" class="status" data-name="status" data-pk="{{ $emot->id }}" data-type="select" data-value="{{ $emot->status }}" data-url="{{ route('Emoticon-update') }}" data-title="Select type">{{ ConfigTextTranslate(strEnabledDisabled($emot->status)) }}</a></td>
                    <td>
                      <button type="button" value="Decline" class="btn btn-xs bg-blue-light text-white" data-toggle="modal" data-target="#detailinfo{{ $emot->id }}">{{ TranslateMenuItem('L_DETAIL_INFO') }}</button>
                    </td>
                    <td>
                        <a href="#" style="color:red;" class="delete{{ $emot->id }}" 
                            id="delete"
                            data-pk="{{ $emot->id }}"
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
                                <img class="img-object imgupload{{ $emot->id }}" src="{{ route('imageshowemoticon', $emot->id) }}?{{ $timenow }}" style="display: block;margin-left: auto;margin-right: auto;">
                              </figure>
                          </div>
                    </td>
                    <td>{{ $emot->name }}</td>
                    <td>{{ number_format($emot->price, 2) }}</td>
                    {{-- <td>{{ $emot->strCategory() }}</td> --}}
                    <td>{{ ConfigTextTranslate(strEnabledDisabled($emot->status)) }}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
          <div style="display: flex;justify-content: center;">{{ $emoticon->links() }}</div>

        </div>

      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuItem('L_CREATE_EMOTICON') }}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('Emoticon-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center">
                <table width="100%" height="auto">
                  <tr>
                    <td align="center">
                        <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
                          <img id="blah" src="http://placehold.jp/150x50.png" alt="your image" style="display: block;border-radius:10px;" width="auto" height="98px" />
                        </div><br>
                        <input type='file' class="main-image" name="file" onchange="readURL(this);"/>
                    </td>
                    {{-- <td align="center">
                      <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
                        <img id="blah1" src="http://placehold.jp/150x50.png" alt="your image" style="display: block;border-radius:10px;" width="auto" height="98px" />
                      </div><br>
                      <input type='file' class="watermark-image" name="file1" />
                    </td> --}}
                  </tr>
                </table>
                  <input type="text" class="form-control required" name="title" placeholder="Nama"><br>
                  <input type="number" class="form-control required" name="price" placeholder="Harga" min="0"><br>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data btn-create toggle-disabled" disabled onclick="FunctionLoadingBtn()" >
            <i class="fa fa-save"></i>{{ TranslateMenuItem('L_SAVE') }}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i>{{ TranslateMenuItem('L_CANCEL') }}
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
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('L_DELETE_DATA') }}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuItem('L_QUESTION_DELETE_IT') }}
          <form action="{{ route('Emoticon-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('L_YES') }}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_NO') }}</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- Modal DELETE ALL SELECTED -->
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
        {{ TranslateMenuItem('L_QUESTION_DELETE_IT') }}
        <form action="{{ route('Emoticon-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
          <input type="hidden" name="imageid" id="idDeleteAllimage" value="">
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

<script>
  //Loading submit button
  function FunctionLoadingBtn(){
    $('.btn-create').text('Loading...');
    $(this).submit('loading').delay(1000).queue(function(){
    });
  }

  //Disable button submit before form fullfilled
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
      $('.toggle-disabled').prop("disabled", true);
    }else{
      $('.toggle-disabled').prop("disabled", false);
    }
  })
</script>

@foreach ($emoticon as $emot)
<!-- Modal detail info -->
<div class="modal fade" id="detailinfo{{ $emot->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ TranslateMenuItem('L_DETAIL_IMAGE') }}</h5>
				<button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-remove"></i>
				</button>
      </div>
      <style>
        #image{{ $emot->id }} {
          height: 200px;
          width: 200px;
          background: url("https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/emoticon/{{ $emot->id }}.png") 0px 0px;
        }
      </style>
      <script>
        var tID{{ $emot->id }}; //we will use this variable to clear the setInterval()
        function stopAnimate{{ $emot->id }}() {
        clearInterval(tID);
        } //end of stopAnimate()
        // function animateScript{{ $emot->id }}() {
        var    position{{ $emot->id }} = 200; //start position for the image slicer
        const  interval{{ $emot->id }} = 80; //80 ms of interval for the setInterval()
        const  diff{{ $emot->id }} = 200;     //diff as a variable for position offset
        tID{{ $emot->id }} = setInterval ( () => {
          document.getElementById("image{{ $emot->id }}").style.backgroundPosition = 
          `-${position<?= $emot->id ?>}px 0px`;  
          //we use the ES6 template literal to insert the variable "position"
          if (position{{ $emot->id }} < 10000)
          { position{{ $emot->id }} = position{{ $emot->id }} + diff{{ $emot->id }};}
          //we increment the position by 320 each time
          else
          { position{{ $emot->id }} = 200; }
          //reset the position to 320px, once position exceeds 1536px
          }
        , interval{{ $emot->id }} ); //end of setInterval
        // } //end of animateScript()
      </script>
        
			<div class="modal-body" align="center">
        <div id="demo">
          <p id="image{{ $emot->id }}" class="border border-dark" > </p>
        </div>
        {{-- <div id="overlaytdt"><img src="{{ route('imageshowgift', $emot->id) }}?{{ $timenow }}" alt="Be patient..." /></div> --}}
			</div> 
		</div>
	</div>
</div>
@endforeach
<!-- End Modal detail info -->

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
      "paging":false,
      "bInfo":false,
      "order": [[3, "asc"]],
      "bLengthChange": false,
      "searching": false,
    });

    $('#trash').hide();
    //CHECK ALL
    $('#checkAll').on('click', function(e) {
      if($(this).is(':checked', true))
      {
        $(".deleteIdAll").prop('checked', true);
        $("#trash").show();
      }else{
        $(".deleteIdAll").prop('checked', false);
        $("#trash").hide();
      }
    });
  });

  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
    "autoWidth" : true,
    "order": [[3, "asc"]],
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

      $('.status').editable({
        mode :'inline',
        value: '',
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

      @php
            foreach($emoticon as $emot) {
              echo'$(".delete'.$emot->id.'").hide();';
              echo'$(".deletepermission'.$emot->id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$emot->id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$emot->id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$emot->id.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$emot->id.'").click(function(e) {';
                echo'e.preventDefault();';

                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
            }
      @endphp

            @php
              foreach($emoticon as $emot) {
              //   echo'$(".save-profile'.$emot->id.'").hide(0);';
              //     echo'$(".med-ovlay'.$emot->id.'").hide(0);';
              //     echo'$(".imgupload'.$emot->id.'").show();';
              //     echo'$(".imgupload1'.$emot->id.'").hide(0);';
              //     echo'$(".imgupload2'.$emot->id.'").hide(0);';
              //     echo'$(".cancel-upload'.$emot->id.'").hide(0);';

              //     echo'$(".edit-profile'.$emot->id.'").on("click", function() {';
              //       echo'$(this).hide(0);';
              //       echo'$(".imgupload'.$emot->id.'").fadeOut(300);';
              //       echo'$(".imgupload1'.$emot->id.'").fadeIn(300);';
              //       echo'$(".imgupload2'.$emot->id.'").fadeIn(300);';
              //       echo'$(".med-ovlay'.$emot->id.'").fadeIn(300);';
              //       echo'$(".cancel-upload'.$emot->id.'").fadeIn(300);';
              //       echo'$(".save-profile'.$emot->id.'").fadeIn(300);';
              //     echo'});';

              //     echo'$(".save-profile'.$emot->id.'").on("click", function() {';
              //       echo'$(this).hide(0);';
              //       echo'$(".cancel-upload'.$emot->id.'").fadeOut(300);';
              //       echo'$(".med-ovlay'.$emot->id.'").fadeOut(300);';
              //       echo'$(".imgupload'.$emot->id.'").fadeIn(300);';
              //       echo'$(".imgupload1'.$emot->id.'").fadeOut(300);';
              //       echo'$(".imgupload2'.$emot->id.'").fadeOut(300);';
              //       echo'$(".edit-profile'.$emot->id.'").fadeIn(300);';
              //     echo'});';

              //     echo'$(".cancel-upload'.$emot->id.'").on("click", function() {';
              //       echo'$(this).hide(0);';
              //       echo'$(".med-ovlay'.$emot->id.'").fadeOut(300);';
              //       echo'$(".imgupload'.$emot->id.'").fadeIn(300);';
              //       echo'$(".imgupload1'.$emot->id.'").fadeOut(300);';
              //       echo'$(".imgupload2'.$emot->id.'").fadeOut(300);';
              //       echo'$(".edit-profile'.$emot->id.'").fadeIn(300);';
              //       echo'$(".save-profile'.$emot->id.'").hide(0);';
              //     echo'});';

              //     echo'$(".upload'.$emot->id.'").change(function() {';
              //       echo'if (this.files && this.files[0]) {';
              //         echo'var reader = new FileReader();';

              //         echo'reader.onload = function(e) {';
              //           echo'$(".imgupload1'.$emot->id.'").attr("src", e.target.result);';
              //         echo'};';

              //         echo'reader.readAsDataURL(this.files[0]);';
              //     echo'}';
              //   echo'});';
              //   echo'$(".upload1'.$emot->id.'").change(function() {';
              //       echo'if (this.files && this.files[0]) {';
              //         echo'var reader = new FileReader();';

              //         echo'reader.onload = function(e) {';
              //           echo'$(".imgupload2'.$emot->id.'").attr("src", e.target.result);';
              //         echo'};';

              //         echo'reader.readAsDataURL(this.files[0]);';
              //     echo'}';
              //   echo'});';
              // }

                //JS BAGIAN IMAGE BONUS
                echo'$(".save-ImgBonus'.$emot->id.'").hide(0);';
                  echo'$(".med-ovlayBonus'.$emot->id.'").hide(0);';
                  echo'$(".imgupload'.$emot->id.'").show();';
                  echo'$(".uploadBonusImg1'.$emot->id.'").show(0);';
                  echo'$(".cancel-ImgBonus'.$emot->id.'").hide(0);';

                  echo'$(".edit-ImgBonus'.$emot->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".imgupload'.$emot->id.'").fadeOut(300);';
                    echo'$(".uploadBonusImg1'.$emot->id.'").fadeIn(300);';
                    echo'$(".med-ovlayBonus'.$emot->id.'").fadeIn(300);';
                    echo'$(".save-ImgBonus'.$emot->id.'").fadeIn(300);';
                    echo'$(".cancel-ImgBonus'.$emot->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".save-ImgBonus'.$emot->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlayBonus'.$emot->id.'").fadeOut(300);';
                    echo'$(".edit-ImgBonus'.$emot->id.'").fadeIn(300);';
                    echo'$(".cancel-ImgBonus'.$emot->id.'").fadeOut(300);';
                    echo'$(".imgupload'.$emot->id.'").fadeIn(300);';
                    echo'$(".uploadBonusImg1'.$emot->id.'").fadeOut(300);';
                  echo'});';

                  echo'$(".cancel-ImgBonus'.$emot->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlayBonus'.$emot->id.'").fadeOut(300);';
                    echo'$(".imgupload'.$emot->id.'").fadeIn(300);';
                    echo'$(".uploadBonusImg1'.$emot->id.'").fadeOut(300);';
                    echo'$(".edit-ImgBonus'.$emot->id.'").fadeIn(300);';
                    echo'$(".save-ImgBonus'.$emot->id.'").hide(0);';
                  echo'});';

                //JS MAIN IMAGE BONUS
                echo'$(".uploadBonus'.$emot->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".uploadBonusImg1'.$emot->id.'").attr("src", e.target.result);';
                      echo'};';
		
                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
              }
            @endphp


            //js delete on delete all selected modal
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

            //hide and show icon delete all
            $('#trash').hide();
            $(".deleteIdAll").click(function(e) {
              if($(".deleteIdAll:checked").length > 1) {
                $("#trash").show();
              }else{
                $("#trash").hide();
              }
            });
    },
    responsive: false
  });

</script>
@endsection