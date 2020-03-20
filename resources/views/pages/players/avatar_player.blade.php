@extends('index')

@section('page')
    <li class="breadcrumb-item"><a href="{{ route('avatar_player') }}">{{ Translate_menuPlayers('L_AVATAR_PLAYER') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('avatar_player') }}">{{ Translate_menuPlayers('L_AVATAR_PLAYER') }}</a></li>
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
        <p>{{Session::get('alert')}}</p>
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
            <h2><strong><i class="fa fa-columns"></i>{{ Translate_menuPlayers('L_AVATAR_PLAYER') }}</strong></h2>
        </div>
    </header>

    <div>
        <div class="widget-body">
            <div class="widget-body-toolbar">
                <div class="row">

                    {{-- Button tambah baru --}}
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                        <div class="input-group">
                            @if($menu && $mainmenu)
                            <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"></i>{{ Translate_menuPlayers('L_CREATE_NEW_AVATAR') }}
                            </button>
                            @endif
                        </div>
                    </div>
                    {{-- end button tambah baru --}}

                </div>
            </div>

            <div class="custom-scroll table-responsive" style="height:900px;">
                <div class="table-outer">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @if($menu && $mainmenu)
                                <th style="width:100px;"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp; {{ TranslateMenuItem('L_SELECT_ALL') }}</th>
                                @endif
                                <th>ID</th>
                                <th style="width:5px;">{{ TranslateMenuItem('L_IMAGE') }}</th>
                                <th>{{ TranslateMenuGame('L_NAME') }}</th>
                                @if($menu && $mainmenu)
                                <th>{{ TranslateMenuGame('L_ACTION') }} &nbsp; &nbsp;
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
                            @foreach($avatarPlayer as $ap)
                            @if($menu && $mainmenu)
                            <tr>
                                <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $ap->id }}" data-username="{{ $ap->name }}" data-name="avatar/{{ $ap->id }}.jpg" class="deletepermission{{ $ap->id }} deleteIdAll"></td>
                                <td><a href="#" class="usertext" data-name="id" data-title="id" data-type="text" data-pk="{{ $ap->id }}" data-url="">{{ $ap->id }}</a></td>
                                <td>
                                    <div class="media-container">
                                        <form method="POST" action="{{ route('avatar_playerUpdateImage')}}" enctype="multipart/form-data">
                                          {{  csrf_field() }}
                                          <span class="media-overlay-wtrAva med-ovlay{{ $ap->id }}">
                                            <input type="hidden" name="pk" value="{{ $ap->id }}">
                                            <input type="file" name="file" id="media-input-wtr" class="upload{{ $ap->id }}" accept="image/*">
                                            <i class="fa fa-edit media-icon-wtr"></i>   
                                            <p class="nav-name">{{ TranslateMenuItem('L_MAIN_IMAGE') }}</p>
                                          </span>
                                          <figure class="media-object">
                                            <img class="img-object-wtr imgupload{{ $ap->id }}" src="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/avatar/{{ $ap->id }}.jpg?{{ $timenow }}" style="margin-left: auto; margin-right: auto;">
                                            <img class="img-object-wtr1Ava imgupload1{{ $ap->id }}" src="http://placehold.jp/80x100.png">
                                        </figure>
                                         
                                        </div>
                                        <div class="media-control" align="center" style="margin-top:-1%">
                                          <button class="save-profile{{ $ap->id }} btn btn-primary"><i class="fa fa-save"></i>{{ Translate_menuPlayers('L_SAVE_AVATAR') }}</button>
                                        </form>
                                          <button class="cancel-upload{{ $ap->id }} btn sa-btn-danger"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_CANCEL') }}</button>
                                          <button class="edit-profile{{ $ap->id }} btn btn-primary"><i class="fa fa-edit"></i>{{ Translate_menuPlayers('L_EDIT_AVATAR') }}</button>
                                        </div>
                                </td>
                                <td><a href="#" class="usertext" data-name="name" data-title="Title Avatar" data-type="text" data-pk="{{ $ap->id }}" data-url="{{ route('avatar_playerUpdate') }}">{{ $ap->name }}</a></td>
                                <td>
                                    <a href="#" style="color:red;" class="delete{{ $ap->id}}"
                                        id="delete"

                                        data-pk="{{ $ap->id }}"
                                        data-toggle="modal"
                                        data-target="#delete-modal">
                                            <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $ap->id }}</td>
                                <td>
                                    <div class="media-container">
                                        <figure class="media-object">
                                            <img class="img-object imgupload{{ $ap->id }}" src="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/avatar/{{ $ap->id }}.jpg?{{ $timenow }}" style="margin:auto;">
                                        </figure>
                                    </div>
                                </td>
                                <td>{{ $ap->name }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ Translate_menuPlayers('L_CREATE_NEW_AVATAR') }}</h4>
                <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-remove"></i>
                </button>
                </div>
                <form action="{{ route('avatar_playerCreate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
        
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group" align="center">
        
                            <table width="100%;" height="auto">
                            <tr>
                                <td align="center">
                                <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
                                    <img id="blah" class="ava" src="http://placehold.jp/150x50.png" alt="your image" style="display: block;border-radius:10px;" width="auto" height="98px" />
                                </div><br>
                                    <input type='file' class="main-image ava" name="file" onchange="readURL(this);"/>
                                </td>
                            </tr>
                            </table>
                            
                            <input type="text" id="name" class="form-control" name="title" placeholder="Nama"><br>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn sa-btn-primary submit-data btn-create btn-disabled" disabled onclick="LoadingFunctionCreate()">
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

        <!-- Modal Delete-->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash">{{ TranslateMenuItem('L_DELETE_DATA') }}</i></h5>
                        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-remove"></i>
                        </button>
                    </div>
                <div class="modal-body">
                    {{ TranslateMenuItem('L_QUESTION_DELETE_IT') }}
                    <form action="{{ route('avatar_playerDelete') }}" method="post">
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
                    <form action="{{ route('avatar_playerDelete-DeleteAllSelected') }}" method="post">
                        {{ method_field('delete')}}
                        {{ csrf_field() }}
                    <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
                    <input type="hidden" name="imageid" id="idDeleteAllimage" value="">
                    <input type="hidden" name="usernameAll" id="userDeleteAll">
                </div>
                <div class="modal-footer">
                <button type="submit" id="submit" class="button_example-yes btn sa-btn-success submit-data submit-data btn-create" onclick="LoadingFunctionCreate()"><i class="fa fa-check"></i>{{ TranslateMenuItem('L_YES') }}</button>
                <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_NO') }}</button>
                </div>
                </form>
            </div>
            </div>
        </div>

