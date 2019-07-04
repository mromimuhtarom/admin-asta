@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Payment_Store') }}">Store</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Payment_Store') }}">Payment Store</a></li>
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
      <h2><strong><i class="fa fa-columns"></i> Payment Store</strong></h2>				
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
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createPaymentStore">
                <i class="fa fa-plus"></i> Create New Payment Store
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah chip store baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="height:820px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">Name</th>
                <th class="th-sm">Payment Type</th>
                <th class="th-sm">Transaction Type</th>
                <th class="th-sm">image</th>
                <th class="th-sm">status</th>
                @if($menu)
                  <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($getPayments as $payment)
              @if($menu)
              <tr>
                <td style="text-align:center;"><input type="checkbox" name="deletepermission" class="deletepermission{{ $payment->id }}"></td>
                <td><a href="#" class="usertext" data-title="Name" data-name="name" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ $payment->name }}</td>
                <td><a href="#" class="usertext" data-title="Payment Type" data-name="payment_type" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ $payment->payment_type }}</td>
                <td><a href="#" class="usertext" data-title="Transaction Type" data-name="transaction_type" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ strTypeTransaction($payment->transaction_type) }}</td>
                <td><a href="#" class="usertext" data-title="Image" data-name="image" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ $payment->image }}</td>
                <td><a href="#" class="stractive" data-title="Status" data-name="status" data-pk="{{ $payment->id }}" data-type="select" data-url="{{ route('PaymentStore-update') }}">{{ strEnabledDisabled($payment->status) }}</td>
                <td style="text-align:center;">
                  <a href="#" style="color:red;" class="delete{{ $payment->id }}" 
                    id="delete" 
                    data-pk="{{ $payment->id }}" 
                    data-toggle="modal" 
                    data-target="#delete-modal">
                    <i class="fa fa-times"></i>
                  </a>
                </td>
              </tr>
              @else 
              <tr>
                <td>{{ $payment->name }}</td>
                <td>{{ $payment->payment_type }}</td>
                <td>{{ strTypeTransaction($payment->transaction_type) }}</td>
                <td>{{ $payment->image }}</td>
                <td>{{ strEnabledDisabled($payment->status) }}</td>
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
<div class="modal fade" id="createPaymentStore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> Create New Payment Store</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('PaymentStore-create') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="text" name="paymentType" class="form-control" id="basic-url" placeholder="payment type">
          </div>
          <div class="form-group">
            <select class="custom-select" name="transactionType">
              <option selected>Transaction type</option>
              <option value="1">Bank Transfer</option>
              <option value="2">Internet Banking</option>
              <option value="3">Cash Digital</option>
              <option value="4">Toko</option>
              <option value="5">Akulaku</option>
              <option value="6">Credit Card</option>
              <option value="7">Manual Transfer</option>
              <option value="8">Google Play</option>
            </select>
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
        <form action="{{ route('PaymentStore-delete') }}" method="post">
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

      $('.stractive').editable({
        value: '',
        mode :'inline',
				source: [
                  {value: '', text: 'choose for activation'},
				          {value: '1', text: 'Enabled'},
					        {value: '0', text: 'Disabled'},
        ]
      });

      // delete Payment store
      @php
        foreach($getPayments as $payment) {
          echo'$(".delete'.$payment->id.'").hide();';
          echo'$(".deletepermission'.$payment->id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$payment->id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$payment->id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$payment->id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$payment->id.'").click(function(e) {';
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