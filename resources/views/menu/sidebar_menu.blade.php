<ul class="metismenu sa-left-menu" id="menu1">
        @foreach( $adm_menu as $mnu)    
        {{-- menu  --}}
        @if (DB::table('asta_db.adm_menu')->where('parent_id', '=', $mnu->menu_id)->where('status', '=', 1)->first())
            <li class="{{ Request::is($mnu->route.'/*') ? 'active' : null }}"><!-- first-level -->
                <a class="has-arrow"   href="" title="Admin"><span class="fa fa-lg fa-fw {{ $mnu->icon }}"></span> <span class="menu-item-parent">{{ $mnu->name }}</span> 
                    <b class="collapse-sign">
                        <em class="fa fa-plus-square-o"></em>
                        <em class="fa fa-minus-square-o"></em>
                    </b>
                </a> 
    
                {{-- submenu --}}
                <ul aria-expanded="true" class="sa-sub-nav collapse">
                    @foreach (DB::table('asta_db.adm_menu')->where('parent_id', '=', $mnu->menu_id)->where('status', '=', 1)->get() as $sb)

                        @if (DB::table('asta_db.adm_menu')->where('parent_id', '=', $sb->menu_id)->where('status', '=', 1)->first())
                            <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                                <a href="" title="{{ $sb->name }}"> {{ $sb->name }}
                                    <b class="collapse-sign">
                                        <em class="fa fa-plus-square-o"></em>
                                        <em class="fa fa-minus-square-o"></em>
                                    </b>
                                </a>
                                    
                                    {{-- submenu kedua --}}
                                    @foreach (DB::table('asta_db.adm_menu')->where('parent_id', '=', $sb->menu_id)->where('status', '=', 1)->get() as $smk)
                                    <ul aria-expanded="true" class="sa-sub-nav-second-level">                    
                                        <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/'.$smk->route.'/*') ? 'active' : null }}">
                                            <a   href="{{ route($smk->route) }}" title="{{ $smk->name }}"> {{ $smk->name }} </a>
                                        </li>
                                    </ul>                    
                                    @endforeach
                            </li>
                        @else 
    
                        {{-- tidak memiliki submenu kedua --}}
                            <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                                <a   href="{{ route($sb->route) }}" title="{{ $sb->name }}"> {{ $sb->name }}</a>                         
                            </li>
                        @endif
                    @endforeach
                </ul>
                 
            </li> 
        @else 
        
        {{-- tidak memiliki submenu --}}
        <li class="{{ Request::is($mnu->route.'/*') ? ' active' : null }}">
            <a class="has-arrow" href="{{ route($mnu->route) }}" title="Admin"><span class="fa fa-lg fa-fw {{ $mnu->icon }}"></span> <span class="menu-item-parent">{{ $mnu->name }}</span>  </a>
        </li>
        @endif
        @endforeach
</ul>





