@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('Chip-view') }}">Players</a></li>
        <li class="breadcrumb-item"><a href="{{ route('Chip-view') }}">Chip Player</a></li>
@endsection


@section('content')

    <div class="searching bg-blue-dark">
    
        <!-- widget content -->
        <div class="widget-body">
    
            <form class="form" action="{{ route('Chip-search') }}" method="get" role="search">
                <div class="btn-input-group">
                    <input type="text" name="inputPlayer" class="form-control" placeholder="username">
                </div>
                <div class="btn-input-group">
                    <input type="date" name="inputMinDate" class="form-control">
                </div>
                <div class="btn-input-group">
                    <input type="date" name="inputMaxDate" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
    
            </form>
    
        </div>
        <!-- end widget content -->
    </div>

@endsection