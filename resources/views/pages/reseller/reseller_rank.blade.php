@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Reseller_Rank') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Reseller_Rank') }}">Reseller Rank</a></li>
@endsection

@section('content')
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

<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
<header>
  <div class="widget-header">	
    <h2><strong>Reseller Rank</strong></h2>				
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
              <i class="fa fa-plus"></i> Create New Reseller Rank
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
              <th class="th-sm">ID</th>
              <th class="th-sm">Name</th>
              <th class="th-sm">Gold Group</th>
              <th class="th-sm">Accumulate Type</th>
              <th class="th-sm">Bonus</th>
              @if($menu)
              <th class="th-sm">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($rank as $rk)
            @if($menu)
            <tr>
                <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $rk->order_id }}"></td>
                <td><a href="#" class="usertext" data-name="order_id" data-pk="{{ $rk->order_id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->order_id }}</a></td>
                <td><a href="#" class="usertext" data-name="name" data-pk="{{ $rk->order_id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->name }}</a></td>
                <td><a href="#" class="usertext" data-name="gold_group" data-pk="{{ $rk->order_id }}" data-type="number" data-url="{{ route('ResellerRank-update') }}">{{ $rk->gold_group }}</a></td>
                <td><a href="#" class="usertext" data-name="accumulate_type" data-pk="{{ $rk->order_id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->accumulate_type }}</a></td>
                <td><a href="#" class="usertext" data-name="bonus" data-pk="{{ $rk->order_id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->bonus }}</a></td>
                <td>
                    <a href="#" style="color:red;" class="delete{{ $rk->order_id }}" 
                        id="delete" 
                        data-pk="{{ $rk->order_id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
            @else 
            <tr>
              <td>{{ $rk->order_id}}</td>
              <td>{{ $rk->name }}</td>
              <td>{{ $rk->gold_group }}</td>
              <td>{{ $rk->accumulate_type }}</td>
              <td>{{ $rk->bonus }}</td>
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
      <h4 class="modal-title" id="myModalLabel">Create Reseller Rank</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        ×
      </button>
    </div>
    <form action="{{ route('ResellerRank-create') }}" method="post">
      @csrf
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <input type="text" class="form-control" name="id" placeholder="ID" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="rankname" placeholder="Rank Name" required>
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
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        × 
      </button>
    </div>
    <div class="modal-body">
      Are You Sure Want To Delete It
      <form action="{{ route('ResellerRank-delete') }}" method="post">
        {{ method_field('delete')}}
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="">
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
    "pagingType": "full_numbers",
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

    @php
        foreach($rank as $rk) {
          echo'$(".delete'.$rk->order_id.'").hide();';
          echo'$(".deletepermission'.$rk->order_id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$rk->order_id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$rk->order_id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$rk->order_id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$rk->order_id.'").click(function(e) {';
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