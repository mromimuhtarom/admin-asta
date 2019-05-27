{{-- <div class="menu-name">
        SLIDE BANNER
        <hr>
</div>
<div class="sidebar-menu">
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::is('Slide-Banner/SlideBanner/*') ? 'sidebaritem active' : null }}">
            <a href="{{ route('SlideBanner-view') }}" class="{{ Request::is('Slide-Banner/SlideBanner/*') ? 'sidebaritem active' : null }}">Slide Banner</a>
        </li>
    </ul>
</div> --}}
<a class="has-arrow"   href="index.html" title="Slide Banner"><span class="fa fa-lg fa-fw fa-flag"></span> <span class="menu-item-parent">Slide Banner</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    <li class="">
        <a   href="{{ route('SlideBanner-view') }}" title="Slide Banner"> Slide Banner </a>
    </li>
</ul>