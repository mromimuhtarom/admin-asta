@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Jackpot_Paytable_Asta_Poker') }}">Games > Asta Poker</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Jackpot_Paytable_Asta_Poker') }}">Jackpot Paytable</a></li>
@endsection


@section('content')
{{-- <div class="menugame border-bottom border-dark">
  @include('menu.nama_game')
</div> --}}

  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Jackpot Paytable</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="text" name="username" placeholder="title" required><br>
          <input type="text" name="multiplier" placeholder="Multiplier" required><br>
          <select name="win">
            <option>Win Type</option>
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
                                    <i class="fas fa-plus-circle"></i>Create JackpotPay
                                  </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                <th></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Multiplier</th>
                <th class="th-sm">Win Type</th>
                <th class="th-sm">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($jackpot_paytable as $pay)
                <tr>
                    <td></td>
                    <td><a href="#" class="usertext" data-name="title" data-pk="{{ $pay->id }}" data-type="text" data-url="{{ route('JackpotPaytable-update') }}">{{ $pay->title }}</a></td>
                    <td><a href="#" class="usertext" data-name="multiplier" data-pk="{{ $pay->id }}" data-type="number" data-url="{{ route('JackpotPaytable-update') }}">{{ $pay->multiplier }}</a></td>
                    <td><a href="#" class="key" data-name="key" data-pk="{{ $pay->id }}" data-type="select" data-value="{{ $pay->key }}" data-url="{{ route('JackpotPaytable-update') }}" data-title="Select win type">{{ $pay->key }}</a></td>
                    <td>Delete</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>

  <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      });
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
              
              
              $('.key').editable({
				        value: 0,
				        source: [
					        {value: 'WIN_HIGHCARD', text: 'High Card'},
					        {value: 'WIN_PAIR', text: 'Pair'},
					        {value: 'WIN_2PAIR', text: '2 pair'},
					        {value: 'WIN_SETOF3', text: 'Three of a kind'},
					        {value: 'WIN_LOW_STRAIGHT', text: 'Low Straight'},
					        {value: 'WIN_STRAIGHT', text: 'Straight'},
					        {value: 'WIN_FLUSH', text: 'Flush'},
					        {value: 'WIN_FULLHOUSE', text: 'Full House'},
					        {value: 'WIN_SETOF4', text: 'Four of a kind'},
					        {value: 'WIN_STRAIGHT_FLUSH', text: 'Straight Flush'},
					        {value: 'WIN_ROYALFLUSH', text: 'Royal Flush'}
				        ]
			        });


              $('.category').editable({
                //value: 'drink',
                source: [
                  {value: 'drink', text: 'Drink'},
                  {value: 'food', text: 'Food'},
                  {value: 'emoji', text: 'Emoji'},
                ]
              }); 
    
          }
      });
  </script>
@endsection