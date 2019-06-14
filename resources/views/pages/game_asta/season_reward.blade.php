@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('SeasonReward-view') }}">Games > Asta Poker</a></li>
        <li class="breadcrumb-item"><a href="{{ route('SeasonReward-view') }}">Season Reward</a></li>
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
                  <th class="th-sm">Position (From - To)</th>
                  <th class="th-sm">Reward Chip</th>
                  <th class="th-sm">Reward Gold</th>
                  <th class="th-sm">Reward Point</th>
                  <th class="th-sm">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reward as $rd)
                  <tr>
                    <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $rd->id }}"></td>
                    <td>
                      <a href="#" class="usertext" data-name="positionFrom" data-title="From" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->positionFrom }}</a> - 
                      <a href="#" class="usertext" data-name="positionTo" Data-title="To" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->positionTo }}</a>
                    </td>
                    <td><a href="#" class="usertext" data-title="Reward Chip" data-name="winpotReward" Data-title="Reward Chip" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->winpotReward }}</a></td>
                    <td><a href="#" class="usertext" data-name="goldReward" Data-title="Reward Gold" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->goldReward}}</a></td>
                    <td><a href="#" class="usertext" data-name="pointReward" Data-title="Reward Point" data-pk="{{ $rd->id }}" data-type="number" data-url="{{ route('SeasonReward-update') }}">{{ $rd->pointReward }}</a></td>
                    <td style="text-align:center;"><a href="#" style="color:red;" class="delete{{ $rd->id }}" id="delete" data-pk="{{ $rd->id }}" data-toggle="modal" data-target="#delete-sReward"><i class="fa fa-times"></i></a></td>
                  </tr>
                @endforeach
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
          <h4 class="modal-title" id="myModalLabel">Create Season Reward</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
          </button>
        </div>
        <form action="{{ route('SeasonReward-create') }}" method="post">
          @csrf
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input class="form-control" type="number" name="rewardFrom" placeholder="From" style="width: 49%; display: inline-block;" required> - <input class="form-control" type="number" name="rewardTo" placeholder="To" style="width: 49%; display: inline-block;" required>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="rewardchip" placeholder="Reward Chip">
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name="rewardgold" placeholder="Reward Gold">
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
  <!-- End Modal -->

  <!-- Modal delete data -->
  <div class="modal fade" id="delete-sReward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <form action="{{ route('SeasonReward-delete') }}" method="post">
            {{ method_field('delete')}}
            @csrf
            <input type="hidden" name="sRewardId" id="sRewardId" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes">Yes</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <!-- End Modal delete data -->

  <!-- Script -->
  <script type="text/javascript">
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

        @php
          foreach($reward as $rd) {
            echo'$(".delete'.$rd->id.'").hide();';
            echo'$(".deletepermission'.$rd->id.'").on("click", function() {';
              echo 'if($( ".deletepermission'.$rd->id.':checked" ).length > 0)';
              echo '{';
                echo '$(".delete'.$rd->id.'").show();';
              echo'}';
              echo'else';
              echo'{';
                echo'$(".delete'.$rd->id.'").hide();';
              echo'}';
  
            echo '});';
        
            echo'$(".delete'.$rd->id.'").click(function(e) {';
              echo'e.preventDefault();';

              echo"var id = $(this).attr('data-pk');";
              echo'var test = $("#sRewardId").val(id);';
            echo'});';
          }
        @endphp

        $('.usertext').editable({
          mode : 'inline'
        });
      },
      responsive: true
    });
  </script> 
  <!-- End Script -->
@endsection