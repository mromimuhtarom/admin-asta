@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Feedback_Game') }}">Feedback</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Abuse_Transaction_Report') }}">Abuse Transaction Report</a></li>
@endsection

@section('content')
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">
        <header>
            <div class="widget-header">	
                <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                <h2>Feedback Game</h2>
            </div>
        </header>
        <div>           
            <!-- widget content -->
            <div class="widget-body p-0">
                        
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>			                
                        <tr>
                            <th>ID Player</th>
                            <th>Username</th>
                            <th>Image Proof</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Print PDF <a href="{{ route('AbuseTransactionReport-PDFall') }}"><i class="fa fa-file-pdf-o"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($abusetransaction as $fdgame)
                            @if ($fdgame->isread === 0)
                            <tr>
                                <td><b>{{ $fdgame->user_id }}</b></td>
                                <td><b>{{ $fdgame->username }}</b></td>
                                <td>
                                    <a href="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/upload/report/{{ $fdgame->id }}.jpg"><img src="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/upload/report/{{ $fdgame->id }}.jpg" class="border border-dark" alt="" width="100" height="100"></a>
                                </td>
                                <td><b>{{ $fdgame->message }}</b></td>
                                <td><b>{{ $fdgame->date }}</b></td>
                                <td><a href="{{ route('AbuseTransactionReport-PDFpersonal', $fdgame->id) }}"><i class="fa fa-file-pdf-o"></i></a></td>
                            </tr>
                            @elseif($fdgame->isread === 1)
                            <tr>
                                <td>{{ $fdgame->user_id }}</td>
                                <td>{{ $fdgame->username }}</td>
                                <td>
                                    <a href="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/upload/report/{{ $fdgame->id }}.jpg"><img src="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/upload/report/{{ $fdgame->id }}.jpg" class="border border-dark" alt="" width="100" height="100"></a>
                                </td>
                                <td>{{ $fdgame->message }}</td>
                                <td>{{ $fdgame->date }}</td>
                                <td><a href="{{ route('AbuseTransactionReport-PDFpersonal', $fdgame->id) }}"><i class="fa fa-file-pdf-o"></i></a></td>
                            </tr>
                            @endif

                            @endforeach
                    </tbody>
                </table>
        
            </div>
            <!-- end widget content -->
                        
        </div>
        <!-- end widget div -->
                        
        </div>
        <!-- end widget -->
        <script>
        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar d-flex'<l><'ml-auto hidden-xs show-control'>r>"+
                "t"+
                "<'dt-toolbar-footer d-flex'<'hidden-xs'i><'ml-auto'p>>",
                "autoWidth" : true,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
                },
                "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
                "pagingType": "full_numbers",
                "order": [[ 2, "desc" ]],
                classes: {
                    sWrapper:      "dataTables_wrapper dt-bootstrap4"
                },
                responsive: false
        });
        </script>
@endsection