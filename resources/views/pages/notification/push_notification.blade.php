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
            <input type="text" name="title" placeholder="title" required><br>
            <textarea name="message" cols="30" rows="5" placeholder="Please Enter The Message"></textarea><br>
            <select name="game">
                <option>Select Game</option>
                <option value=""></option>
            </select><br>
            <select name="type">
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
        <div class="footer-table">
                            <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                                <i class="fas fa-plus-circle"></i>Create Push Notification
                            </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
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
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
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
              console.log(mode);
          }
      });
  </script>
@endsection