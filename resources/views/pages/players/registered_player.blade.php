@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">Registered Player</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<!--- Warning Aler --->
@if (\Session::has('alert'))
  <div class="alert alert-danger">
    <p>{{\Session::get('alert')}}</p>
  </div>
@endif
<!--- End Warning Alert --->
<!--- Content Search --->
<div class="search bg-blue-dark " style="margin-bottom:2%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('RegisteredPlayer-search')}}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div cl ass="col" style="padding-left:1%;">
                    <input type="text" name="inputPlayer" class="left" placeholder="username/Player ID">
                </div>
                <div class="col" style="padding-left:1%;">
                  <select name="status" class="form-control">
                    <option value="">Choose Status</option>
                    <option value="{{ $plyr_status[0] }}">{{ ucwords($plyr_status[1]) }}</option>
                    <option value="{{ $plyr_status[2] }}">{{ ucwords($plyr_status[3]) }}</option>
                    <option value="{{ $plyr_status[4] }}">{{ ucwords($plyr_status[5]) }}</option>
                  </select>
                </div>
                <div class="col" style="padding-left:1%;">
                    <select name="type_user" class="form-control">
                      <option value="">Choose Register Type</option>
                      <option value="{{ $plyr_type[0] }}">{{ ucwords($plyr_type[1]) }}</option>
                      <option value="{{ $plyr_type[2] }}">{{ ucwords($plyr_type[3]) }}</option>
                    </select>
                </div>

                <div class="col" style="padding-left:1%;">
                    <input type="date" name="inputMinDate" class="form-control">
                </div>
                <div class="col" style="padding-left:1%;">
                    <input type="date" name="inputMaxDate" class="form-control">
                </div>
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
        <h2>Registered Players </h2>
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
                  Total Record Entries is {{ $registerPlayer->total() }}
                </div>
      
              </div>
      
          </div>
        
        <table id="registered-players" class="table table-striped table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.user_id"> Player ID <i class="fa fa-sort{{ iconsorting('user_id') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.username"> Username <i class="fa fa-sort{{ iconsorting('username') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.chip"> Chip <i class="fa fa-sort{{ iconsorting('chip') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.point"> Point <i class="fa fa-sort{{ iconsorting('point') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user_stat.gold"> Gold <i class="fa fa-sort{{ iconsorting('gold') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.status"> Status <i class="fa fa-sort{{ iconsorting('status') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.join_date"> Date created <i class="fa fa-sort{{ iconsorting('join_date') }}"></i></a></th>
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.user.user_type"> Register Form <i class="fa fa-sort{{ iconsorting('user_type') }}"></i></a></th>
              {{-- <th class="th-sm">Device</th> --}}
              <th><a href="{{ route('Guest-search') }}?inputPlayer=&inputMinDate={{ $getMindate }}&inputMaxDate={{ $getMaxdate }}&sorting={{ $sortingorder }}&namecolumn=asta_db.country.name"> Country <i class="fa fa-sort{{ iconsorting('name') }}"></i></a></th>
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
            <td>{{ $regis->username }}</td>
            <td><a href="#" class="usertext" data-title="Bank Account" data-name="chip" data-pk="{{ $regis->user_id }}" data-type="number" data-url="{{ route('RegisteredPlayer-update') }}">{{ $regis->chip }}</a></td>
            <td><a href="#" class="usertext" data-title="Bank Account" data-name="point" data-pk="{{ $regis->user_id }}" data-type="number" data-url="{{ route('RegisteredPlayer-update') }}">{{ $regis->point }}</a></td>
            <td><a href="#" class="usertext" data-title="Bank Account" data-name="gold" data-pk="{{ $regis->user_id }}" data-type="number" data-url="{{ route('RegisteredPlayer-update') }}">{{ $regis->gold }}</a></td>
            <td><a href="#"class="status" data-title="Bank Account" data-name="status" data-pk="{{ $regis->user_id }}" data-value="{{ $regis->status }}" data-type="select" data-url="{{ route('RegisteredPlayer1-update') }}">{{ $regis->strStatus() }}</a></td>
            <td>{{ $regis->join_date }}</td>
            <td>{{ $user_type }}</td>
            <td>{{ $regis->countryname }}</td>
        </tr>   
      @else
        <tr>
            <td><a href="{{ route('RegisteredPlayer-detaildevice', $regis->user_id) }}">{{ $regis->user_id }}</a></td>
            <td>{{ $regis->username }}</td>
            <td>{{ $regis->chip }}</td>
            <td>{{ $regis->point }}</td>
            <td>{{ $regis->gold }}</td>
            <td>{{ $regis->strStatus() }}</td>
            <td>{{ $regis->join_date }}</td>
            <td>{{ $user_type }}</td>
            <td>{{ $regis->countryname }}</td>
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

<script type="text/javascript">
	$(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
      "pagingType": "full_numbers",
      "paging":false,
      "ordering": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false
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

        $('.usertext').editable({
          mode :'inline',
          validate: function(value) {
            if($.trim(value) == '') {
              return 'This field is required';
            }
          }
        });
        $('.status').editable({
            mode :'inline',
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            },
            source: [
                {value: '', text: 'Choose For Activation'},
                @php
                  echo '{value: "'.$plyr_status[0].'", text: "'.$plyr_status[1].'"},';
                  echo '{value: "'.$plyr_status[2].'", text: "'.$plyr_status[3].'"},';
                  echo '{value: "'.$plyr_status[4].'", text: "'.$plyr_status[5].'"},';
                @endphp
            ]

        });
      },
    responsive: false
  });
</script>
@endif
<!--- End Show After Search --->
@endsection