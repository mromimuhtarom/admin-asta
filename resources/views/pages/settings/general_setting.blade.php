@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">{{ translate_menu('L_SETTINGS') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">{{ translate_menu('L_GENERAL_SETTING') }}</a></li>
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
          <h2><strong>{{ TranslateGeneralSettings('System settings') }}</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">{{ TranslateMenuGame('L_NAME') }}</th>
                    <th class="th-sm">{{ translate_menu('L_SETTINGS') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Maintenance') }}</td>
                    @if($menu && $mainmenu)
                    <td><a href="#" class="popUpSetting" data-title="Maintenance" data-name="value" data-value="{{ $getMaintenance->value }}" data-pk="{{ $getMaintenance->id }}" data-type="select" data-url="{{ route('GeneralSetting-update') }}">{{ $getMaintenance->strmaintenance() }}</a></td>
                    @else 
                    <td>{{ strMaintenanceOnOff($getMaintenance->value) }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Point expired') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $getPointExpired->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ $getPointExpired->value }}</a><span>({{ TranslateGeneralSettings('days')}})</span>
                    </td>
                    @else
                    <td>{{ $getPointExpired->value }} ({{ TranslateGeneralSettings('days')}})</td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Award Signup') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_signup->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ number_format($award_signup->value, 2) }}</a>
                    </td>
                    @else
                    <td>{{ number_format($award_signup->value, 2) }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Award Signup Guest') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_signup_guest->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ number_format($award_signup_guest->value, 2) }}</a>
                    </td>
                    @else
                    <td>{{ number_format($award_signup_guest->value, 2) }} </td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Award Daily Chips') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_chips->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ number_format($award_daily_chips->value, 2) }}</a>
                    </td>
                    @else
                    <td>{{ number_format($award_daily_chips->value, 2) }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Award Daily Chips Guest') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_chips_guest->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ number_format($award_daily_chips_guest->value, 2) }}</a>
                    </td>
                    @else
                    <td>{{ number_format($award_daily_chips_guest->value, 2) }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Award Daily Days') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_days->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ number_format($award_daily_days->value, 2) }}</a>
                    </td>
                    @else
                    <td>{{ number_format($award_daily_days->value, 2) }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>{{ TranslateGeneralSettings('Award Daily Multiply') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <a href="#" class="inlineSetting" data-title="Point Expired" data-name="value" data-pk="{{ $award_daily_multiply->id }}" data-type="number" data-url="{{ route('GeneralSetting-update')}}">{{ number_format($award_daily_multiply->value, 2) }}</a>
                    </td>
                    @else
                    <td>{{ number_format($award_daily_multiply->value, 2) }}</td>
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
          <h2><strong>{{ TranslateGeneralSettings('Bank Settings') }}</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">{{ translateMenuGame('L_NAME') }}</th>
                    <th class="th-sm">{{ translate_menu('L_SETTINGS') }}</th>
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
          <h2><strong>{{ TranslateGeneralSettings('Info Settings') }}</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">{{ translateMenuGame('L_NAME') }}</th>
                    <th class="th-sm">{{ translate_menu('L_SETTINGS') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ TranslateGeneralSettings('About') }}</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit About') }}
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
                  <tr>
                    <td>Asta</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModalAstaPoker">
                        <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Asta Poker') }}
                      </button>
                    </td>
                    @else 
                    <td>{{ $getPokerWeb->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Big Two</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModalBigTwo">
                        <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Big Two') }}
                      </button>
                    </td>
                    @else 
                    <td>{{ $getPokerWeb->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Domino QQ</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModalQQ">
                        <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Domino QQ') }}
                      </button>
                    </td>
                    @else 
                    <td>{{ $getPokerWeb->value }}</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Domino Susun</td>
                    @if($menu && $mainmenu)
                    <td>
                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModalSusun">
                        <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Domino Susun') }}
                      </button>
                    </td>
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
          <h2><strong>{{ TranslateGeneralSettings('CS & Legal Settings') }}</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="th-sm">{{ translateMenuGame('L_NAME') }}</th>
                    <th class="th-sm">{{ translate_menu('L_SETTINGS') }}</th>
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
                          <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit privacy & policy')}}
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
                        <i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Term of Service')}}
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


  <!-- Modal Asta Poker-->
  <div class="modal fade" id="myModalAstaPoker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Asta Poker') }}</h4>
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
                    <input type="hidden" name="idastapoker" value="{{ $getPrivacyPolicy->id }}">
                    <input type="text" name="urlastapoker" placeholder="Url" class="form-control" value="{{ $getPrivacyPolicy->value }}"><br>
                    <textarea name="contentastapoker" id="" class="form-control" cols="30" rows="27">{{ tagsEnabler($client->get('unity-asset/text_file/asta-poker.txt')) }}</textarea>
                    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
                      <script>
                          CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                          CKEDITOR.replace( 'contentastapoker', {
                            extraPlugins:'bbcode',
                            removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                            fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                            toolbar: [
                              [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                              [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                              [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                              '/',
                              [ 'Bold', 'Italic', 'Underline' ],
                              [ 'FontSize' ],
                              [ 'TextColor' ], 
                              [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                              [ 'Maximize' ]
                            ]
                          });
                          CKEDITOR.config.autoParagraph = false;
                          CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                      </script>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end create --}}



  <!-- Modal Big Two -->
  <div class="modal fade" id="myModalBigTwo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Big Two') }}</h4>
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
                    <input type="hidden" name="idbigtwo" value="{{ $getPrivacyPolicy->id }}">
                    <input type="text" name="urlbigtwo" placeholder="Url" class="form-control" value="{{ $getPrivacyPolicy->value }}"><br>
                    <textarea name="contentbigtwo" id="" class="form-control" cols="30" rows="27">{{ tagsEnabler($client->get('unity-asset/text_file/bigtwo.txt')) }}</textarea>
                    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
                      <script>
                          CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                          CKEDITOR.replace( 'contentbigtwo', {
                            extraPlugins:'bbcode',
                            removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                            fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                            toolbar: [
                              [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                              [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                              [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                              '/',
                              [ 'Bold', 'Italic', 'Underline' ],
                              [ 'FontSize' ],
                              [ 'TextColor' ], 
                              [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                              [ 'Maximize' ]
                            ]
                          });
                          CKEDITOR.config.autoParagraph = false;
                          CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                      </script>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end create --}}


  <!-- Modal Domino QQ -->
  <div class="modal fade" id="myModalQQ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Domino QQ') }}</h4>
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
                    <input type="hidden" name="iddominoQQ" value="{{ $getPrivacyPolicy->id }}">
                    <input type="text" name="urldominoQQ" placeholder="Url" class="form-control" value="{{ $getPrivacyPolicy->value }}"><br>
                    <textarea name="contentdominoQQ" id="" class="form-control" cols="30" rows="27">{{ tagsEnabler($client->get('unity-asset/text_file/dominoQQ.txt')) }}</textarea>
                    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
                      <script>
                          CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                          CKEDITOR.replace( 'contentdominoQQ', {
                            extraPlugins:'bbcode',
                            removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                            fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                            toolbar: [
                              [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                              [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                              [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                              '/',
                              [ 'Bold', 'Italic', 'Underline' ],
                              [ 'FontSize' ],
                              [ 'TextColor' ], 
                              [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                              [ 'Maximize' ]
                            ]
                          });
                          CKEDITOR.config.autoParagraph = false;
                          CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                      </script>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end create --}}


  <!-- Modal Domino Susun -->
  <div class="modal fade" id="myModalSusun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Domino Susun') }}</h4>
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
                    <input type="hidden" name="iddominosusun" value="{{ $getPrivacyPolicy->id }}">
                    <input type="text" name="urldominosusun" placeholder="Url" class="form-control" value="{{ $getPrivacyPolicy->value }}"><br>
                    <textarea name="contentdominosusun" id="" class="form-control" cols="30" rows="27">{{ tagsEnabler($client->get('unity-asset/text_file/dominosusun.txt')) }}</textarea>
                    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
                      <script>
                          CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                          CKEDITOR.replace( 'contentdominosusun', {
                            extraPlugins:'bbcode',
                            removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                            fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                            toolbar: [
                              [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                              [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                              [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                              '/',
                              [ 'Bold', 'Italic', 'Underline' ],
                              [ 'FontSize' ],
                              [ 'TextColor' ], 
                              [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                              [ 'Maximize' ]
                            ]
                          });
                          CKEDITOR.config.autoParagraph = false;
                          CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                      </script>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end create --}}


    
  <!-- Modal Privacy Policy-->
  <div class="modal fade" id="myModalPrivacyPolicy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit privacy & policy') }}</h4>
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
                    <textarea name="contentprivacypolicy" id="" class="form-control" cols="30" rows="27">{{ tagsEnabler($client->get('unity-asset/text_file/privacy-policy.txt')) }}</textarea>
                    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
                      <script>
                          CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                          CKEDITOR.replace( 'contentprivacypolicy', {
                            extraPlugins:'bbcode',
                            removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                            fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                            toolbar: [
                              [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                              [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                              [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                              '/',
                              [ 'Bold', 'Italic', 'Underline' ],
                              [ 'FontSize' ],
                              [ 'TextColor' ], 
                              [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                              [ 'Maximize' ]
                            ]
                          });
                          CKEDITOR.config.autoParagraph = false;
                          CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                      </script>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
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
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit Term of Service') }}</h4>
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
                      <input type="text" name="urltermofservice" placeholder="Url" class="form-control" val ue="{{ $getTermOfService->value }}"><br>
                      <textarea name="contenttermofservice" id="" class="form-control" cols="30" rows="27">{{ tagsEnabler($client->get('unity-asset/text_file/term-of-service.txt')) }}</textarea>
                      <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
                        <script>
                          CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                          CKEDITOR.replace( 'contenttermofservice', {
                            extraPlugins:'bbcode',
                              removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                              fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                              toolbar: [
                                [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                                [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                                [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                                '/',
                                [ 'Bold', 'Italic', 'Underline' ],
                                [ 'FontSize' ],
                                [ 'TextColor' ],
                                [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                                [ 'Maximize' ]
                              ]
                          } );
                          CKEDITOR.config.autoParagraph = false;
                          CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                        </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn sa-btn-primary submit-data">
                <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
              </button>
              <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
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
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>{{ TranslateGeneralSettings('Edit About') }}</h4>
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
                  <textarea name="contentabout" id="aboutasta" class="form-control" cols="30" rows="10">{{ tagsEnabler($client->get('unity-asset/text_file/about.txt')) }}</textarea>
                  <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/standard/ckeditor.js"></script>
                  <script>
                      CKEDITOR.plugins.addExternal('bbcode', '/ckeditor/plugins/bbcode/plugin.js');
                      CKEDITOR.replace( 'contentabout', {
                        extraPlugins:'bbcode',
                        removePlugins: 'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                        fontSize_sizes: "8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px",
                        toolbar: [
                          [ 'Source', '-', 'Save', 'NewPage', '-', 'Undo', 'Redo' ],
                          [ 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat' ],
                          [ 'Link', 'Unlink', 'Image', 'Smiley', 'SpecialChar' ],
                          '/',
                          [ 'Bold', 'Italic', 'Underline' ],
                          [ 'FontSize' ],
                          [ 'TextColor' ],
                          [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ],
                          [ 'Maximize' ]
                        ]
                      });
                      CKEDITOR.config.autoParagraph = false;
                      CKEDITOR.config.coreStyles_bold = { element: 'b', overrides: 'strong' };
                      CKEDITOR.config.coreStyles_italic = { element: 'i'};
                      // CKEDITOR.config.colorButton_foreStyle = { 
                      //   element: 'color', 
                      //   styles: {'color': '#(color)'}
                      //   };
                      // CKEDITOR.config.fontSize_style = {
                      //     element:        'size',
                      //     styles:         { 'font-size': '#(size)' }
                      // };
                      // CKEDITOR.config.extraPlugins = 'bbcode';
                      // CKEDITOR.config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';
                  </script>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary submit-data">
              <i class="fa fa-save"></i>{{ TranslateMenuItem('Save') }}
            </button>
            <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
              <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel') }}
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