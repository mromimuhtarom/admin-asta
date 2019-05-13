@extends('index')


@section('sidebarmenu')
@include('menu.menustore')    
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
    
    <div class="table-aii">
        <div class="table-header">
                Payment Store
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Type Payment</th>
                <th class="th-sm">Type Transaction</th>
                <th class="th-sm">Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                {{-- @foreach($items as $itm) --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
          </table>
         
    </div>
@endsection