@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
{{-- <div class="menugame border-bottom border-dark">
  @include('menu.nama_game')
</div> --}}

  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Season Reward</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="number" name="from" placeholder="From" required style="width:95px;"> - <input type="number" name="to" placeholder="To" required style="width:95px;"> <br>
          <input type="text" name="rewardchip" placeholder="Reward Chip"><br>
          <input type="text" name="rewardgold" placeholder="Reward Gold">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
 
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all as $error)
          <li>{{$error}}</li>  
          @endforeach
      </ul>
  </div>
      
  @endif
  
  @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{\Session::get('success')}}</p>
      </div>
      
  @endif



    <div class="table-aii">
              <tr>
                <th></th>
                <th class="th-sm">Position (From - To)</th>
                <th class="th-sm">Reward Chip</th>
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
      });

      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
      });
  </script> 
@endsection