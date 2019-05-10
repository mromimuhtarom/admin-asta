@extends('index')


@section('sidebarmenu')
@include('menu.menustore')    
@endsection


@section('content')
    <div class="table-aii">
        <div class="table-header">
                Best Offer
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Rate</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Price Cash</th>
                <th class="th-sm">As long</th>
                <th class="th-sm">Pay Transaction</th>
                <th class="th-sm">Action</th>
              </tr>
            </thead>
            <tbody>
                {{-- @foreach($guests as $gs) --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
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