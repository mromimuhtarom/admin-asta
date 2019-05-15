<div class="menu-name">
        SLIDE BANNER
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Slide-Banner/SlideBanner/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('SlideBanner-view') }}" class="{{ Request::is('Slide-Banner/SlideBanner/*') ? 'sidebaritem active' : null }}">Slide Banner</a>
        </li>
    </ul>
</div>