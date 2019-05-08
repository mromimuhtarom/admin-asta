@extends('index')


@section('sidebarmenu')
@include('menu.menuplayer');
@endsection


@section('content')
    <div class="table-aii">
        <div class="table-header">
            <form action="">
                <div class="row">
                    <div class="col">
                        <input type="text" name="username" placeholder="username">
                    </div>
                    <div class="col">
                        <select name="action" id="">
                            <option>Choose Action</option>
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