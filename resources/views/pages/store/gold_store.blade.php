@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">Store</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Chip_Store') }}">Gold Store</a></li>
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

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong><i class="fa fa-columns"></i> Gold Store</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah chip store baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createGoldStore">
                <i class="fa fa-plus"></i> Create New Gold Store
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah chip store baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="height:800px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">Title</th>
                <th class="th-sm">Gold Awarded</th>
                <th class="th-sm">Price Cash</th>
                <th class="th-sm">Pay Transaction</th>
                <th class="th-sm">Google Key</th>
                <th class="th-sm">Active</th>
                @if($menu)
                  <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($getGolds as $gold)
              @if($menu)
              <tr>
                <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $gold->id }}"></td>
                <td><a href="#" class="usertext" data-title="Name" data-name="name" data-pk="{{ $gold->id }}" data-type="text" data-url="{{ route('GoldStore-update') }}">{{ $gold->name }}</a></td>
                <td><a href="#" class="usertext" data-title="Gold Awarded" data-name="goldAwarded" data-pk="{{ $gold->id }}" data-type="number" data-url="{{ route('GoldStore-update') }}">{{ $gold->goldAwarded }}</a></td>
                <td><a href="#" class="usertext" data-title="Price" data-name="price" data-pk="{{ $gold->id }}" data-type="text" data-url="{{ route('GoldStore-update') }}">{{ $gold->price }}</a></td>
                <td><a href="#" class="transactionType" data-title="Price" data-name="price" data-pk="{{ $gold->id }}" data-type="select" data-url="{{ route('GoldStore-update') }}">{{ strTypeTransaction($gold->transaction_type) }}</a></td>
                <td><a href="#" class="usertext" data-title="Google Key" data-name="google_key" data-pk="{{ $gold->id }}" data-type="text" data-url="{{ route('GoldStore-update') }}">{{ $gold->google_key }}</a></td>
                <td><a href="#" class="strEnable" data-title="Active" data-name="active" data-pk="{{ $gold->id }}" data-type="select" data-url="{{ route('GoldStore-update') }}">{{ strEnabledDisabled($gold->active) }}</a></td>
                <td style="text-align:center;">
                  <a href="#" style="color:red;" class="delete{{ $gold->id }}" 
                    id="delete" 
                    data-pk="{{ $gold->id }}" 
                    data-toggle="modal" 
                    data-target="#delete-modal">
                    <i class="fa fa-times"></i>
                  </a>
                </td>
              </tr>
              @else 
              <tr>
                <td>{{ $gold->name }}</td>
                <td>{{ $gold->goldAwarded }}</td>
                <td>{{ $gold->price }}</td>
                <td>{{ strTypeTransaction($gold->transaction_type) }}</td>
                <td>{{ $gold->google_key }}</td>
                <td>{{ strEnabledDisabled($gold->active) }}</td>
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
<!-- end Table -->

<!-- Modal -->
<div class="modal fade" id="createGoldStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create New Gold Store</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('GoldStore-create') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="number" name="goldAwarded" class="form-control" id="basic-url" placeholder="gold awarded">
          </div>
          <div class="form-group">
            <input type="number" name="priceCash" class="form-control" id="basic-url" placeholder="price cash">
          </div>
          <div class="form-group">
            <input type="text" name="googleKey" class="form-control" id="basic-url" placeholder="google key">
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
<!-- end Modal -->

<!-- delete Modal -->
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
        <form action="{{ route('GoldStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End delete Modal -->

<!-- script -->
<script>
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

      $('.strEnable').editable({
        mode: 'inline',
        value: '',
        source: [
          {value: '', text: 'Choose For Activation'},
          {value: 0, text: 'Disabled'},
          {value: 1, text: 'Enabled'}
        ]
      });

      $('.transactionType').editable({
				value: '',
        mode: 'inline',
				source: [
            {value: '', text: 'Choose For Transaction Type'},
					  {value: 1, text: 'Bank Transfer'},
					  {value: 2, text: 'Internet Banking'},
					  {value: 3, text: 'Cash Digital'},
					  {value: 4, text: 'Toko'},
					  {value: 5, text: 'Akulaku'},
					  {value: 6, text: 'Credit Card'},
					  {value: 7, text: 'Google Play'}
				   ]
			});

      // delete gold store
      @php
        foreach($getGolds as $gold) {
          echo'$(".delete'.$gold->id.'").hide();';
          echo'$(".deletepermission'.$gold->id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$gold->id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$gold->id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$gold->id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$gold->id.'").click(function(e) {';
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
<!-- end script -->
@endsection