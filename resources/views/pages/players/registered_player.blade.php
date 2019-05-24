@extends('index')

@section('sidebarmenu')
    @include('menu.menuplayer');    
@endsection

@section('content')
<div class="table-aii">
    <div class="footer-table">
        <div class="add-btn-smt">
            Registered Player
        </div>
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
        <thead class="th-table">
          <tr>
            <th class="th-sm">Username</th>
            <th class="th-sm">Date Created</th>
            <th class="th-sm">Register From</th>
            <th class="th-sm">Device</th>
            <th class="th-sm">Country</th>
          </tr>
        </thead>
        <tbody>
            @foreach($registered as $regis)
            <tr>
                <td>{{ $regis->username }}</td>
                <td>{{ $regis->join_date }}</td>
                @php
                    if($regis->facebook_id !== ''){
                        $user_type = 'Facebook';
                    } else if($regis->user_type === 1) {
                        $user_type = 'Asta';
                    }
                @endphp
                <td>{{ $user_type }}</td>
                <td>{{ $regis->devicename}}</td>
                <td>{{ $regis->countryname }}</td>
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