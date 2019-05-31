@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="search bg-blue-dark">
    <div class="table-header w-100 h-100">
        <form action="">
            <div class="row h-100 w-100">
                <div class="col">
                    <input type="text" name="username" placeholder="username">
                </div>
                <div class="col">
                    <select name="action" id="">
                        <option>Choose Action</option>
                        @foreach($logs as $log)
                        <option value="{{ $log->action }}">{{ $log->action}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="date" name="dari">
                </div>
                <div class="col">
                    <input type="date" name="sampai">
                </div>
                <div class="col">
                    <button class="myButton" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection