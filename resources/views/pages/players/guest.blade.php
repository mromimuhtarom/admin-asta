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