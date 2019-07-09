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
@if($menu)
<div class="input-insert bg-blue-dark">
    <div class="row">
        <div class="col" align="center" style="color:white; font-size:30px; font-weight:bold;">Register Reseller</div>
        <div class="w-100"><p>&nbsp;</p></div>
        <div class="col">
            <div class="table-header w-100 h-100">
                <form action="{{ route('RegisterReseller-create')}}" method="post">
                    @csrf
                    {{-- <div class="row h-100 w-100 no-gutters">
                        <div class="col" style="padding-left:1%;width:25%;">Username</div>
                        <div class="col" style="padding-left:1%;">
                            <input type="text" name="inputUsername" class="form-control" placeholder="username" required>
                        </div>
                        <div class="w-100"><p>&nbsp;</p></div>
                        <div class="col" style="padding-left:1%;">Username</div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMinDate">
                        </div>
                        <div class="w-100"><p>&nbsp;</p></div>
                        <div class="col" style="padding-left:1%;">Username</div>
                        <div class="col" style="padding-left:1%;">
                            <input type="date" class="form-control" name="inputMaxDate">
                        </div>
                        <div class="w-100"><p>&nbsp;</p></div>
                        <div class="col" style="padding-left:1%;">
                            <button class="myButton" type="submit">Cari</button>
                        </div>
                    </div> --}}
                    <table border="0" width="100%" height="100%" style="color:white">
                        <tr>
                            <td>Full Name<p>&nbsp;</p></td>
                            <td>
                                    <input type="text" name="firstName" class="form-control" placeholder="First Name" value="{{ old('fullname') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                            <td>
                                    <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="{{ old('fullname') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr style="">
                            <td>Username</td>
                            <td colspan="2">
                                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td colspan="2">
                                    <input type="text" name="password" class="form-control" value="{{ generateID(6) }}" readonly>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td colspan="2">
                                    <input type="number" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td colspan="2">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Identity Card</td>
                            <td colspan="2">
                                    <input type="text" name="idcard" class="form-control"value="{{ old('identify') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>Address</td>
                            <td colspan="2">
                                    <textarea name="address" rows="5" class="form-control">{{ old('idcard') }}</textarea>
                                    <p>&nbsp;</p>
                            </td>
                        </tr> --}}
                        <tr>
                            <td colspan="3" align="center"><button class="myButton" type="submit">Submit</button></td>
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