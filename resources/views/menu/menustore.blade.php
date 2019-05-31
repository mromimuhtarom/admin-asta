@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Store"><span class="fa fa-lg fa-fw fa-cubes"></span> <span class="menu-item-parent">Store</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
    $best_offer = 'Best Offer';
    $role_access = $menu->RoleType1($best_offer);
    $role_acces = $menu->RoleType2($best_offer);
    @endphp
    @if($role_access || $role_acces)
    <li class="{{ Request::is('store/Best-Offer/*') ? 'active' : null }}">
        <a   href="{{ route('BestOffer-view') }}" title="Best Offer"> Best Offer </a>
    </li>
    @endif
    <li class="{{ Request::is('store/Chip-Store/*') ? 'active' : null }}">
        <a   href="{{ route('ChipStore-view') }}" title="Chip Store"> Chip Store </a>
    </li>
    <li class="{{ Request::is('store/Gold-Store/*') ? 'active' : null }}">
        <a   href="{{ route('GoldStore-view') }}" title="Gold Store"> Gold Store </a>
    </li>
    <li class="{{ Request::is('store/Goods-Store/*') ? 'active' : null }}">
        <a   href="{{ route('GoodsStore-view') }}" title="Goods Store"> Goods Store </a>
    </li>
    <li class="{{ Request::is('store/Gift-Store/*') ? 'active' : null }}">
        <a   href="{{ route('GiftStore-view') }}" title="Gift"> Gift </a>
    </li>
    <li class="{{ Request::is('store/Transaction-Store/*') ? 'active' : null }}">
        <a   href="{{ route('TransactionStore-view') }}" title="Transaction Store"> Transaction Store </a>
    </li>
    <li class="{{ Request::is('store/Payment-Store/*') ? 'active' : null }}">
        <a   href="{{ route('PaymentStore-view') }}" title="Payment Store"> Payment Store </a>
    </li>
    <li class="{{ Request::is('store/Report-Store/*') ? 'active' : null }}">
        <a   href="{{ route('ReportStore-view') }}" title="Report Store"> Report Store </a>
    </li>
</ul>