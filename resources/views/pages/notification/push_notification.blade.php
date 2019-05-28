@extends('index')


@section('sidebarmenu')
@include('menu.menunotification')    
@endsection


@section('content')


    
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all as $error)
            <li>{{$error}}</li>  
            @endforeach
        </ul>
    </div>
        
    @endif
    
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
        
    @endif




    {{-- <div class="table-aii">
        <div class="footer-table">
                            <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                                <i class="fas fa-plus-circle"></i>Create Push Notification
                            </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Message</th>
                <th class="th-sm">Game</th>
                <th class="th-sm">Type</th>
                <th class="th-sm">Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                <tr>
                    <td></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->title }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->message }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>

    <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });  
      });

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
  </script> --}}
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Push Notification</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        <form action="{{ route('PushNotification-create') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Bot Name" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn sa-btn-primary">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


  {{-- <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
      <header>
        <div class="widget-header">	
          <span class="widget-icon"> <i class="fa fa-table"></i> </span>
          <h2>Email Notification</h2>
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
          
          <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th data-hide="phone">title</th>
                <th data-hide="phone,tablet">Message</th>
                <th data-hide="phone,tablet">Game</th>
                <th data-hide="phone,tablet">Type</th>
                <th data-hide="phone,tablet">Active</th>
              </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                <tr>
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->title }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->message }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
        
        </div>
        <!-- end widget content -->
  
      </div>
      <!-- end widget div -->
  
    </div>

    
  <script>
        var responsiveHelper_datatable_col_reorder = responsiveHelper_datatable_col_reorder || undefined;
        // var responsiveHelper_datatable_tabletools = responsiveHelper_datatable_tabletools ||undefined;
        
        var breakpointDefinition = {
          tablet : 1024,
          phone : 480
        };
      $('#datatable_col_reorder').dataTable({
        "sDom": "<'dt-toolbar d-flex align-items-center'<f><'hidden-xs ml-auto'B>r>"+
            "t"+
            "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
        "autoWidth" : true,
        "classes": {
          "sWrapper":      "dataTables_wrapper dt-bootstrap4"
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
  
                $('.usertext').editable({
                  mode :'inline'
                });
      
        },
          buttons: [ {
              extend: 'colvis',
              text: 'Show / hide columns',
              className: 'btn btn-default',
              columnText: function ( dt, idx, title ) {
                  return title;
              }			        
          } ],
          
        responsive: true
      });
  </script> --}}

  <div class="jarviswidget jarviswidget-color-green-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      <!-- widget options:
        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
        
        data-widget-colorbutton="false"	
        data-widget-editbutton="false"
        data-widget-togglebutton="false"
        data-widget-deletebutton="false"
        data-widget-fullscreenbutton="false"
        data-widget-custombutton="false"
        data-widget-collapsed="true" 
        data-widget-sortable="false"
        
      -->
    <header>
      <div class="widget-header">	
        <h2><strong>Fixed</strong> <i>Height</i></h2>				
      </div>
    </header>
  
    <div>
      
      <div class="jarviswidget-editbox">
        <input class="form-control" type="text">
        <span class="note"><i class="fa fa-check text-success"></i> Change title to update and save instantly!</span>
        
      </div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          
          <div class="row">
            
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input class="form-control" id="prepend" placeholder="Filter" type="text">
              </div>
            </div>
            <div class="col-3 col-sm-7 col-md-7 col-lg-7 text-right">
              
              {{-- <button class="btn sa-btn-success">
                <i onclick="addBots()" class="fa fa-plus"></i> <span class="hidden-mobile">Add New Row</span>
              </button> --}}
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
              </button>
              
            </div>
            
          </div>
          
            
  
        </div>
        
        <div class="custom-scroll table-responsive" style="height:290px; overflow-y: scroll;">
          
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th class="th-sm"></th>
                    <th class="th-sm">Title</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">Game</th>
                    <th class="th-sm">Type</th>
                    <th class="th-sm">Active</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>                      
                @foreach($notifications as $notification)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $notification->id }}"></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->title }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->message }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td>
                      <a href="#" style="color:red;" class="delete{{ $notification->id }}" 
                      id="delete" 
                      data-pk="{{ $notification->id }}" 
                      data-toggle="modal" 
                      data-target="#delete-modal">
                        <i class="fa fa-times"></i>
                      </a>
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
  
  {{-- <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Bot</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        <form action="{{ route('Bots-create') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Bot Name" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn sa-btn-primary">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div> --}}
  <!-- End Modal -->
  
  
  <!-- Button trigger modal -->
    <!-- Modal -->
    {{-- <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Create Bot</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('Bots-create') }}" method="POST">
            {{  csrf_field() }}
          <div class="modal-body">
            <input type="text" name="username" placeholder="username" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div> --}}
   
    {{-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all as $error)
            <li>{{$error}}</li>  
            @endforeach
        </ul>
    </div>  
    @endif
    
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
      </div>
    @endif --}}
    
  <!-- Modal -->
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              × 
            </button>
          </div>
          <div class="modal-body">
            Are You Sure Want To Delete It
            <form action="{{ route('PushNotification-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="userid" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes">Yes</button>
            <button type="button" class="button_example-no" data-dismiss="modal">No</button>
          </div>
            </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">

      table = $('table.table').dataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
        "sDom": "t"+"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
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
    
          $('.usertext').editable({
            mode :'inline'
          });
    
          @php
            foreach($notifications as $notification) {
              echo'$(".delete'.$notification->id.'").hide();';
              echo'$(".deletepermission'.$notification->id.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$notification->id.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$notification->id.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$notification->id.'").hide();';
                echo'}';
    
              echo '});';
            
              echo'$(".delete'.$notification->id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#id").val(id);';
              echo'});';
            }
          @endphp
        },
        responsive: true
      });
    
    </script>
@endsection