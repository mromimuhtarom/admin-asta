<div class="menu-name">
        ADMIN
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Admin/User-Admin/*') ? 'submenu-active' : null }}">
            <a href="{{ route('UserAdmin-view') }}">User Admin</a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('Role-view') }}">Role Admin</a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('Log-view') }}">Log Admin</a>
        </li>
    </ul>
</div>