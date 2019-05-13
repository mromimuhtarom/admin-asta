@extends('index')


@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection


@section('content')
    <div class="table-aii">
        <div class="table-header">
            <form action="{{ route('Chip-search') }}" method="get" role="search">
                <div class="row">
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