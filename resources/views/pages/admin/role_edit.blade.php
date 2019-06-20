@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Role_Admin') }}">Role Admin</a></li>
@endsection

@section('content')
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">

        <header>
            <div class="widget-header">	
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Role Menu</strong></h2>				
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
    <!-- end widget -->


    <script type="text/javascript">
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              // $.fn.editable.defaults.mode = 'inline';


          $('.type').editable({
            mode: 'inline',
            value: 0,
            source: [
                {value: 0, text: 'The Menu Can\'t be Accessed and can\'t be edited '},
                {value: 1, text: 'The Menu Can be Accessed and can\'t be edited '},
                {value: 2, text: 'The Menu Can be Accessed and edited '}
               ]
          });
        </script>
@endsection