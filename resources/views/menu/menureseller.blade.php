@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Transactions"><span class="fa fa-lg fa-fw fa-suitcase"></span> <span class="menu-item-parent">Reseller</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    {{-- @php
        $Banking_transaction = 'Banking transaction';
        $role_access49 = $menu->RoleType1($Banking_transaction);
        $role_acces49 = $menu->RoleType2($Banking_transaction);
    @endphp
    @if($role_access49 || $role_acces49) --}}
    <li class="{{ Request::is('Transaction/Banking_Transaction/*') ? 'active' : null }}">
        <a   href="{{ route('Banking-view') }}" title="Banking Transaction"> Reseller </a>
    </li>
    {{-- @endif
    @php
        $User_Bank_Transaction = 'User Bank Transaction';
        $role_access50 = $menu->RoleType1($User_Bank_Transaction);
        $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a   href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Reseller Transaction </a>
    </li>
    {{-- @endif --}}
    {{--@php
    $User_Bank_Transaction = 'User Bank Transaction';
    $role_access50 = $menu->RoleType1($User_Bank_Transaction);
    $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a   href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Reseller Rank </a>
    </li>
    {{-- @endif --}}
        {{--@php
    $User_Bank_Transaction = 'User Bank Transaction';
    $role_access50 = $menu->RoleType1($User_Bank_Transaction);
    $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a   href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Balance Reseller </a>
    </li>
    {{-- @endif --}}
           {{--@php
    $User_Bank_Transaction = 'User Bank Transaction';
    $role_access50 = $menu->RoleType1($User_Bank_Transaction);
    $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a   href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Register Reseller </a>
    </li>
    {{-- @endif --}}
</ul>