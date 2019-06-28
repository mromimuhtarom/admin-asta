@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Report_Admin') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Report_Admin') }}">Report Admin</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
    <div class="search bg-blue-dark">
        <div class="table-header w-100 h-100">
            <form action="{{ route('ReportAdmin-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col">
                        <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <select name="logType" class="form-control">
                            <option value="">Choose Log Type</option>
                            <option value="1">Login</option>
                            <option value="2">Log Out</option>
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMinDate">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" class="form-control" name="inputMaxDate">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
@endsection