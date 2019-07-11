@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">Settings</a></li>
        <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">General Setting</a></li>
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
        <form action="{{ route('RegisterPlayerID-create') }}" method="post">
            @csrf
            <table style="color:white" border="1" width="100%" height="100%">
                <tr>
                    <td colspan="3" align="center" style="font-size: 200%;">Player ID <i class="fa fa-group"></i></td>
                </tr>
                <tr>
                    <td width='30%'>Number of inputs filled in Player ID</td>
                    <td align="center"> :</td>
                    <td><input type="number" name="inputcount" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>


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
  </script>
@endsection