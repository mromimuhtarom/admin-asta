@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
{{-- <div class="menugame border-bottom border-dark">
  @include('menu.nama_game')
</div> --}}
    <div class="table-aii" style=" display: table; width: auto;">
        <div class="table-header">
                Season
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Time Zone</th>
                <th class="th-sm">Entry fee</th>
                <th class="th-sm">Small Blind</th>
                <th class="th-sm">Big Blind</th>
                <th class="th-sm">Start Chip</th>
                <th class="th-sm">Quit Win</th>
                <th class="th-sm">Quit Lose</th>
                <th class="th-sm">Start Time</th>
                <th class="th-sm">Finish Time</th>
                <th class="th-sm">Hand Win</th>
                <th class="th-sm">Hand Lose</th>
                <th class="th-sm">Disconnect Win</th>
                <th class="th-sm">Disconnect Lose</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($season as $sn)
                @php
                    //  $dt = new DateTime('UTC');//asli
                    $dt = new DateTime($sn->timezone);
                    $dt->setTimestamp($sn->startTime);
                    //  $dt->setTimeZone(new DateTimeZone($season->timezone));//asli
                    $dt->setTimeZone(new DateTimeZone($sn->timezone));
                    //  $dt = new DateTime('UTC');//asli
         
                    //  $dtf = new DateTime('UTC');//asli
                    $dtf = new DateTime($sn->timezone);
                    $dtf->setTimestamp($sn->finishTime);
                    //  $dtf->setTimeZone(new DateTimeZone($season->timezone));//asli
                    $dtf->setTimeZone(new DateTimeZone($sn->timezone));
                    //  $dtf = new DateTime('UTC');//asli
                @endphp
                <tr>
                    <td></td>
                    <td>{{ $sn->title }}</td>
                    <td>{{ $sn->timezone }}</td>
                    <td>{{ $sn->entryFee }}</td>
                    <td>{{ $sn->sb }}</td>
                    <td>{{ $sn->bb}}</td>
                    <td>{{ $sn->startChips }}</td>
                    <td>{{ $sn->quitWin }}</td>
                    <td>{{ $sn->quitLose }}</td>
                    <td>{{ $dt->format('Y-m-d H:i') }}</td>
                    <td>{{ $dtf->format('Y-m-d H:i') }}</td>
                    <td>{{ $sn->handWin}}</td>
                    <td>{{ $sn->handLose}}</td>
                    <td>{{ $sn->disconnectWin }}</td>
                    <td>{{ $sn->disconnectLose}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>
<script>
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
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