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




