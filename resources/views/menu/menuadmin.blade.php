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
    <li class="">
        <a   href="{{ route('UserAdmin-view') }}" title="User Admin"> User Admin </a>
    </li>
    <li class="">
        <a   href="{{ route('Role-view') }}" title="Role Admin"> Role Admin </a>
    </li>
    <li class="">
        <a   href="{{ route('Log-view') }}" title="Log Admin"> Log Admin </a>
    </li>
</ul>