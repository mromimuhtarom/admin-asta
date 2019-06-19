@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Season_Big_Two') }}">Games > Big Two</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Season_Big_Two') }}">Season</a></li>
@endsection


@section('content')

  <!-- Response Status -->
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
  <!-- End Response Status -->


  <!-- Form Season -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong>Asta Poker Season</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"><span> Create New Season</span></i>
              </button>
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>
        
        <div class="custom-scroll table-responsive" style="max-height:600px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="th-sm"></th>
                  <th class="th-sm">Title</th>
                  <th class="th-sm">Time Zone</th>
                  <th class="th-sm">Entry fee</th>
                  <th class="th-sm">Small Blind</th>
                  <th class="th-sm">Big Blind</th>
                  <th class="th-sm">Start Chip</th>
                  <th class="th-sm">Quit Win</th>
                  <th class="th-sm">Quit Lose</th>
                  <th class="th-sm">Start Time</th>
                  <th class="th-sm">Finish Time</th>
                  <th class="th-sm">Hand Win</th>
                  <th class="th-sm">Hand Lose</th>
                  <th class="th-sm">Disconnect Win</th>
                  <th class="th-sm">Disconnect Lose</th>
                  <th class="th-sm">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach($season as $sn)
                @php
                    //  $dt = new DateTime('UTC');//asli
                    $dt = new DateTime($sn->timezone);
                    $dt->setTimestamp($sn->startTime);
                    //  $dt->setTimeZone(new DateTimeZone($season->timezone));//asli
                    $dt->setTimeZone(new DateTimeZone($sn->timezone));
                    //  $dt = new DateTime('UTC');//asli
          
                    //  $dtf = new DateTime('UTC');//asli
                    $dtf = new DateTime($sn->timezone);
                    $dtf->setTimestamp($sn->finishTime);
                    //  $dtf->setTimeZone(new DateTimeZone($season->timezone));//asli
                    $dtf->setTimeZone(new DateTimeZone($sn->timezone));
                    //  $dtf = new DateTime('UTC');//asli
                @endphp --}}
                <tr>
                    {{-- <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $sn->seasonId }}"></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="title" data-pk="{{ $sn->seasonId }}" data-type="text" data-url="{{ route('Season-update')}}">{{ $sn->title }}</a></td>
                    <td>{{ $sn->timezone }}</td>
                    <td><a href="#" class="usertext" data-title="Entry Fee" data-name="entryfee" data-pk="{{ $sn->seasonId }}" data-type="number" data-url="{{ route('Season-update')}}">{{ $sn->entryFee }}</a></td>
                    <td><a href="#" class="usertext" data-title="Small Blind" data-name="sb" data-pk="{{ $sn->seasonId }}" data-type="number" data-url="{{ route('Season-update')}}">{{ $sn->sb }}</a></td>
                    <td><a href="#" class="usertext" data-title="Big Blind" data-name="bb" data-pk="{{ $sn->seasonId }}" data-type="number" data-url="{{ route('Season-update')}}">{{ $sn->bb }}</a></td>
                    <td><a href="#" class="usertext" data-title="Start Chip" data-name="startChips" data-pk="{{ $sn->seasonId }}" data-type="number" data-url="{{ route('Season-update')}}">{{ $sn->startChips }}</a></td>
                    <td>{{ $sn->quitWin }}</td>
                    <td>{{ $sn->quitLose }}</td>
                    <td>{{ $dt->format('Y-m-d H:i') }}</td>
                    <td>{{ $dtf->format('Y-m-d H:i') }}</td>
                    <td>{{ $sn->handWin }}</td>
                    <td>{{ $sn->handLose }}</td>
                    <td>{{ $sn->disconnectWin }}</td>
                    <td>{{ $sn->disconnectLose}}</td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $sn->seasonId }}" id="delete" data-pk="{{ $sn->seasonId }}" data-toggle="modal" data-target="#delete-season"><i class="fa fa-times"></i></a></td> --}}
                </tr>
                {{-- @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  <!-- End Form Season -->

  <!-- Modal create data -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create New Season</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        {{-- <form action="{{ route('Season-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="seasonName" placeholder="Season Name" required>
                </div>
                <div class="form-group">
                  <label for="startTime">Start Time</label>
                  <input type="date" class="form-control" name="startTime" placeholder="Start Time" required>
                </div>
                <div class="form-group">
                  <label for="startTime">Finish Time</label>
                  <input type="date" class="form-control" name="finishTime" placeholder="Finsih Time" required>
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
        </form> --}}
      </div>
    </div>
  </div>
  <!-- End Modal -->

  <!-- Modal delete data -->
  <div class="modal fade" id="delete-season" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          {{-- <form action="{{ route('Season-delete') }}" method="post">
            {{ method_field('delete')}}
            @csrf
            <input type="hidden" name="seasonId" id="seasonId" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes">Yes</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
        </div>
          </form> --}}
      </div>
    </div>
  </div>
  <!-- End Modal delete data -->

  <!-- Script -->
  <script>
    $(document).ready(function() {
      $('table.table').dataTable( {
        "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
      });
    });

    table = $('table.table').dataTable({
      "sDom": "t"+"<'dt-toolbar-footer d-flex'>",
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

        // @php
        //   foreach($season as $sn) {
        //     echo'$(".delete'.$sn->seasonId.'").hide();';
        //     echo'$(".deletepermission'.$sn->seasonId.'").on("click", function() {';
        //       echo 'if($( ".deletepermission'.$sn->seasonId.':checked" ).length > 0)';
        //       echo '{';
        //         echo '$(".delete'.$sn->seasonId.'").show();';
        //       echo'}';
        //       echo'else';
        //       echo'{';
        //         echo'$(".delete'.$sn->seasonId.'").hide();';
        //       echo'}';
  
        //     echo '});';
        
        //     echo'$(".delete'.$sn->seasonId.'").click(function(e) {';
        //       echo'e.preventDefault();';

        //       echo"var id = $(this).attr('data-pk');";
        //       echo'var test = $("#seasonId").val(id);';
        //     echo'});';
        //   }
        // @endphp

        $('.usertext').editable({
          mode : 'inline'
        });
      },
      responsive: true
    });
  </script>
  <!-- End Script -->
@endsection