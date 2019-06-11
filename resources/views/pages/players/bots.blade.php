@extends('index')

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

<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
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
      <h2><strong>Bots</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah bot baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah bot baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="max-height:600px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu)
                <th></th>
                @endif
                <th class="th-sm">Username</th>
                <th class="th-sm">Bank Account</th>
                <th class="th-sm">Rank</th>
                <th class="th-sm">Gold</th>
                <th class="th-sm">Country</th>
                @if($menu)
                <th class="th-sm">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($bots as $bot)
              @if($menu)
              <tr>
                  <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $bot->user_id }}"></td>
                  <td>{{ $bot->username }}</td>
                  <td><a href="#" class="usertext" data-title="Bank Account" data-name="chip" data-pk="{{ $bot->user_id }}" data-type="text" data-url="{{ route('Bots-update') }}">{{ $bot->chip }}</td>
                  <td>{{ $bot->rank_id}}</td>
                  <td>{{ $bot->gold }}</td>
                  <td>{{ $bot->name }}</td>
                  <td>
                    <a href="#" style="color:red;" class="delete{{ $bot->user_id }}" 
                    id="delete" 
                    data-pk="{{ $bot->user_id }}" 
                    data-toggle="modal" 
                    data-target="#delete-modal">
                      <i class="fa fa-times"></i>
                    </a>
                  </td>
              </tr>
              @else 
              <tr>
                  <td>{{ $bot->username }}</td>
                  <td>{{ $bot->chip }}</td>
                  <td>{{ $bot->rank_id}}</td>
                  <td>{{ $bot->gold }}</td>
                  <td>{{ $bot->name }}</td>
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
</div>
 
  
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
        <form action="{{ route('Bots-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes">Yes</button>
        <button type="button" class="button_example-no" data-dismiss="modal">No</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal -->


<script type="text/javascript">
	$(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
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

      $('.usertext').editable({
        mode :'inline'
      });

      // delete bots
      @php
        foreach($bots as $bot) {
          echo'$(".delete'.$bot->user_id.'").hide();';
          echo'$(".deletepermission'.$bot->user_id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$bot->user_id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$bot->user_id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$bot->user_id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$bot->user_id.'").click(function(e) {';
            echo'e.preventDefault();';

            echo"var id = $(this).attr('data-pk');";
            echo'var test = $("#userid").val(id);';
          echo'});';
        }
      @endphp
    },
    responsive: true
  });

</script>
@endsection