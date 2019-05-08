@extends('index')


@section('sidebarmenu')
    @include('menu.menugift')
@endsection

@section('content')
<div class="table-aii">
    <div class="table-header">
            Daily Gift
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th></th>
            <th class="th-sm">Title Gift</th>
            <th class="th-sm">Category</th>
            <th class="th-sm">Quantity</th>
            <th class="th-sm">Status</th>
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
            </tr>
            {{-- @endforeach --}}
        </tbody>
      </table>
     
</div>    
@endsection