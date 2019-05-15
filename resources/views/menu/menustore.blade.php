<div class="menu-name">
        STORE
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('store/Best-Offer/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('BestOffer-view') }}" class="{{ Request::is('store/Best-Offer/*') ? 'sidebaritem active' : null }}">Best Offer</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Chip-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('ChipStore-view') }}" class="{{ Request::is('store/Chip-Store/*') ? 'sidebaritem active' : null }}">Chip Store</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Gold-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('GoldStore-view') }}" class="{{ Request::is('store/Gold-Store/*') ? 'sidebaritem active' : null }}">Gold Store</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Goods-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('GoodsStore-view') }}" class="{{ Request::is('store/Goods-Store/*') ? 'sidebaritem active' : null }}">Goods Store</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Gift-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('GiftStore-view') }}" class="{{ Request::is('store/Gift-Store/*') ? 'sidebaritem active' : null }}">Gift</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Transaction-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('TransactionStore-view') }}"  class="{{ Request::is('store/Transaction-Store/*') ? 'sidebaritem active' : null }}">Transaction Store</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Payment-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('PaymentStore-view') }}" class="{{ Request::is('store/Payment-Store/*') ? 'sidebaritem active' : null }}">Payments Store</a>
        </li>
        <li class="sidebar-item {{ Request::is('store/Report-Store/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('ReportStore-view') }}" class="{{ Request::is('store/Report-Store/*') ? 'sidebaritem active' : null }}">Report Store</a>
        </li>
    </ul>
</div>