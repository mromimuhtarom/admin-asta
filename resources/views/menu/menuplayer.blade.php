<div class="menu-name">
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
</div>