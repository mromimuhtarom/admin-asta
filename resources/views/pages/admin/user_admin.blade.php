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
                <th class="th-sm">Image
                </th>
                <th class="th-sm">Username
                </th>
                <th class="th-sm">Full Name
                </th>
                <th class="th-sm">Role Type
                </th>
                <th class="th-sm">
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach($admin as $adm)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $adm->username }}</td>
                    <td>{{ $adm->fullname }}</td>
                    <td>{{ $adm->name }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
      </div>      

      
@endsection