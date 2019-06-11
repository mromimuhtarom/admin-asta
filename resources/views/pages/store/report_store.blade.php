@extends('index')


@section('sidebarmenu')
@include('menu.menustore')    
@endsection


@section('content')
  <div class="searching bg-blue-dark">
    <!-- widget content -->
    <div class="widget-body">

      <form class="form" action="#" method="get" role="search">
        <div class="btn-input-group">
          <input type="text" name="usernameStore" class="form-control" placeholder="username">
        </div>
        <div class="form-group">
          <select class="custom-select">
            <option selected>Choose action</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </div>
        <div class="btn-input-group">
          <input type="date" name="startDate" class="form-control">
        </div>
        <div class="btn-input-group">
          <input type="date" name="endDate" class="form-control">
        </div>
        <div>
          <button type="submit" class="btn btn-primary">Cari</button>
        </div>

      </form>

    </div>
    <!-- end widget content -->
  </div>
@endsection