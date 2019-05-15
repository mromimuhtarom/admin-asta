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




    <div class="table-aii">
        <div class="table-header">
                Email Notification  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                                      <i class="fas fa-plus-circle"></i>Create Email Notification
                                    </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Subject</th>
                <th class="th-sm">Message</th>
                <th class="th-sm">From</th>
                <th class="th-sm">From Email</th>
                <th class="th-sm">Type</th>
                {{-- <th class="th-sm">Action</th> --}}
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
                    {{-- <td></td> --}}
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
  
  
      });
  </script>
@endsection