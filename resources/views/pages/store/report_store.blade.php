@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Store') }}">Store</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Store') }}">Report Store</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
  {{-- <div class="searching bg-blue-dark">
    <!-- widget content -->
    <div class="widget-body">

      <form class="form" action="#" method="get" role="search">
        <div class="btn-input-group">
          <input type="text" name="usernameStore" class="form-control" placeholder="username">
        </div>
        <div class="form-group">
          <select class="custom-select">
            <option selected>Choose action</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>
        <div class="btn-input-group">
          <input type="date" name="startDate" class="form-control">
        </div>
        <div class="btn-input-group">
          <input type="date" name="endDate" class="form-control">
        </div>
        <div>
          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
        </div>

      </form>

    </div>
    <!-- end widget content -->
  </div> --}}
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
      <form action="{{ route('ReportStore-search') }}">
            <div class="row h-100 w-100">
                <div class="col">
                    <input type="text" name="username" class="left" placeholder="username">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="dari" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="sampai" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection