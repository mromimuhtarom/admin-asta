@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">Registered Player</a></li>
@endsection

@section('content')
{{-- <img src="/upload/avatars/{{ $username->avatar }}" alt=""> --}}

<div class="d-flex w-100" style="margin-left:7%;">
<div class="well well-sm">
        
<div class="row">
<div class="col">
    <div class="well well-light well-sm m-0 p-0">

        <div class="row">

            <div class="col-sm-12" >

                <div id="carouselExampleControls" class="carousel slide profile-carousel" data-ride="carousel" style="height:100%; margin-bottom:-50%;">
                    <div class="air air-bottom-right padding-10">
                        <a href="javascript:void(0);" class="btn text-white bg-teal btn-sm"><i class="fa fa-check"></i> Profile</a>&nbsp; 
                    </div>
                    <div class="air air-top-left padding-10">
                        <h4 class="text-white font-md">Register In {{ date(' F d, Y', strtotime($username->join_date)) }}</h4>
                    </div>


                    {{-- <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                    </ol> --}}
                    <div class="carousel-inner" style="height:100%">
                        <!-- Slide 1 -->
                        <div class="carousel-item active" style="height:100%">	
                            <img src="/upload/img/demo/s1.jpg" width="100%" height="100%"alt="demo user">
                        </div>
                        {{-- <!-- Slide 2 -->
                        <div class="carousel-item">
                            <img src="/upload/img/demo/s2.jpg" width="100%" height="5%" alt="demo user">
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <img src="/upload/img/demo/m3.jpg" width="100%" height="5%" alt="demo user">
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12">

                <div class="row">

                    <div class="col-sm-2 col-2 profile-pic">
                        <img src="/upload/avatars/{{ $username->avatar}}" class="rounded-circle" alt="demo user" style="margin-left:2%; margin-top:-30%;">
                         
                        </div>
                        <div class="col-sm-6 col-8">
                            <h1><strong class="text-medium">{{ $username->username }}</strong>
                            <br>
                            <small> Players </small></h1>

                            <ul class="list-unstyled">
                                <li>
                                    <p class="text-muted">
                                        Email <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:simmons@smartadmin">{{ $username->email }}</a>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted">
                                        Country <i class="fa fa-flag-o"></i>&nbsp;&nbsp;<span class="text-darken">{{ $country->name }}</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted">
                                        Gold <i class="fa fa-cubes"></i>&nbsp;&nbsp;<span class="text-darken">{{ $username->gold }}</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted">
                                        Chip <i class="fa fa-database"></i>&nbsp;&nbsp;<span class="text-darken">{{ $username->chip }}</span>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted">
                                        Point <i class="fa fa-tags"></i>&nbsp;&nbsp;<span class="text-darken">{{ $username->point }}</span>
                                    </p>
                                </li>
                            </ul>
                            {{-- <br> --}}
                            {{-- <p class="font-md">
                                <i>A little about me...</i>
                            </p> --}}
                            {{-- <p>

                                Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio
                                cumque nihil impedit quo minus id quod maxime placeat facere

                            </p>
                            <br>
                            <a href="javascript:void(0);" class="btn btn-default btn-xs"><i class="fa fa-envelope-o"></i> Send Message</a> --}}
                            {{-- <br>
                            <br> --}}

                        </div>


                    </div>

                </div>

            </div>

            

        </div>
        <!-- end row -->

    </div>

</div>
</div>
</div>
</div>
{{-- end profile --}}



<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-2" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
        <h2>Device {{ $username->username}} </h2>
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
        
        <table id="registered-players" class="table table-striped table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Device Name</th>
              <th class="th-sm">Join Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($device as $dvc)
            <tr>
                <td>{{ $dvc->name }}</td>
                @php
                if($dvc->join_date == NULL)
                {
                    $join_date = 'NULL';
                } else {
                    $join_date = $dvc->join_date;
                }
                @endphp
                <td>{{ $join_date }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      
      </div>
      <!-- end widget content -->

    </div>
    <!-- end widget div -->

  </div>

<script type="text/javascript">
  table = $('table.table').dataTable({
    "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'f>r>"+
						"t"+
						"<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
    "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
    "pagingType": "full_numbers",
    "autoWidth" : true,
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
    responsive: true
  });
</script>
@endsection