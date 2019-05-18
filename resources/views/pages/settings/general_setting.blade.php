@extends('index')

@section('sidebarmenu')
@include('menu.menusetting')    
@endsection


@section('content')

<div class="cards">
  <div class="card">
    <div class="table-header">
      System Settings
    </div>
    <table class="table table-striped" style="margin-left:1px; display: table; width: auto;" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm"></th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Settings</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td>Maintenance</td>
          <td>
          <a href="#" class="popUpSetting" data-title="Maintenance" data-name="value" data-value="{{ $getMaintenance->value }}" data-pk="{{ $getMaintenance->id }}" data-type="select" data-url="{{ route('GeneralSetting-update') }}">
            @if ($getMaintenance->value == 1)
              On
            @else
              Off
            @endif
          </a></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>Point Expired</td>
          <td><a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $getPointExpired->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $getPointExpired->value }}</a><span> (hari)</span></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card">
    <div class="table-header" style=" display: table; width: auto;">
      Bank Settings
    </div>
    <table class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm"></th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Value</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td>BCA</td>
          <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="value" data-pk="{{ $getBank->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getBank->value }}</a></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card">
      <div class="table-header">
          Info Settings
    </div>
    <table class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm"></th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Setting</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td>Privacy Policy</td>
          <td><a href="#" class="inlineSetting" data-title="Facebook" data-name="value" data-pk="{{ $getPrivacyPolicy->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getPrivacyPolicy->value }}</a></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>Term Of Service</td>
          <td><a href="#" class="inlineSetting" data-title="Term Of Service" data-name="value" data-pk="{{ $getTermOfService->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getTermOfService->value }}</a></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>Term Of Service</td>
          <td><a href="#" class="inlineSetting" data-title="About" data-name="value" data-pk="{{ $getAbout->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getAbout->value }}</a></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>PokerWeb</td>
          <td><a href="#" class="inlineSetting" data-title="About" data-name="value" data-pk="{{ $getPokerWeb->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getPokerWeb->value }}</a></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card">
    <div class="table-header" style=" display: table; width: auto;">
      CS & Legal Settings
    </div>
    <table class="table display" style="margin-left:1px;" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="th-sm"></th>
          <th class="th-sm">Name</th>
          <th class="th-sm">Setting</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td></td>
            <td>Facebook</td>
            <td><a href="#" class="inlineSetting" data-title="Facebook" data-name="value" data-pk="{{ $getFb->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getFb->value }}</a></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>Twitter</td>
            <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="value" data-pk="{{ $getTwitter->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getTwitter->value }}</a></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td>Instagram</td>
            <td><a href="#" class="inlineSetting" data-title="Instagram" data-name="value" data-pk="{{ $getIg->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getIg->value }}</a></td>
            <td></td>
          </tr>
      </tbody>
    </table>
  </div>
</div>

<script>
  $('table.table').dataTable({
    pageLength : 2,
    lengthMenu: [[2, 10, 20, -1], [5, 10, 20, 'All']],
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
  
        $('.inlineSetting').editable({
            mode :'popup'
        });
  
        $('.popUpSetting').editable({
          value: 0,
          source: [
            {value: 0, text: 'Off'},
            {value: 1, text: 'On'}
          ]
        });
    }
  });
</script>
@endsection