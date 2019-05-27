{{-- <div class="menu-name">
    DAILY GIFT
    <hr>
</div>
<div class="sidebar-menu">
<ul class="sidebar-nav">
    <li class="sidebar-item {{ Request::is('Daily-Gift/Daily-Gift/*') ? 'sidebaritem active' : null }}">
        <a href="{{ route('DailyGift-view') }}" class="{{ Request::is('Daily-Gift/Daily-Gift/*') ? 'sidebaritem active' : null }}">Daily Gift</a>
    </li>
</ul>
</div> --}}
<a class="has-arrow"   href="index.html" title="Daily Gift"><span class="fa fa-lg fa-fw fa-gift"></span> <span class="menu-item-parent">Daily Gift</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    <li class="{{ Request::is('Daily-Gift/Daily-Gift/*') ? 'active' : null }}">
        <a   href="{{ route('DailyGift-view') }}" title="Daily Gift"> Daily Gift </a>
    </li>
</ul>