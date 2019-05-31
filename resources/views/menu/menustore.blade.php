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
        $role_access41 = $menu->RoleType1($best_offer);
        $role_acces41 = $menu->RoleType2($best_offer);
    @endphp
    @if($role_access41 || $role_acces41)
    <li class="{{ Request::is('store/Best-Offer/*') ? 'active' : null }}">
        <a   href="{{ route('BestOffer-view') }}" title="Best Offer"> Best Offer </a>
    </li>
    @endif
    @php
        $Chip_Store = 'Chip Store';
        $role_access42 = $menu->RoleType1($best_offer);
        $role_acces42 = $menu->RoleType2($best_offer);
    @endphp
    @if($role_access42 || $role_acces42)
    <li class="{{ Request::is('store/Chip-Store/*') ? 'active' : null }}">
        <a   href="{{ route('ChipStore-view') }}" title="Chip Store"> Chip Store </a>
    </li>
    @endif
    @php
        $Gold_Store = 'Gold Store';
        $role_access43 = $menu->RoleType1($Gold_Store);
        $role_acces43 = $menu->RoleType2($Gold_Store);
    @endphp
    @if($role_access43 || $role_acces43)
    <li class="{{ Request::is('store/Gold-Store/*') ? 'active' : null }}">
        <a   href="{{ route('GoldStore-view') }}" title="Gold Store"> Gold Store </a>
    </li>
    @endif
    @php
        $Goods_Store = 'Goods Store';
        $role_access44 = $menu->RoleType1($Goods_Store);
        $role_acces44 = $menu->RoleType2($Goods_Store);
    @endphp
    @if($role_access44 || $role_acces44)
    <li class="{{ Request::is('store/Goods-Store/*') ? 'active' : null }}">
        <a   href="{{ route('GoodsStore-view') }}" title="Goods Store"> Goods Store </a>
    </li>
    @endif
    @php
        $Gift = 'Gift';
        $role_access45 = $menu->RoleType1($Gift);
        $role_acces45 = $menu->RoleType2($Gift);
    @endphp
    @if($role_access45 || $role_acces45)
    <li class="{{ Request::is('store/Gift-Store/*') ? 'active' : null }}">
        <a   href="{{ route('GiftStore-view') }}" title="Gift"> Gift </a>
    </li>
    @endif
    @php
        $Transaction_Store = 'Transaction_Store';
        $role_access46 = $menu->RoleType1($Transaction_Store);
        $role_acces46 = $menu->RoleType2($Transaction_Store);
    @endphp
    @if($role_access46 || $role_acces46)
    <li class="{{ Request::is('store/Transaction-Store/*') ? 'active' : null }}">
        <a   href="{{ route('TransactionStore-view') }}" title="Transaction Store"> Transaction Store </a>
    </li>
    @endif
    @php
        $Payment_Store = 'Payment Store';
        $role_access47 = $menu->RoleType1($Payment_Store);
        $role_acces47 = $menu->RoleType2($Payment_Store);
    @endphp
    @if($role_access47 || $role_acces47)
    <li class="{{ Request::is('store/Payment-Store/*') ? 'active' : null }}">
        <a   href="{{ route('PaymentStore-view') }}" title="Payment Store"> Payment Store </a>
    </li>
    @endif
    @php
        $Report_Store = 'Report Store';
        $role_access48 = $menu->RoleType1($Report_Store);
        $role_acces48 = $menu->RoleType2($Report_Store);
    @endphp
    @if($role_access48 || $role_acces48)
    <li class="{{ Request::is('store/Report-Store/*') ? 'active' : null }}">
        <a   href="{{ route('ReportStore-view') }}" title="Report Store"> Report Store </a>
    </li>
    @endif
</ul>