@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Admin</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Role Admin</a></li>
@endsection

@section('content')
@if($menu && $mainmenuaccess)
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
          <div class="widget-header">	
            <h2><strong><i class="fa fa-list"></i> Role Admin</strong></h2>				
          </div>
        </header>
        
        <div>
          
          <div class="jarviswidget-editbox">            
          </div>
          
          <div class="widget-body">
            
            <div class="custom-scroll table-responsive" style="height:800px;">
              
              <div class="table-outer">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th width="30%">Main Menu</th>
                        <th width="70%">Sub Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($mainmenu as $mnmnu)   
                      @if($mnmnu->name !== 'Version Asset Apk' &&  $mnmnu->role_id !== 11 && $mnmnu->role_id !== 29)            
                        <tr>
                          <td><a href="#" class="mainmenu{{ $mnmnu->menu_id }}" style="text-decoration:underline;">{{ translate_menu($mnmnu->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                          <td>
                            <div class="namedetail{{ $mnmnu->menu_id }}" style="color:red;">Detail3 ... <i class="fa fa-hand-o-down"></i></div>
                            <!-- sub menu pertama -->
                            @if (!$mnmnu['rolemenu']->isEMPTY())
                              <table width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display:none; border:1px solid #dee2e6;">
                                  <tr style="background-color:#f5f5f5;">
                                    <td width="30%"><b>Menu Name</b></td>
                                    <td width="70%"><b>Type</b></td>
                                  </tr>
                                  <tr>
                                    <td>{{ translate_menu($mnmnu->name) }}</td>
                                    <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($mnmnu->type)) }}</a></td>
                                  </tr>
                                  @foreach($mnmnu['rolemenu'] as $sbmnu)
                                    @if ($sbmnu->role_id == $mnmnu->role_id)
                                      @if (!$sbmnu['rolemenu']->isEMPTY())
                                        <tr>
                                          <td><a href="" class="submenut{{ $sbmnu->menu_id }}" style="text-decoration:underline;">{{ translate_menu($sbmnu->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                                          <td>
                                            <div class="namedetailsub{{ $sbmnu->menu_id }}" style="color:red;">Detail4 ... <i class="fa fa-hand-o-down"></i></div>
                                            
                                            <!-- ======================= sub menu kedua ============================= -->
                                            <table width="100%" class="submenusub{{ $sbmnu->menu_id}}" style="border:1px solid #dee2e6;">
                                              <tr style="background-color:#f5f5f5;">
                                                <td>Menu Name</td>
                                                <td >Type</td>
                                              </tr>
                                              <tr>
                                                <td>{{ translate_menu($sbmnu->name) }}</td>
                                                <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbmnu->type)) }}</a></td>
                                              </tr>
                                              @foreach ($sbmnu['rolemenu'] as $sbt)
                                                @if ($sbt->role_id == $sbmnu->role_id)
                                                  @if (!$sbt['rolemenu']->isEMPTY())
                                                    <tr>
                                                      <td><a href="" class="submenue{{ $sbt->menu_id }}" style="text-decoration:underline;">{{ translate_menu($sbt->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                                                      <td>
                                                        <div class="namedetailsube{{ $sbt->menu_id }}" style="color:red;">Detail4 ... <i class="fa fa-hand-o-down"></i></div>
                                            
                                                          <!-- ================= sub menu ketiga ================= -->
                                                          <table width="100%" class="submenusube{{ $sbt->menu_id}}" style="border:1px solid #dee2e6;">
                                                            <tr style="background-color:#f5f5f5;">
                                                              <td>Menu Name</td>
                                                              <td >Type</td>
                                                            </tr>  
                                                            <tr>
                                                              <td>{{ translate_menu($sbt->name) }}</td>
                                                              <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbt->type)) }}</a></td>
                                                            </tr>
                                                            @foreach ($sbt['rolemenu'] as $sbe)
                                                              @if ($sbe->role_id == $sbt->role_id)
                                                                <tr>
                                                                  <td>{{ translate_menu($sbe->name) }}tt</td>
                                                                  <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbe->type }}" data-pk="{{ $sbe->menu_id }}" data-url="{{ route('Role-menu-edit', $sbe->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbe->type)) }}</a></td>
                                                                </tr>                                 
                                                              @endif                            
                                                            @endforeach
                                                          </table> 
                                                          <!-- =================== end sub menu ketiga ================== --> 

                                                      </td>
                                                    </tr>
                                                  @else
                                                    <tr>
                                                      <td>{{ translate_menu($sbt->name) }}</td>
                                                      <td><a href="#" class="type" id="type" data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbt->type)) }}</a></td>
                                                    </tr>
                                                  @endif
                                                @endif
                                              @endforeach
                                            </table>
                                            <!-- =================== end submenu kedua ===================== -->

                                          </td>
                                        </tr>
                                      @else 
                                        <tr>
                                          <td>{{ translate_menu($sbmnu->name) }}</td>
                                          <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbmnu->type)) }}</a></td>
                                        </tr>
                                      @endif
                                    @endif
                                  @endforeach
                              </table>
                              <!-- =================== end sub menu pertama ==================================== -->
                            @else 
                              <table border="1" width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display:none; border:1px solid #dee2e6;">
                                  <tr style="background-color:#f5f5f5;">
                                    <td width="50%"><b>Menu Name</b></td>
                                    <td width="50%"><b>Type</b></td>
                                  </tr>
                                  <tr>
                                    <td>{{ translate_menu($mnmnu->name) }}</td>
                                    <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($mnmnu->type)) }}</a></td>
                                  </tr>
                              </table>
                            @endif
                          </td>
                        </tr>
                      @elseif ($role_op->role_id === 11 || $role_op->role_id === 29)
                        <tr>
                            <td><a href="#" class="mainmenu{{ $mnmnu->menu_id }}" style="text-decoration:underline;">{{ translate_menu($mnmnu->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                            <td>
                              <div class="namedetail{{ $mnmnu->menu_id }}" style="color:red;">Detail5 ... <i class="fa fa-hand-o-down"></i></div>

                              <!-- ======================= sub menu pertama ============================= -->
                              @if (!$mnmnu['rolemenu']->isEMPTY())
                                <table width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display:none; border:1px solid #dee2e6;">
                                    <tr style="background-color:#f5f5f5;">
                                      <td width="30%"><b>Menu Name</b></td>
                                      <td width="70%"><b>Type</b></td>
                                    </tr>
                                    <tr>
                                      <td>{{ translate_menu($mnmnu->name) }}hh</td>
                                      <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($mnmnu->type)) }}</a></td>
                                    </tr>
                                    @foreach($mnmnu['rolemenu'] as $sbmnu)
                                      @if ($sbmnu->role_id == $mnmnu->role_id)
                                        @if (!$sbmnu['rolemenu']->isEMPTY())
                                          <!-- sub menu ketiga -->
                                          <tr>
                                            <td><a href="" class="submenut{{ $sbmnu->menu_id }}" style="text-decoration:underline;">{{ translate_menu($sbmnu->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                                            <td>
                                              <div class="namedetailsub{{ $sbmnu->menu_id }}" style="color:red;">Detail1 ... <i class="fa fa-hand-o-down"></i></div>
                                              <!-- ======================= sub menu kedua ============================= -->
                                              <table width="100%" class="submenusub{{ $sbmnu->menu_id}}" style="border:1px solid #dee2e6;display:none;">
                                                <tr style="background-color:#f5f5f5;">
                                                  <td>Menu Name</td>
                                                  <td>Type</td>
                                                </tr>
                                                <tr>
                                                  <td>{{ translate_menu($sbmnu->name) }}ii</td>
                                                  <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbmnu->type)) }}</a></td>
                                                </tr>
                                                @foreach ($sbmnu['rolemenu'] as $sbt)
                                                  @if ($sbt->role_id == $sbmnu->role_id)
                                                    @if (!$sbt['rolemenu']->isEMPTY())
                                                      <tr>
                                                        <td><a href="" class="submenue{{ $sbt->menu_id }}" style="text-decoration:underline;">{{ translate_menu($sbt->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                                                        <td>
                                                          <div class="namedetailsube{{ $sbt->menu_id }}" style="color:red;">Detail4 ... <i class="fa fa-hand-o-down"></i></div>
                                              
                                                            <!-- ================= sub menu ketiga ================= -->
                                                            <table width="100%" class="submenusube{{ $sbt->menu_id}}" style="border:1px solid #dee2e6;">
                                                              <tr style="background-color:#f5f5f5;">
                                                                <td>Menu Name</td>
                                                                <td >Type</td>
                                                              </tr>  
                                                              <tr>
                                                                <td>{{ translate_menu($sbt->name) }}</td>
                                                                <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbt->type)) }}</a></td>
                                                              </tr>
                                                              @foreach ($sbt['rolemenu'] as $sbe)
                                                                @if ($sbe->role_id == $sbt->role_id)
                                                                  <tr>
                                                                    <td>{{ translate_menu($sbe->name) }}tt</td>
                                                                    <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbe->type }}" data-pk="{{ $sbe->menu_id }}" data-url="{{ route('Role-menu-edit', $sbe->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbe->type)) }}</a></td>
                                                                  </tr>                                 
                                                                @endif                            
                                                              @endforeach
                                                            </table> 
                                                            <!-- =================== end sub menu ketiga ================== --> 

                                                        </td>
                                                      </tr>
                                                    @else
                                                      <tr>
                                                        <td>{{ translate_menu($sbt->name) }}aa</td>
                                                        <td><a href="#" class="type" id="type" data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbt->type)) }}</a></td>
                                                      </tr>
                                                    @endif
                                                  @endif
                                                @endforeach
                                              </table>
                                              <!-- ======================= End sub menu kedua ============================= -->
                                            </td>
                                          </tr>
                                        @else 
                                          <tr>
                                            <td>{{ translate_menu($sbmnu->name) }}MM</td>
                                            <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbmnu->type)) }}</a></td>
                                          </tr>
                                        @endif
                                      @endif
                                    @endforeach
                                </table>
                              @else 
                                <table border="1" width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display:none; border:1px solid #dee2e6;">
                                    <tr style="background-color:#f5f5f5;">
                                      <td width="50%"><b>Menu Name</b></td>
                                      <td width="50%"><b>Type</b></td>
                                    </tr>
                                    <tr>
                                      <td>{{ translate_menu($mnmnu->name) }}</td>
                                      <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($mnmnu->type)) }}</a></td>
                                    </tr>
                                </table>
                              @endif
                              <!-- ======================= End sub menu pertama ============================= -->
                            </td>
                        </tr>
                      @elseif($mnmnu->role_id === 11 || $mnmnu->role_id === 29)
                        <tr>
                            <td><a href="#" class="mainmenu{{ $mnmnu->menu_id }}" style="text-decoration:underline;">{{ translate_menu($mnmnu->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                            <td>
                              <div class="namedetail{{ $mnmnu->menu_id }}" style="color:red;">Detail6 ... <i class="fa fa-hand-o-down"></i></div>
                              <!-- ======================= sub menu pertama ============================= -->
                              @if (!$mnmnu['rolemenu']->isEMPTY())
                                <table width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display: none; border:1px solid #dee2e6;">
                                    <tr style="background-color:#f5f5f5;">
                                      <td width="50%"><b>Menu Name</b></td>
                                      <td width="50%"><b>Type</b></td>
                                    </tr>
                                    <tr>
                                      <td>{{ translate_menu($mnmnu->name) }}</td>
                                      <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($mnmnu->type)) }}</a></td>
                                    </tr>
                                    @foreach($mnmnu['rolemenu'] as $sbmnu)
                                      @if ($sbmnu->role_id == $mnmnu->role_id)
                                        @if (!$sbmnu['rolemenu']->isEMPTY())
                                          <tr>
                                            <td><a href="" class="submenut{{ $sbmnu->menu_id }}" style="text-decoration:underline;">{{ translate_menu($sbmnu->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                                            <td>
                                              <div class="namedetailsub{{ $sbmnu->menu_id }}" style="color:red;">Detail7 ... <i class="fa fa-hand-o-down"></i></div>
                                              <!-- ======================= sub menu kedua ============================= -->
                                              <table width="100%" class="submenusub{{ $sbmnu->menu_id}}" style="border:1px solid #dee2e6;">
                                                <tr style="background-color:#f5f5f5;">
                                                  <td>Menu Name</td>
                                                  <td>Type</td>
                                                </tr>
                                                <tr>
                                                  <td>{{ translate_menu($sbmnu->name) }}</td>
                                                  <td><a href="#" class="type" id="type" data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbmnu->type)) }}</a></td>
                                                </tr>
                                                @foreach ($sbmnu['rolemenu'] as $sbt)
                                                  @if ($sbt->role_id == $sbmnu->role_id)
                                                    @if (!$sbt['rolemenu']->isEMPTY())
                                                      <tr>
                                                        <td><a href="" class="submenue{{ $sbt->menu_id }}" style="text-decoration:underline;">{{ translate_menu($sbt->name) }} <i class="fa fa-hand-o-right"></i></a></td>
                                                        <td>
                                                          <div class="namedetailsube{{ $sbt->menu_id }}" style="color:red;">Detail4 ... <i class="fa fa-hand-o-down"></i></div>
                                              
                                                            <!-- ================= sub menu ketiga ================= -->
                                                            <table width="100%" class="submenusube{{ $sbt->menu_id}}" style="border:1px solid #dee2e6;">
                                                              <tr style="background-color:#f5f5f5;">
                                                                <td>Menu Name</td>
                                                                <td >Type</td>
                                                              </tr>  
                                                              <tr>
                                                                <td>{{ translate_menu($sbt->name) }}</td>
                                                                <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbt->type)) }}</a></td>
                                                              </tr>
                                                              @foreach ($sbt['rolemenu'] as $sbe)
                                                                @if ($sbe->role_id == $sbt->role_id)
                                                                  <tr>
                                                                    <td>{{ translate_menu($sbe->name) }}tt</td>
                                                                    <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbe->type }}" data-pk="{{ $sbe->menu_id }}" data-url="{{ route('Role-menu-edit', $sbe->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbe->type)) }}</a></td>
                                                                  </tr>                                 
                                                                @endif                            
                                                              @endforeach
                                                            </table> 
                                                            <!-- =================== end sub menu ketiga ================== --> 

                                                        </td>
                                                      </tr>
                                                    @else
                                                      <tr>
                                                        <td>{{ translate_menu($sbt->name) }}aa</td>
                                                        <td><a href="#" class="type" id="type" data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbt->type)) }}</a></td>
                                                      </tr>
                                                    @endif
                                                  @endif
                                                @endforeach
                                              </table>
                                              <!-- ======================= End sub menu kedua ============================= -->
                                            </td>
                                          </tr>
                                        @else 
                                          <tr>
                                            <td>{{ translate_menu($sbmnu->name) }}</td>
                                            <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($sbmnu->type)) }}</a></td>
                                          </tr>
                                        @endif
                                      @endif
                                    @endforeach
                                </table>
                              @else 
                                <table border="1" width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display:none; border:1px solid #dee2e6;">
                                    <tr style="background-color:#f5f5f5;">
                                      <td width="50%"><b>Menu Name</b></td>
                                      <td width="50%"><b>Type</b></td>
                                    </tr>
                                    <tr>
                                      <td>{{ translate_menu($mnmnu->name) }}</td>
                                      <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ ConfigTextTranslate(strMenuType($mnmnu->type)) }}</a></td>
                                    </tr>
                                </table>
                              @endif
                              <!-- ======================= End sub menu pertama ============================= -->
                            </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            
            </div>
          
          </div>
        </div>
        
    </div>


    <script type="text/javascript">
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
          });

          $('.type').editable({
            mode: 'inline',
            value: '',
            source: [
                {value: '', text: 'Choose for role type'},
                @php
                echo '{value: "'.$type[0].'", text: "'.ConfigTextTranslate($type[1]).'"},';
                echo '{value: "'.$type[2].'", text: "'.ConfigTextTranslate($type[3]).'"},';
                echo '{value: "'.$type[4].'", text: "'.ConfigTextTranslate($type[5]).'"}';
                @endphp
            ],
            validate: function(value) {
              if($.trim(value) == '' ) {
                return 'This field is required';
              }
            }
          });
              @php

                // submenu satu
                foreach($mainmenu as $mnu) {
                  echo'$(".namedetail'.$mnu->menu_id.'").show();';
                  echo'$(".mainmenu'.$mnu->menu_id.'").on("click", function(e) {';
                      echo'$(".submenu'.$mnu->menu_id.'").toggle();';
                      echo'$(".namedetail'.$mnu->menu_id.'").toggle();';
                      echo'e.preventDefault();';
                  echo '});';

                  // submenu kedua
                  foreach($mnu['rolemenu'] as $sbmenu) {
                    echo'$(".namedetailsub'.$sbmenu->menu_id.'").show();';
                    echo'$(".submenusub'.$sbmenu->menu_id.'").toggle();';
                    echo'$(".submenut'.$sbmenu->menu_id.'").on("click", function(e) {';
                      echo'$(".submenusub'.$sbmenu->menu_id.'").toggle();';
                      echo'$(".namedetailsub'.$sbmenu->menu_id.'").toggle();';
                      echo'e.preventDefault();';
                    echo '});';

                    // submenu ketiga
                    foreach($sbmenu['rolemenu'] as $sbmenut) {
                      echo'$(".namedetailsube'.$sbmenut->menu_id.'").show();';
                      echo'$(".submenusube'.$sbmenut->menu_id.'").toggle();';
                      echo'$(".submenue'.$sbmenut->menu_id.'").on("click", function(e) {';
                        echo'$(".submenusube'.$sbmenut->menu_id.'").toggle();';
                        echo'$(".namedetailsube'.$sbmenut->menu_id.'").toggle();';
                        echo'e.preventDefault();';
                      echo '});';
                    }
                  }
                }
              @endphp
      
          $(document).ready(function() {
            $('table.table').dataTable( {
              "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
              "pagingType": "full_numbers",
              "searching": false,
            });
          });

          table = $('table.table').dataTable({
            "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
            "paging": false,
            "autoWidth" : true,
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
                
          },
            responsive: false
          });
    </script>
@endif
@endsection