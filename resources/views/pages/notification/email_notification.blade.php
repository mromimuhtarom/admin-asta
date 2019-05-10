@extends('index')


@section('sidebarmenu')
@include('menu.menunotification')    
@endsection


@section('content')
    <div class="table-aii">
        <div class="table-header">
                Gold Store
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