<div class="menu-name">
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
        {{-- <li class="sidebar-item">
            <a href="{{ route('FindRoom-view') }}">Find Room</a>
        </li> --}}
    </ul>
</div>