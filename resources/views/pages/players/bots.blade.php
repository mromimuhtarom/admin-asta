@extends('index')

@section('sidebarmenu')
@include('menu.menuplayer')    
@endsection

@section('content')

<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="margin-top:5%;">
          <h5 class="modal-title" id="exampleModalLabel">Create Bot</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('Bots-create') }}" method="POST">
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
            Bots <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                    <i class="fas fa-plus-circle"></i>Create Bots
                 </button>
    </div>
     <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th></th>
            <th class="th-sm">Username</th>
            <th class="th-sm">Bank Account</th>
            <th class="th-sm">Rank</th>
            <th class="th-sm">Gold</th>
            <th class="th-sm">Country</th>
          </tr>
        </thead>
        <tbody>
            @foreach($bots as $bot)
            <tr>
                <td></td>
                <td>{{ $bot->username }}</td>
                <td><a href="#" class="usertext" data-title="Bank Account" data-name="chip" data-pk="{{ $bot->user_id }}" data-type="text" data-url="{{ route('Bots-update') }}">{{ $bot->chip }}</td>
                <td>{{ $bot->rank_id}}</td>
                <td>{{ $bot->gold }}</td>
                <td>{{ $bot->name }}</td>
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