@extends('index')

@section('sidebarmenu')
@include('menu.menusetting')    
@endsection


@section('content')
<div class="row">
    <div class="col">
        <div class="table-aii">
            <div class="footer-table">
              <div class="add-btn-smt">
                Asta Poker
              </div>
            </div>
             <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
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
            <div class="footer-table">
              <div class="add-btn-smt">
                Asta Big 2
              </div>
            </div>
             <table id="dt-material-checkbox" class="table display" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
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
            <div class="footer-table">
              <div class="add-btn-smt">
                Domino Susun
              </div>
            </div>
             <table id="dt-material-checkbox" class="table display" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
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
            <div class="footer-table">
              <div class="add-btn-smt">
                Domino QQ
              </div>
            </div>
             <table id="dt-material-checkbox" class="table display" style="margin-left:1px;margin-top:-9%;" cellspacing="0" width="100%">
                <thead class="th-table">
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
          "pagingType": "full_numbers",
    "bInfo" : false,
    "sDom": '<"row view-filter smt-aii add-smt"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager-smt"<"col-sm-12"<"bottom"p>>>',
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