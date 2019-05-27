    {{-- <!-- second-level -->
    <li class="active">
        <a   href="index.html" title="Analytics Dashboard"> Analytics Dashboard </a>

    </li><!-- second-level -->
    <li class="">
        <a   href="dashboard-marketing.html" title="Marketing Dashboard"> Marketing Dashboard </a>

    </li><!-- second-level -->
    <li class="">
        <a   href="dashboard-social.html" title="Social Wall"> Social Wall </a>

    </li>  --}}
    <a class="has-arrow"   href="{{ route('home') }}" title="Dashboard"><span class="fa fa-lg fa-fw fa-home"></span> <span class="menu-item-parent">Dashboard</span> 
        <b class="collapse-sign">
            <em class="fa fa-plus-square-o"></em>
            <em class="fa fa-minus-square-o"></em>
        </b>
    </a>
    <ul aria-expanded="true" class="sa-sub-nav collapse">
        <!-- second-level -->
        <li class="active">
            <a   href="{{ route('home') }}" title="Analytics Dashboard"> Analytics Dashboard </a>
    
        </li><!-- second-level -->
        <li class="">
            <a   href="dashboard-marketing.html" title="Marketing Dashboard"> Marketing Dashboard </a>
    
        </li><!-- second-level -->
        <li class="">
            <a   href="dashboard-social.html" title="Social Wall"> Social Wall </a>
    
        </li>      
    </ul>