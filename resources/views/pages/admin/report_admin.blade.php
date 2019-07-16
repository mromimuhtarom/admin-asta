@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Admin') }}">Report Admin</a></li>
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
    <div class="search bg-blue-dark">
        <div class="table-header w-100 h-100">
            <form action="{{ route('ReportAdmin-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col">
                        <input type="text" name="inputPlayer" class="left" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select name="logType" class="form-control">
                            <option value="">Choose Log Type</option>
                            @foreach($action as $ac)
                            <option value="{{$ac->id}}">{{ $ac->action }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
@endsection