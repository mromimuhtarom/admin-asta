@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">{{ Translate_menuPlayers('RegisteredPlayerID') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">{{ Translate_menuPlayers('Player ID') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">

@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif

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

<div class="playerId bg-blue-dark">
    <div class="table-header w-100 h-100" style="padding-right:2%;">
      @if ($menu && $mainmenu)
      <form action="{{ route('RegisterPlayerID-create') }}" method="post">
          @csrf
          <table style="color:white" border="1" width="100%" height="100%">
              <tr>
                  <td colspan="3" align="center" style="font-size: 200%;">{{ Translate_menuPlayers('Player ID') }}<i class="fa fa-group"></i></td>
              </tr>
              <tr>
                  <td width='30%'>{{ Translate_menuPlayers('NumberOfIDsToBeAdded') }}</td>
                  <td colspan="2"><input type="number" name="inputcount" class="form-control" required min="0">&nbsp;</td>
              </tr>
              <tr>
                  <td width="30%">{{ Translate_menuPlayers('UserType') }}</td>
                  <td colspan="2">
                      <select name="usertype" class="form-control" required>
                          <option value="">{{ Translate_menuPlayers('Choose User Type') }}</option>
                          <option value="{{ $type[0] }}">{{ ConfigTextTranslate($type[1]) }}</option>
                          <option value="{{ $type[2] }}">{{ ConfigTextTranslate($type[3]) }}</option>
                          {{-- <option value="{{ $type[4] }}">{{ ConfigTextTranslate($type[5]) }}</option> --}}
                      </select>&nbsp;
                  </td>
              </tr>
              <tr>
                  <td colspan="3" align="center"><button type="submit" class="btn btn-primary submit-data"><i class="fa fa-save"></i>{{ Translate_menuPlayers('Save') }}</button></td>
              </tr>
              <tr>
                  <td>{{ Translate_menuPlayers('Player ID used') }} : {{ number_format($playerused->countuserid) }}</td>
                  <td> {{ Translate_menuPlayers('Guest ID used') }} : {{ number_format($guestused->countuserid) }}</td>
                  {{-- <td>{{ Translate_menuPlayers('Bot ID used') }} : {{ number_format($botused->countuserid) }}</td> --}}
              </tr>
              <tr>
                  <td>{{ Translate_menuPlayers('Player ID didnt use') }} : {{ number_format($playernotused->countuserid) }}</td>
                  <td>{{ Translate_menuPlayers('Guest ID didnt use') }} : {{ number_format($guestnotused->countuserid) }} </td>
                  {{-- <td>{{ Translate_menuPlayers('Bot ID didnt use') }} : {{ number_format($botnotused->countuserid) }}</td> --}}
              </tr>
              <tr>
                  <td>{{ Translate_menuPlayers('Total Player ID') }} : {{ number_format($totalplayer->countuserid) }}</td>
                  <td>{{ Translate_menuPlayers('Total Guest ID') }} : {{ number_format($totalguest->countuserid) }} </td>
                  {{-- <td>{{ Translate_menuPlayers('Total Bot ID') }} : {{ number_format($totalbot->countuserid) }}</td> --}}
              </tr>
          </table>
      </form>
      @else 
      <table style="color:white;" border="1" width="100%" height="80%">
          <tr>
            <td Colspan="3" align="center">{{ Translate_menuPlayers('ID Player already') }}</td>
          </tr>
          <tr>
              <td>{{ Translate_menuPlayers('Player ID used') }} : {{ number_format($playerused->countuserid) }}</td>
              <td>{{ Translate_menuPlayers('Guest ID used') }}: {{ number_format($guestused->countuserid) }}</td>
              {{-- <td>{{ Translate_menuPlayers('Bot ID used') }}: {{ number_format($botused->countuserid) }}</td> --}}
          </tr>
          <tr>
              <td>{{ Translate_menuPlayers('Player ID didnt use') }} : {{ number_format($playernotused->countuserid) }}</td>
              <td>{{ Translate_menuPlayers('Guest ID didnt use') }}  : {{ number_format($guestnotused->countuserid) }} </td>
              {{-- <td>{{ Translate_menuPlayers('Bot ID didnt use') }}: {{ number_format($botnotused->countuserid) }}</td> --}}
          </tr>
          <tr>
              <td>{{ Translate_menuPlayers('Total Player ID') }}: {{ number_format($totalplayer->countuserid) }}</td>
              <td>{{ Translate_menuPlayers('Total Guest ID') }} : {{ number_format($totalguest->countuserid) }} </td>
              {{-- <td>{{ Translate_menuPlayers('Total Bot ID') }} : {{ number_format($totalbot->countuserid) }}</td> --}}
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