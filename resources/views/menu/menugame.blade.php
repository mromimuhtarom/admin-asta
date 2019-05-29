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
    <li class="">
        <a   href="" title="Table"> Table 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-Poker/Table/*') ? 'active' : null }}">
                <a   href="{{ route('Table-view') }}" title="Asta Poker"><span class="fa fa-gamepad"></span> Asta Poker </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Asta Big 2 </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino Susun </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino QQ </a>
            </li>
        </ul>
    </li>
    <li class="">
        <a   href="" title="Category"> Category 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-Poker/Category/*') ? 'active' : null }}">
                <a   href="{{ route('Category-view') }}" title="Asta Poker"><span class="fa fa-gamepad"></span> Asta Poker </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Asta Big 2 </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino Susun </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino QQ </a>
            </li>
        </ul>
    </li>
    <li class="">
        <a   href="" title="Season"> Season 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'active' : null }}">
                <a   href="{{ route('Season-view') }}" title="Asta Poker"><span class="fa fa-gamepad"></span> Asta Poker </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Asta Big 2 </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino Susun </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino QQ </a>
            </li>
        </ul>
    </li>
    <li class="">
        <a   href="" title="Season Reward"> Season Reward 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('SeasonReward-view') }}" title="Asta Poker"><span class="fa fa-gamepad"></span> Asta Poker </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Asta Big 2 </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino Susun </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino QQ </a>
            </li>
        </ul>
    </li>
    <li class="">
        <a   href="" title="Tournament"> Tournament 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('Tournament-view') }}" title="Asta Poker"><span class="fa fa-gamepad"></span> Asta Poker </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Asta Big 2 </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino Susun </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino QQ </a>
            </li>
        </ul>
    </li>
    <li class="">
        <a   href="" title="Jackpot Paytable"> Jackpot Paytable 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            <li class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('JackpotPaytable-view') }}" title="Asta Poker"><span class="fa fa-gamepad"></span> Asta Poker </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Asta Big 2 </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino Susun </a>
            </li>
            <li class=" ">
                <a   href="#" title="Flags"><span class="fa fa-gamepad"></span> Domino QQ </a>
            </li>
        </ul>
    </li>
</ul>