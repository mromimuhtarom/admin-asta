@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">Settings</a></li>
        <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">General Setting</a></li>
@endsection


@section('content')

@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif

@if (\Session::has('success'))
<div class="alert alert-success">
  <p>{{\Session::get('success')}}</p>
</div>
@endif

<div class="settings-table">
  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>System Settings</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Maintenance</td>
                    @if($menu && $mainmenu)
                    <td><a href="#" class="popUpSetting" data-title="Maintenance" data-name="value" data-value="{{ $getMaintenance->value }}" data-pk="{{ $getMaintenance->id }}" data-type="select" data-url="{{ route('GeneralSetting-update') }}">{{ $getMaintenance->strmaintenance() }}</a></td>
                    @else 
                    <td>{{ strMaintenanceOnOff($getMaintenance->value) }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Point Expired</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $getPointExpired->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $getPointExpired->value }}</a><span> (hari)</span>
                    </td>
                    @else
                    <td>{{ $getPointExpired->value }} (Day)</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Award Signup</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_signup->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $award_signup->value }}</a>
                    </td>
                    @else
                    <td>{{ $award_signup->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Award Signup Guest</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_signup_guest->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $award_signup_guest->value }}</a>
                    </td>
                    @else
                    <td>{{ $award_signup_guest->value }} </td>
                    @endif
                  </tr>
                  <tr>
                    <td>Award Daily Chips</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_chips->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $award_daily_chips->value }}</a>
                    </td>
                    @else
                    <td>{{ $award_daily_chips->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Award Daily Chips Guest</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_chips_guest->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $award_daily_chips_guest->value }}</a>
                    </td>
                    @else
                    <td>{{ $award_daily_chips_guest->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Award Daily Days</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_days->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $award_daily_days->value }}</a>
                    </td>
                    @else
                    <td>{{ $award_daily_days->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Award Daily Multiply</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_multiply->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $award_daily_multiply->value }}</a>
                    </td>
                    @else
                    <td>{{ $award_daily_multiply->value }}</td>
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
          <h2><strong>Bank Settings</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Value</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>BCA</td>
                    @if($menu && $mainmenu)
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
          <h2><strong>Info Settings</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>About</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-edit"></i> Edit About
                    </button>
                    </td>
                    @else 
                    <td>{{$getAbout->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>PokerWeb</td>
                    @if($menu && $mainmenu)
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
          <h2><strong>CS & Legal Settings</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Setting</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Facebook</td>
                    @if($menu && $mainmenu)
                    <td><a href="#" class="inlineSetting" data-title="Facebook" data-name="value" data-pk="{{ $getFb->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getFb->value }}</a></td>
                    @else 
                    <td>{{ $getFb->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Twitter</td>
                    @if($menu && $mainmenu)
                    <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="value" data-pk="{{ $getTwitter->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getTwitter->value }}</a></td>
                    @else 
                    <td>{{ $getTwitter->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Instagram</td>
                    @if($menu && $mainmenu)
                    <td><a href="#" class="inlineSetting" data-title="Instagram" data-name="value" data-pk="{{ $getIg->id }}" data-type="text" data-url="{{ route('GeneralSetting-update')}}">{{ $getIg->value }}</a></td>
                    @else 
                    <td>{{ $getIg->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Privacy Policy</td>
                    @if($menu && $mainmenu)
                    <td>
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModalPrivacyPolicy">
                            <i class="fa fa-edit"></i> Edit Privacy Policy
                        </button>
                    </td>
                    @else 
                    <td>{{ $getPrivacyPolicy->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Term Of Service</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModalTermOfSevice">
                        <i class="fa fa-edit"></i> Edit Term Of service
                    </button>
                    </td>
                    @else 
                    <td>{{$getTermOfService->value }}</td>
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





  <!-- Modal About-->
  {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit About</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('AboutGeneralSetting') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="hidden" name="idabout" value="{{ $getAbout->id }}">
                  <input type="text" name="urlabout" placeholder="Url" class="form-control" value="{{$getAbout->value }}"><br>
                  <textarea name="contentabout" id="" class="form-control" cols="30" rows="10">{{ $client->get('about.txt') }}</textarea>
                  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
                  <script>
                    CKEDITOR.replace( 'contentabout' );
                  </script>
                </div>
              </div>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i> Save
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i> Cancel
            </button>
          </div>
           </div>
               </form> --}}

            <!-- Modal Privacy Policy-->
            <div class="modal fade" id="myModalPrivacyPolicy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Privacy Policy</h4>
                    <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      <i class="fa fa-remove"></i>
                    </button>
                  </div>
                  <form action="{{ route('AboutGeneralSetting') }}" method="post">
                    @csrf
                    <div class="modal-body">
              
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                              <input type="hidden" name="idprivacypolicy" value="{{ $getPrivacyPolicy->id }}">
                              <input type="text" name="urlprivacypolicy" placeholder="Url" class="form-control" value="{{ $getPrivacyPolicy->value }}"><br>
                              <textarea name="contentprivacypolicy" id="" class="form-control" cols="30" rows="27">{{ $client->get('privacy-policy.txt') }}</textarea>
                              <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
                                <script>
                                    CKEDITOR.replace( 'contentprivacypolicy' );
                                </script>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn sa-btn-primary submit-data">
                        <i class="fa fa-save"></i> Save
                      </button>
                      <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                        <i class="fa fa-remove"></i> Cancel
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- end create --}}

    <!-- Modal Term Of Service -->
    <div class="modal fade" id="myModalTermOfSevice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Term Of Service</h4>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="fa fa-remove"></i>
            </button>
          </div>
          <form action="{{ route('AboutGeneralSetting') }}" method="post">
            @csrf
            <div class="modal-body">
      
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                      <input type="hidden" name="idtermofservice" value="{{ $getTermOfService->id }}">
                      <input type="text" name="urltermofservice" placeholder="Url" class="form-control" value="{{$getTermOfService->value }}"><br>
                      <textarea name="contenttermofservice" id="" class="form-control" cols="30" rows="27">{{ $client->get('term-of-service.txt') }}</textarea>
                      <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
                        <script>
                          CKEDITOR.replace( 'contenttermofservice' );
                        </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn sa-btn-primary submit-data">
                <i class="fa fa-save"></i> Save
              </button>
              <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                <i class="fa fa-remove"></i> Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- end create --}}



      <!-- Modal About-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit About</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('AboutGeneralSetting') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="hidden" name="idabout" value="{{ $getAbout->id }}">
                  <input type="text" name="urlabout" placeholder="Url" class="form-control" value="{{$getAbout->value }}"><br>
                  <textarea name="contentabout" id="" class="form-control" cols="30" rows="10">{{ $client->get('about.txt') }}</textarea>
                  <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
                  <script>
                      CKEDITOR.replace( 'contentabout' );
                  </script>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i> Save
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i> Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


    

  
<script>

  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
    });
  });

  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
    "autoWidth" : true,
    "paging": false,
    "classes": {
      "sWrapper": "dataTables_wrapper dt-bootstrap4"
    },
    "oLanguage": {
      "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },
    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.inlineSetting').editable({
            mode :'inline',
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            }
        });

      $('.popUpSetting').editable({
        mode: 'inline',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
        source: [
          @php
          echo '{value: "'.$maintenaceonoff[0].'", text: "'.$maintenaceonoff[1].'"},';
          echo '{value: "'.$maintenaceonoff[2].'", text: "'.$maintenaceonoff[3].'"}';
          @endphp
        ]
      });
     
    },
    responsive: false
  });

</script>
@endsection