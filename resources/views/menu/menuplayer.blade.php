{{-- <div class="menu-name">
        PLAYERS
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Players/Active-Players/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Active-view') }}" class="{{ Request::is('Players/Active-Players/*') ? 'sidebaritem active' : null }}">Active Player</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/High-Roller/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('HighRoller-view') }}" class="{{ Request::is('Players/High-Roller/*') ? 'sidebaritem active' : null }}">High Rollers</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/Registered-Player/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('RegisteredPlayer-view') }}" class="{{ Request::is('Players/Registered-Player/*') ? 'sidebaritem active' : null }}">Registered Player</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/Guest/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Guest-view') }}" class="{{ Request::is('Players/Guest/*') ? 'sidebaritem active' : null }}">Guest</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/Bots/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Bots-view') }}" class="{{ Request::is('Players/Bots/*') ? 'sidebaritem active' : null }}">Bots</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/Report/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Report-view') }}" class="{{ Request::is('Players/Report/*') ? 'sidebaritem active' : null }}">Report</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/Chip-Player/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Chip-view') }}" class="{{ Request::is('Players/Chip-Player/*') ? 'sidebaritem active' : null }}">Chip Player</a>
        </li>
        <li class="sidebar-item {{ Request::is('Players/Gold-Player/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Gold-view') }}" class="{{ Request::is('Players/Gold-Player/*') ? 'sidebaritem active' : null }}">Gold Player</a>
        </li>
    </ul>
</div> --}}
<a class="has-arrow"   href="index.html" title="Players"><span class="fa fa-lg fa-fw fa-group"></span> <span class="menu-item-parent">Players</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    <li class="">
        <a   href="{{ route('Active-view') }}" title="Active Player"> Active Player </a>
    </li>
    <li class="">
        <a   href="{{ route('HighRoller-view') }}" title="High Rollers"> High Rollers </a>
    </li>
    <li class="">
        <a   href="{{ route('RegisteredPlayer-view') }}" title="Registered Player"> Registered Player </a>
    </li>
    <li class="">
        <a   href="{{ route('Guest-view') }}" title="Guest"> Guest </a>
    </li>
    <li class="">
        <a   href="{{ route('Bots-view') }}" title="Bots"> Bots </a>
    </li>
    <li class="">
        <a   href="{{ route('Report-view') }}" title="Report"> Report </a>
    </li>
    <li class="">
        <a   href="{{ route('Chip-view') }}" title="Chip Player"> Chip Player </a>
    </li>
    <li class="">
        <a   href="{{ route('Gold-view') }}" title="Gold Player"> Gold Player </a>
    </li>
</ul>