@extends('index')

{{-- @section('namepages')
<h1 class="page-header"><i class="fa-fw fa fa-home"></i>  Dashboard <span>> My Dashboard</span></h1>
@endsection	 --}}
@section('content')
<link rel="stylesheet" href="/css/dashboard.css">
<link rel="stylesheet" href="/css/ring_chart.css">
<div class="home">
{{-- awal home --}}
<div id="banking" class="h-100 border-bottom tab">
    <div class="title-table size1">
        <div class="row font-title">
            <div class="col" align="center">Total banking transaction</div>
            <div class="col" align="center">Player request transaction</div>
        </div>
    
    </div>
    <div class="content-table size2">
        <div class="row no-gutters"  style="padding-left:10%; text-align:center">
            <div class="col" valign="middle">
                <div class="row h-100 w-100">
                    <div class="col-6" id="svg"> 
                        <svg width="250px" height="250px" class="border border-dark" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="40" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="460" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="40" stroke="#007d2a" stroke-width="3" fill="#ffffff" stroke-dasharray="50, 100"/>{{--ygdipakai--}} <!-- untuk yang chip -->
                            <circle cx="50" cy="50" r="30" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="460" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="30" stroke="#ffaa01" stroke-width="3" fill="#ffffff" stroke-dasharray="60, 100"/>{{--ygdipakai--}}  <!-- untuk yang gold -->
                            <circle cx="50" cy="50" r="20" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="460" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="20" stroke="#0019ff" stroke-width="4" fill="#ffffff" stroke-dasharray="20" stroke-dashoffset="100"/>{{--dikalikan 2--}} <!-- untuk yang goods -->
                            <circle cx="50" cy="50" r="10" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="460" stroke-dashoffset="50"/>
                            {{--<circle cx="50" cy="50" r="10" stroke="#ff6600" stroke-width="3" fill="#ffffff" stroke-dasharray= "10"/> ygdipakai--}} <!-- untuk yang best offer -->
                            <circle cx="50" cy="50" r="10" stroke="#ff6600" stroke-width="3" fill="#ffffff" stroke-dasharray="50, 100"  stroke-dashoffset="30"/>  {{-- tanpa dikali --}}
                        </svg> 
                    </div>
                    {{-- <div class="col-1 d-flex flex-column" id="svg-description">
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#007d2a" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ffaa01" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#0019ff" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ff6600" />  
                        </svg> 
                    </div> --}}
                    <div class="col" align="left" id="svg-description-text">
                        {{-- <div class="text-description">Chip</div>
                        <div class="text-description">Gold</div>
                        <div class="text-description">Goods</div>
                        <div class="text-description">Best Offer</div> --}}
                        <div class="row" style="margin-bottom:2%; width:100%; height:70%;">
                            <div class="col"><div class="circle-chip rounded-circle"></div></div>
                            <div class="col">Chip</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-gold rounded-circle"></div></div>
                            <div class="col">Gold</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-goods rounded-circle"></div></div>
                            <div class="col">Goods</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" style="margin-bottom:2%;"> --}}
                            <div class="col"><div class="circle-bestoffers rounded-circle"></div></div>
                            <div class="col">Best Offers</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row h-100 w-100">
                    <div class="col-6" id="svg">
                        <svg width="250px" height="250px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="40" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="40" stroke="#000000" stroke-width="3" fill="#ffffff" stroke-dasharray="20, 100" stroke-dashoffset="200"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="30" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="30" stroke="#ffaa01" stroke-width="3" fill="#ffffff" stroke-dasharray="30, 100" stroke-dashoffset="50"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="20" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="20" stroke="#0019ff" stroke-width="3" fill="#ffffff" stroke-dasharray="40, 100" stroke-dashoffset="280"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="10" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="10" stroke="#ff6600" stroke-width="3" fill="#ffffff" stroke-dasharray="50, 100" stroke-dashoffset="150"/>{{--ygdipakai--}}
                        </svg>
                    </div>
                    {{-- <div class="col-1 d-flex flex-column" id="svg-description">
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#000000" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ffaa01" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#0019ff" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ff6600" />  
                        </svg> 
                    </div> --}}
                    <div class="col" align="left" id="svg-description-text">
                        {{-- <div class="text-description">Player</div>
                        <div class="text-description">Gold</div>
                        <div class="text-description">Goods</div>
                        <div class="text-description">Best Offer</div> --}}
                        <div class="row" style="margin-bottom:2%; width:100%; height:70%;">
                            <div class="col"><div class="circle-players rounded-circle"></div></div>
                            <div class="col">Players</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-gold rounded-circle"></div></div>
                            <div class="col">Gold</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-goods rounded-circle"></div></div>
                            <div class="col">Goods</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" style="margin-bottom:2%;"> --}}
                            <div class="col"><div class="circle-bestoffers rounded-circle"></div></div>
                            <div class="col">Best Offers</div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>

    </div>
