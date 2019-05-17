@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">

  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create User Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="text" name="username" placeholder="username" required><br>
          <input type="text" name="fullname" placeholder="Full Name" required><br>
          <select name="role" required>
            <option>Pilih Role</option>
            <option value=""></option>
          </select>
          <input type='file' onchange="readURL(this);" /><br><br>
          <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" />
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
                User Admin  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                              <i class="fas fa-plus-circle"></i>Create Admin
                            </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Username</th>
                <th class="th-sm">Full Name</th>
                <th class="th-sm">Role Type</th>
                <th class="th-sm"></th>
              </tr>
            </thead>
            <tbody>
                @foreach($admin as $adm)
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="#" class="usertext" data-name="username" data-title="Username" data-pk="{{ $adm->operator_id }}" data-type="text" data-url="{{ route('UserAdmin-update') }}">{{ $adm->username }}</a></td>
                    <td><a href="#" class="usertext" data-name="fullname" data-title="Full Name" data-pk="{{ $adm->operator_id }}" data-type="text" data-url="{{ route('UserAdmin-update') }}">{{ $adm->fullname }}</a></td>
                    <td><a href="#" class="role" data-name="role_id" data-title="Role" data-pk="{{ $adm->operator_id }}" data-type="select" data-url="{{ route('UserAdmin-update') }}">{{ $adm->name }}</a></td>
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
    
           
            $('.role').editable({
            value: 2,
            source: [
                @php
                    $roles = DB::table('adm_role')->get();
                    foreach($roles as $role) {
                            echo '{value:"'.$role->role_id.'", text: "'.$role->name.'"}, ';
                    }
                    @endphp
               ]
            });
    
    
        });
    </script>
@endsection