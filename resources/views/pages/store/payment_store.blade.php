@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Payment_Store') }}">{{ TranslateMenuToko('L_STORE')}}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Payment_Store') }}">{{ TranslateMenuToko('L_PAYMENT_STORE')}}</a></li>
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
      <h2><strong><i class="fa fa-columns"></i>{{ TranslateMenuToko('L_PAYMENT_STORE')}}</strong></h2>				
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
                <i class="fa fa-plus"></i> {{ TranslateMenuToko('L_CREATE_NEW_PAYMENT_STORE')}}
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
                <th class="th-sm">{{ TranslateMenuGame('L_NAME')}}</th>
                <th class="th-sm">{{ translate_menuTransaction('L_TYPE')}}e</th>
                <th class="th-sm">{{ Translate_menuPlayers('L_DESC')}}</th>
                <th class="th-sm">{{ Translate_menuPlayers('L_STATUS')}}</th>
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
                <td style="text-align:center;"><input type="checkbox" name="deletepermission[]" data-pk="{{ $payment->id }}" data-username="{{ $payment->PaymentName }}" class="deletepermission{{ $payment->id }} deleteIdAll"></td>
                <td><a href="#" class="usertext" data-title="Name" data-name="name" data-pk="{{ $payment->id }}" data-type="text" data-url="{{ route('PaymentStore-update') }}">{{ $payment->PaymentName }}</td>
                <td><a href="#" class="payment_type" data-title="Type" data-name="type" data-pk="{{ $payment->id }}" data-value="{{ $payment->IdType }}" data-type="select" data-url="{{ route('PaymentStore-update') }}">{{ TranslateTranstype($payment->PaymentType) }}</td>
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
                <td>{{ TranslateTranstype($payment->type) }}</td>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuToko('L_CREATE_NEW_PAYMENT_STORE')}}</h4>
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
            <select class="custom-select required" name="transactionType">
              <option selected disabled>{{ TranslateMenuToko('L_TRANSACTION_TYPE')}}</option>
              @foreach ($paymenttype as $pt)
                <option value="{{ $pt->id }}">{{ TranslateTranstype($pt->name) }}</option>    
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data btn-create toggle-disabled" disabled onclick="FunctionLoadBtn()">
            <i class="fa fa-save"></i>{{ TranslateMenuGame('L_SAVE')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i>{{ TranslateMenuGame('L_CANCEL')}}
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuGame('L_DELETE_DATA')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('L_ARE_U_SURE')}}
        <form action="{{ route('PaymentStore-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userid" id="userid" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('L_YES')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_NO')}}</button>
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('L_DELETE_ALL_SELECTED_DATA')}}</h5>
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
          <input type="hidden" name="usernameAll" id="userDeleteAll" valie="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('L_YES')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('L_NO')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- script -->
<script>
  //Loading Submit Button
  function FunctionLoadBtn(){
    $(".btn-create").text("Loading...");
    $(this).submit('loading').delay(1000).queue(function() {
    })
  }

  $(document).on('change keyup', '.required', function(e){
    let Disabled = true;

    $(".required").each(function() {
      let value = this.value
      if ((value)&&(value.trim() !=''))
      {
        Disabled = false
      } else {
        Disabled = true
        return false
      }
    });

    if(Disabled){
      $('.toggle-disabled').prop("disabled", true);
    } else {
      $('.toggle-disabled').prop("disabled", false);
    }
  })

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
          {value: '{{ $pty->id }}', text:'{{ TranslateTranstype($pty->name) }}'},
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
                  {value: '', text:'pilih untuk aktivasi'},
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
      var allUsername = [];
      $('.deleteIdAll:checked').each(function() {
        allVals.push($(this).attr('data-pk'));
        var join_selected_values = allVals.join(",");
        $('#idDeleteAll').val(join_selected_values);

        //untuk get username ketika multiple delete
        allUsername.push($(this).attr('data-username'));
        var join_selected_username = allUsername.join(",");
        $('#userDeleteAll').val(join_selected_username);
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