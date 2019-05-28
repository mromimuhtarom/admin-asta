@extends('index')


@section('sidebarmenu')
@include('menu.menunotification')    
@endsection


@section('content')




      <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Create Email Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            {{  csrf_field() }}
          <div class="modal-body">
            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
            <input type='file' onchange="readURL(this);" /><br><br>
            <input type="text" name="subject" placeholder="Subject" required><br>
            <textarea name="message" cols="30" rows="5" placeholder="Please Enter The Message" required></textarea><br>
            <select name="from" required>
              <option>Select From</option>
              <option value=""></option>
            </select><br>
            <input type="email" name="email" placeholder="From Email" required><br>
            <select name="type" required>
              <option>Select Type</option>
              <option value=""></option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
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




    {{-- <div class="table-aii">
        <div class="footer-table">
                                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                                      <i class="fas fa-plus-circle"></i>Create Email Notification
                                    </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Subject</th>
                <th class="th-sm">Message</th>
                <th class="th-sm">From</th>
                <th class="th-sm">From Email</th>
                <th class="th-sm">Type</th>
                <th class="th-sm">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="#" class="usertext" data-title="Subject" data-name="subject" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->subject }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="textarea" data-url="{{ route('EmailNotification-update')}}">{{ $notification->message }}</a></td>
                    <td><a href="#" class="usertext" data-title="From" data-name="fromName" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->fromName }}</a></td>
                    <td><a href="#" class="usertext" data-title="From Email" data-name="fromEmail" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->fromEmail }}</td>
                    <td><a href="#" class="typenotif" data-title="Type" data-name="type" data-pk="{{ $notification->id }}" data-type="select" data-url="{{ route('EmailNotification-update')}}">{{ $notification->type }}</a></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>

    <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });  
      });
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });

              $('.typenotif').editable({
                value: 'Pilih Type',
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
    
          }
      });
  </script> --}}
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>Email Notification</h2>
      </div>

      <div class="widget-toolbar">
        <!-- add: non-hidden - to disable auto hide -->
      </div>
    </header>

    <!-- widget div-->
    <div>

      <!-- widget edit box -->
      <div class="jarviswidget-editbox">
        <!-- This area used as dropdown edit box -->

      </div>
      <!-- end widget edit box -->

      <!-- widget content -->
      <div class="widget-body p-0">
        
        <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th data-hide="phone">title</th>
              <th data-hide="phone,tablet">Subject</th>
              <th data-hide="phone,tablet">Message</th>
              <th data-hide="phone,tablet">From</th>
              <th data-hide="phone,tablet">From Email</th>
              <th data-hide="phone,tablet">Type</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notifications as $notification)
            <tr>
                <td></td>
                <td><a href="#" class="usertext" data-title="Subject" data-name="subject" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->subject }}</a></td>
                <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="textarea" data-url="{{ route('EmailNotification-update')}}">{{ $notification->message }}</a></td>
                <td><a href="#" class="usertext" data-title="From" data-name="fromName" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->fromName }}</a></td>
                <td><a href="#" class="usertext" data-title="From Email" data-name="fromEmail" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('EmailNotification-update')}}">{{ $notification->fromEmail }}</td>
                <td><a href="#" class="typenotif" data-title="Type" data-name="type" data-pk="{{ $notification->id }}" data-type="select" data-url="{{ route('EmailNotification-update')}}">{{ $notification->type }}</a></td>
            </tr>

            @endforeach
          </tbody>
        </table>
      
      </div>
      <!-- end widget content -->

    </div>
    <!-- end widget div -->

  </div>
<script>
      var responsiveHelper_datatable_col_reorder = responsiveHelper_datatable_col_reorder || undefined;
      // var responsiveHelper_datatable_tabletools = responsiveHelper_datatable_tabletools ||undefined;
      
      var breakpointDefinition = {
        tablet : 1024,
        phone : 480
      };
    $('#datatable_col_reorder').dataTable({
      "sDom": "<'dt-toolbar d-flex align-items-center'<f><'hidden-xs ml-auto'B>r>"+
          "t"+
          "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
      "autoWidth" : true,
      "classes": {
        "sWrapper":      "dataTables_wrapper dt-bootstrap4"
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
    
      },
        buttons: [ {
            extend: 'colvis',
            text: 'Show / hide columns',
            className: 'btn btn-default',
            columnText: function ( dt, idx, title ) {
                return title;
            }			        
        } ],
        
      responsive: true
    });
</script>    
@endsection