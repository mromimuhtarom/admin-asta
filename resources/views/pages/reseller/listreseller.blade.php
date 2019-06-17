@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('ListReseller-view') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ListReseller-view') }}">Reseller</a></li>
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
      <h2><strong>List Reseller</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah bot baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              {{-- @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
              </button>
              @endif --}}
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
                <th class="th-sm">Name</th>
                <th class="th-sm">Phone</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Gold</th>
                <th class="th-sm">Rank</th>
                @if($menu)
                <th class="th-sm">Password</th>
                <th class="th-sm">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($reseller as $rsl)
              @if($menu)
              <tr>
                  <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $rsl->id }}"></td>
                  <td><a href="#" class="usertext" data-name="username" data-pk="{{ $rsl->id }}" data-type="text" data-url="{{ route('ListReseller-update') }}">{{ $rsl->username }}</a></td>
                  <td><a href="#" class="usertext" data-name="name" data-pk="{{ $rsl->id }}" data-type="text" data-url="{{ route('ListReseller-update') }}">{{ $rsl->name }}</a></td>
                  <td><a href="#" class="usertext" data-name="phone" data-pk="{{ $rsl->id }}" data-type="number" data-url="{{ route('ListReseller-update') }}">{{ $rsl->phone }}</a></td>
                  <td><a href="#" class="usertext" data-name="email" data-pk="{{ $rsl->id }}" data-type="email" data-url="{{ route('ListReseller-update') }}">{{ $rsl->email }}</a></td>
                  <td><a href="#" class="usertext" data-name="gold" data-pk="{{ $rsl->id }}" data-type="number" data-url="{{ route('ListReseller-update') }}">{{ $rsl->gold }}</a></td>
                  <td><a href="#" class="usertext" data-name="rank_id" data-pk="{{ $rsl->id }}" data-type="number" data-url="{{ route('ListReseller-update') }}">{{ $rsl->rank_id }}</a></td>
                  <td><a href="#" class="password{{ $rsl->id }} btn btn-primary" id="password" data-pk="{{ $rsl->id }}" data-toggle="modal" data-target="#reset-password">Reset Password</a></td>
                  <td>
                    <a href="#" style="color:red;" class="delete{{ $rsl->id }}" 
                      id="delete" 
                      data-pk="{{ $rsl->id }}" 
                      data-toggle="modal" 
                      data-target="#delete-modal">
                        <i class="fa fa-times"></i>
                    </a>
                  </td>
              </tr>
              @else 
              <tr>
                <td>{{ $rsl->username }}</td>
                <td>{{ $rsl->name }}</td>
                <td>{{ $rsl->phone }}</td>
                <td>{{ $rsl->email }}</td>
                <td>{{ $rsl->gold }}</td>
                <td>{{ $rsl->rank_id }}</td>
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

  {{-- reset password --}}
  <div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            × 
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('ListResellerPassword-update') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="userid" id="userid" value="">
            <input type="password" class="form-control" name="password" placeholder="Password" value="" required/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes">Reset Password</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
        </div>
          </form>
      </div>
    </div>
  </div>


{{-- end reset password --}}
 
  
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
        <form action="{{ route('ListReseller-delete') }}" method="post">
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
        foreach($reseller as $rsl) {
          echo'$(".delete'.$rsl->id.'").hide();';
          echo'$(".deletepermission'.$rsl->id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$rsl->id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$rsl->id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$rsl->id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$rsl->id.'").click(function(e) {';
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