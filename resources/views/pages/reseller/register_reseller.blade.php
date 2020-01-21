@extends('index')

@section('page')
    <li class="breadcrumb-item"><a href="{{ route('Register_Reseller') }}">{{ translate_menu('Reseller')}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('Register_Reseller') }}">{{ translate_menu('Register_Reseller')}}</a></li>
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
        <div class="col" align="center" style="color:white; font-size:30px; font-weight:bold; font-family:Century Gothic;"><i class="fa fa-plus-square"></i> {{ translate_menu('Register_Reseller')}}</div>
        <div class="w-100"><p>&nbsp;</p></div>
        <div class="col">
            <div class="table-header w-100 h-100">
                <form action="{{ route('RegisterReseller-create')}}" method="post">
                    @csrf
                    <table border="0" width="100%" height="100%" style="color:white; font-family:Century Gothic;">
                        <tr>
                            <td>{{ translate_menuContentAdmin('Full Name')}}<p>&nbsp;</p></td>
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
                            <td>{{ translate_menuContentAdmin('Username')}}<p>&nbsp;</p> </td>
                            <td colspan="3">
                                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ TranslateReseller('Password')}}<p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="text" name="password" class="form-control" value="{{ generateID(6) }}" readonly>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ TranslateReseller('Phone')}}<p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="number" min="0" name="phone" class="form-control" value="{{ old('phone') }}" required>
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
                            <td>{{ TranslateReseller('Identity Card')}} <p>&nbsp;</p></td>
                            <td colspan="3">
                                    <input type="text" name="idcard" class="form-control"value="{{ old('identify') }}" required>
                                    <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center"><button class="myButton submit-data" type="submit" style="font-family:Century Gothic; font-weight:bold;"><i class="fa fa-save"></i>{{ TranslateMenuItem('Save')}}</button></td>
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
        <h4 class="alert-heading">{{ TranslateReseller('Access denied')}}!</h4>
        {{ TranslateReseller('You cant access')}}
        <p class="text-align-left">
            <br>
        </p>
</div>	
@endif
@endsection