@extends('index')


@section('sidebarmenu')
@include('menu.menuslide')    
@endsection


@section('content')

      <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="margin-top:5%;">
            <h5 class="modal-title" id="exampleModalLabel">Create Slide Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="POST">
            {{  csrf_field() }}
          <div class="modal-body">
            <input type='file' onchange="readURL(this);" /><br><br>
            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
            {{-- <input type="text" name="username" placeholder="username" required><br> --}}
            <textarea name="caption" cols="30" rows="5" placeholder="caption"></textarea><br>
            <select name="action">
              <option>Pilih Action</option>
              <option value=""></option>
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
                Slide Banner  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                                <i class="fas fa-plus-circle"></i>Create Slide Banners
                              </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Caption</th>
                <th class="th-sm">Action</th>
                <th class="th-sm">Active</th>
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

    {{-- <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script> --}}
@endsection