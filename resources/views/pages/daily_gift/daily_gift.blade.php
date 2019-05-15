@extends('index')


@section('sidebarmenu')
    @include('menu.menugift')
@endsection

@section('content')


      <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Create Daily Gift</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            {{  csrf_field() }}
          <div class="modal-body">
            <input type="text" name="title" placeholder="Title" required><br>
            <input type="text" name="quantity" placeholder="Quantity"><br>
            <select name="action">
              <option>Select Action</option>
              <option>Chip</option>
              <option>Gold</option>
            </select>
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
            Daily Gift  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                          <i class="fas fa-plus-circle"></i>Create Daily Gift
                        </button>
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