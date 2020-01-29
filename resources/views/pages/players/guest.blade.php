@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Guest') }}">{{ Translate_menuPlayers('Players') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Guest') }}">{{ Translate_menuPlayers('Guest') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!----------- Warning Alert ---------->
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
@if (count($errors) > 0)
<div class="error-val">
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>
</div>
@endif
<!--------End Warning Alert ---------->

<!---- Content Search ---->
    <div class="searchguest bg-blue-dark" style="margin-bottom:3%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Guest-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                  @if (Request::is('Players/Guest/Guest-search*'))
                    <div class="col">
                      <input type="text" id="username" class="left" name="inputPlayer" placeholder="username" value="{{ $username }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select id="status" name="inputStatus" class="form-control" required>
                            <option value="">{{ Translate_menuPlayers('Choose status') }}</option>
                            <option value="used" @if($status == 'used') selected @endif;>{{ Translate_menuPlayers('Used') }}</option>
                            <option value="nonused" @if($status == 'nonused') selected @endif;>{{ Translate_menuPlayers('Non used') }}</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                  @else 
                    <div class="col">
                        <input type="text" id="username" class="left" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select id="status" name="inputStatus" class="form-control" required>
                            <option value="">{{ Translate_menuPlayers('Choose status') }}</option>
                            <option value="used">{{ Translate_menuPlayers('Used') }}</option>
                            <option value="nonused">{{ Translate_menuPlayers('Non used') }}</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                  @endif;
                </div>
            </form>
        </div>
    </div> 
<!---- End Content Search ----->

<!-----Show After Search ----->
@if (Request::is('Players/Guest/Guest-search*'))
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
        <header>
          <div class="widget-header">	
            <span class="widget-icon"> <i class="fa fa-group"></i> </span>
            <h2>{{ Translate_menuPlayers('Guest') }} </h2>
          </div>
  
          <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
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
          <div class="widget-body p-0">
              <div class="widget-body-toolbar">
        
                  <div class="row">
                    
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group">
                        @if($menu && $mainmenu)
                        <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus"></i> {{ Translate_menuPlayers('Create user guest ID') }}
                        </button>
                        @endif
                      </div>
                    </div>
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
                </div>
            
            <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
              
              <thead>
                <tr>
                    <th>{{ Translate_menuPlayers('Guest ID') }}</th>
                    <th>{{ Translate_menuPlayers('Player ID') }}</th>
                    @if($status == 'used')
                    <th class="th-sm">{{ Translate_menuPlayers('Username') }}</th>
                    @endiF
                    <th class="th-sm">{{ Translate_menuPlayers('Device ID') }}</th>
                    <th>{{ Translate_menuPlayers('Device Timer') }}</th>
                    <th>{{ Translate_menuPlayers('Status') }}</th>
                </tr>
              </thead>
              <tbody>
                    @foreach($guests as $gs)
                    <tr>
                      <td>{{ $gs->guest_id }}</td>
                      <td>{{ $gs->user_id }}</td>
                      @if($status == 'used')
                     <td>{{ $gs->username }}</td>
                     @endif
                     @if ($gs->device_key == NULL)
                    <td>{{ "Device is Not Connected"}}</td>
                    @else
                    <td>{{ $gs->device_key }}</td>
                    @endif
                    <td>{{ $gs->expired_date }}</td>
                    <td>{{ $gs->status }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{-- info --}}
             <div class="widget-body-toolbar">
        
                  <div class="row">
                    
                    <!-- Button tambah bot baru -->
                    <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                      <div class="input-group" style="color: #969696;font-size: 1rem;font-weight: 700;font-style: italic;">
                      </div>
                    </div>
                    <!-- End Button tambah bot baru -->
          
                  </div>
          
             </div>
          {{-- end info --}}
          </div>
          <!-- end widget content -->
        </div>
        <!-- end widget div -->
        
  
      </div>


<!-- Modal Insert -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ Translate_menuPlayers('Create user guest ID') }}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('Guest-create') }}" method="post">
        @csrf
        <div class="modal-body">
  
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                  <input type="number" name="inputcount" placeholder="Number of inputs filled in Guest ID" class="form-control" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i> {{ Translate_menuPlayers('Save') }}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ Translate_menuPlayers('Cancel') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
 
  
<!-- End Modal Insert -->
<script>
    var responsiveHelper_datatable_col_reorder = responsiveHelper_datatable_col_reorder || undefined;
                  
    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };
    $('#datatable_col_reorder').dataTable({
        "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'f>r>"+
		        "t"+
		        "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
        "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
        "pagingType": "full_numbers",
        "order": [[ 3, "desc" ]],
        "autoWidth" : true,
        "classes": {
            "sWrapper":      "dataTables_wrapper dt-bootstrap4"
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
                  
        responsive: false
    });
</script>
@endif
<!------ End Show After Search ------->

<script>
    $('#username').prop('readonly', true);
    $('#username').prop('disabled', true);
    $('#mindate').prop('readonly', true);
    $('#mindate').prop('disabled', true);
    $('#maxdate').prop('readonly', true);
    $('#maxdate').prop('disabled', true);
    $('#status').click(function(e) {
        e.preventDefault();
        if($(this).val() == 'used') {
            $('#username').prop('readonly', false);
            $('#username').prop('disabled', false);
            $('#mindate').prop('readonly', false);
            $('#mindate').prop('disabled', false);
            @php 
            echo"$('#mindate').val('".$datenow->toDateString()."');";
            echo"$('#maxdate').val('".$datenow->toDateString()."');";
            @endphp
            $('#maxdate').prop('readonly', false);
            $('#maxdate').prop('disabled', false);
        } else if($(this).val() == 'nonused')
        {
            $('#username').prop('readonly', true);
            $('#username').prop('disabled', true);
            $('#username').val("");
            $('#mindate').prop('readonly', true);
            $('form input[type="date"]').prop("disabled", false);
            var minDate = $("#mindate").val("");
            var maxDate = $("#maxdate").val("");
            $('#maxdate').prop('readonly', true);
            
        } else 
        {
            $('#username').prop('readonly', true);
            $('#username').val("");
            $('#username').prop('disabled', true);
            $('#mindate').prop('readonly', true);
            $('#mindate').val("");
            $('#mindate').prop('disabled', true);
            $('#maxdate').prop('readonly', true);
            $('#maxdate').val("");
            $('#maxdate').prop('disabled', true);
        }
    });
</script>
@endsection