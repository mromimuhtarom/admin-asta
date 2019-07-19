@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Banking_Transactions') }}">Transaction</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Banking_Transactions') }}">Banking Transaction</a></li>
@endsection

@section('content')
<link rel="stylesheet" href="/css/admin.css">
@if (\Session::has('alert'))
<div class="alert alert-danger">
  <p>{{\Session::get('alert')}}</p>
</div>
@endif
@if (count($errors) > 0)
<div class="error-val">
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>
</div>
@endif
<div class="search bg-blue-dark">
    <div class="table-header w-100 h-100">
			<form action="{{ route('Banking-search')}}">
            <div class="row h-100 w-100">
                <div class="col">
                    <select name="time" id="time" class="form-control">
												<option value="">Choose Time</option>
												<option value="today">today</option>
												<option value="week">Week</option>
												<option value="month">Month</option>
												<option value="all time">All Time</option>
                    </select>
                </div>
                <div class="col">
									<input type="date" class="form-control" id="minDate" name="inputMinDate" value="">
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="">
                </div>
                <div class="col">
                    <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// $('#time').change(function(){
//   if($(this).val() == 'today'){ // or this.value == 'volvo'
// 		// $("#minDate").disa();
// 		$('form input[type="date"]').prop("disabled", true);
//   }
// });
$('form input[type="date"]').prop("disabled", true);
$("#time").click(function(e) {
   e.preventDefault();
	 
	 if($(this).val() == 'today'){ 
		@php
   	echo'var minDate = $("#minDate").val("'.$datenow.'");';
		echo'var maxDate = $("#maxDate").val("'.$datenow.'");';
		@endphp
		$('form input[type="date"]').prop("readonly", true);
		$('form input[type="date"]').prop("disabled", false);
  } else if($(this).val() == 'week'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	} else if($(this).val() == 'month'){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	} else if($(this).val() == ''){
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("disabled", true);
	} else {
		var minDate = $("#minDate").val("");
		var maxDate = $("#maxDate").val("");
		$('form input[type="date"]').prop("readonly", false);
		$('form input[type="date"]').prop("disabled", false);
	}
});



</script>
@endsection