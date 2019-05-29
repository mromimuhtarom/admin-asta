@extends('index')


@section('sidebarmenu')
@include('menu.menunotification')    
@endsection


@section('content')

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
          <h4 class="modal-title" id="myModalLabel">Create Push Notification</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
      <form action="{{ route('EmailNotification-create') }}" method="POST" enctype="multipart/form-data">
            {{  csrf_field() }}
          <div class="modal-body">
            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" class="rounded-circle" /><br><br>
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
            <button type="submit" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn sa-btn-primary">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
    
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all as $error)
            <li>{{$error}}</li>  
            @endforeach
        </ul>
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
                  <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-plus"></i>
                  </button>
              </div>
            </div>
            <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
              
              {{-- <button class="btn sa-btn-success">
                <i onclick="addBots()" class="fa fa-plus"></i> <span class="hidden-mobile">Add New Row</span>
              </button> --}}
              
            </div>
            
          </div>
          
            
  
        </div>
        
        <div class="custom-scroll table-responsive" style="height:800px;">
          
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th class="th-sm"></th>
                    {{-- <th class="th-sm">title</th> --}}
                    <th class="th-sm">Subject</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">From</th>
                    <th class="th-sm">From Email</th>
                    <th class="th-sm">Type</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>                      
                @foreach($emailnotifications as $notification)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $notification->id }}"></td>
                    {{-- <td></td> --}}
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
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              × 
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
            <button type="submit" class="button_example-yes">Yes</button>
            <button type="button" class="button_example-no" data-dismiss="modal">No</button>
          </div>
            </form>
        </div>
      </div>
    </div>
      
    <script type="text/javascript">
      $(document).ready(function() {
        $('table.table').dataTable( {
          // "pageLength": 50,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
    
          // delete bots
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
        },
        responsive: true
      });
    
    </script>
@endsection