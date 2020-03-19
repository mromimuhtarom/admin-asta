@extends('index')

@section('page')
<<<<<<< HEAD
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('L_ITEM') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('L_REPORT_GIFT') }}</a></li>
=======
<li class="menunameheader"><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item menunameheader"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('Item') }}</a></li>
<li class="breadcrumb-item menunameheader"><a href="{{ route('Table_Gift') }}">{{ TranslateMenuItem('Report Gift') }}</a></li>
>>>>>>> 4063a539c261fe0fc5b5c7d24fff752000a50249
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
        <form action="{{ route('ReportGift-search') }}">
            <div class="row h-100 w-100">
              @if(Request::is('Item/Report_Gift/ReportGift/ReportGift-search*') || Request::is('Item/Report_Gift/ReportGift/ReportGift-all*'))
                <div class="col">
                    <input type="text" name="username" class="left" placeholder="username">
                </div>
                <div class="col">
                    <select name="action" id="" class="form-control">
                        <option value="">{{ TranslateMenuItem('Choose Game') }}</option>
                        @foreach($game as $gm)
                          <option value="{{ $gm->id }}" @if($action == $gm->id) selected @endif>{{ $gm->desc }}</option>
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
              @else
                <div class="col">
                  <input type="text" name="username" class="left" placeholder="username">
                </div>
                <div class="col">
                    <select name="action" id="" class="form-control">
                        <option value="">{{ TranslateMenuItem('L_CHOOSE_GAME') }}</option>
                        @foreach($game as $gm)
                        <option value="{{ $gm->id }}">{{ $gm->desc }}</option>
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
              @endif
            </div>
        </form>
    </div>
</div> 
@endsection