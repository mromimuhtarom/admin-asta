@extends('index')


@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Point_Players') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Point_Players') }}">Point Player</a></li>
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
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif

    <div class="search bg-blue-dark">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Point-search') }}" method="get" role="search">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col" style="padding-right:-10%">
                        <input type="text" name="inputPlayer" style="width:95%;" class="left" placeholder="username">
                    </div>
                    <div class="col" >
                        <select name="inputGame" class="form-control">
                            <option value="">Choose Game</option>
                            @foreach ($game as $gm)
                            <option value="{{ $gm->id }}">{{ $gm->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMinDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <input type="date" name="inputMaxDate" class="form-control" value="{{ $datenow->toDateString() }}">
                    </div>
                    <div class="col" style="padding-left:1%;">
                        <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 

@endsection