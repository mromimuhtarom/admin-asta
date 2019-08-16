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



<div class="playerId bg-blue-dark">
    <div class="table-header w-100 h-100" style="padding-right:2%;">
      @if ($menu && $mainmenu)
      <form action="{{ route('RegisterPlayerID-create') }}" method="post">
          @csrf
          <table style="color:white" border="1" width="100%" height="100%">
              <tr>
                  <td colspan="3" align="center" style="font-size: 200%;">Player ID <i class="fa fa-group"></i></td>
              </tr>
              <tr>
                  <td width='30%'>Number of inputs filled in Player ID</td>
                  <td colspan="2"><input type="number" name="inputcount" class="form-control" required>&nbsp;</td>
              </tr>
              <tr>
                  <td width="30%">User Type</td>
                  <td colspan="2">
                      <select name="usertype" class="form-control" required>
                          <option value="">Choose User Type</option>
                          <option value="{{ $type[0] }}">{{ $type[1] }}</option>
                          <option value="{{ $type[2] }}">{{ $type[3] }}</option>
                          <option value="{{ $type[4] }}">{{ $type[5] }}</option>
                      </select>&nbsp;
                  </td>
              </tr>
              <tr>
                  <td colspan="3" align="center"><button type="submit" class="btn btn-primary submit-data"><i class="fa fa-save"></i> Save</button></td>
              </tr>
              <tr>
                  <td> Player ID used : {{ $playerused->countuserid }}</td>
                  <td> Guest ID used is: {{ $guestused->countuserid }}</td>
                  <td> Bot ID used is: {{ $botused->countuserid }}</td>
              </tr>
              <tr>
                  <td>Player ID didn't use : {{ $playernotused->countuserid }}</td>
                  <td>Guest ID didn't use : {{ $guestnotused->countuserid }} </td>
                  <td>Bot Id didn't use: {{ $botnotused->countuserid }}</td>
              </tr>
              <tr>
                  <td>Total Player ID : {{ $totalplayer->countuserid }}</td>
                  <td>Total Guest ID : {{ $totalguest->countuserid }} </td>
                  <td>Total Bot ID : {{ $totalbot->countuserid }}</td>
              </tr>
          </table>
      </form>
      @else 
      <table style="color:white;" border="1" width="100%" height="80%">
          <tr>
            <td Colspan="3" align="center">ID player Already Used</td>
          </tr>
          <tr>
              <td> Player ID used : {{ $playerused->countuserid }}</td>
              <td> Guest ID used is: {{ $guestused->countuserid }}</td>
              <td> Bot ID used is: {{ $botused->countuserid }}</td>
          </tr>
          <tr>
              <td>Player ID didn't use : {{ $playernotused->countuserid }}</td>
              <td>Guest ID didn't use : {{ $guestnotused->countuserid }} </td>
              <td>Bot Id didn't use: {{ $botnotused->countuserid }}</td>
          </tr>
          <tr>
              <td>Total Player ID : {{ $totalplayer->countuserid }}</td>
              <td>Total Guest ID : {{ $totalguest->countuserid }} </td>
              <td>Total Bot ID : {{ $totalbot->countuserid }}</td>
          </tr>
      </table>
      @endif
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