@extends('index')


@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day_Reseller') }}">{{ translate_menu('Reseller') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day_Reseller') }}">{{ translate_menu('Reseller-Transaction') }}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Transaction_Day_Reseller') }}">{{ translate_menu('Transaction_Day_Reseller') }}</a></li>
@endsection


@section('content')
<link rel="stylesheet" href="/css/admin.css">
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
  
@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif


<!--- Content Search --->
<div class="search bg-blue-dark" style="margin-bottom:3%;">
    <div class="table-header w-100 h-100">
		<form action="{{ route('TransactionDay-search')}}">
            <div class="row h-100 w-100">

                    @if (Request::is('Reseller/Reseller-Transaction/Transaction_Day_Reseller/TransactionDayReseller-search*'))
                        <div class="col">
                            <select name="choose_time" id="time" class="form-control">
                                <option value="">{{ translate_MenuTransaction('Choose Time') }}</option>
                                    <option value="Day" @if($time == 'Day') selected @endif>{{ translate_MenuTransaction('Day') }}</option>
                                    <option value="Week" @if($time == 'Week') selected @endif>{{ translate_MenuTransaction('Week') }}</option>
                                    <option value="Month" @if($time == 'Month') selected @endif>{{ translate_MenuTransaction('Month') }}</option>
                                    <option value="All time" @if($time == 'All time') selected @endif>{{ translate_MenuTransaction('All time') }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="minDate" name="inputMinDate" value="{{ $minDate }}">
                        </div>
                        <div class="col">
                                <input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="{{ $maxDate }}">
                        </div>
                        <div class="col">
                                <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    @else 
                        <div class="col">
                            <select name="choose_time" id="time" class="form-control">
                                <option value="">{{ translate_MenuTransaction('Choose Time') }}</option>
                                <option value="Day">{{ translate_MenuTransaction('Day') }}</option>
                                <option value="Week">{{ translate_MenuTransaction('Week') }}</option>
                                <option value="Month">{{ translate_MenuTransaction('Month') }}</option>
                                <option value="All time">{{ translate_MenuTransaction('All time') }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="minDate" name="inputMinDate" value="{{ $datenow }}">
                        </div>
                        <div class="col">
                                <input type="date" class="form-control" id="maxDate" name="inputMaxDate" value="{{ $datenow }}">
                        </div>
                        <div class="col">
                                <button class="myButton searchbtn" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </div>										
                    @endif
            </div>
        </form>
    </div>
</div>
<!--- End Content Search ---> 
@endsection