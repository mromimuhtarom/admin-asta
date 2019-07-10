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
    
    <div class="custom-scroll table-responsive" style="height:800px;">
      
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
              <th class="th-sm">Type</th>
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
                <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $rk->id }}"></td>
                <td><a href="#" class="usertext" data-name="id" data-pk="{{ $rk->id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->id }}</a></td>
                <td><a href="#" class="usertext" data-name="name" data-pk="{{ $rk->id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->name }}</a></td>
                <td><a href="#" class="usertext" data-name="gold" data-pk="{{ $rk->id }}" data-type="number" data-url="{{ route('ResellerRank-update') }}">{{ $rk->gold }}</a></td>
                <td><a href="#" class="usertext" data-name="type" data-pk="{{ $rk->id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ strTransactionType($rk->type) }}</a></td>
                <td><a href="#" class="usertext" data-name="bonus" data-pk="{{ $rk->id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->bonus }}</a></td>
                <td>
                    <a href="#" style="color:red;" class="delete{{ $rk->id }}" 
                        id="delete" 
                        data-pk="{{ $rk->id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
            @else 
            <tr>
              <td>{{ $rk->id}}</td>
              <td>{{ $rk->name }}</td>
              <td>{{ $rk->gold }}</td>
              <td>{{ strTransactionType($rk->type) }}</td>
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
      <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create Reseller Rank</h4>
      <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="fa fa-remove"></i>
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
        <button type="submit" class="btn sa-btn-primary">
          <i class="fa fa-save"></i> Save
        </button>
        <button type="submit" class="btn btn-danger" data-dismiss="modal">
          <i class="fa fa-remove"></i> Cancel
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
      <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
      <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i>
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
      <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
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
          echo'$(".delete'.$rk->id.'").hide();';
          echo'$(".deletepermission'.$rk->id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$rk->id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$rk->id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$rk->id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$rk->id.'").click(function(e) {';
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