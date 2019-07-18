@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Role Admin</a></li>
@endsection

@section('content')
@if($menu)
<!-- Widget ID (each widget will need unique ID)-->
{{-- <div class="jarviswidget jarviswidget-color-darken" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">

        <header>
            <div class="widget-header">	
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong><i class="fa fa-list"></i> Role Menu</strong></h2>				
            </div>
        </header>

        <!-- widget div-->
        <div>
            
            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->
            
            <!-- widget content -->
            <div class="widget-body">
                    @foreach(array_chunk($roles, 2) as $chunk)
                    <table border="0" align="center" width="1680px">

                        <tr>

                          @foreach($chunk as $c )
                          <td width="600px" rowspan="22">
                            <table border="1">
                              <tr>
                                <td height="30px" width="200px">
                                  <font color="black">{{ ucFirst($c->name) }}</font>
                                </td>
                                <td height="30px" width="500px">
                                  <a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $c->type }}" data-pk="{{ $c->menu_id }}" data-url="{{ route('Role-menu-edit', $c->role_id) }}">{{ strMenuType($c->type) }}</a>
                                </td>
                              </tr>
                            </table>
                          </td>
                          
                          <td width="100px;"></td>
                          @endforeach

                        </tr>
                      </table>
                      @endforeach
                      

                
            </div>
            <!-- end widget content -->
            
        </div>
        <!-- end widget div -->
        
    </div>
    <!-- end widget --> --}}
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
            <div class="widget-body-toolbar">
              
              <div class="row">
                
                <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
                  
                  {{-- <button class="btn sa-btn-success">
                    <i onclick="addBots()" class="fa fa-plus"></i> <span class="hidden-mobile">Add New Row</span>
                  </button> --}}
                  
                </div>
                
              </div>
              
                
        
            </div>
            
            <div class="custom-scroll table-responsive" style="height:800px;">
              
              <div class="table-outer">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>Main Menu</th>
                        <th>Sub Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($mainmenu as $mnmnu)                
                    <tr>
                      <td><a href="#" class="mainmenu{{ $mnmnu->menu_id }}">{{ $mnmnu->name }}</a></td>
                      <td>
                        <div class="namedetail{{ $mnmnu->menu_id }}">Detail ...</div>
                        @if (!$mnmnu['rolemenu']->isEMPTY())
                        <table border="1" width="100%" class="submenu{{ $mnmnu->menu_id }}" style="display:none;">
                            <tr>
                              <td width="50%"><b>Menu Name</b></td>
                              <td width="50%"><b>Type</b></td>
                            </tr>
                            <tr>
                              <td>{{ $mnmnu->name }}</td>
                              <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ strMenuType($mnmnu->type) }}</a></td>
                            </tr>
                            @foreach($mnmnu['rolemenu'] as $sbmnu)
                            @if (!$sbmnu['rolemenu']->isEMPTY())
                              <tr>
                                <td><a href="" class="submenut{{ $sbmnu->menu_id }}">{{ $sbmnu->name }}</a></td>
                                <td>
                                  <div class="namedetailsub{{ $sbmnu->menu_id }}">Detail ...</div>
                                  <table border="1" width="100%" class="submenusub{{ $sbmnu->menu_id}}">
                                    <tr>
                                      <td>Menu Name</td>
                                      <td>Type</td>
                                      <tr>
                                        <td>{{ $sbmnu->name }}</td>
                                        <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ strMenuType($sbmnu->type) }}</a></td>
                                      </tr>
                                    </tr>
                                    @foreach ($sbmnu['rolemenu'] as $sbt)
                                      <tr>
                                        <td>{{ $sbt->name }}</td>
                                        <td><a href="#" class="type" id="type" data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbt->type }}" data-pk="{{ $sbt->menu_id }}" data-url="{{ route('Role-menu-edit', $sbt->role_id) }}">{{ strMenuType($sbt->type) }}</a></td>
                                      </tr>
                                    @endforeach
                                  </table>
                                </td>
                              </tr>
                            @else 
                              <tr>
                                <td>{{ $sbmnu->name }}</td>
                                <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $sbmnu->type }}" data-pk="{{ $sbmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $sbmnu->role_id) }}">{{ strMenuType($sbmnu->type) }}</a></td>
                              </tr>
                            @endif

                            @endforeach
                        </table>
                        @else 
                        <table border="1" width="50%" class="submenu{{ $mnmnu->menu_id }}" style="display:none;">
                            <tr>
                              <td width="50%"><b>Menu Name</b></td>
                              <td width="50%"><b>Type</b></td>
                            </tr>
                            <tr>
                              <td>{{ $mnmnu->name }}</td>
                              <td><a href="#" class="type" id="type"  data-title="Select Role Type" data-name="type" data-type="select" data-value="{{ $mnmnu->type }}" data-pk="{{ $mnmnu->menu_id }}" data-url="{{ route('Role-menu-edit', $mnmnu->role_id) }}">{{ strMenuType($mnmnu->type) }}</a></td>
                            </tr>
                        </table>
                        @endif
                      </td>
                    </tr>
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
              // $.fn.editable.defaults.mode = 'inline';
              @php
                foreach($mainmenu as $mnu) {
                  echo'$(".namedetail'.$mnu->menu_id.'").show();';
                  echo'$(".mainmenu'.$mnu->menu_id.'").on("click", function(e) {';
                      echo'$(".submenu'.$mnu->menu_id.'").toggle();';
                      echo'$(".namedetail'.$mnu->menu_id.'").toggle();';
                      echo'e.preventDefault();';
                  echo '});';

                  foreach($mnu['rolemenu'] as $sbmenu) {
                    echo'$(".namedetailsub'.$sbmenu->menu_id.'").show();';
                    echo'$(".submenusub'.$sbmenu->menu_id.'").toggle();';
                    echo'$(".submenut'.$sbmenu->menu_id.'").on("click", function(e) {';
                      echo'$(".submenusub'.$sbmenu->menu_id.'").toggle();';
                      echo'$(".namedetailsub'.$sbmenu->menu_id.'").toggle();';
                      echo'e.preventDefault();';
                    echo '});';
                  }
                }
              @endphp

          $('.type').editable({
            value: '',
            mode: 'inline',
            source: [
                {value:'', text: 'Choose for role type'},
                @php
                echo '{value: "'.$type[0].'", text: "'.$type[1].'"},';
                echo '{value: "'.$type[2].'", text: "'.$type[3].'"},';
                echo '{value: "'.$type[4].'", text: "'.$type[5].'"}';
                @endphp
               ]
          });
      
          $(document).ready(function() {
            $('table.table').dataTable( {
              "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
              "pagingType": "full_numbers",
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
            responsive: true
          });
    </script>
@endif
@endsection