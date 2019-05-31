@extends('index')


@section('sidebarmenu')
@include('menu.menustore')    
@endsection


@section('content')

<style>
.media-container {
	position: relative;
	display: inline-block;
	margin: auto;
  border-radius: 50%;
  border: 1px solid black;
	overflow: hidden;
	width: 100px;
	height: 100px;
	/* vertical-align: middle */
}
	.media-overlay {
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(180, 180, 180, 0.6);
  }
		#media-input {
			display: block;
			width: 100%;
			height: 100%;
			line-height: 100%;
			opacity: 0;
			position: relative;
			z-index: 9;
		}
		.media-icon {
			/* display: sticky; */
      transform: translate(-1%,-90%);
			color: #ffffff;
			font-size: 2em;
			height: 100%;
			line-height: 100px;
      position: absolute;
			z-index: 0;
			width: 100%;
			text-align: center;
		}
	.media-object {}
		.img-object {
      border: 1px solid black;
			border-radius: 50%;
			width: 100px;
			height: 100px;
			display: block;
		}

.media-control {
	margin-top: 30px;
}
	.edit-profile {}
	.save-profile {}

</style>

<script type="text/javascript">

  @php
  foreach($gifts as $gf) {
echo 'function Upload'.$gf->id.'() {';
  echo 'var cc1'.$gf->id.' = document.getElementById("can'.$gf->id.'");';
  echo'var fileinput'.$gf->id.' = document.getElementById("finput'.$gf->id.'");';
  echo 'var image = new SimpleImage(fileinput'.$gf->id.');';
  echo 'image.drawTo(cc1'.$gf->id.');';
  echo '}';
  }
