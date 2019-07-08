@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Balance_Reseller') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Balance_Reseller') }}">Balance Reseller</a></li>
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
        <form action="{{ route('BalanceReseller-search') }}" method="get" role="search">
            <div class="row h-100 w-100 no-gutters">
                <div class="col">
                    <input type="text" name="inputUsername" class="left" placeholder="username" required>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="inputMinDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:3%;">
                    <input type="date" class="form-control" name="inputMaxDate" value="{{ $datenow->toDateString() }}">
                </div>
                <div class="col" style="padding-left:3%;">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>    
@endsection