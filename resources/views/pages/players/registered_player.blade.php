@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">{{ Translate_menuPlayers('Players') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">{{ Translate_menuPlayers('Registered Player') }}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">

 <!-- Response Status -->
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

<!--- Warning Aler --->
@if (\Session::has('alert'))
  <div class="alert alert-danger">
    <p>{{\Session::get('alert')}}</p>
  </div>
@endif

<!-- successfull Warning -->
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
    @endif

<!--- End Warning Alert --->
<!--- Content Search --->
<div class="search bg-blue-dark " style="margin-bottom:2%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('RegisteredPlayer-search')}}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                @if (Request::is('Players/Registered_Players/RegisteredPlayer-search*'))
                  <div cl ass="col" style="padding-left:1%;">
                    <input type="text" name="inputPlayer" class="left" placeholder="username/Player ID" value="{{ $getUsername }}">
                  </div>
                  <div class="col" style="padding-left:1%;">
                    <select name="status" class="form-control">
                      <option value="">{{ Translate_menuPlayers('Choose status') }}</option>
                      <option value="{{ $plyr_status[0] }}" @if($getStatus == $plyr_status[0]) selected @endif;>{{ Translate_menuPlayers(ucwords($plyr_status[1])) }}</option>
                      <option value="{{ $plyr_status[2] }}" @if($getStatus == $plyr_status[2]) selected @endif;>{{ Translate_menuPlayers(ucwords($plyr_status[3])) }}</option>
                      <option value="{{ $plyr_status[4] }}" @if($getStatus == $plyr_status[4]) selected @endif;>{{ Translate_menuPlayers(ucwords($plyr_status[5])) }}</option>
                    </select>
                  </div>
                  <div class="col" style="padding-left:1%;">
                      <select name="type_user" class="form-control">
                        <option value="">{{ Translate_menuPlayers('Choose Register Type') }}</option>
                        <option value="{{ $plyr_type[0] }}" @if($getTypeUser == $plyr_type[0]) selected @endif;>{{ Translate_menuPlayers(ucwords($plyr_type[1])) }}</option>
                        <option value="{{ $plyr_type[2] }}" @if($getTypeUser == $plyr_type[2]) selected @endif;>{{ Translate_menuPlayers(ucwords($plyr_type[3])) }}</option>
                      </select>
                  </div>
                  <div class="col" style="padding-left:1%;">
                    <input type="date" name="inputMinDate" class="form-control" value="{{ $getMindate }}">
                  </div>
                  <div class="col" style="padding-left:1%;">
                    <input type="date" name="inputMaxDate" class="form-control" value="{{ $getMaxdate }}">
                  </div>
                @else 
                  <div cl ass="col" style="padding-left:1%;">
                      <input type="text" name="inputPlayer" class="left" placeholder="username/Player ID">
                  </div>
                  <div class="col" style="padding-left:1%;">
                    <select name="status" class="form-control">
                      <option value="">{{ Translate_menuPlayers('Choose status') }}</option>
                      <option value="{{ $plyr_status[0] }}">{{ Translate_menuPlayers(ucwords($plyr_status[1])) }}</option>
                      <option value="{{ $plyr_status[2] }}">{{ Translate_menuPlayers(ucwords($plyr_status[3])) }}</option>
                      <option value="{{ $plyr_status[4] }}">{{ Translate_menuPlayers(ucwords($plyr_status[5])) }}</option>
                    </select>
                  </div>
                  <div class="col" style="padding-left:1%;">
                      <select name="type_user" class="form-control">
                        <option value="">{{ Translate_menuPlayers('Choose Register Type') }}</option>
                        <option value="{{ $plyr_type[0] }}">{{ Translate_menuPlayers(ucwords($plyr_type[1])) }}</option>
                        <option value="{{ $plyr_type[2] }}">{{ Translate_menuPlayers(ucwords($plyr_type[3])) }}</option>
                      </select>
                  </div>
                  <div class="col" style="padding-left:1%;">
                      <input type="date" name="inputMinDate" class="form-control">
                  </div>
                  <div class="col" style="padding-left:1%;">
                      <input type="date" name="inputMaxDate" class="form-control">
                  </div>
                @endif
                <div class="col" style="padding-left:1%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div> 
<!--- End Content Search --->

<!--- Show After Search --->
@if (Request::is('Players/Registered_Players/RegisteredPlayer-search*'))
<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <span class="widget-icon"> <i class="fa fa-user"></i> </span>
        <h2>{{ Translate_menuPlayers('Registered Player') }}</h2>
      </div>

      <div class="widget-toolbar">
        <!-- add: non-hidden - to disable auto hide -->
      </div>
    </header>

    <!-- widget div-->
    <div>

      <!-- widget edit box -->
      <div class="jarviswidget-editbox">
        <!-- This area used as dropdown edit box -->

      </div>
      <!-- end widget edit box -->

      <!-- widget content -->
      <div class="widget-body p-0">
          <div class="widget-body-toolbar">
        
              <div class="row">
                
                <div class="col-9 col-sm-5 col-md-5 col-lg-5" style="font-style:italic;color:#969696;font-weight:bold;">
                  {{ Translate_menuPlayers('Total Record Entries is') }}{{ $registerPlayer->total() }}
                </div>
      
              </div>
      
          </div>
        
        <table id="registered-players" class="table table-striped table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.user_id">{{ Translate_menuPlayers('Player ID') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.user_id') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_level.level">{{ Translate_menuPlayers('Level') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_level.level') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username">{{ Translate_menuPlayers('Username') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.username') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.chip">{{ Translate_menuPlayers('Chip') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.chip') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.point">{{ Translate_menuPlayers('Point') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.point') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.gold">{{ Translate_menuPlayers('Gold Coins') }}<i class="fa fa-sort{{ iconsorting('asta_db.user_stat.gold') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.status">{{ Translate_menuPlayers('Status') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.status') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.join_date">{{ Translate_menuPlayers('Date Created') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.join_date') }}"></i></a></th>
              <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.user_type">{{ Translate_menuPlayers('Register Form') }}<i class="fa fa-sort{{ iconsorting('asta_db.user.user_type') }}"></i></a></th>
              {{-- <th class="th-sm">Device</th> --}}
              {{-- <th><a href="{{ route('RegisteredPlayer-search') }}?inputPlayer={{ $getUsername }}&status={{ $getStatus }}&type_user={{ $getTypeUser }}&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.country.name">{{ Translate_menuPlayers('Country') }}<i class="fa fa-sort{{ iconsorting('asta_db.country.name') }}"></i></a></th> --}}
            </tr>
          </thead>
<tbody>
@foreach($registerPlayer as $regis)
@php
  // if($regis->facebook_id !== ''){
  //     $user_type = 'Facebook';
  // } else 
  if($regis->user_type === 1) {
    $user_type = 'Player Asta';
  } else if($regis->user_type === 2) {
    $user_type = "Guest Asta";
  }
@endphp

      @if ($menu && $mainmenu)
        <tr>
            <td><a href="{{ route('RegisteredPlayer-detaildevice', $regis->user_id) }}">{{ $regis->user_id}}</a></td>
            <td>{{ $regis->level }}</td>
            <td>{{ $regis->username }}</td>
            <td><a href="{{ route('chip_detail') }}?inputPlayer={{ $regis->user_id }}">{{ number_format($regis->chip, 2) }}</a></td>
            <td><a href="{{ route('point_detail') }}?inputPlayer={{ $regis->user_id }}">{{ number_format($regis->point, 2) }}</a></td>
            <td><a href="{{ route('gold_detail') }}?inputPlayer={{ $regis->user_id }}">{{ number_format($regis->gold, 2) }}</a></td>
            {{-- <td><a href="#"class="status" data-title="Status" data-name="status" data-pk="{{ $regis->user_id }}" data-value="{{ $regis->status }}" data-type="select" data-url="{{ route('RegisteredPlayer1-update') }}">{{ $regis->strStatus() }}</a></td> --}}
            <td><a href="#"class="status" data-toggle="modal" data-target="#ModalBanned{{ $regis->user_id }}">{{ Translate_menuPlayers($regis->strStatus()) }}</a></td>
            <td>{{ date("d-m-Y H:i:s", strtotime($regis->join_date)) }}</td>
            <td>{{ $user_type }}</td>
            {{-- <td>{{ $regis->countryname }}</td> --}}
        </tr>   
      @else
        <tr>
            <td><a href="{{ route('RegisteredPlayer-detaildevice', $regis->user_id) }}">{{ $regis->user_id }}</a></td>
            <td>{{ $regis->level }}</td>
            <td>{{ $regis->username }}</td>
            <td><a href="{{ route('chip_detail') }}?inputPlayer={{ $regis->user_id }}">{{ number_format($regis->chip, 2) }}</a></td>
            <td><a href="{{ route('point_detail') }}?inputPlayer={{ $regis->user_id }}">{{ number_format($regis->point, 2) }}</a></td>
            <td><a href="{{ route('gold_detail') }}?inputPlayer={{ $regis->user_id }}">{{ number_format($regis->gold, 2) }}</a></td>
            <td>{{ $regis->strStatus() }}</td>
            <td>{{ date("d-m-Y H:i:s", strtotime($regis->join_date)) }}</td>
            <td>{{ $user_type }}</td>
            {{-- <td>{{ $regis->countryname }}</td> --}}
        </tr>   
      @endif
    @endforeach
  </tbody>
</table>

</div>
<!-- end widget content -->
<div style="display: flex;justify-content: center;">{{ $registerPlayer->links() }}</div>
</div>
<!-- end widget div -->

</div>


@foreach($registerPlayer as $regis)
<!-- Modal update Account -->
<div class="modal fade" id="ModalBanned{{ $regis->user_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>Change Player Status</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('RegisteredPlayer-update') }}" method="post">
        @csrf
        <div class="modal-body">
  
          <div class="row">
            <div class="col-12">
              <div class="form-group" id="formGroup">
                <div style="height:100px;overflow:auto;margin-bottom:20px;" class="border border-dark">
                  <table width="100%" style="border:1px solid #dee2e6;">
                    <tr style="background-color:#f5f5f5;">
                      <td>User ID</td>
                      <td>Username</td>
                      <td>Status</td>
                      <td>Date Time</td>
                      <td>Description</td>
                    </tr>
                    @php 
                      $loguser = App\LogUser::where('user_id', '=', $regis->user_id)->wherebetween('action_id', [25, 27])->get();

                    @endphp
                    @foreach($loguser as $log)
                    <tr>
                      <td>{{ $log->user_id }}</td>
                      <td>{{ $regis->username}}</td>
                      <td>{{ status_player($log->action_id) }}</td>
                      <td>{{ date("d-m-Y H:i:s", strtotime($log->datetime)) }}</td>
                      <td>{{ $log->description }}</td>
                    </tr>
                    @endforeach
                  </table> 
                </div>           
                  <input type="hidden" name="player_id" value="{{ $regis->user_id}}">
                  <textarea name="description" class="form-control" onkeyup="myDesc{{ $regis->user_id }}()" id="descriptionallow{{ $regis->user_id }}" cols="30" rows="10" placeholder="Alasan Ganti status"></textarea><br>
                  <span id="lblErrorDesc{{ $regis->user_id }}" style="color: red"></span> 
                  <select name="status_player" class="form-control" onclick="myFunction{{ $regis->user_id }}()" class="status_player">
                    <option value="">{{ Translate_menuPlayers('Choose status') }}</option>
                    @if ($regis->status == 1)
                    <option value="{{ $plyr_status[2] }}" @if($regis->status == $plyr_status[2]) selected @endif>{{ Translate_menuPlayers(ucwords($plyr_status[3])) }}</option>
                    <option value="{{ $plyr_status[4] }}" @if($regis->status == $plyr_status[4]) selected @endif>{{ Translate_menuPlayers(ucwords($plyr_status[5])) }}</option>
                    @elseif($regis->status == 2)
                    <option value="{{ $plyr_status[0] }}" @if($regis->status == $plyr_status[0]) selected @endif>{{ Translate_menuPlayers(ucwords($plyr_status[1])) }}</option>
                    <option value="{{ $plyr_status[4] }}" @if($regis->status == $plyr_status[4]) selected @endif>{{ Translate_menuPlayers(ucwords($plyr_status[5])) }}</option>
                    @elseif($regis->status == 3)
                    <option value="{{ $plyr_status[0] }}" @if($regis->status == $plyr_status[0]) selected @endif>{{ Translate_menuPlayers(ucwords($plyr_status[1])) }}</option>
                    <option value="{{ $plyr_status[2] }}" @if($regis->status == $plyr_status[2]) selected @endif>{{ Translate_menuPlayers(ucwords($plyr_status[3])) }}</option>
                    @endif
                  </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data">
            <i class="fa fa-save"></i> {{ Translate_menuPlayers('Save') }}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ Translate_menuPlayers('Cancel') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
 
  
<!-- End Modal Insert -->
@endforeach


<script type="text/javascript">
@foreach($registerPlayer as $regis)
   function myFunction{{ $regis->user_id }}() {
      if(document.getElementById("descriptionallow{{ $regis->user_id }}").value === "") {
        document.getElementById("lblErrorDesc{{ $regis->user_id }}").innerHTML = "{{ translate_MenuContentAdmin('L_DESCRIPTION_NULL') }}";
      } else {
        document.getElementById("lblErrorDesc{{ $regis->user_id }}").innerHTML = "";
      }
   }
   function myDesc{{ $regis->user_id }}() {
      if(document.getElementById("descriptionallow{{ $regis->user_id }}").value === "") {
        document.getElementById("lblErrorDesc{{ $regis->user_id }}").innerHTML = "{{ translate_MenuContentAdmin('L_DESCRIPTION_NULL') }}";
      } else {
        document.getElementById("lblErrorDesc{{ $regis->user_id }}").innerHTML = "";
      }
   }
@endforeach
	$(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
      "pagingType": "full_numbers",
      "paging":false,
      "ordering": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
    });
  });

  
  table = $('table.table').dataTable({
    "sDom": "<'dt-toolbar d-flex'<><'ml-auto hidden-xs show-control'>>",
    "autoWidth" : true,
    "paging": false,
    "bInfo": false,
    "ordering": false,  
    "bFilter": false,
    "classes": {
      "sWrapper": "dataTables_wrapper dt-bootstrap4"
    },
    "oLanguage": {
      "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },
      buttons: [ {
          extend: 'colvis',
          text: 'Show / hide columns',
          className: 'btn btn-default',
          columnText: function ( dt, idx, title ) {
              return title;
          }			        
      } ],
      "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      },
    responsive: false
  });
</script>
@endif
<!--- End Show After Search --->
@endsection