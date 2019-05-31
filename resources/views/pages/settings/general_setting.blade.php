@extends('index')

@section('sidebarmenu')
@include('menu.menusetting')    
@endsection


@section('content')

<div class="settings-table">
  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      <header>
        <div class="widget-header">	
          <h2><strong>Bots</strong></h2>				
        </div>
      </header>
    
      <div>
        
        <div class="jarviswidget-editbox">
          <input class="form-control" type="text">
          <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
          
        </div>
        
        <div class="widget-body">          
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Maintenance</td>
                    @if($menu)
                    <td>
                      <a href="#" class="popUpSetting" data-title="Maintenance" data-name="value" data-value="{{ $getMaintenance->value }}" data-pk="{{ $getMaintenance->id }}" data-type="select" data-url="{{ route('GeneralSetting-update') }}">
                        @if ($getMaintenance->value == 1)
                          On
                        @else
                          Off
                        @endif
                      </a>
                    </td>
                    @else 
                    <td>
                      @if ($getMaintenance->value == 1)
                        On
                      @else
                        Off
                      @endif
                    </td>
                    @endif
                  </tr>
                  <tr>
                    <td>Point Expired</td>
                    @if($menu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $getPointExpired->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $getPointExpired->value }}</a><span> (hari)</span>
                    </td>
                    @else
                    <td>{{ $getPointExpired->value }} (hari)</td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      <header>
        <div class="widget-header">	
          <h2><strong>Bots</strong></h2>				
        </div>
      </header>
    
      <div>
        
        <div class="jarviswidget-editbox">
          <input class="form-control" type="text">
          <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
          
        </div>
        
        <div class="widget-body">          
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Value</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BCA</td>
                    @if($menu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Twitter" data-name="value" data-pk="{{ $getBank->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getBank->value }}</a>
                    </td>
                    @else 
                    <td>{{ $getBank->value }}</td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
      <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
          <div class="widget-header">	
            <h2><strong>Bots</strong></h2>				
          </div>
        </header>
      
        <div>
          
          <div class="jarviswidget-editbox">
            <input class="form-control" type="text">
            <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
            
          </div>
          
          <div class="widget-body">          
            <div class="custom-scroll table-responsive" style="height:350px;">
              
              <div class="table-outer">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <th class="th-sm">Name</th>
                      <th class="th-sm">Setting</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Privacy Policy</td>
                      @if($menu)
                      <td><a href="#" class="inlineSetting" data-title="Facebook" data-name="value" data-pk="{{ $getPrivacyPolicy->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getPrivacyPolicy->value }}</a></td>
                      @else 
                      <td>{{ $getPrivacyPolicy->value }}</td>
                      @endif
                    </tr>
                    <tr>
                      <td>Term Of Service</td>
                      @if($menu)
                      <td><a href="#" class="inlineSetting" data-title="Term Of Service" data-name="value" data-pk="{{ $getTermOfService->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getTermOfService->value }}</a></td>
                      @else 
                      <td>{{ $getTermOfService->value }}</td>
                      @endif
                    </tr>
                    <tr>
                      <td>Term Of Service</td>
                      @if($menu)
                      <td><a href="#" class="inlineSetting" data-title="About" data-name="value" data-pk="{{ $getAbout->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getAbout->value }}</a></td>
                      @else 
                      <td>{{ $getAbout->value }}</td>
                      @endif
                    </tr>
                    <tr>
                      <td>PokerWeb</td>
                      @if($menu)
                      <td><a href="#" class="inlineSetting" data-title="About" data-name="value" data-pk="{{ $getPokerWeb->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getPokerWeb->value }}</a></td>
                      @else 
                      <td>{{ $getPokerWeb->value }}</td>
                      @endif
                    </tr>
                  </tbody>
                </table>
              </div>
            
            </div>
          
          </div>
        </div>
      </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      <header>
        <div class="widget-header">	
          <h2><strong>Bots</strong></h2>				
        </div>
      </header>
    
      <div>
        
        <div class="jarviswidget-editbox">
          <input class="form-control" type="text">
          <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
          
        </div>
        
        <div class="widget-body">          
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Facebook</td>
                    @if($menu)
                    <td><a href="#" class="inlineSetting" data-title="Facebook" data-name="value" data-pk="{{ $getFb->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getFb->value }}</a></td>
                    @else 
                    <td>{{ $getFb->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Twitter</td>
                    @if($menu)
                    <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="value" data-pk="{{ $getTwitter->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getTwitter->value }}</a></td>
                    @else 
                    <td>{{ $getTwitter->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Instagram</td>
                    @if($menu)
                    <td><a href="#" class="inlineSetting" data-title="Instagram" data-name="value" data-pk="{{ $getIg->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getIg->value }}</a></td>
                    @else 
                    <td>{{ $getIg->value }}</td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          
          </div>
        
        </div>
      </div>
    </div>
  </div>
</div>


<div class="settings-table">
  <div>

    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
      <header>
        <div class="widget-header">	
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>Players Online </h2>
        </div>
        <div class="widget-toolbar">
        </div>
      </header>
      <div>
        <div class="jarviswidget-editbox">
        </div>
        <div class="widget-body p-0">

          <div class="custom-scroll table-responsive" style="height:300px; overflow-y: scroll;">
            <div class="table-outer">
              <table id="online-players" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                  <tr>
                    <th data-hide="phone">Name</th>
                    <th data-class="expand">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Facebook</td>
                    @if($menu)
                    <td><a href="#" class="inlineSetting" data-title="Facebook" data-name="value" data-pk="{{ $getFb->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getFb->value }}</a></td>
                    @else 
                    <td>{{ $getFb->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Twitter</td>
                    @if($menu)
                    <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="value" data-pk="{{ $getTwitter->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getTwitter->value }}</a></td>
                    @else 
                    <td>{{ $getTwitter->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Instagram</td>
                    @if($menu)
                    <td><a href="#" class="inlineSetting" data-title="Instagram" data-name="value" data-pk="{{ $getIg->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getIg->value }}</a></td>
                    @else 
                    <td>{{ $getIg->value }}</td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<script>
  // $('table.table').dataTable({
  //   pageLength : 5,
  //   lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
  //   columnDefs: [{
  //     orderable: false,
  //     className: 'select-checkbox',
  //     targets: 0
  //   }],
  //   "pagingType": "full_numbers",
  //   "bInfo" : false,
  //   "sDom": '<"row view-filter smt-aii add-smt"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager-smt"<"col-sm-12"<"bottom"p>>>',
  //   select: {
  //     style: 'os',
  //     selector: 'td:first-child'
  //   },
  //   "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
  //       $.ajaxSetup({
  //           headers: {
  //               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //           }
  //       });
  
  //       $('.inlineSetting').editable({
  //           mode :'popup'
  //       });
  
  //       $('.popUpSetting').editable({
  //         mode: 'inline'
  //         value: 0,
  //         source: [
  //           {value: 0, text: 'Off'},
  //           {value: 1, text: 'On'}
  //         ]
  //       });
  //   }
  // });


  table = $('table.table').dataTable({
    "sDom": "<'dt-toolbar d-flex align-items-center'<f><'hidden-xs ml-auto'B>r>"+
        "t"+
        "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
    "autoWidth" : true,
    "classes": {
      "sWrapper": "dataTables_wrapper dt-bootstrap4"
    },
    "oLanguage": {
      "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },
      buttons: [ {
          extend: 'colvis',
          text: 'Show / hide columns',
          className: 'btn btn-default',
          columnText: function ( dt, idx, title ) {
            return title;
          }			        
      } ],
      "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('.inlineSetting').editable({
            mode :'inline'
        });

        $('.popUpSetting').editable({
          mode: 'inline',
          value: 0,
          source: [
            {value: 0, text: 'Off'},
            {value: 1, text: 'On'}
          ]
        });
      },
    responsive: true
  });
</script>
@endsection