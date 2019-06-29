@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Gold_Players') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Gold_Players') }}">Gold Player</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">

    <div class="search bg-blue-dark">
            <div class="table-header w-100 h-100" style="padding-right:2%;">
                <form action="{{ route('Gold-search') }}" method="get" role="search">
                    <div class="row h-100 w-100 no-gutters">
                        <div class="col" align="left">
                            <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                        </div>
                        <div class="col" align="left" style="padding-left:1%;">
                            <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                        </div>
                        <div class="col" align="left" style="padding-left:1%;">
                            <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
                        </div>
                        <div class="col" align="left" style="padding-left:1%;">
                            <button class="myButton" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>    
@endsection