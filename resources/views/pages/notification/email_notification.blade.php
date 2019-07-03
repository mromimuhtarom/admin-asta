@extends('index')



@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Email_Notification') }}">Notification</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Email_Notification') }}">Email Notification</a></li>
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

  
      <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Push Notification</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
      <form action="{{ route('EmailNotification-create') }}" method="POST" enctype="multipart/form-data">
            {{  csrf_field() }}
          <div class="modal-body" align="center">
            <div style="border-radius:10px;border:1px solid black;width:200px;height:100px;position: relative;display: inline-block;">
              <img id="blah" src="http://placehold.jp/150x50.png" alt="your image" width="auto" height="98px" style="display: block;border-radius:10px;"/>
            </div><br>
            <input type='file' name="file" onchange="readURL(this);" /><br><br>
            <input type="text" name="subject" class="form-control" placeholder="Subject" required><br>
            <textarea name="message" cols="30" class="form-control" rows="5" placeholder="Please Enter The Message" required></textarea><br>
            {{-- <select name="from" class="form-control" required>
              <option>Select From</option>
            </select><br> --}}
            <input type="email" name="email" class="form-control" placeholder="From Email" required><br>
            <select name="type" class="form-control" required>
              <option>Select Type</option>
              <option value="deposit_received">Deposit Received</option>
              <option value="deposit_received">Deposit Received</option>
              <option value="withdrawal_requested">Withdrawal Requested</option>
              <option value="withdrawal_decline">Withdrawal Decline</option>
              <option value="withdrawal_approved">Withdrawal Approved</option>
              <option value="login">Login</option>
              <option value="forgot">Forgot Password</option>
              <option value="welcome">Account Creation</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary">
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





