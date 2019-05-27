@extends('index')


@section('sidebarmenu')
@include('menu.menuplayer');
@endsection


@section('content')
    <div class="search bg-teal">
        <div class="table-header w-100 h-100">
            <form action="{{ route('Gold-search') }}" method="get" role="search">
                <div class="row w-100 h-100">
                    <div class="col">
                        <input type="text" name="inputPlayer" placeholder="username">
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