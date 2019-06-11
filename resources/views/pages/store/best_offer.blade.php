@extends('index')


@section('sidebarmenu')
@include('menu.menustore')    
@endsection


@section('content')

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
      <h2><strong>Best Offers</strong></h2>				
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
                @if ($menu)
                  <th class="th-sm"></th>
                @endif
                <th class="th-sm">Image</th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Rate</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Price Cash</th>
                <th class="th-sm">As long</th>
                <th class="th-sm">Pay Transaction</th>
                @if ($menu)
                  <th class="th-sm">Action</th>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Create Best Offers</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
      </div>
      <form action="#" method="post">
        @csrf
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="titleLabel">Title</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="titleLabel">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="rateLabel">Rate</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="rateLabel">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="priceLabel">Price</span>
            </div>
            <input type="text" class="form-control" id="basic-url" aria-describedby="priceLabel">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="dayOptions">As Long</label>
            </div>
            <select class="custom-select" id="daysOption">
              <option selected>Choose...</option>
              <option value="1">1 Day</option>
              <option value="2">2 Day</option>
              <option value="3">3 Day</option>
              <option value="4">4 Day</option>
              <option value="5">5 Day</option>
              <option value="6">6 Day</option>
              <option value="7">7 Day</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="categoryOptions">Select Category</label>
            </div>
            <select class="custom-select" id="categoriesOption">
              <option selected>Choose...</option>
              <option value="gold">Gold</option>
              <option value="chip">Chip</option>
              <option value="goods">Goods</option>
            </select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="banksOption">Pay Transaction</label>
            </div>
            <select class="custom-select" id="daysOption">
              <option selected>Choose...</option>
              <option value="viaTf">Bank Transfer</option>
              <option value="viaIb">Internet Banking</option>
              <option value="viaCd">Cash Digital</option>
              <option value="viaToko">Toko</option>
              <option value="ViaCc">Credit Card</option>
            </select>
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
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="margin-top:5%;">
        <h5 class="modal-title" id="exampleModalLabel">Create Best Offers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        {{  csrf_field() }}
      <div class="modal-body">
          <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
          <input type='file' onchange="readURL(this);" /><br><br>
        <input type="text" name="title" placeholder="title" required><br>
        <select name="category">
          <option>Select Ctegory</option>
          <option value=""></option>
        </select><br>
        <input type="number" name="price" placeholder="price"><br>
        <select name="longtime">
          <option>As Long</option>
          <option value=""></option>
        </select><br>
        <select name="paytransaction">
          <option>Pay Transaction</option>
          <option value=""></option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
 
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



    <div class="table-aii">
        <div class="footer-table">
                            <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                              <i class="fas fa-plus-circle"></i>Create Best Offers
                            </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Rate</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Price Cash</th>
                <th class="th-sm">As long</th>
                <th class="th-sm">Pay Transaction</th>
                <th class="th-sm">Action</th>
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
<script>
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
      });
</script>
@endsection