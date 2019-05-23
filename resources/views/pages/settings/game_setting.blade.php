@extends('index')

@section('sidebarmenu')
@include('menu.menusetting')    
@endsection


@section('content')
<div class="row">
    <div class="col">
        <div class="table-aii">
            <div class="table-header">
                    Asta Poker
            </div>
             <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
             
        </div>
    </div>
    <div class="col">
        <div class="table-aii">
            <div class="table-header">
                    Asta Big2
            </div>
             <table id="dt-material-checkbox" class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
             
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="table-aii">
            <div class="table-header">
                    Domino Susun
            </div>
             <table id="dt-material-checkbox" class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
             
        </div>
    </div>
    <div class="col">
        <div class="table-aii">
            <div class="table-header">
                    Domino QQ
            </div>
             <table id="dt-material-checkbox" class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @foreach($items as $itm) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
              </table>
             
        </div>
    </div>
</div>
<script>
      table = $('table.table').dataTable({
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