@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Log_Admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Log_Admin') }}">Log Admin</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
@if (\Session::has('alert'))
  <div class="alert alert-danger">
    <p>{{\Session::get('alert')}}</p>
  </div>
@endif
<div class="search bg-blue-dark">
    <div class="table-header w-100 h-100">
        <form action="{{ route('Log-search') }}">
            <div class="row h-100 w-100">
                <div class="col">
                    <input type="text" name="username" class="left" placeholder="username">
                </div>
                <div class="col">
                    <select name="action" id="" class="form-control">
                        <option value="">Choose Action</option>
                        @foreach($logs as $log)
                        <option value="{{ $log->action }}">{{ $log->action}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="dari" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="sampai"  value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection