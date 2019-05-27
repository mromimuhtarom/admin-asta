@extends('index')


@section('sidebarmenu')
@include('menu.menutransaction')    
@endsection

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
<div class="row">
    <div class="col">
        <div class="table-aii">
            <div class="footer-table">
                <div class="add-btn-smt">
                    Request Transactions
                </div>
            </div>
            <table id="dt-material-checkbox" class="table" style="margin-left:1px;margin-top:-10%;" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th class="th-sm"></th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($rewardRequest as $reward)
                        <!-- Modal -->
                            <div class="modal fade" id="view-detail{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-top:5%;">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            {{  csrf_field() }}
                                        <div class="modal-body">
                                            {{-- <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
                                            <input type='file' onchange="readURL(this);" /><br><br>
                                            <input type="text" name="title" placeholder="Title Gift" required><br>
                                            <input type="number" name="expire" placeholder="expire" required><br>
                                            <select name="transaction">
                                                <option>Category</option>
                                                <option value=""></option>
                                            </select> --}}
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {{-- @if($reward->status == 0) --}}
                            <!-- Modal -->
                            <div class="modal fade" id="decline{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-top:5%;">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            {{  csrf_field() }}
                                        <div class="modal-body">
                                            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
                                            <input type='file' onchange="readURL(this);" /><br><br>
                                            <input type="text" name="title" placeholder="Title Gift" required><br>
                                            <input type="number" name="expire" placeholder="expire" required><br>
                                            <select name="transaction">
                                                <option>Category</option>
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
                            <!-- Modal -->
                            <div class="modal fade" id="approve{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="margin-top:5%;">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            {{  csrf_field() }}
                                        <div class="modal-body">
                                            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
                                            <input type='file' onchange="readURL(this);" /><br><br>
                                            <input type="text" name="title" placeholder="Title Gift" required><br>
                                            <input type="number" name="expire" placeholder="expire" required><br>
                                            <select name="transaction">
                                                <option>Category</option>
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
                    <tr>
                        <td></td>
                        <td>


                            <div class="row">
                                <div class="col">{{ $reward->date_buy }}</div>
                                <div class="col" align="right">Buy in Best Offer</div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="media-profile-reward">
                                        <img src="/images/gifts/41.png" alt="" class="img-profile-reward">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row no-gutters" style="margin-left:2%;">
                                        <div class="col"><h4><a href="#">{{ $reward->username }}</a></h4></div>
                                    </div>
                                    <div class="row no-gutters" style="margin-left:2%;">
                                        <div class="col"><h4>Buy {{ $reward->qty }} {{ $reward->reward_name }} Using Bank Transfer</h4></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-2"><input type="button" value="View Detail" class="detail-banktransaction" data-toggle="modal" data-target="#view-detail{{ $reward->id }}"></div>
                                <div class="col-2"><input type="button" value="Decline" class="decline-banktransaction" data-toggle="modal" data-target="#decline{{ $reward->id }}"></div>
                                <div class="col-2"><input type="button" value="Approve" class="approve-banktransaction" data-toggle="modal" data-target="#approve{{ $reward->id }}""></div>
                                <div class="col" align="right">Pending</div>
                            </div>
                        </td>
                    </tr>
                    {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="col">
            <div class="table-aii">
                <div class="footer-table">
                    <div class="add-btn-smt">
                        Request Transaction
                    </div>
                </div>
                <table id="dt-material-checkbox" class="table display" style="margin-left:1px;margin-top:-10%;" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="th-sm"></th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($admin as $adm) --}}
                        <tr>
                            <td></td>
                            <td>
                                    {{-- @foreach ($rewardRequest as $reward)
                                    @if($reward->status == 0)
                                    @endif
                                    @endforeach --}}
                                    <div class="row">
                                        <div class="col">14-03-2019  03:36:10</div>
                                        <div class="col" align="right">Buy in Best Offer</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="media-profile-reward">
                                                <img src="/images/gifts/41.png" alt="" class="img-profile-reward">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row no-gutters" style="margin-left:2%;">
                                                <div class="col"><h4 style="font-size:100%;">Eliot</h4></div>
                                            </div>
                                            <div class="row no-gutters" style="margin-left:2%;">
                                                <div class="col"><h4 style="font-size:100%;">Buy 300 Gold Coins Using Bank Transfer</h4></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-2"><input type="button" value="View Detail" class="detail-banktransaction"></div>
                                        <div class="col-2"><input type="button" value="Completed" class="approve-banktransaction"></div>
                                        <div class="col" align="right">Approve by Perkasa</div>
                                    </div>
        
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
    </div>
</div>
<script>
      table = $('table.table').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter smt-aii add-smt"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager-smt"<"col-sm-12"<"bottom"p>>>',
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