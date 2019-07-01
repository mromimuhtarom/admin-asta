@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Registered_Players') }}">Registered Player</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
    <div class="search bg-blue-dark" style="margin-bottom:2%;">
        <div class="table-header w-100 h-100">
            <form action="{{ route('RegisteredPlayer-search')}}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col" style="padding-left:1%;">
                        <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                    </div>
                    <div class="col" style="padding-left:1%;">
                      <select name="status" class="form-control">
                        <option value="">Choose Status</option>
                        <option value="1">Approve</option>
                        <option value="2">Banned</option>
                        <option value="3">Problem</option>
                      </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 





@endsection