<div class="menu-name">
    SETTINGS
    <hr>
</div>
<div class="sidebar-menu">
<ul class="sidebar-nav">
    <li class="sidebar-item {{ Request::is('Settings/General-Setting/*') ? 'sidebaritem active' : null }}">
        <a href="{{ route('GeneralSetting-view') }}" class="{{ Request::is('Settings/General-Setting/*') ? 'sidebaritem active' : null }}">General Settings</a>
    </li>
    <li class="sidebar-item {{ Request::is('Settings/Game-Setting/*') ? 'sidebaritem active' : null }}">
        <a href="{{ route('GameSetting-view') }}" class="{{ Request::is('Settings/Game-Setting/*') ? 'sidebaritem active' : null }}">Game Settings</a>
    </li>
    <li class="sidebar-item {{ Request::is('Settings/Admin-Setting/*') ? 'sidebaritem active' : null }}">
        <a href="{{ route('AdminSetting-view') }}" class="{{ Request::is('Settings/Admin-Setting/*') ? 'sidebaritem active' : null }}">Admin Settings</a>
    </li>
</ul>
</div>