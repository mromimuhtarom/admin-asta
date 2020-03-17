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

<!-- Table -->
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">

  <header>
    <div class="widget-header">	
      <h2><strong><i class="fa fa-columns"></i>{{ TranslateMenuToko('L_BEST_OFFER')}}</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      <div class="widget-body-toolbar">
        
        <div class="row">
          
          <!-- Button tambah best offer baru -->
          <div class="col-9 col-sm-5 col-md-5 col-lg-5">
            <div class="input-group">
              @if($menu)
              <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i>
              </button>
              @endif
            </div>
          </div>
          <!-- End Button tambah best offer baru -->

        </div>

      </div>
      
      <div class="custom-scroll table-responsive" style="max-height:600px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if ($menu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">{{ TranslateMenuToko('L_IMAGE')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_TITLE')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_RATE')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_CATEGORY')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_PRICE_CASH')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_AS_LONG')}}</th>
                <th class="th-sm">{{ TranslateMenuToko('L_PAY_TRANSACTION')}}</th>
                @if ($menu)
                  <th class="th-sm">{{ TranslateMenuToko('L_ACTION')}}</th>
                @endif
              </tr>
            </thead>
            <tbody>
              {{-- @foreach($guests as $gs) --}}
              @if($menu)
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              @else 
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              @endif
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      
      </div>
    
    </div>
  </div>
</div>
<!-- end Table -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">{{ TranslateMenuToko('L_CREATE_BEST_OFFER')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <form action="#" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group" align="center">
              <img id="imgPreview" src="http://placehold.it/180" alt="your image" width="100" height="100" class="rounded-circle" /><br><br>
              <input type='file' name="file" onchange="readURL(this);"/><br><br>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="basic-url" placeholder="title">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="basic-url" placeholder="rate">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="basic-url" placeholder="price">
          </div>
          <div class="form-group">
            <select class="custom-select">
              <option selected>{{ TranslateMenuToko('L_AS_LONG')}}</option>
              <option value="1">1 {{ TranslateMenuToko('L_DAY')}}</option>
              <option value="2">2 {{ TranslateMenuToko('L_DAY')}}</option>
              <option value="3">3 {{ TranslateMenuToko('L_DAY')}}</option>
              <option value="4">4 {{ TranslateMenuToko('L_DAY')}}</option>
              <option value="5">5 {{ TranslateMenuToko('L_DAY')}}</option>
              <option value="6">6 {{ TranslateMenuToko('L_DAY')}}</option>
              <option value="7">7 {{ TranslateMenuToko('L_DAY')}}</option>
            </select>
          </div>
          <div class="form-group">
            <select class="custom-select">
              <option selected>{{ TranslateMenuGame('L_SELECT_CATEGORY')}}</option>
              <option value="gold">{{ Translate_menuPlayers('L_GOLD_COINS')}}</option>
              <option value="chip">{{ Translate_menuPlayers('L_CHIP')}}</option>
              <option value="goods">{{ Translate_menuPlayers('L_GOODS')}}</option>
            </select>
          </div>
          <div class="form-group">
            <select class="custom-select">
              <option selected>{{ TranslateMenuToko('L_PAYMENT_METHODE')}}</option>
              <option value="viaTf">{{ TranslateMenuToko('L_BANK_TRANSFER')}}</option>
              <option value="viaIb">{{ TranslateMenuToko('L_INTERNET_BANKING')}}</option>
              <option value="viaCd">{{ TranslateMenuToko('L_CASH_DIGITAL')}}</option>
              <option value="viaToko">{{ TranslateMenuToko('L_SHOP')}}</option>
              <option value="ViaCc">{{ TranslateMenuToko('L_CREDIT_CARD')}}</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">
            {{ TranslateMenuGame('L_CANCEL')}}
          </button>
          <button type="submit" class="btn sa-btn-primary">
            {{ TranslateMenuGame('L_SAVE')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->

<!-- script -->
<script>
  // preview image
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#imgPreview')
          .attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
  // end preview image

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
    },
    responsive: false
  });

</script>
<!-- end script -->
@endsection