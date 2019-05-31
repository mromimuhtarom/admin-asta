@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Setting"><span class="fa fa-lg fa-fw fa-gears"></span> <span class="menu-item-parent">Settings</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
        $General_Settings	 = 'General Settings';
        $role_access38 = $menu->RoleType1($General_Settings);
        $role_acces38 = $menu->RoleType2($General_Settings);
    @endphp
    @if($role_access38 || $role_acces38)
    <li class="{{ Request::is('Settings/General-Setting/*') ? 'active' : null }}">
        <a   href="{{ route('GeneralSetting-view') }}" title="General Settings"> General Settings </a>
    </li>
    @endif
    {{-- @php
        $Gold_Player	 = 'Gold Player';
        $role_access39 = $menu->RoleType1($Gold_Player);
        $role_acces39 = $menu->RoleType2($Gold_Player);
    @endphp
    @if($role_access39 || $role_acces39) --}}
    <li class="{{ Request::is('Settings/Game-Setting/*') ? 'active' : null }}">
        <a   href="{{ route('GeneralSetting-view') }}" title="Game Settings"> Game Settings </a>
    </li>
    {{-- @endif --}}
</ul>