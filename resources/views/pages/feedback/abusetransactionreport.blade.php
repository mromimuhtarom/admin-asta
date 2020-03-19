@extends('index')

@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Feedback_Game') }}">{{ TranslateMenuFeedback('Feedback') }}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Abuse_Transaction_Report') }}">{{ TranslateMenuFeedback('Abuse Transaction Report') }}</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">

@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
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

<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom: 3%;">
    <div class="table-header w-100 h-100">
        <form action="{{ route('AbuseTransactionReport-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col usernameabuse">
                    <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                </div>
                <div class="col" style="padding-left:1%;">
                    <select name="TransactionType" id="" class="form-control">
                        <option value="">{{ TranslateMenuToko('L_TRANSACTION_TYPE') }}</option>
                        <option value="{{ $AbusetrnsType[0] }}">{{ translate_menu($AbusetrnsType[1]) }} Pemain</option>
                        <option value="{{ $AbusetrnsType[2] }}">{{ translate_menu($AbusetrnsType[3]) }} Pemain</option>
                    </select>
                </div>
                @if (Request::is('FeedBack/Abuse_Transaction_Report/AbuseTransactionReport-search'))
                <div class="col date-min" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMinDate"  value="{{ $minDate }}">
                </div>
                <div class="col date-max" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMaxDate"  value="{{ $maxDate }}">
                </div>
                @else
                <div class="col date-min" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMinDate"  value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col date-max" style="padding-left:1%;">
                    <input type="date" class="form-control" name="inputMaxDate"  value="{{ $datenow->toDateString() }}">
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
@if (Request::is('FeedBack/Abuse_Transaction_Report/AbuseTransactionReport-search'))
<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">
        <header>
            <div class="widget-header">	
                <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                <h2>{{ TranslateMenuFeedback('Feedback') }} Game</h2>
            </div>
        </header>
        <div>           
            <!-- widget content -->
            <div class="widget-body p-0">
                        
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>			                
                        <tr>
                            <th>{{ Translate_menuPlayers('L_PLAYER_ID') }}</th>
                            <th>{{ Translate_menuPlayers('L_USERNAME') }}</th>
                            <th>{{ TranslateMenuFeedback('Image Proof') }}</th>
                            <th>{{ TranslateMenuItem('L_DESCRIPTION') }}</th>
                            <th>{{ Translate_menuTransaction('L_DATE') }}</th>
                            <th>Print PDF <a href="{{ route('AbuseTransactionReport-PDFall') }}"><i class="fa fa-file-pdf-o"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($search as $fdgame)
                            @if ($fdgame->isread === 0)
                            <tr>
                                <td><b>{{ $fdgame->user_id }}</b></td>
                                <td><b>{{ $fdgame->username }}</b></td>
                                <td>
                                    <a href="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/upload/report/{{ $fdgame->id }}.jpg"><img src="https://aws-asta-s3-01.s3-ap-southeast-1.amazonaws.com/unity-asset/upload/report/{{ $fdgame->id }}.jpg" class="border border-dark" alt="" width="100" height="100"></a>
                                </td>
                                <td><b>{{ $fdgame->message }}</b></td>
                                <td><b>{{ date("d-m-Y H:i:s", strtotime($fdgame->date)) }}</b></td>
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
                                <td>{{ date("d-m-Y H:i:s", strtotime($fdgame->date)) }}</td>
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
    @endif
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