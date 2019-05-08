@extends('index')

@section('sidebarmenu')
@include('menu.menugame')
@endsection


@section('content')
<div class="menugame">
  @include('menu.nama_game')
</div>
    <div class="table-aii">
        <div class="table-header">
                Table
        </div>
         <table id="dt-material-checkbox" class="table table-striped" style="margin-left:1px;" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="th-sm">Nama Table</th>
                <th class="th-sm">Type Table</th>
                <th class="th-sm">Group</th>
                <th class="th-sm">Level</th>
                <th class="th-sm">Seats</th>
                <th class="th-sm">Speed</th>
                <th class="th-sm">Small Blind</th>
                <th class="th-sm">Max Blind</th>
                <th class="th-sm">Min Buy</th>
                <th class="th-sm">Max Buy</th>
                <th class="th-sm">Jackpot Low</th>
                <th class="th-sm">Jackpot Med</th>
                <th class="th-sm">Jackpot High</th>
                <th class="th-sm">In Find Room</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach($tables as $tb)
                <tr>
                    <td></td>
                    <td>{{ $tb->tablename }}</td>
                    <td>{{ $tb->strTableType() }}</td>
                    <td></td>
                    <td>{{ $tb->levelLimit }}</td>
                    <td>{{ $tb->seats }}</td>
                    <td>{{ $tb->strTableSpeed() }}</td>
                    @if ($tb->tabletype == 's')
                    <td>{{ $tb->sb }}</td>
                    <td>{{ $tb->bb }}</td>                        
                    @else
                    <td>{{ $tb->baseSB}}</td>
                    <td>{{ $tb->baseBB}}</td>        
                    @endif
                    <td>{{ $tb->tablelow }}</td>
                    <td>{{ $tb->tablelimit }}</td>
                    <td>{{ $tb->jackpotLow }}</td>
                    <td>{{ $tb->jackpotMed }}</td>
                    <td>{{ $tb->jackpotHi }}</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
         
    </div>   
@endsection