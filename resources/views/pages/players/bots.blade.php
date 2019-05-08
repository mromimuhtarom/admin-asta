@extends('index')

@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection

@section('content')
<div class="table-aii">
    <div class="table-header">
            Bots
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th></th>
            <th class="th-sm">Username</th>
            <th class="th-sm">Bank Account</th>
            <th class="th-sm">Rank</th>
            <th class="th-sm">Gold</th>
            <th class="th-sm">Country</th>
          </tr>
        </thead>
        <tbody>
            @foreach($bots as $bot)
            <tr>
                <td></td>
                <td>{{ $bot->username }}</td>
                <td>{{ $bot->chip }}</td>
                <td>{{ $bot->rank_id}}</td>
                <td>{{ $bot->gold }}</td>
                <td>{{ $bot->name }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
     
</div>  
@endsection