</div>



<div id="player" class="tab border-bottom">
    <div id="total">
        <div class="row h-100 w-100">
            <div class="col">

                <div class="total-player">
                    <div class="title-table size3 font-title">
                        Total Player1
                    </div>
                    <div class="content-table size4">
                    <div class="chart-bar">
                        <div class="chart-middle">
                            <div class="gridline">
                                <div class="chart-horzontal">
                                        <div style="width: 30%; background-color:#4072ee;">7</div>
                                        <div style="width: 30%; margin-top:5.8%; background-color:#b558f6;">10</div>
                                        <div style="width: 30%; margin-top:5.8%; background-color:#fec400;">10</div>
                                        <div style="width: 30%; margin-top:5.8%; background-color:#29cb97;">10</div>
                                </div>
                            </div>

                        </div>
                        <div class="explanation">
                            <table width="100%" >
                                <tr>
                                    <td width="5%"><span class="dot1"></span></td>
                                    <td width="10%">Terdaftar</td>
                                    <td width="20%">123</td>
                                </tr>
                                <tr>
                                    <td width="5%"><span class="dot2"></span></td>
                                    <td width="10%">Guest</td>
                                    <td width="20%">123</td>
                                </tr>
                                <tr>
                                    <td width="5%"><span class="dot3"></span></td>
                                    <td width="10%">Online</td>
                                    <td width="20%">123</td>
                                </tr>
                                <tr>
                                    <td width="5%"><span class="dot4"></span></td>
                                    <td width="10%">Ofline</td>
                                    <td width="20%">123</td>
                                </tr>
                            </table>                            
                        </div>
                    </div>
                    </div>
                </div>

                <div class="total-device">
                    <div class="title-table size5 font-title">
                        Total Device
                    </div>
                    <div class="content-table size6">
                        <div class="row no-gutters h-100 w-100">
                            <div class="col">
                                  <div class="figure-content">
                                    <svg width="100%" height="100%" viewBox="0 0 42 42" class="donut" aria-labelledby="beers-title beers-desc" role="img">
                                      <title id="beers-title">Beers in My Cellar</title>
                                      {{-- <desc id="beers-desc">Donut chart showing 10 total beers. Two beers are Imperial India Pale Ales, four beers are Belgian Quadrupels, and three are Russian Imperial Stouts. The last remaining beer is unlabeled.</desc>
                                      <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff" role="presentation"></circle>
                                      <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d2d3d4" stroke-width="3" role="presentation"></circle> --}}

                                      <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ff4e5a" stroke-width="3" stroke-dasharray="50" stroke-dashoffset="0"></circle>

                                      <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#46bbff " stroke-width="3" stroke-dasharray="50" stroke-dashoffset="20"></circle>

                                      <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d9d42c" stroke-width="3" stroke-dasharray="50" stroke-dashoffset="50"></circle>
                                     
                                      <!-- unused 10% -->
                                      <g class="chart-text">
                                        <text x="50%" y="50%" class="chart-number">
                                          100 %
                                        </text>
                                      </g>
                                    </svg>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="row no-gutters w-100 h-100">
                                    <div class="col d-flex flex-column" style="padding-top: 10%">
                                        <div class="text-description" style="font-weight: bold; color: black;">
                                            Detail
                                        </div>
                                        <div class="textdescription" style="padding-top: 20%">Ios</div>
                                        <div class="textdescription" style="padding-top: 20%">Android</div>
                                        <div class="textdescription" style="padding-top: 20%">Desktop</div>

                                    </div>
                                    <div class="col d-flex flex-column" style="padding-top: 10%">
                                        <div class="textdescription">&nbsp;</div>
                                        <div class="textdescription" style="padding-top: 20%">15 %</div>
                                        <div class="textdescription" style="padding-top: 20%">35 %</div>
                                        <div class="textdescription" style="padding-top: 20%">50 %</div>
                                    </div>
                                    <div class="col d-flex flex-column" style="margin-top: 10%">
                                        <div class="textdescription">&nbsp;</div>
                                        <div class="ios" style="margin-top: 20%"></div>
                                        <div class="android" style="margin-top: 20%"></div>
                                        <div class="desktop" style="margin-top: 20%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div id="total1">
            <div class="dashboard-games">
                <div class="game-title">
                    <h3>
                        Total Game Played
                    </h3>
                </div>
                <div class="game-table">
                    @foreach ($gameName as $game)
                        <div class="game-table-detail">
                            {{-- <div class="font-player-total">63 Player</div> --}}
                            <div>
                                @foreach ($rooms as $room)
                                    <p>name : {{$room->harga}} | rooms : {{$room->room_id}}</p>
                                @endforeach
                            </div>
                            <div>
                                <div class="img-gamelogo"><img src="/images/games/{{$game->id}}.png" width="100%" height="90%" alt=""></div>
                                <h4>Asta {{ $game->name }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="total-countryplay">
                    <div class="title-table size8 font-title">
                        Total country player
                    </div>
                    <div class="content-table size6">
                        <div class="map">

                        </div>
                        <div class="countryplayer-description">
                            <div class="row border-bottom border-dark" style="width:80%; margin-left:10%; margin-bottom:5%; margin-top:5%;">
                                <div class="col border-bottom border-dark">Country</div>
                                <div class="col border-bottom border-dark">Player</div>
                            </div>
                            <div class="row border-bottom border-dark" style="width:80%; margin-left:10%; margin-bottom:2%;">
                                <div class="col border-bottom border-dark">Indonesia</div>
                                <div class="col border-bottom border-dark">314</div>
                            </div>  
                            <div class="row border-bottom border-dark" style="width:80%; margin-left:10%; margin-bottom:2%;">
                                <div class="col border-bottom border-dark">Malaysia</div>
                                <div class="col border-bottom border-dark">314</div>
                            </div>   
                            <div class="row border-bottom border-dark" style="width:80%; margin-left:10%; margin-bottom:2%;">
                                <div class="col border-bottom border-dark">Singapore</div>
                                <div class="col border-bottom border-dark">314</div>
                            </div>                           
                        </div>
                    </div>
                    
                </div> --}}


            </div>
    </div>
</div>



<div id="slide-banner" class="tab border-bottom">
    <div id="total3">
        <div class="row h-100 w-100">
            <div class="col">

                <div class="campaign-slide">
                    <div class="title-table size9 font-title">
                        Campaign Slide Banner
                    </div>
                    <div class="content-table size4">
                        <div class="content-slidebanner">
                            <div class="row no-gutters border-bottom border-dark" style="width:90%; margin-left: 5%; padding-bottom:5%; margin-top:5%;">
                                <div class="col" style="width:30%;">
                                    <img src="" alt="">
                                </div>
                                <div class="col" style="width:60%;">
                                    <div class="row no-gutters">
                                        <div class="col">Slide Banner</div>
                                    </div>
                                    <div class="row">
                                        <div class="col" style="font-weight: bold;">Best Offers Gold</div>
                                    </div>
                                </div>
                                <div class="col" style="width:5%; text-align:right; padding-right: 2%;">
                                    <a href=""><i class="fas fa-ellipsis-h fa-2x" style="color:black;"></i></a>
                                </div>
                            </div>
                            <div class="row no-gutters" style="width:90%; margin-left: 5%; margin-top:1%;">
                                <div class="col" style="font-weight: bold;">Total View: 15</div>
                                <div class="col" style="font-weight: bold;" align="right">10 Transactions</div>
                            </div>
                        </div>
                    
                    </div>
                </div>

                <div class="total-dailygift">
                    <div class="title-table size5 font-title">
                        Total Daily Gift
                    </div>
                    <div class="content-table size6">
                        <div class="row no-gutters h-100 w-100">
                            <div class="col">
                                  <div class="figure-content">
                                    <svg width="100%" height="100%" viewBox="0 0 42 42" class="donut" aria-labelledby="beers-title beers-desc" role="img">
                                      <title id="beers-title">Beers in My Cellar</title>
                                      {{-- <desc id="beers-desc">Donut chart showing 10 total beers. Two beers are Imperial India Pale Ales, four beers are Belgian Quadrupels, and three are Russian Imperial Stouts. The last remaining beer is unlabeled.</desc>
                                      <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff" role="presentation"></circle>
                                      <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d2d3d4" stroke-width="3" role="presentation"></circle> --}}

                                      <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#FEC400" stroke-width="3" stroke-dasharray="60" stroke-dashoffset="10"></circle>

                                      <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#007d2a" stroke-width="3" stroke-dasharray="60" stroke-dashoffset="20"></circle>

                                      <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ffffff" stroke-width="3.5" stroke-dasharray="50" stroke-dashoffset="50"></circle>
                                    </svg>
                                  </div>
                            </div>
                            <div class="col">
                                <div class="row no-gutters w-100 h-100">
                                    <div class="col d-flex flex-column" style="padding-top: 10%">
                                        <div class="text-description" style="font-weight: bold; color: black;">
                                            Daily Gift
                                        </div>
                                        <div class="textdescription" style="padding-top: 20%">Chips</div>
                                        <div class="textdescription" style="padding-top: 20%">Gold</div>

                                    </div>
                                    <div class="col d-flex flex-column" style="padding-top: 10%">
                                        <div class="textdescription">&nbsp;</div>
                                        <div class="textdescription" style="padding-top: 20%">15 %</div>
                                        <div class="textdescription" style="padding-top: 20%">35 %</div>
                                    </div>
                                    <div class="col d-flex flex-column" style="margin-top: 10%">
                                        <div class="textdescription">&nbsp;</div>
                                        <div class="chip" style="margin-top: 20%"></div>
                                        <div class="gold" style="margin-top: 20%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>    
</div>




<div id="game" class=" h-100 tab border-bottom">
    <div id="table">
        <div class="total-table">
            <div class="title-table size7 font-title">
                Total table
            </div>
            <div class="content-table size4">

            <div class="content-game">
                <div class="font-player-total d-flex flex-column">
                    <div>30 Player</div> 
                    <div>10 Invoice</div>
                    <div>10 Intermediate</div>
                    <div>10 Pro</div>
                </div>
                <div class="img-gamelogo">
                    <img src="/images/asset/poker.png" width="100%" height="50%" alt="">
                    <div class="font-game-name">Asta Poker</div>
                </div>
            </div>                        
        </div>    
    </div>
</div>

<div id="store" class="tab h-100">
    <div class="title-table size1">
        <div class="row font-title">
            <div class="col" align="center">Total Sale Store</div>
            <div class="col" align="center">Transaction/Payment Store</div>
        </div>
    
    </div>
    <div class="content-table size2">
        <div class="row border w-100 h-100" style="padding-left:10%; text-align:center; margin-left:0%;">
            <div class="col">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col-6" id="svg"> 
                        <svg width="250px" height="250px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="40" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="40" stroke="#007d2a" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="200"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="30" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="30" stroke="#ffaa01" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="50"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="20" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="20" stroke="#0019ff" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="280"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="10" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="10" stroke="#ff6600" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="150"/>{{--ygdipakai--}}
                        </svg>
                    </div>
                    {{-- <div class="col-1 d-flex flex-column" id="svg-description">
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#007d2a" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ffaa01" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#0019ff" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ff6600" />  
                        </svg> 
                    </div> --}}
                    <div class="col" align="left" id="svg-description-text">
                        {{-- <div class="text-description">Chip</div>
                        <div class="text-description">Gold</div>
                        <div class="text-description">Goods</div>
                        <div class="text-description">Best Offer</div> --}}
                        <div class="row" style="margin-bottom:2%; width:100%; height:70%; margin-left:1%;">
                            <div class="col"><div class="circle-chip rounded-circle"></div></div>
                            <div class="col">Chip</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-gold rounded-circle"></div></div>
                            <div class="col">Gold</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-goods rounded-circle"></div></div>
                            <div class="col">Goods</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" style="margin-bottom:2%;"> --}}
                            <div class="col"><div class="circle-bestoffers rounded-circle"></div></div>
                            <div class="col">Best Offers</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row h-100 w-100 no-gutters">
                    <div class="col-6" id="svg">
                        <svg width="250px" height="250px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="40" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="40" stroke="#000000" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="200"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="30" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="30" stroke="#ffaa01" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="50"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="20" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="20" stroke="#0019ff" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="280"/>{{--ygdipakai--}}
                            <circle cx="50" cy="50" r="10" stroke="#e6e6e6" stroke-width="3" fill="#ffffff" stroke-dasharray="251.3" stroke-dashoffset="50"/>
                            <circle cx="50" cy="50" r="10" stroke="#ff6600" stroke-width="3" fill="#ffffff" stroke-dasharray="100" stroke-dashoffset="150"/>{{--ygdipakai--}}
                        </svg>
                    </div>
                    {{-- <div class="col-1 d-flex flex-column" id="svg-description">
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#000000" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ffaa01" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#0019ff" />  
                        </svg> 
                        <svg class="color-description" width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="50" stroke="#ffffff" stroke-width="1" fill="#ff6600" />  
                        </svg> 
                    </div> --}}
                    <div class="col" align="left" id="svg-description-text">
                        {{-- <div class="text-description">Player</div>
                        <div class="text-description">Gold</div>
                        <div class="text-description">Goods</div>
                        <div class="text-description">Best Offer</div> --}}
                        <div class="row" style="margin-bottom:2%; width:100%; height:70%;  margin-left:1%;">
                            <div class="col"><div class="circle-players rounded-circle"></div></div>
                            <div class="col">Players</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-gold rounded-circle"></div></div>
                            <div class="col">Gold</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" tyle="margin-bottom:2%; width:100%;"> --}}
                            <div class="col"><div class="circle-goods rounded-circle"></div></div>
                            <div class="col">Goods</div>
                            <div class="w-100"></div>
                        {{-- </div>
                        <div class="row border border-dark" style="margin-bottom:2%;"> --}}
                            <div class="col"><div class="circle-bestoffers rounded-circle"></div></div>
                            <div class="col">Best Offers</div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>

    </div>
</div>
{{-- end home --}}
</div>
@endsection