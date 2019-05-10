@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
<div class="menugame">
  @include('menu.nama_game')
</div>
    <div class="table-aii">
        <div class="table-header">
                Jackpot Paytable
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
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
  
         
          $('.usertext').editable({
              mode :'inline'
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
  
  
      });
  </script>
@endsection