</div>

<script>
    $(document).ready(function () {
        $('#name').on('input change', function () {
            if ($(this).val() != '') {
                $('#submit').prop('disabled', false);
            }
            else {
                $('#submit').prop('disabled', true);
            }
        });
    });

    //loading button sesudah submit
    function LoadingFunctionCreate(){
        $('.btn-create').text("Loading");
        $(this).submit('loading').delay(1000).queue(function() {
        })
    }
</script>
  <script type="text/javascript">

        $(document).ready(function() {
            $('table.table').dataTable( {
                "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                "pagingType": "full_numbers",
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

                    @php
                            foreach($avatarPlayer as $ap) {
                            echo'$(".delete'.$ap->id.'").hide();';
                            echo'$(".deletepermission'.$ap->id.'").on("click", function() {';
                                echo 'if($( ".deletepermission'.$ap->id.':checked" ).length > 0)';
                                echo '{';
                                echo '$(".delete'.$ap->id.'").show();';
                                echo'}';
                                echo'else';
                                echo'{';
                                echo'$(".delete'.$ap->id.'").hide();';
                                echo'}';

                            echo '});';

                            echo'$(".delete'.$ap->id.'").click(function(e) {';
                                echo'e.preventDefault();';

                                echo"var id = $(this).attr('data-pk');";
                                echo'var test = $("#id").val(id);';
                            echo'});';


                            // untuk image
                            echo'$(".save-profile'.$ap->id.'").hide(0);';
                            echo'$(".med-ovlay'.$ap->id.'").hide(0);';
                            echo'$(".imgupload1'.$ap->id.'").hide(0);';
                            echo'$(".imgupload2'.$ap->id.'").hide(0);';
                            echo'$(".cancel-upload'.$ap->id.'").hide(0);';

                            echo'$(".edit-profile'.$ap->id.'").on("click", function() {';
                                echo'$(this).hide(0);';
                                echo'$(".imgupload'.$ap->id.'").fadeOut(300);';
                                echo'$(".imgupload1'.$ap->id.'").fadeIn(300);';
                                echo'$(".imgupload2'.$ap->id.'").fadeIn(300);';
                                echo'$(".med-ovlay'.$ap->id.'").fadeIn(300);';
                                echo'$(".cancel-upload'.$ap->id.'").fadeIn(300);';
                                echo'$(".save-profile'.$ap->id.'").fadeIn(300);';
                            echo'});';

                            echo'$(".save-profile'.$ap->id.'").on("click", function() {';
                                echo'$(this).hide(0);';
                                echo'$(".cancel-upload'.$ap->id.'").fadeOut(300);';
                                echo'$(".med-ovlay'.$ap->id.'").fadeOut(300);';
                                echo'$(".imgupload'.$ap->id.'").fadeIn(300);';
                                echo'$(".imgupload1'.$ap->id.'").fadeOut(300);';
                                echo'$(".imgupload2'.$ap->id.'").fadeOut(300);';
                                echo'$(".edit-profile'.$ap->id.'").fadeIn(300);';
                            echo'});';

                            echo'$(".cancel-upload'.$ap->id.'").on("click", function() {';
                                echo'$(this).hide(0);';
                                echo'$(".med-ovlay'.$ap->id.'").fadeOut(300);';
                                echo'$(".imgupload'.$ap->id.'").fadeIn(300);';
                                echo'$(".imgupload1'.$ap->id.'").fadeOut(300);';
                                echo'$(".imgupload2'.$ap->id.'").fadeOut(300);';
                                echo'$(".edit-profile'.$ap->id.'").fadeIn(300);';
                                echo'$(".save-profile'.$ap->id.'").hide(0);';
                            echo'});';

                            echo'$(".upload'.$ap->id.'").change(function() {';
                                echo'if (this.files && this.files[0]) {';
                                echo'var reader = new FileReader();';

                                echo'reader.onload = function(e) {';
                                    echo'$(".imgupload1'.$ap->id.'").attr("src", e.target.result);';
                                echo'};';

                                echo'reader.readAsDataURL(this.files[0]);';
                            echo'}';
                            echo'});';
                            echo'$(".upload1'.$ap->id.'").change(function() {';
                                echo'if (this.files && this.files[0]) {';
                                echo'var reader = new FileReader();';

                                echo'reader.onload = function(e) {';
                                    echo'$(".imgupload2'.$ap->id.'").attr("src", e.target.result);';
                                echo'};';

                                echo'reader.readAsDataURL(this.files[0]);';
                            echo'}';
                            echo'});';
                        }
                    @endphp

                    ///DELETE ALL SELECTED MODAL 
                    $('.delete').click(function(e) {
                        e.preventDefault();
                        var allVals = [];
                        var allUsername = [];
                            $(".deleteIdAll:checked").each(function() {
                            allVals.push($(this).attr('data-pk'));
                            var join_selected_values = allVals.join(",");
                            $('#idDeleteAll').val(join_selected_values);

                            //untuk get nama ketika multiple delete
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
