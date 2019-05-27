@extends('index')
@section('namepages')
<h1 class="page-header"><i class="fa-fw fa fa-home"></i>  Players <span>> High Rollers</span></h1>
@endsection


@section('content')
  <div class="table-aii">
    {{-- <div class="footer-table">
      <div class="add-btn-smt">
        Hight Roller
      </div>
    </div> --}}
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
        <thead class="th-table">
          <tr>
            <th></th>
            <th class="th-sm">Bank Account</th>
            <th class="th-sm">Players</th>
            <th class="th-sm">Country</th>
            <th class="th-sm">Gold</th>
          </tr>
        </thead>
        <tbody>
            @foreach($player as $plyr)
            <tr>
                <td></td>
                <td>{{ number_format($plyr->chip, 2,',', '.') }}</td>
                <td>{{ $plyr->username }}</td>
                <td>{{ $plyr->name }}</td>
                <td>{{ $plyr->gold}}</td>
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