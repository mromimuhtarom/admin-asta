@extends('index')

@section('sidebarmenu')
@include('menu.menusetting')    
@endsection


@section('content')

{{-- <form action=""class="dropzone"  id="addImages">
    {{ csrf_field() }}
    <input type="hidden" name="tournamentId" value="">
</form> --}}
<div class="table-aii">
    <div class="table-header">
            Profile Admin
            
    </div>
     <table id="dt-material-checkbox" class="table display table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Avatar</th>
            <th class="th-sm">Username</th>
            <th class="th-sm">Full Name</th>
            <th class="th-sm">Role</th>
            <th class="th-sm">Reset</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                </td>
                <td><a href="#" class="usertext" data-title="Username" data-name="username" data-pk="{{ $user->operator_id }}" data-type="text" data-url="{{ route('AdminSetting-update')}}">{{ $user->username }}</a></td>
                <td><a href="#" class="usertext" data-title="Full Name" data-name="fullname" data-pk="{{ $user->operator_id }}" data-type="text" data-url="{{ route('AdminSetting-update')}}">{{ $user->fullname }}</a></td>
                <td><a href="#" class="role" data-name="role_id" data-type="select" data-value="{{ $user->role_id }}" data-pk="{{ $user->operator_id }}" data-url="{{ route('AdminSetting-update') }}" data-title="select permission"></a></td>
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


        $('.role').editable({
            value: 0,
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