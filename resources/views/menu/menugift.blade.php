@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Daily Gift"><span class="fa fa-lg fa-fw fa-gift"></span> <span class="menu-item-parent">Daily Gift</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
        $Daily_Gift = 'Daily Gift';
        $role_access27 = $menu->RoleType1($Daily_Gift);
        $role_acces27 = $menu->RoleType2($Daily_Gift);
    @endphp
    @if($role_access27 || $role_acces27)
    <li class="{{ Request::is('Daily-Gift/Daily-Gift/*') ? 'active' : null }}">
        <a   href="{{ route('DailyGift-view') }}" title="Daily Gift"> Daily Gift </a>
    </li>
    @endif
</ul>