@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
<div class="menugame">
  @include('menu.nama_game')
</div>
    <div class="table-aii">
        <div class="table-header">
                Season Reward
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Position (From - To)</th>
                <th class="th-sm">Reward Chip</th>
                <th class="th-sm">Reward Gold</th>
                <th class="th-sm">Reward Point</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($reward as $rd)
                <tr>
                    <td></td>
                    <td>{{ $rd->positionFrom }} - {{ $rd->positionTo }}</td>
                    <td>{{ $rd->winpotReward }}</td>
                    <td>{{ $rd->goldReward}}</td>
                    <td>{{ $rd->pointReward }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>   
@endsection