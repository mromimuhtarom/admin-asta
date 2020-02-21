@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Payment_Store') }}">{{ TranslateMenuToko('Store')}}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Payment_Store') }}">{{ TranslateMenuToko('Payment Store')}}</a></li>
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
      <h2><strong><i class="fa fa-columns"></i>{{ TranslateMenuToko('Payment Store')}}</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah chip store baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu && $mainmenu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#createPaymentStore">
                <i class="fa fa-plus"></i> {{ TranslateMenuToko('Create new payment store')}}
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
                @if($menu && $mainmenu)
                <th style="width:100px;"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ translate_MenuContentAdmin('L_SELECT_ALL')}}</th>
                @endif
                <th class="th-sm">{{ TranslateMenuGame('Name')}}</th>
                <th class="th-sm">{{ translate_menuTransaction('Type')}}e</th>
                <th class="th-sm">{{ Translate_menuPlayers('Desc')}}</th>
                <th class="th-sm">{{ Translate_menuPlayers('Status')}}</th>
                @if($menu && $mainmenu)
                <th align="center" style="width: 10px;">
                  <a href="#" style="color:red;font-weight:bold;" 
                  class="delete" 
                  id="trash" 
                  data-toggle="modal" 
                  data-target="#deleteAll"><i class="fa  fa-trash-o"></a></th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($getPayments as $payment)
              @if($menu && $mainmenu)
              <tr>
                <td style="text-align:center;"><input type="checkbox" name="deletepermission[]" data-pk="{{ $payment->id }}" class="deletepermission{{ $payment->id }} deleteIdAll"></td>
                <td><a href="#" class="usertext" data-title="Name" data-name="name" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ $payment->PaymentName }}</td>
                <td><a href="#" class="payment_type" data-title="Type" data-name="type" data-pk="{{ $payment->id }}" data-value="{{ $payment->IdType }}" data-type="select" data-url="{{ route('PaymentStore-update') }}">{{ ucwords(str_replace('_', ' ',$payment->PaymentType)) }}</td>
                <td><a href="#" class="usertext" data-title="desc" data-name="desc" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ $payment->desc }}</td>
                <td><a href="#" class="stractive" data-title="status" data-name="status" data-pk="{{ $payment->id }}" data-type="select" data-url="{{ route('PaymentStore-update') }}">{{ ConfigTextTranslate(strEnabledDisabled($payment->status)) }}</td>
                {{-- <td><a href="#" class="stractive" data-title="Status" data-name="status" data-pk="{{ $payment->id }}" data-type="select" data-url="{{ route('PaymentStore-update') }}">{{ strEnabledDisabled($payment->status) }}</td> --}}
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
                <td>{{ strTypeTransaction($payment->type) }}</td>
                <td>{{ $payment->desc }}</td>
                <td>{{ ConfigTextTranslate(strEnabledDisabled($payment->status)) }}</td>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuToko('Create new payment store')}}</h4>
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
            <select class="custom-select" name="transactionType">
              <option selected>{{ TranslateMenuToko('Transaction type')}}</option>
              @foreach ($paymenttype as $pt)
                <option value="{{ $pt->id }}">{{ $pt->name }}</option>    
              @endforeach
              {{-- <option value="1">{{ TranslateMenuToko('Bank Transfer')}}</option>
              <option value="2">{{ TranslateMenuToko('Internet Banking')}}</option>
              <option value="3">{{ TranslateMenuToko('Cash Digital')}}</option>
              <option value="4">{{ TranslateMenuToko('Shop')}}</option>
              <option value="5">Akulaku</option>
              <option value="6">{{ TranslateMenuToko('Credit card')}}</option>
              <option value="7">{{ TranslateMenuToko('Manual transfer')}}</option>
              <option value="8">Google Play</option> --}}
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i>{{ TranslateMenuGame('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i>{{ TranslateMenuGame('Cancel')}}
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuGame('Delete Data')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are U Sure')}}
        <form action="{{ route('PaymentStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End delete Modal -->

<!-- Modal DELETE ALL SELECTED -->
<div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('Delete all selected data')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        {{ translate_MenuContentAdmin('L_QUESTION_DELETE_ALL')}}
        <form action="{{ route('PaymentStore-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- script -->
<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
      "pagingType": "full_numbers",
    });

    //CHECKBOX ALL
  $('#trash').hide();
    $('#checkAll').on('click', function(e) {
      if($(this).is(':checked', true))
      {
        $(".deleteIdAll").prop('checked', true);
        $("#trash").show();
      }else{
        $(".deleteIdAll").prop('checked', false);
        $("#trash").hide();
      }
    });

  });


  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
    "autoWidth" : true,
    "paging": false,
    "ordering": false,
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

      $('.payment_type').editable({
        mode  :'inline',
        value : '',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
        source: [
          {value: '', text:'Pilih tipe pembayaran'},
          @foreach($paymenttype as $pty)
          {value: '{{ $pty->id }}', text:'{{ ucwords(str_replace("_", " ",$pty->name)) }}'},
          @endforeach
        ]
      });
      
      $('.stractive').editable({
        value: '',
        mode :'inline',
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        },
				source: [
                  {value: '', text: 'choose for activation'},
				          // {value: '1', text: 'Enabled'},
					        // {value: '0', text: 'Disabled'},
                  @php
                        // $endis = preg_split( "/ :|, /", $atv->value );
                      echo '{value:"'.$endis[0].'", text: "'.ConfigTextTranslate($endis[1]).'"}, ';
                      echo '{value:"'.$endis[2].'", text: "'.ConfigTextTranslate($endis[3]).'"}, ';
                  @endphp
        ]
      });

      //js delete on delete all selected modal
    $('.delete').click(function(e) {
      e.preventDefault();
      var allVals = [];
      $('.deleteIdAll:checked').each(function() {
        allVals.push($(this).attr('data-pk'));
        var join_selected_values = allVals.join(",");
        $('#idDeleteAll').val(join_selected_values);
      });
    });

    //hide and show icon delete all
    $('#trash').hide();
    $(".deleteIdAll").click(function(e) {
      if($(".deleteIdAll:checked").length > 1) {
          $("#trash").show();
      }else{
          $("#trash").hide();
        }
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
    responsive: false
  });
</script>
<!-- end script -->

@endsection