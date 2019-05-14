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
          <h5 class="modal-title" id="exampleModalLabel">Create Gift</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          {{  csrf_field() }}
        <div class="modal-body">
          <input type="text" name="username" placeholder="username" required>
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
                Gold Store  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                              <i class="fas fa-plus-circle"></i>Create Gift
                            </button>
        </div>
         <table id="dt-material-checkbox" class="table table-striped data-table" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm"></th>
                <th class="th-sm">Image</th>
                <th class="th-sm">Title Gift</th>
                <th class="th-sm">Chip Price</th>
                <th class="th-sm">Gold Price</th>
                <th class="th-sm">Expire</th>
                <th class="th-sm">Category</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($gifts as $gf)
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Gift" data-pk="{{ $gf->id }}" data-type="text" data-url="{{ route('GiftStore-update') }}">{{ $gf->name }}</a></td>
                    <td><a href="#" class="usertext" data-name="chipsPrice" data-title="Chip Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->chipsPrice }}</a></td>
                    <td><a href="#" class="usertext" data-name="diamondPrice" data-title="Gold Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->diamondPrice }}</a></td>
                    <td><a href="#" class="usertext" data-name="expire" data-title="expire" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->expire }}</a></td>
                    <td><a href="#" class="category" data-name="category" data-pk="{{ $gf->id }}" data-type="select" data-value="{{ $gf->category }}" data-url="{{ route('GiftStore-update') }}" data-title="Select type">{{ $gf->category }}</a></td>
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

          $('.category').editable({
            //value: 'drink',
            source: [
              {value: 'drink', text: 'Drink'},
              {value: 'food', text: 'Food'},
              {value: 'emoji', text: 'Emoji'},
            ]
          });    
  
  
      });
      
    </script> 

    
@endsection