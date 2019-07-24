@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Guest') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Guest') }}">Guest</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
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
    <div class="search bg-blue-dark" style>
        <div class="table-header w-100 h-100">
            <form action="{{ route('Guest-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col">
                        <input type="text" id="username" class="left" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select id="status" name="inputStatus" class="form-control">
                            <option value="">Choose Status</option>
                            <option value="used">Used</option>
                            <option value="nonused">Non Used</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" id="mindate" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" id="maxdate" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    

<script>
    $('#username').prop('readonly', true);
    $('#username').prop('disabled', true);
    $('#mindate').prop('readonly', true);
    $('#mindate').prop('disabled', true);
    $('#maxdate').prop('readonly', true);
    $('#maxdate').prop('disabled', true);
    $('#status').click(function(e) {
        e.preventDefault();
        if($(this).val() == 'used') {
            $('#username').prop('readonly', false);
            $('#username').prop('disabled', false);
            $('#mindate').prop('readonly', false);
            $('#mindate').prop('disabled', false);
            @php 
            echo"$('#mindate').val('".$datenow->toDateString()."');";
            echo"$('#maxdate').val('".$datenow->toDateString()."');";
            @endphp
            $('#maxdate').prop('readonly', false);
            $('#maxdate').prop('disabled', false);
        } else if($(this).val() == 'nonused')
        {
            $('#username').prop('readonly', true);
            $('#username').prop('disabled', true);
            $('#username').val("");
            $('#mindate').prop('readonly', true);
            $('form input[type="date"]').prop("disabled", false);
            var minDate = $("#mindate").val("");
            var maxDate = $("#maxdate").val("");
            $('#maxdate').prop('readonly', true);
            
        } else 
        {
            $('#username').prop('readonly', true);
            $('#username').val("");
            $('#username').prop('disabled', true);
            $('#mindate').prop('readonly', true);
            $('#mindate').val("");
            $('#mindate').prop('disabled', true);
            $('#maxdate').prop('readonly', true);
            $('#maxdate').val("");
            $('#maxdate').prop('disabled', true);
        }
    });
</script>
@endsection