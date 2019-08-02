@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Register_Reseller') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Register_Reseller') }}">Register Reseller</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
@if(\Session::has('alert'))
<div style="text-align:center; margin-left:10%; margin-right:10%;"class="alert alert-danger">
  {{ Session::get('alert') }}
</div>
@endif
@if (\Session::has('success'))
<div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
</div>
@endif
@if($menu && $mainmenu)
<div class="input-insert bg-blue-dark">
    <div class="row">
        <div class="col" align="center" style="color:white; font-size:30px; font-weight:bold; font-family:Century Gothic;"><i class="fa fa-plus-square"></i> Register Reseller</div>
        <div class="w-100"><p>&nbsp;</p></div>
        <div class="col">
            <div class="table-header w-100 h-100">
                <form action="{{ route('RegisterReseller-create')}}" method="post">
                    @csrf
                    <table border="0" width="100%" height="100%" style="color:white; font-family:Century Gothic;">
                        <tr>
                            <td>Full Name<p>&nbsp;</p></td>
                            <td>
                                    <input type="text" name="firstName" class="form-control" placeholder="First Name" value="{{ old('fullname') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                    <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="{{ old('fullname') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr style="">
                            <td>Username <p>&nbsp;</p> </td>
                            <td colspan="3">
                                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Password<p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="text" name="password" class="form-control" value="{{ generateID(6) }}" readonly>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone<p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="number" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Email<p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Identity Card<p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="text" name="idcard" class="form-control"value="{{ old('identify') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center"><button class="myButton submit-data" type="submit" style="font-family:Century Gothic; font-weight:bold;"><i class="fa fa-save"></i> Submit</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>


    </div>
</div>    
@else 
<div class="alert-danger alert-block" style="padding-left:2%;">
        <a class="close" data-dismiss="alert" href="#">×</a>
        <h4 class="alert-heading">Access Denied!</h4>
        You can't access this page with your current roles
        <p class="text-align-left">
            <br>
            {{-- <a href="javascript:void(0);" class="btn btn-sm btn-default"><strong>Action Button</strong></a> --}}
        </p>
</div>	
@endif
@endsection