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
            <h5 class="modal-title" id="exampleModalLabel">Create Push Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            {{  csrf_field() }}
          <div class="modal-body">
            <input type="text" name="username" placeholder="username" required>
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
                Gold Store  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                                <i class="fas fa-plus-circle"></i>Create Push Notification
                            </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Message</th>
                <th class="th-sm">Game</th>
                <th class="th-sm">Type</th>
                <th class="th-sm">Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                <tr>
                    <td></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->title }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->message }}</a></td>
                    <td></td>
                    <td></td>
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
  
         
          $('.usertext').editable({
              mode :'popup'
          });
  
  
      });
  </script>
@endsection