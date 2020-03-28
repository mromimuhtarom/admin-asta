@extends('index')

@section('page')
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Feedback_Game') }}">{{ TranslateMenuFeedback('L_FEEDBACK') }}</a></li>
    <li class="breadcrumb-item menunameheader"><a href="{{ route('Feedback_Game') }}">{{ TranslateMenuFeedback('L_FEEDBACK') }} Game</a></li>
@endsection

@section('content')
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


<div class="jarviswidget jarviswidget-color-darken no-padding" id="wid-id-0" data-widget-editbutton="false">
<header>
    <div class="widget-header">	
        <span class="widget-icon"> <i class="fa fa-history"></i> </span>
        <h2>{{ TranslateMenuFeedback('L_FEEDBACK') }} Game</h2>
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
                    <th>{{ TranslateMenuFeedback('L_RATING') }}</th>
                    <th>{{ TranslateMenuFeedback('L_MESSAGE') }}</th>
                    <th>{{ Translate_menuTransaction('L_DATE') }}</th>
                    <th>Print PDF <a href="{{ route('FeedbackGame-PDFall') }}"><i class="fa fa-file-pdf-o"></i></a></th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($feedbackgame as $fdgame)
                    <tr>
                     <td>{{ $fdgame->user_id }}</td>
                     <td>{{ $fdgame->username }}</td>
                     <td>{{ $fdgame->strRating() }}</td>
                     <td>{{ $fdgame->msg }}</td>
                     <td>{{ date("d-m-Y H:i:s", strtotime($fdgame->date)) }}</td>
                     <td><a href="{{ route('FeedbackGame-PDFpersonal', $fdgame->id)}}"><i class="fa fa-file-pdf-o"></i></a></td>
                    </tr>
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