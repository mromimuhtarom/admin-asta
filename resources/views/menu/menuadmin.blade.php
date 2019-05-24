<div class="menu-name">
        ADMIN
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="{{ Request::is('Admin/User-Admin/*') ? 'sidebaritem' : null }} sidebar-item">
            <a href="{{ route('UserAdmin-view') }}" class=" h-100 w-100">User Admin</a>
        </li>
        <li class="sidebar-item {{ Request::is('Admin/Role-Admin/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Role-view') }}" class="{{ Request::is('Admin/Role-Admin/*') ? 'sidebaritem active' : null }}">Role Admin</a>
        </li>
        <li class="sidebar-item {{ Request::is('Admin/Log-Admin/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Log-view') }}" class="{{ Request::is('Admin/Log-Admin/*') ? 'sidebaritem active' : null }}">Log Admin</a>
        </li>
    </ul>
</div>