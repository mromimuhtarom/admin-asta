@extends('index')


@section('sidebarmenu')
@include('menu.menustore')    
@endsection


@section('content')



  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Chip Store</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="text" name="title" placeholder="title" required><br>
          <select name="category">
            <option>Select Category</option>
            <option value=""></option>
          </select><br>
          <input type="number" name="chipawarded" placeholder="Chip Awarded"><br>
          <input type="number" name="goldcost" placeholder="Gold Cost">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
 
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all as $error)
          <li>{{$error}}</li>  
          @endforeach
      </ul>
  </div>
      
  @endif
  
  @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{\Session::get('success')}}</p>
      </div>
      
  @endif



    <div class="table-aii">
        <div class="table-header">
                Chip Store  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                              <i class="fas fa-plus-circle"></i>Create Chip Store
                            </button>
        </div>
          <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Title</th>
                <th class="th-sm">Category</th>
                <th class="th-sm">Chip Awarded</th>
                <th class="th-sm">Gold Cost</th>
                <th class="th-sm">Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($items as $itm)
                <tr>
                    <td></td>
                    <td>{{ $itm->name }}</td>
                    <td>{{ $itm->category }}</td>
                    <td>{{ $itm->chipAwarded }}</td>
                    <td>{{ $itm->goldCost }}</td>
                    <td>{{ strEnabledDisabled($itm->active) }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>
<script>
      table = $('#dt-material-checkbox').dataTable({
          columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
          }],
          select: {
          style: 'os',
          selector: 'td:first-child'
          },
          "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $('.usertext').editable({
                mode :'popup'
              });
    
          }
      });
</script>
@endsection