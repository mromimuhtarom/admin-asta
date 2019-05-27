{{-- <div class="menu-name">
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
</div> --}}
<a class="has-arrow"   href="index.html" title="Transactions"><span class="fa fa-lg fa-fw fa-money"></span> <span class="menu-item-parent">Transactions</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    <li class="">
        <a   href="{{ route('Banking-view') }}" title="Banking Transaction"> Banking Transaction </a>
    </li>
    <li class="">
        <a   href="{{ route('UserBank-view') }}" title="User Bank Transaction"> User Bank Transaction </a>
    </li>
</ul>