<div class="menu-name">
    DAILY GIFT
    <hr>
</div>
<div class="sidebar-menu">
<ul class="sidebar-nav">
    <li class="sidebar-item {{ Request::is('Daily-Gift/Daily-Gift/*') ? 'sidebaritem active' : null }}">
        <a href="{{ route('DailyGift-view') }}" class="{{ Request::is('Daily-Gift/Daily-Gift/*') ? 'sidebaritem active' : null }}">Daily Gift</a>
    </li>
</ul>
</div>