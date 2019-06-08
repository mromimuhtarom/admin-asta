@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Players"><span class="fa fa-lg fa-fw fa-group"></span> <span class="menu-item-parent">Players</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
        $Active_Players = 'Active Players';
        $role_access30 = $menu->RoleType1($Active_Players);
        $role_acces30 = $menu->RoleType2($Active_Players);
    @endphp
    @if($role_access30 || $role_acces30)
    <li class="{{ Request::is('Players/Active-Players/*') ? 'active' : null }}">
        <a   href="{{ route('Active-view') }}" title="Active Player"> Active Player </a>
    </li>
    @endif
    @php
        $High_Rollers	 = 'Report Player';
        $role_access31 = $menu->RoleType1($High_Rollers);
        $role_acces31 = $menu->RoleType2($High_Rollers);
    @endphp
    @if($role_access31 || $role_acces31)
    <li class="{{ Request::is('Players/Report-Player/*') ? 'active' : null }}">
        <a   href="{{ route('ReportPlayer-view') }}" title="High Rollers"> Report Player </a>
    </li>
    @endif
    @php
        $High_Rollers	 = 'High Rollers';
        $role_access31 = $menu->RoleType1($High_Rollers);
        $role_acces31 = $menu->RoleType2($High_Rollers);
    @endphp
    @if($role_access31 || $role_acces31)
    <li class="{{ Request::is('Players/High-Roller/*') ? 'active' : null }}">
        <a   href="{{ route('HighRoller-view') }}" title="High Rollers"> High Rollers </a>
    </li>
    @endif
    @php
        $Registered_Player	 = 'Registered Player';
        $role_access32 = $menu->RoleType1($Registered_Player);
        $role_acces32 = $menu->RoleType2($Registered_Player);
    @endphp
    @if($role_access32 || $role_acces32)
    <li class="{{ Request::is('Players/Registered-Player/*') ? 'active' : null }}">
        <a   href="{{ route('RegisteredPlayer-view') }}" title="Registered Player"> Registered Player </a>
    </li>
    @endif
    @php
        $Guest	 = 'Guest';
        $role_access33 = $menu->RoleType1($Guest);
        $role_acces33 = $menu->RoleType2($Guest);
    @endphp
    @if($role_access33 || $role_acces33)
    <li class="{{ Request::is('Players/Guest/*') ? 'active' : null }}">
        <a   href="{{ route('Guest-view') }}" title="Guest"> Guest </a>
    </li>
    @endif
    @php
        $Bots	 = 'Bots';
        $role_access34 = $menu->RoleType1($Bots);
        $role_acces34 = $menu->RoleType2($Bots);
    @endphp
    @if($role_access34 || $role_acces34)
    <li class="{{ Request::is('Players/Bots/*') ? 'active' : null }}">
        <a   href="{{ route('Bots-view') }}" title="Bots"> Bots </a>
    </li>
    @endif
    @php
        $Report	 = 'Play Report';
        $role_access35 = $menu->RoleType1($Report);
        $role_acces35 = $menu->RoleType2($Report);
    @endphp
    @if($role_access35 || $role_acces35)
    <li class="{{ Request::is('Players/PlayReport/*') ? 'active' : null }}">
        <a   href="{{ route('PlayReport-view') }}" title="Report">Play Report </a>
    </li>
    @endif
    @php
        $Chip_Player	 = 'Chip Player';
        $role_access36 = $menu->RoleType1($Chip_Player);
        $role_acces36 = $menu->RoleType2($Chip_Player);
    @endphp
    @if($role_access36 || $role_acces36)
    <li class="{{ Request::is('Players/Chip-Player/*') ? 'active' : null }}">
        <a   href="{{ route('Chip-view') }}" title="Chip Player"> Chip Player </a>
    </li>
    @endif
    @php
        $Gold_Player	 = 'Gold Player';
        $role_access37 = $menu->RoleType1($Gold_Player);
        $role_acces37 = $menu->RoleType2($Gold_Player);
    @endphp
    @if($role_access37 || $role_acces37)
    <li class="{{ Request::is('Players/Gold-Player/*') ? 'active' : null }}">
        <a   href="{{ route('Gold-view') }}" title="Gold Player"> Gold Player </a>
    </li>
    @endif
</ul>