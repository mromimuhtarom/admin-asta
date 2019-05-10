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
                    <td>
                        <a href="#" class="usertext" data-name="positionFrom" data-title="From" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->positionFrom }}</a> - 
                        <a href="#" class="usertext" data-name="positionTo" Data-title="To" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->positionTo }}</a>
                    </td>
                    <td><a href="#" class="usertext" data-title="Reward Chip" data-name="winpotReward" Data-title="Reward Chip" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->winpotReward }}</a></td>
                    <td><a href="#" class="usertext" data-name="goldReward" Data-title="Reward Gold" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->goldReward}}</a></td>
                    <td><a href="#" class="usertext" data-name="pointReward" Data-title="Reward Point" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->pointReward }}</a></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>   
    <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
         
          $('.usertext').editable({
              mode :'popup'
          });
  
  
      });
  </script> 
@endsection