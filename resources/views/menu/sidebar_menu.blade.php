@php
use App\Classes\MenuClass;
use App\MenuName;
$adm_menu = DB::table('asta_db.adm_menu')->where('status', '=', 1)->where('parent_id', '=', 0)->get();
@endphp

<ul class="metismenu sa-left-menu" id="menu1">
    @foreach( $adm_menu as $mnu)
    @php
    $iconplus = DB::table('asta_db.adm_menu')->where('parent_id', '=', $mnu->menu_id)->where('status', '=', 1)->first();
    @endphp
    @if ($iconplus)
        <li class="{{ Request::is($mnu->route.'/*') ? 'active' : null }}"><!-- first-level -->
            <a class="has-arrow"   href="" title="Admin"><span class="fa fa-lg fa-fw {{ $mnu->icon }}"></span> <span class="menu-item-parent">{{ $mnu->name }}</span> 
                {{-- @if ($iconplus) --}}
                <b class="collapse-sign">
                    <em class="fa fa-plus-square-o"></em>
                    <em class="fa fa-minus-square-o"></em>
                </b>
                {{-- @endif --}}
            </a> 
            @php 
            $sub = DB::table('asta_db.adm_menu')->where('parent_id', '=', $mnu->menu_id)->where('status', '=', 1)->get();
            @endphp
            <ul aria-expanded="true" class="sa-sub-nav collapse">
                @foreach ($sub as $sb)
                    @php
                    $sb2 = DB::table('asta_db.adm_menu')->where('parent_id', '=', $sb->menu_id)->where('status', '=', 1)->first();
                    @endphp
                    @if ($sb2)
                        <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                            <a href="" title="{{ $sb->name }}"> {{ $sb->name }}
                                <b class="collapse-sign">
                                    <em class="fa fa-plus-square-o"></em>
                                    <em class="fa fa-minus-square-o"></em>
                                </b>
                            </a>
                            @php 
                            $submenukedua = DB::table('asta_db.adm_menu')->where('parent_id', '=', $sb->menu_id)->where('status', '=', 1)->get();
                            @endphp
                            
                                @foreach ($submenukedua as $smk)
                                <ul aria-expanded="true" class="sa-sub-nav-second-level">                    
                                    <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/'.$smk->route.'/*') ? 'active' : null }}">
                                        <a   href="{{ route($smk->route) }}" title="{{ $smk->name }}"> {{ $smk->name }} </a>
                                    </li>
                                </ul>                    
                                @endforeach
                            
    
                        </li>
                    @else 
                        <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                            <a   href="{{ route($sb->route) }}" title="{{ $sb->name }}"> {{ $sb->name }}</a>                         
                        </li>
                    @endif
                @endforeach
            </ul>
             
        </li> 
    @else 
    <li class="{{ Request::is('Settings/*') ? ' active' : null }}">
        <a class="has-arrow" href="{{ route($mnu->route) }}" title="Admin"><span class="fa fa-lg fa-fw {{ $mnu->icon }}"></span> <span class="menu-item-parent">{{ $mnu->name }}</span>  </a>
    </li>
    @endif
    @endforeach
</ul>




{{-- <ul class="metismenu sa-left-menu" id="menu1">
        <li class="{{ Request::is('Dashboard/*') ? 'active' : null }}"><!-- first-level -->
             @include('menu.menuhome')
        </li>

        <li class="{{ Request::is('Admin/*') ? 'active' : null }}">
            @include('menu.menuadmin')										
        </li>
        Transaction<li class="{{ Request::is('Transaction/*') ? 'active' : null }}">
            @include('menu.menutransaction')                    
        </li> 
        <li class="{{ Request::is('Players/*') ? 'active' : null }}">
            @include('menu.menuplayer')										
        </li>

        <li class="{{ Request::is('Slide_Banner/*') ? 'active' : null }}">
            @include('menu.menuslide')
        </li>

        <li class="{{ Request::is('Daily-Gift/*') ? 'active' : null }}">
            @include('menu.menugift')
        </li>

        <li class="{{ Request::is('Game/*', 'Game-Asta-BigTwo/*', 'Game-Asta-DominoSusun/*','Game-Asta-DominoQQ/*') ? 'active' : null }}">
            @include('menu.menugame')
        </li>

        <li class="{{ Request::is('Store/*') ? 'active' : null }}">
            @include('menu.menustore')
        </li>

        <li class="{{ Request::is('Notification/*') ? 'active' : null }}">
            @include('menu.menunotification')
        </li>

        <li class="{{ Request::is('Settings/*') ? 'active' : null }}">
            @include('menu.menusetting')
        </li>

        <li class="{{ Request::is('Reseller/*') ? 'active' : null }}">
            @include('menu.menureseller')
        </li>

        <li class="{{ Request::is('Settings/*') ? ' active' : null }}">
            <a class="has-arrow"   href="{{ route('logout') }}" title="Log Out"><span class="fa fa-lg fa-fw fa-power-off"></span> <span class="menu-item-parent">Log Out</span> 

            </a>
        </li>
</li>  
</ul> --}}