<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong>Push Notification</strong></h2>				
      </div>
    </header>
  
    <div>
      
      <div class="jarviswidget-editbox">
        <input class="form-control" type="text">
        <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
        
      </div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          
          <div class="row">
            
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              <div class="input-group">
                @if($menu)
                  <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-plus"></i> Create New Email Notification
                  </button>
                  @endif
              </div>
            </div>
            <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
              
              {{-- <button class="btn sa-btn-success">
                <i onclick="addBots()" class="fa fa-plus"></i> <span class="hidden-mobile">Add New Row</span>
              </button> --}}
              
            </div>
            
          </div>
          
            
  
        </div>
        
        <div class="custom-scroll table-responsive" style="height:870px;">
          
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                    @if($menu)
                    <th class="th-sm"></th>
                    @endif
                    <th class="th-sm">title</th>
                    <th class="th-sm">Subject</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">From</th>
                    <th class="th-sm">From Email</th>
                    <th class="th-sm">Type</th>
                    @if($menu)
                    <th></th>
                    @endif
                </tr>
              </thead>
              <tbody>                      
                @foreach($emailnotifications as $notification)
                @if($menu)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $notification->id }}"></td>
                    <td>
                        <div class="media-container">
                            <form method="POST" action="{{ route('EmailNotification-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay med-ovlay{{ $notification->id }}">
                                <input type="hidden" name="pk" value="{{ $notification->id }}">
                                <input type="file" name="file" id="media-input" class="upload{{ $notification->id }}" accept="image/*" style="  display: block;margin-left: auto;margin-right: auto;">
                                <i class="fa fa-edit media-icon"></i>
                              </span>
                              <figure class="media-object">
                                <img class="img-object imgupload{{ $notification->id }}" src="/upload/EmailNotification/{{ $notification->imageUrl }}" style="display: block;margin-left: auto;margin-right: auto;">
                              </figure>
                            </div>
                            <div class="media-control" align="center" style="margin-top:-1%">
                              <button class="save-profile{{ $notification->id }}">Save Gift</button>
                            </form>
                              <button class="edit-profile{{ $notification->id }}">Edit Gift</button>
                        </div>
                    </td>
                    <td><a href="#" class="usertext" data-title="Subject" data-name="subject" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->subject }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="textarea" data-url="{{ route('EmailNotification-update')}}">{{ $notification->message }}</a></td>
                    <td><a href="#" class="usertext" data-title="From" data-name="fromName" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->fromName }}</a></td>
                    <td><a href="#" class="usertext" data-title="From Email" data-name="fromEmail" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->fromEmail }}</td>
                    <td><a href="#" class="typenotif" data-title="Type" data-name="type" data-pk="{{ $notification->id }}" data-type="select" data-url="{{ route('EmailNotification-update')}}">{{ $notification->type }}</a></td>
                    <td>
                      <a href="#" style="color:red;" class="delete{{ $notification->id }}" 
                      id="delete" 
                      data-pk="{{ $notification->id }}" 
                      data-toggle="modal" 
                      data-target="#delete-modal">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                </tr>
                @else 
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $notification->id }}"></td>
                    <td>
                        <div class="media-container">
                            {{-- <form method="POST" action="{{ route('EmailNotification-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay med-ovlay{{ $notification->id }}">
                                <input type="hidden" name="pk" value="{{ $notification->id }}">
                                <input type="file" name="file" id="media-input" class="upload{{ $notification->id }}" accept="image/*">
                                <i class="fa fa-edit media-icon"></i>
                              </span> --}}
                              <figure class="media-object">
                                <img class="img-object imgupload{{ $notification->id }}" src="/upload/EmailNotification/{{ $notification->imageUrl }}">
                              </figure>
                            </div>
                            {{-- <div class="media-control">
                              <button class="save-profile{{ $notification->id }}">Save Gift</button>
                            </form>
                              <button class="edit-profile{{ $notification->id }}">Edit Gift</button> --}}
                        </div>
                    </td>
                    <td>{{ $notification->subject }}</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->fromName }}</td>
                    <td>{{ $notification->fromEmail }}</td>
                    <td>{{ $notification->type }}</td>
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
            <form action="{{ route('EmailNotification-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
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
        "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
        "paging": false,
        "autoWidth" : true,
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

          
          $('.typenotif').editable({
            value: 'Pilih Type',
            mode :'inline',
            source: [
              {value: 'deposit_received', text: 'Deposit Received'},
              {value: 'new_device', text: 'New Device'},
              {value: 'withdrawal_requested', text: 'Withdrawal Requested'},
              {value: 'withdrawal_declined', text: 'Withdrawal Declined'},
              {value: 'withdrawal_approved', text: 'Withdrawal Approved'},
              {value: 'login', text: 'Login'},
              {value: 'forgot', text: 'Forgot Password'},
              {value: 'welcome', text: 'Account Creation'},
            ]
          });        

          $('.game').editable({
            mode :'inline'
          });          
    
       
          @php
            foreach($emailnotifications as $notification) {
              echo'$(".delete'.$notification->id.'").hide();';
              echo'$(".deletepermission'.$notification->id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$notification->id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$notification->id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$notification->id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$notification->id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
            }
          @endphp
          @php
          foreach($emailnotifications as $notification) {
                echo'$(".save-profile'.$notification->id.'").hide(0);';
                  echo'$(".med-ovlay'.$notification->id.'").hide(0);';

                  echo'$(".edit-profile'.$notification->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$notification->id.'").fadeIn(300);';
                    echo'$(".save-profile'.$notification->id.'").fadeIn(300);';
                  echo'});';
                  echo'$(".save-profile'.$notification->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$notification->id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$notification->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".upload'.$notification->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload'.$notification->id.'").attr("src", e.target.result);';
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
    <script>

        // Dropzone.options.myDropzone = {
        //   init: function() {
        
        //       this.on('queuecomplete', function () {
        //         location.reload();
        //     });
        
        //   }
        // };
        $(".dropzone").dropzone({
			//url: "/file/post",
			addRemoveLinks : true,
			maxFilesize: 0.5,
			dictDefaultMessage: '<div class="text-center">Drop file</div>',
			dictResponseError: 'Error uploading file!',
      init: function() {

        this.on('queuecomplete', function () {
          location.reload();
        });

      }
      // maxFiles: 1,
      // accept: function(file, done) {
      //   console.log("uploaded");
      //   done();
      // },
      // init: function() {
      //   this.on("maxfilesexceeded", function(file){
      //     alert("No more files please!");
      //   });
      // }
		});
    </script>
@endsection