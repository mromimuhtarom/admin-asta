@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Slide_Banner') }}">Settings</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Slide_Banner') }}">Slide Banner</a></li>
@endsection


@section('content')

<p style="text-align: center;"><img height="230px" width="300px" align="center" src="/images/underconstruction.png"/></p>
 
<div>
<h3 style="text-align: center;"><span style="font-size:48px;">Under Construction</span></h3>
</div>
 
<div class="col-sm-12 margin_bottom" style="text-align: center;">
    <span style="font-size:24px;"><span style="">
        <span style="">this page coming soon</span>
    </span>
</span>
</div>

@endsection