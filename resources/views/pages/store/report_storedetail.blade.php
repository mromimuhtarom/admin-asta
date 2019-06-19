@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Store') }}">Store</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Store') }}">Report Store</a></li>
@endsection


@section('content')
    <div class="table-aii">
        <div class="table-header">
            <form action="">
                <div class="row">
                    <div class="col">
                        <input type="text" name="username" placeholder="username">
                    </div>
                    <div class="col">
                        <select name="action" id="">
                            <option>Choose Action</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="date" name="dari">
                    </div>
                    <div class="col">
                        <input type="date" name="sampai">
                    </div>
                    <div class="col">
                        <button class="myButton" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
    
    <div class="table-aii">
        <div class="footer-table">
            <div class="add-btn-smt">
                Payment Store
            </div>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Type Payment</th>
                <th class="th-sm">Type Transaction</th>
                <th class="th-sm">Active</th>
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
                    <td></td>
                    <td></td>
                </tr>
                {{-- @endforeach --}}
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