@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')




  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Table-create') }}" method="POST">
          {{  csrf_field() }}
          <div class="modal-body">
            <input type="text" name="categoryName" placeholder="Category Name"><br>
             <input type="number" name="minbuy" placeholder="Min Buy"><br>
             <input type="number" name="maxbuy" placeholder="Max Buy">
            {{-- <select name="category" id="">
              <option>Select Category</option>
              <option value=""></option>
            </select> --}}
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



  <!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are You Sure Want To Delete It
          <form action="{{ route('UserAdmin-delete') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="category" id="category" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="button_example-yes">Yes</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
        </div>
          </form>
      </div>
    </div>
  </div>
{{-- end delete notification --}}




    <div class="table-aii">
        <div class="table-header">
                Category  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                            <i class="fas fa-plus-circle"></i>Create Category
                          </button>
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
                    <td><input type="checkbox" name="deletepermission" class="deletepermission{{ $kt->id }}"></td>
                    <td><a href="#" class="usertext" data-title="Title" data-name="name" data-pk="{{ $kt->id }}" data-type="text" data-url="{{ route('Category-update')}}">{{ $kt->name }}</a></td>
                    <td><a href="#" class="usertext" data-title="Min Buy" data-name="tablelow" data-pk="{{ $kt->id }}" data-type="number" data-url="{{ route('Category-update')}}">{{ $kt->tablelow }}</a></td>
                    <td><a href="#" class="usertext" data-title="Max Buy" data-name="tablelimit" data-pk="{{ $kt->id }}" data-type="number" data-url="{{ route('Category-update')}}">{{ $kt->tablelimit }}</a></td>
                    <td><a href="#" class="usertext" data-name="fee" data-pk="{{ $kt->id }}" data-type="text" data-url="{{ route('Category-update') }}">{{ $kt->percentGroupFee() }}</a></td>
                    <td></td>
                    <td><a href="#" style="color:red;" class="delete{{ $kt->id }}" id="delete" data-pk="{{ $kt->id }}" data-toggle="modal" data-target="#delete"><i class="fas fa-times"></i></a></td>
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
      });
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

              @php
                  foreach($category as $kt) {
                    echo'$(".delete'.$kt->id.'").hide();';
                    echo'$(".deletepermission'.$kt->id.'").on("click", function() {';
                      echo 'if($( ".deletepermission'.$kt->id.':checked" ).length > 0)';
                      echo '{';
                        echo '$(".delete'.$kt->id.'").show();';
                      echo'}';
                      echo'else';
                      echo'{';
                        echo'$(".delete'.$kt->id.'").hide();';
                      echo'}';
          
                    echo '});';
                
                  echo'$(".delete'.$kt->id.'").click(function(e) {';
                    echo'e.preventDefault();';

                    echo"var id = $(this).attr('data-pk');";
                    echo'var test = $("#category").val(id);';
                  echo'});';
                }
              @endphp

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
    
          }
      });
  </script>  
@endsection