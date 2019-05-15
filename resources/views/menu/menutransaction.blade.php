<div class="menu-name">
        TRANSACTIONS
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Transaction/Banking_Transaction/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('Banking-view') }}" class="{{ Request::is('Transaction/Banking_Transaction/*') ? 'sidebaritem active' : null }}">Banking Transaction</a>
        </li>
        <li class="sidebar-item {{ Request::is('Transaction/User_Banking_Transaction/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('UserBank-view') }}" class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'sidebaritem active' : null }}">User Bank Transaction</a>
        </li>
    </ul>
</div>