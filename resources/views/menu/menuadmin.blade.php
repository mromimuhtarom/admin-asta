{{-- <div class="menu-name">
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
</div> --}}
<a class="has-arrow"   href="index.html" title="Admin"><span class="fa fa-lg fa-fw fa-user"></span> <span class="menu-item-parent">Admin</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
        $User_Admin = 'User Admin';
        $role_access1 = $menu->RoleType1($User_Admin);
        $role_acces1 = $menu->RoleType2($User_Admin);
    @endphp
    @if($role_access1 || $role_acces1)
    <li class="{{ Request::is('Admin/User-Admin/*') ? 'active' : null }}">
        <a   href="{{ route('UserAdmin-view') }}" title="User Admin"> User Admin </a>
    </li>
    @endif
    @php
        $Role_Admin = 'Role Admin';
        $role_access2 = $menu->RoleType1($Role_Admin);
        $role_acces2 = $menu->RoleType2($Role_Admin);
    @endphp
    @if($role_access2 || $role_acces2)
    <li class="{{ Request::is('Admin/Role-Admin/*') ? 'active' : null }}">
        <a   href="{{ route('Role-view') }}" title="Role Admin"> Role Admin </a>
    </li>
    @endif
    @php
        $Log_Admin = 'Log Admin';
        $role_access3 = $menu->RoleType1($Log_Admin);
        $role_acces3 = $menu->RoleType2($Log_Admin);
    @endphp
    @if($role_access3 || $role_acces3)
    <li class="{{ Request::is('Admin/Log-Admin/*') ? 'active' : null }}">
        <a   href="{{ route('Log-view') }}" title="Log Admin"> Log Admin </a>
    </li>
    @endif
</ul>