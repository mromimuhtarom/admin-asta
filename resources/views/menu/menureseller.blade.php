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
    @php
        $list_reseller = 'List Reseller';
        $role_access51 = $menu->RoleType1($list_reseller);
        $role_acces51 = $menu->RoleType2($list_reseller);
    @endphp
    @if($role_access51 || $role_acces51)
    <li class="{{ Request::is('Reseller/List-Reseller/*') ? 'active' : null }}">
        <a href="{{ route('ListReseller-view') }}" title="List Reseller"> Reseller </a>
    </li>
    @endif
    {{-- @php
        $User_Bank_Transaction = 'User Bank Transaction';
        $role_access50 = $menu->RoleType1($User_Bank_Transaction);
        $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Reseller Transaction </a>
    </li>
    {{-- @endif --}}
    @php
    $reseller_rank = 'Reseller Rank';
    $role_access53 = $menu->RoleType1($reseller_rank);
    $role_acces53 = $menu->RoleType2($reseller_rank);
    @endphp
    @if($role_access53 || $role_acces53)
    <li class="{{ Request::is('Reseller/Reseller-Rank/*') ? 'active' : null }}">
        <a href="{{ route('ResellerRank-view') }}" title="User Bank Transaction"> Reseller Rank </a>
    </li>
    @endif
        {{--@php
    $User_Bank_Transaction = 'User Bank Transaction';
    $role_access50 = $menu->RoleType1($User_Bank_Transaction);
    $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Balance Reseller </a>
    </li>
    {{-- @endif --}}
           {{--@php
    $User_Bank_Transaction = 'User Bank Transaction';
    $role_access50 = $menu->RoleType1($User_Bank_Transaction);
    $role_acces50 = $menu->RoleType2($User_Bank_Transaction);
    @endphp
    @if($role_access50 || $role_acces50) --}}
    <li class="{{ Request::is('Transaction/User_Banking_Transaction/*') ? 'active' : null }}">
        <a href="{{ route('UserBank-view') }}" title="User Bank Transaction"> Register Reseller </a>
    </li>
    {{-- @endif --}}
</ul>