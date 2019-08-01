@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('profile-view') }}">Profile</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profile-view') }}">My Account</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">

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
    <div>{{Session::get('alert')}}</div>
</div>
    
@endif

  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif



<div class="profile bg-blue-dark">
    <div class="table-header w-100 h-100" style="padding-right:2%;">
        <form action="" method="post">
            <table style="color:white" border="1" width="100%" height="100%">
                <tr>
                    <td colspan="3" align="center" style="font-size: 200%;">My Profile <i class="fa fa-user"></i></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td align="center"> :</td>
                    <td>{{ $profile->username}}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td align="center">:</td>
                    <td>{{ $profile->rolename}}</td>
                </tr>
                <tr>
                    <td>Full Name</td>
                    <td align="center">:</td>
                    <td><a href="#" class="usertext" data-name="fullname" data-title="Full Name" data-pk="{{ $profile->op_id }}" data-type="text" data-url="{{ route('profile-update') }}">{{ $profile->fullname}}</a></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td align="center">:</td>
                    <td><a href="#" class="password btn btn-primary" id="password" data-pk="{{ $profile->op_id }}" data-toggle="modal" data-target="#reset-password"><i class="fa fa-key"></i> Reset Password</a></td>
                </tr>
            </table>
        </form>
    </div>
</div>


  {{-- reset password --}}
  <div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Reset Password</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('profile-password') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="userid" id="userid" value="">
            <input type="password" class="form-control" name="password" placeholder="Password" value="" required/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-primary submit-data"><i class="fa fa-key"></i> Reset Password</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
        </div>
          </form>
      </div>
    </div>
  </div>
{{-- end reset password --}}


<script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $.fn.editable.defaults.mode = 'inline';


    $('.usertext').editable({
      mode: 'inline'
    });

          $(".password").click(function(e) {
                e.preventDefault();
    
                var id = $(this).attr('data-pk');
                var test = $("#userid").val(id);
          });
  </script>
@endsection