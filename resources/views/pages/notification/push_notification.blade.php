@extends('index')




@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Push_Notification') }}">Notification</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Push_Notification') }}">Push Notification</a></li>
@endsection


@section('content')

  <!-- Response Status -->
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
        
    
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
        
    @endif
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Push Notification</h4>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <form action="{{ route('PushNotification-create') }}" method="post">
          @csrf
          <div class="modal-body">
    
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="title" placeholder="Title" required=""><br>
                  <textarea name="message" id="" class="form-control" cols="30" rows="10">Please Enter The message</textarea><br>
                  <select name="game" class="form-control">
                    <option value="">Select Game</option>
                    @foreach ($game as $gm)
                    <option value="{{ $gm->id }}">{{ $gm->name }}</option>
                    @endforeach
                  </select><br>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn sa-btn-primary">
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


  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-sitemap"></i> Push Notification</strong></h2>				
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
                @if($menu && $mainmenu)
                  <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                      <i class="fa fa-plus"></i> Create New Push Notification
                  </button>
                  @endif
              </div>
            </div>
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
                    @if($menu && $mainmenu)
                    <th class="th-sm"></th>
                    @endif
                    <th class="th-sm">Title</th>
                    <th class="th-sm">Message</th>
                    <th class="th-sm">Game</th>
                    <th class="th-sm">Type</th>
                    {{-- <th class="th-sm">Action</th> --}}
                    @if($menu && $mainmenu)
                    <th></th>
                    @endif
                </tr>
              </thead>
              <tbody>                      
                @foreach($notifications as $notification)
                @if($menu && $mainmenu)
                <tr>
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $notification->id }}"></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->title }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->message }}</a></td>
                    <td><a href="#" class="game" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="select" data-url="{{ route('PushNotification-update')}}">{{ $notification->gamename }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    {{-- <td></td> --}}
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
                @else
                <tr>
                    <td>{{ $notification->title }}</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->gamename }}</td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td>
                    <td></td>
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
  <!-- Modal -->
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i> 
            </button>
          </div>
          <div class="modal-body">
            Are You Sure Want To Delete It
            <form action="{{ route('PushNotification-delete') }}" method="post">
              {{ method_field('delete')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" id="id" value="">
          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
            <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
          </div>
            </form>
        </div>
      </div>
    </div>
      
    <script type="text/javascript">
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
    
          $('.usertext').editable({
            mode :'inline',
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            }
          });

          $('.game').editable({
                mode:'inline',
  				      value: '',
                validate: function(value) {
                  if($.trim(value) == '') {
                    return 'This field is required';
                  }
                },
  				      source: [
                  @php
                  foreach($game as $gm) {
                  echo '{value:"'.$gm->id.'", text: "'.$gm->name.'" },';
                  }
                  @endphp
  				      ]
          });     
    
          // delete bots
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