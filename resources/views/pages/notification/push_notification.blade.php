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
                  {{-- <img src="" alt=""><br>
                  <input type="file" name=""><br> --}}
                  <select name="notification_type" class="form-control">
                    <option value="">Select Notification Type</option>
                    <option value="">Game</option>
                    <option value="">Store</option>
                    <option value="">News Event</option>
                    <option value="">Daily Gift</option>
                    <option value="">Tournament</option>
                    <option value="">Season</option>
                  </select><br>
                  <select name="category_type" class="form-control">
                    <option value="">Select Category Type</option>
                    <option value=""></option>
                  </select><br>
                  <select name="schedule" class="form-control" id="schedule">
                    <option value="">Select Schedule</option>
                    <option value="today">Today</option>
                    <option value="schedule">Schedule</option>
                    <option value="daily">Daily</option>
                    <option value="custom">Custom</option>
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
                    {{-- <th class="th-sm">Message</th>
                    <th class="th-sm">Type</th>
                    <th class="th-sm">Date</th> --}}
                    {{-- <th class="th-sm">Action</th> --}}
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Title</th>
                    <th class="th-sm">Text</th>
                    <th class="th-sm">Image</th>
                    <th class="th-sm">Type</th>
                    <th class="th-sm">Category</th>
                    <th class="th-sm">Device</th>
                    <th class="th-sm">Schedule</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">Date</th>
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
                    {{-- <td><a href="#" class="usertext" data-title="Title" data-name="msg" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->msg }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="type" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}">{{ $notification->type }}</a></td>
                    <td><a href="#" class="game" data-title="Message" data-name="date" data-pk="{{ $notification->id }}" data-type="select" data-url="{{ route('PushNotification-update')}}">{{ $notification->date }}</a></td>
                    <td><a href="#" class="usertext" data-title="Message" data-name="message" data-pk="{{ $notification->id }}" data-type="text" data-url="{{ route('PushNotification-update')}}"></a></td> --}}
                    {{-- <td></td> --}}
                    <td></td>
                    <td></td>
                    <td><a href=""> {{ $notification->msg }}</a></td>
                    <td></td>
                    <td><a href="">{{ $notification->type }}</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="">{{ $notification->date }}</a></td>
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
                    <td>{{ $notification->msg }}</td>
                    <td>{{ $notification->type }}</td>
                    <td>{{ $notification->date }}</td>
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
{{-- untuk tanggal insert --}}
    <div class="modal fade date " id="date-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
            <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-remove"></i> 
            </button>
          </div>
          <div class="modal-body">
            Choose Time and Date
            <form action="" method="post">
              {{ csrf_field() }}
              <input type="time" name="time" value="" placeholder="Time"><br>
              <input type="date" name="startdate" id="startdate" value="">&nbsp;&nbsp;&nbsp;<input type="date" name="enddate" id="enddate" value=""><br>
              <select name="" id="textboxtotal">
                <option value="">Choose textbox total</option>
                <option value="input1">1</option>
                <option value="input2">2</option>
                <option value="input3">3</option>
              </select>
              <table id="costum-date">
                <tr>
                  <td>
                    <select name="timechoose" id="timechoose">
                      <option value="">Choose time</option>
                      <option value="weekly">Weekly</option>
                      <option value="monthly">Monthly</option>
                    </select>
                  </td>
                  <td></td>
                  <td>
                    <select name="day" id="day">
                      <option value="">Choose Day</option>
                      <option value="sunday">Sunday</option>
                      <option value="monday">Monday</option>
                      <option value="tuesday">Tuesday</option>
                      <option value="wednesday">Wednesday</option>
                      <option value="thursday">Thursday</option>
                      <option value="friday">Friday</option>
                      <option value="saturday">Saturday</option>
                    </select>
                    <select name="datechoose" id="datechoose">
                      <option value="">Choose Date</option>
                      @for($i=1; $i <= 31; $i++) 
                      <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>         
                    <select name="timechoose1" id="timechoose1">
                      <option value="">Choose time</option>
                      <option value="weekly1">Weekly</option>
                      <option value="monthly1">Monthly</option>
                    </select>
                  </td>
                  <td></td>
                  <td>
                    <select name="day1" id="day1">
                      <option value="">Choose Day</option>
                      <option value="sunday1">Sunday</option>
                      <option value="monday1">Monday</option>
                      <option value="tuesday1">Tuesday</option>
                      <option value="wednesday1">Wednesday</option>
                      <option value="thursday1">Thursday</option>
                      <option value="friday1">Friday</option>
                      <option value="saturday1">Saturday</option>
                    </select>
                    <select name="datechoose1" id="datechoose1">
                      <option value="">Choose Date</option>
                      @for($i=1; $i <= 31; $i++) 
                      <option value="{{ $i.'1' }}">{{ $i }}</option>
                      @endfor
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <select name="timechoose2" id="timechoose2">
                      <option value="">Choose time</option>
                      <option value="weekly2">Weekly</option>
                      <option value="monthly2">Monthly</option>
                    </select>
                  </td>
                  <td></td>
                  <td>
                    <select name="day2" id="day2">
                      <option value="">Choose Day</option>
                      <option value="sunday2">Sunday</option>
                      <option value="monday2">Monday</option>
                      <option value="tuesday2">Tuesday</option>
                      <option value="wednesday2">Wednesday</option>
                      <option value="thursday2">Thursday</option>
                      <option value="friday2">Friday</option>
                      <option value="saturday2">Saturday</option>
                    </select>
                    <select name="datechoose2" id="datechoose2">
                      <option value="">Choose Date</option>
                      @for($i=1; $i <= 31; $i++) 
                      <option value="{{ $i.'2' }}">{{ $i }}</option>
                      @endfor
                    </select>
                  </td>
                </tr>
              </table>

          </div>
          <div class="modal-footer">
            <button type="submit" class="button_example-yes btn sa-btn-success" id=""><i class="fa fa-check"></i> Yes</button>
            <button type="button" id="btn-cancel-date" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
          </div>
            </form>
        </div>
      </div>
    </div>
      
    <script type="text/javascript">
    $("#timechoose").click(function(e) {
      if($(this).val() == 'weekly') {
        $("#day").show();
        $('#datechoose').hide();
      } else if($(this).val() == 'monthly') {
        $('#datechoose').show();
        $('#day').hide();
      } else {
        $('#datechoose').hide();
        $('#day').hide();
      }
    });

    $("#timechoose1").click(function(e) {
      if($(this).val() == 'weekly1') {
        $("#day1").show();
        $('#datechoose1').hide();
      } else if($(this).val() == 'monthly1') {
        $('#datechoose1').show();
        $('#day1').hide();
      } else  {
        $('#datechoose1').hide();
        $('#day1').hide();
      }
    });

    $("#timechoose2").click(function(e) {
      if($(this).val() == 'weekly2') {
        $("#day2").show();
        $('#datechoose2').hide();
      } else if($(this).val() == 'monthly2') {
        $('#datechoose2').show();
        $('#day2').hide();
      } else {
        $('#datechoose2').hide();
        $('#day2').hide();
      }
    });

    $("#textboxtotal").click(function(e) {
      e.preventDefault();
      if($(this).val() == 'input1') {
          $('#timechoose').show();
          $('#timechoose1').hide();
          $('#timechoose2').hide();
      } else if($(this).val() == 'input2') {
          $('#timechoose').show();
          $('#timechoose1').show();
          $('#timechoose2').hide();
      } else if($(this).val() == 'input3') {
          $('#timechoose').show();
          $('#timechoose1').show();
          $('#timechoose2').show();
      } else {
          $('#timechoose').hide();
          $('#timechoose1').hide();
          $('#timechoose2').hide();
          $('#datechoose').hide();
          $('#datechoose1').hide();
          $('#datechoose2').hide();
          $('#day').hide();
          $('#day1').hide();
          $('#day2').hide();
      }

    })
     
    $("#schedule").change(function(e) {
      e.preventDefault();
      
      if($(this).val() == 'today'){
        @php 
          echo '$("#startdate").val("'.$datenow.'");';
        @endphp
        // $('#date-modal').modal('show');
        $('#date-modal').modal()
          $("#enddate").hide();
          $('#costum-date').hide();
          $('#textboxtotal').hide();
      } else if($(this).val() == 'schedule') {
        @php 
          echo '$(".datetime").val("'.$datenow.'");';
        @endphp
        $('#date-modal').modal('show');
        $("#startdate").show();
        $("#enddate").hide();
        $('#costum-date').hide();
        $('#textboxtotal').hide();
      } else if($(this).val() == 'daily') {
        $('#date-modal').modal('show');
        $("#startdate").show();
        $("#enddate").show();
        $('#costum-date').hide();
        $('#textboxtotal').hide();
      } else if($(this).val() == 'custom') {
        $('#startdate').hide();
        $(this).attr('data-toggle', "modal");
        $(this).attr('data-target', "#date-modal");
        $('#textboxtotal').show();
        $("#enddate").hide();
        $('#costum-date').show();
        $('#timechoose').hide();
        $('#timechoose1').hide();
        $('#timechoose2').hide();
        $('#day').hide();
        $('#day1').hide();
        $('#day2').hide();
        $('#datechoose').hide();
        $('#datechoose1').hide();
        $('#datechoose2').hide();
        $('#costum-date').show();
        
      } else {
        // $(this).removeAttr('data-toggle');
        // $(this).removeAttr('data-target');
        $('#date-modal').modal('hide');
      }
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
        responsive: false
      });
    
    </script>
@endsection