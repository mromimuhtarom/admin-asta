{{-- <div class="menu-name">
        GAME Asta Poker
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Game-Asta-Poker/Table/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Table-view') }}" class="{{ Request::is('Game-Asta-Poker/Table/*') ? 'sidebaritem active' : null }}">Table</a>
        </li>
        <li class="sidebar-item {{ Request::is('Game-Asta-Poker/Category/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Category-view') }}" class="{{ Request::is('Game-Asta-Poker/Category/*') ? 'sidebaritem active' : null }}">Category</a>
        </li>
        <li class="sidebar-item {{ Request::is('Game-Asta-Poker/Season/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Season-view') }}" class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'sidebaritem active' : null }}">Season</a>
        </li>
        <li class="sidebar-item {{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('SeasonReward-view') }}" class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'sidebaritem active' : null }}">Season Reward</a>
        </li>
        <li class="sidebar-item {{ Request::is('Game-Asta-Poker/Tournament/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Tournament-view') }}" class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'sidebaritem active' : null }}">Tournament</a>
        </li>
        <li class="sidebar-item {{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('JackpotPaytable-view') }}" class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'sidebaritem active' : null }}">Jackpot Paytable</a>
        </li>
    </ul>
</div> --}}
<a class="has-arrow"   href="index.html" title="Games"><span class="fa fa-lg fa-fw fa-gamepad"></span> <span class="menu-item-parent">Games</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>

<ul aria-expanded="true" class="sa-sub-nav collapse">
    <!-- GAME ASTA POKER -->
    <li class="{{ Request::is('Game-Asta-Poker/*') ? 'active' : null }}">
        <a   href="" title="Asta Poker"> Asta Poker 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level collapse">
            <li class="{{ Request::is('Game-Asta-Poker/Table/*') ? 'active' : null }}">
                <a   href="{{ route('Table-view') }}" title="Table"><span class="fa fa-table"></span> Table </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Category/*') ? 'active' : null }}">
                <a   href="{{ route('Category-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'active' : null }}">
                <a   href="{{ route('Season-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('SeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('Tournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('JackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
        </ul>
    </li>

    <!-- GAME BIG 2 -->
    <li class="{{ Request::is('Game-Asta-BigTwo/*') ? 'active' : null }}">
        <a   href="" title="Asta Big 2"> Asta Big 2 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-BigTwo/Table/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoTable-view') }}" title="Table"><span class="fa fa-table"></span> Table </a>
            </li>
            <li class="{{ Request::is('Game-Asta-BigTwo/Category/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoCategory-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            <li class="{{ Request::is('Game-Asta-BigTwo/Season/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoSeason-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            <li class="{{ Request::is('Game-Asta-BigTwo/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoSeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            <li class="{{ Request::is('Game-Asta-BigTwo/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoTournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            <li class="{{ Request::is('Game-Asta-BigTwo/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoJackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
        </ul>
    </li>

    <!-- GAME DOMINO SUSUN -->
    <li class="{{ Request::is('Game-Asta-DominoSusun/*') ? 'active' : null }}">
        <a   href="" title="Domino Susun"> Domino Susun 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-DominoSusun/Table/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSTable-view') }}" title="Table"><span class="fa fa-table"></span> Table </a>
            </li>
            <li class="{{ Request::is('Game-Asta-DominoSusun/Category/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSCategory-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSSeason-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSSeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSTournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            <li class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSJackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
        </ul>
    </li>

    <!-- GAME DOMINO QQ -->
    <li class="{{ Request::is('Game-Asta-DominoQQ/*') ? 'active' : null }}">
        <a   href="" title="Domino QQ"> Domino QQ 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-DominoQQ/Table/*') ? 'active' : null }}">
                <a   href="{{ route('DominoQTable-view') }}" title="Table"><span class="fa fa-table"></span> Table </a>
            </li>
            <li class="{{ Request::is('Game-Asta-DominoQQ/Category/*') ? 'active' : null }}">
                <a   href="{{ route('DominoQCategory-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            <li class="{{ Request::is('Game-Asta-DominoQQ/Season/*') ? 'active' : null }}">
                <a   href="{{ route('DominoQSeason-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            <li class="{{ Request::is('Game-Asta-DominoQQ/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('DominoQSeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            <li class="{{ Request::is('Game-Asta-DominoQQ/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('DominoQTournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            <li class="{{ Request::is('Game-Asta-DominoQQ/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('DominoQJackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
        </ul>
    </li>
</ul>