<ul class="metismenu sa-left-menu" id="menu1">
        <li class="{{ Request::is('Dashboard/*') ? 'active' : null }}"><!-- first-level -->
            @include('menu.menuhome')               
        </li>

        <li class="{{ Request::is('Admin/*') ? 'active' : null }}">
            @include('menu.menuadmin')										
        </li>

        <li class="{{ Request::is('Transaction/*') ? 'active' : null }}">
            @include('menu.menutransaction')                    
        </li>

        <li class="{{ Request::is('Players/*') ? 'active' : null }}">
            @include('menu.menuplayer')										
        </li>

        <li class="{{ Request::is('Slide-Banner/*') ? 'active' : null }}">
            @include('menu.menuslide')
        </li>

        <li class="{{ Request::is('Daily-Gift/*') ? 'active' : null }}">
            @include('menu.menugift')
        </li>

        <li class="{{ Request::is('Game-Asta-Poker/*', 'Game-Asta-BigTwo/*', 'Game-Asta-DominoSusun/*','Game-Asta-DominoQQ/*') ? 'active' : null }}">
            @include('menu.menugame')
        </li>

        <li class="{{ Request::is('store/*') ? 'active' : null }}">
            @include('menu.menustore')
        </li>

        <li class="{{ Request::is('Notification/*') ? 'active' : null }}">
            @include('menu.menunotification')
        </li>

        <li class="{{ Request::is('Settings/*') ? 'active' : null }}">
            @include('menu.menusetting')
        </li>
        <li class="{{ Request::is('Settings/*') ? ' active' : null }}">
            <a class="has-arrow"   href="{{ route('logout') }}" title="Log Out"><span class="fa fa-lg fa-fw fa-power-off"></span> <span class="menu-item-parent">Log Out</span> 
                {{-- <b class="collapse-sign">
                    <em class="fa fa-plus-square-o"></em>
                    <em class="fa fa-minus-square-o"></em>
                </b> --}}
            </a>
        </li>
</li>  
</ul>