@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
    <link rel="stylesheet" href="/css/admin.css">
    <div class="table-aii">
        <div class="table-header">
                User Admin
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Role</th>
                <th class="th-sm">Action</th>
                <th style="width:2px;"></th>
              </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $role->name }}</td>
                    <td><a href="#" class="myButton">View & Edit</a></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th>Name
                    </th>
                    <th>Position
                    </th>
                    <th>Office
                    </th>
                    <th colspan="2">Age
                    </th>
                    <th colspan="2">Start date
                    </th>
                </tr>
            </tfoot> --}}
          </table>
         
      </div>    

      
@endsection