@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Log_Online_Offline_User') }}">Online & Offline User</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Log_Online_Offline_User') }}">Online User</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
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
<div class="searchonoff bg-blue-dark">
    <div class="table-header w-100 h-100">
        <form action="{{ route('LogOnlineOfflineUser-search') }}">
            <div class="row h-100 w-100">
                <div class="col">
                    <input type="text" name="username" class="form-control" placeholder="username">
                </div>
                <div class="col">
                    <select name="action" id="" class="form-control">
                        <option value="">Choose Action</option>
                        @foreach($action as $ac)
                        <option value="{{ $ac->id }}">{{ $ac->action}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="usertype" id="" class="form-control" required>
                        <option value="">Choose User Type</option>
                        <option value="0">Player</option>
                        <option value="1">Operator</option>
                    </select>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="dari">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="sampai">
                </div>
                <div class="col">
                    <button class="myButton" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection