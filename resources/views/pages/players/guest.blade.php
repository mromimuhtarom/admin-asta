@extends('index')

@section('sidebarmenu')
    @include('menu.menuplayer')    
@endsection

@section('content')
<div class="table-aii">
    <div class="table-header">
            Guest
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">ID Guest</th>
            <th class="th-sm">Device</th>
          </tr>
        </thead>
        <tbody>
            @foreach($guests as $gs)
            <tr>
                <td>{{ $gs->username }}</td>
                @if ($gs->device_id == NULL)
                    <td>{{ "Device is Not Connected"}}</td>
                @else
                    <td>{{ $gs->device_id }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
      </table>
     
</div>   
@endsection