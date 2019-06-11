@extends('index')

@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
    <div class="search bg-blue-dark">
        <div class="table-header w-100 h-100">
            <form action="{{ route('ReportPlayer-search') }}" method="get" role="search">
                <div class="row h-100 w-100">
                    <div class="col">
                        <input type="text" name="inputPlayer" placeholder="username">
                    </div>
                    <div class="col">
                        <select name="logType">
                            <option value="">Choose Log Type</option>
                            <option value="1">Login</option>
                            <option value="2">Log Out</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="date" name="inputMinDate">
                    </div>
                    <div class="col">
                        <input type="date" name="inputMaxDate">
                    </div>
                    <div class="col">
                        <button class="myButton" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
@endsection