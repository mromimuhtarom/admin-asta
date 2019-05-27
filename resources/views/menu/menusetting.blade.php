{{-- <div class="menu-name">
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
</ul>
</div> --}}
<a class="has-arrow"   href="index.html" title="Setting"><span class="fa fa-lg fa-fw fa-gears"></span> <span class="menu-item-parent">Settings</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    <li class="{{ Request::is('Settings/General-Setting/*') ? 'active' : null }}">
        <a   href="{{ route('GeneralSetting-view') }}" title="General Settings"> General Settings </a>
    </li>
    <li class="{{ Request::is('Settings/Game-Setting/*') ? 'active' : null }}">
        <a   href="{{ route('GeneralSetting-view') }}" title="Game Settings"> Game Settings </a>
    </li>
</ul>