@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Notification"><span class="fa fa-lg fa-fw fa-bell-o"></span> <span class="menu-item-parent">Notification</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
        $Push_Notification = 'Push Notification';
        $role_access28 = $menu->RoleType1($Push_Notification);
        $role_acces28 = $menu->RoleType2($Push_Notification);
    @endphp
    @if($role_access28 || $role_acces28)
    <li class="{{ Request::is('Notification/Push-Notification/*') ? 'active' : null }}">
        <a   href="{{ route('PushNotification-view') }}" title="Push Notification"> Push Notification </a>
    </li>
    @endif
    @php
        $Email_Notification = 'Email Notification';
        $role_access29 = $menu->RoleType1($Email_Notification);
        $role_acces29 = $menu->RoleType2($Email_Notification);
    @endphp
    @if($role_access29 || $role_acces29)
    <li class="{{ Request::is('Notification/Email-Notification/*') ? 'active' : null }}">
        <a   href="{{ route('EmailNotification-view') }}" title="Email Notification"> Email Notification </a>
    </li>
    @endif
</ul>