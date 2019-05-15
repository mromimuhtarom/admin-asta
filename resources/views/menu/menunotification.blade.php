<div class="menu-name">
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
</div>