@endphp
</script>



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
            <img id="blah" src="http://placehold.it/180" alt="your image" width="100" height="100" /><br><br>
            <input type='file' onchange="readURL(this);" /><br><br>
            <input type="text" name="title" placeholder="Title Gift" required><br>
            <input type="number" name="expire" placeholder="expire" required><br>
            <select name="transaction">
              <option>Category</option>
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
        <div class="footer-table">
                          @if($menu)
                            <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#basicExampleModal">
                              <i class="fas fa-plus-circle"></i>Create Gift
                            </button>
                          @endif
        </div>
         <table id="dt-material-checkbox" class="table table-striped data-table" style="margin-left:1px;margin-top:-5%;" cellspacing="0" width="100%">
            <thead class="th-table">
              <tr>
                @if($menu)
                <th class="th-sm"></th>
                @endif
                <th width="10px">Image</th>
                <th class="th-sm">Title Gift</th>
                <th class="th-sm">Price</th>
                {{-- <th class="th-sm">Gold Price</th>
                <th class="th-sm">Expire</th> --}}
                <th class="th-sm">Category</th>
                @if($menu)
                <th></th>
                @endif
              </tr>
            </thead>
            <tbody>
                @foreach($gifts as $gf)
                @if($menu)
                <tr>
                    <td></td>
                    <td >
                      {{-- <form method="post" action="" enctype="multipart/form-data" id="myform"> --}}
                          {{-- <div class='preview'>
                            <img src="/images/gifts/{{ $gf->imageUrl	 }}" id="img" width="100" height="100">
                          </div><br>
                          <div >
                              <input type="file" id="file" name="file" /><br><br>
                              <input type="button" class="button" value="Upload" id="but_upload">
                          </div> --}}
                          <div class="media-container">
                            <form method="POST" action="{{ route('GiftStore-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay med-ovlay{{ $gf->id }}">
                                <input type="hidden" name="pk" value="{{ $gf->id }}">
                                <input type="file" name="file" id="media-input" class="upload{{ $gf->id }}" accept="image/*">
                                {{-- <i class="glyphicon glyphicon-edit media-icon"></i> --}}
                                <i class="fas fa-edit media-icon"></i>
                              </span>
                              <figure class="media-object">
                                <img class="img-object imgupload{{ $gf->id }}" src="/images/gifts/{{ $gf->image_url }}">
                              </figure>
                            </div>
                            <div class="media-control">
                              <button class="save-profile{{ $gf->id }}">Save Gift</button>
                            </form>
                              <button class="edit-profile{{ $gf->id }}">Edit Gift</button>
                            </div>
                      {{-- </form> --}}
                    </td>
                    <td><a href="#" class="usertext" data-name="name" data-title="Title Gift" data-pk="{{ $gf->id }}" data-type="text" data-url="{{ route('GiftStore-update') }}">{{ $gf->name }}</a></td>
                    <td><a href="#" class="usertext" data-name="chipsPrice" data-title="Chip Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->price }}</a></td>
                    {{-- <td><a href="#" class="usertext" data-name="diamondPrice" data-title="Gold Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->diamondPrice }}</a></td>
                    <td><a href="#" class="usertext" data-name="expire" data-title="expire" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->expire }}</a></td> --}}
                    <td><a href="#" class="category" data-name="category_id" data-pk="{{ $gf->id }}" data-type="select" data-value="{{ $gf->category_id }}" data-url="{{ route('GiftStore-update') }}" data-title="Select type">{{ $gf->strCategory() }}</a></td>
                    <td></td>
                </tr>
                @else
                <tr>
                    <td >
                      {{-- <form method="post" action="" enctype="multipart/form-data" id="myform"> --}}
                          {{-- <div class='preview'>
                            <img src="/images/gifts/{{ $gf->imageUrl	 }}" id="img" width="100" height="100">
                          </div><br>
                          <div >
                              <input type="file" id="file" name="file" /><br><br>
                              <input type="button" class="button" value="Upload" id="but_upload">
                          </div> --}}
                          <div class="media-container">
                            {{-- <form method="POST" action="{{ route('GiftStore-updateimage') }}" enctype="multipart/form-data">
                              {{  csrf_field() }}
                              <span class="media-overlay med-ovlay{{ $gf->id }}">
                                <input type="hidden" name="pk" value="{{ $gf->id }}">
                                <input type="file" name="file" id="media-input" class="upload{{ $gf->id }}" accept="image/*">
                                <i class="fas fa-edit media-icon"></i>
                              </span> --}}
                              <figure class="media-object">
                                <img class="img-object imgupload{{ $gf->id }}" src="/images/gifts/{{ $gf->image_url }}">
                              </figure>
                            {{-- </div>
                            <div class="media-control">
                              <button class="save-profile{{ $gf->id }}">Save Gift</button>
                            </form>
                              <button class="edit-profile{{ $gf->id }}">Edit Gift</button> --}}
                            </div>
                      {{-- </form> --}}
                    </td>
                    <td>{{ $gf->name }}</td>
                    <td>{{ $gf->price }}</td>
                    {{-- <td><a href="#" class="usertext" data-name="diamondPrice" data-title="Gold Price" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->diamondPrice }}</a></td>
                    <td><a href="#" class="usertext" data-name="expire" data-title="expire" data-pk="{{ $gf->id }}" data-type="number" data-url="{{ route('GiftStore-update') }}">{{ $gf->expire }}</a></td> --}}
                    <td>{{ $gf->strCategory() }}</td>
                </tr> 
                @endif
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
          "pagingType": "full_numbers",
          "bInfo" : false,
          "sDom": '<"row view-filter w-50 add"<"col-sm-12"<"pull-right border-left margin-left"l><"pull-right margin-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"bottom"p>>>',
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

              $('.category').editable({
                value: 0,
				        source: [
					        {value: '1', text: 'Makanan'},
					        {value: '2', text: 'Minuman'},
					        {value: '3', text: 'Item'},
                ]
              });

            @php
              foreach($gifts as $gf) {
                echo'$(".save-profile'.$gf->id.'").hide(0);';
                  echo'$(".med-ovlay'.$gf->id.'").hide(0);';

                  echo'$(".edit-profile'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeIn(300);';
                    echo'$(".save-profile'.$gf->id.'").fadeIn(300);';
                  echo'});';
                  echo'$(".save-profile'.$gf->id.'").on("click", function() {';
                    echo'$(this).hide(0);';
                    echo'$(".med-ovlay'.$gf->id.'").fadeOut(300);';
                    echo'$(".edit-profile'.$gf->id.'").fadeIn(300);';
                  echo'});';

                  echo'$(".upload'.$gf->id.'").change(function() {';
                    echo'if (this.files && this.files[0]) {';
                      echo'var reader = new FileReader();';
		
                      echo'reader.onload = function(e) {';
                        echo'$(".imgupload'.$gf->id.'").attr("src", e.target.result);';
                      echo'};';
		
                      echo'reader.readAsDataURL(this.files[0]);';
                  echo'}';
                echo'});';
              }
            @endphp
    
          }
      });
</script>
@endsection