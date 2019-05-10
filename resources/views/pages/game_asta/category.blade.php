@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
<div class="menugame">
  @include('menu.nama_game')
</div>
    <div class="table-aii">
        <div class="table-header">
                Category
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Min Buy</th>
                <th class="th-sm">Max Buy</th>
                <th class="th-sm">Fee</th>
                <th class="th-sm">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($category as $kt)
                <tr>
                    <td></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="name" data-pk="{{ $kt->id }}" data-type="text" data-url="{{ route('Category-update')}}">{{ $kt->name }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="tablelow" data-pk="{{ $kt->id }}" data-type="number" data-url="{{ route('Category-update')}}">{{ $kt->tablelow }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="tablelimit" data-pk="{{ $kt->id }}" data-type="number" data-url="{{ route('Category-update')}}">{{ $kt->tablelimit }}</a></td>
                    <td><a href="#" class="usertext" data-name="fee" data-pk="{{ $kt->id }}" data-type="text" data-url="{{ route('Category-update') }}">{{ $kt->percentGroupFee() }}</a></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div> 
    <script type="text/javascript">
      $(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
         
          $('.usertext').editable({
              mode :'popup'
          });
  
  
      });
  </script>  
@endsection