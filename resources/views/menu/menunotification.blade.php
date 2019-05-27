{{-- <div class="menu-name">
        NOTIFICATION
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Notification/Push-Notification/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('PushNotification-view') }}" class="{{ Request::is('Notification/Push-Notification/*') ? 'sidebaritem active' : null }}">Push Notifications</a>
        </li>
        <li class="sidebar-item {{ Request::is('Notification/Email-Notification/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('EmailNotification-view') }}" class="{{ Request::is('Notification/Email-Notification/*') ? 'sidebaritem active' : null }}">Email Notifications</a>
        </li>
    </ul>
</div> --}}
<a class="has-arrow"   href="index.html" title="Notification"><span class="fa fa-lg fa-fw fa-bell-o"></span> <span class="menu-item-parent">Notification</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    <li class="">
        <a   href="{{ route('PushNotification-view') }}" title="Push Notification"> Push Notification </a>
    </li>
    <li class="">
        <a   href="{{ route('EmailNotification-view') }}" title="Email Notification"> Email Notification </a>
    </li>
</ul>