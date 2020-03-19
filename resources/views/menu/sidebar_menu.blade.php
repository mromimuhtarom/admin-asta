<ul class="metismenu sa-left-menu" id="menu1" >
        @foreach( $adm_menu as $mnu)    
        {{-- menu  --}}
        @if(!$mnu['children']->isEMPTY())
        @if($menuname->RoleType1($mnu->name) || $menuname->RoleType2($mnu->name))
            <li class="{{ Request::is($mnu->route.'/*') ? 'active' : null }}"><!-- first-level -->
                <a class="has-arrow"   href="#" title="Admin"> <span class="fa fa-lg fa-fw {{ $mnu->icon }}"></span> <span class="menu-item-parent">{{ translate_menu($mnu->name) }}</span>
                    <b class="collapse-sign">
                        <em class="fa fa-plus-square-o"></em>
                        <em class="fa fa-minus-square-o"></em>
                    </b>
                </a> 
    
                {{-- submenu --}}
                <ul aria-expanded="true" class="sa-sub-nav collapse">
                    @foreach ($mnu['children'] as $sb)

                        @if(!$sb['children']->isEMPTY())
                        @if($menuname->RoleType1($sb->name) || $menuname->RoleType2($sb->name))
                            <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                                <a href="#" title="{{ translate_menu($sb->name) }}"> {{ translate_menu($sb->name) }}
                                    <b class="collapse-sign">
                                        <em class="fa fa-plus-square-o"></em>
                                        <em class="fa fa-minus-square-o"></em>
                                    </b>
                                </a>
                                    
                                    {{-- submenu kedua --}}
                                    @foreach ($sb['children'] as $smk)
                                    <ul aria-expanded="true" class="sa-sub-nav-second-level">   
                                        @if(!$smk['children']->isEMPTY())
                                            <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                                                <a href="#" title="{{ translate_menu($smk->name) }}"> {{ translate_menu($smk->name) }}
                                                    <b class="collapse-sign">
                                                        <em class="fa fa-plus-square-o"></em>
                                                        <em class="fa fa-minus-square-o"></em>
                                                    </b>
                                                </a>
                                                    
                                                {{-- submenu ketiga --}}
                                                @foreach ($smk['children'] as $sme)
                                                    <ul aria-expanded="true" class="sa-nav-forth-level">   
                                                        @if($menuname->RoleType1($sme->name) || $menuname->RoleType2($sme->name))                 
                                                        <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/'.$smk->route.'/'.$sme->route.'/*') ? 'active' : null }}">
                                                            <a href="{{ route($sme->route) }}" title="{{ translate_menu($sme->name) }}"> {{ translate_menu($sme->name) }}</a> 
                                                        </li>
                                                        @endif
                                                    </ul>                    
                                                @endforeach
                                                {{-- end sub menu ketiga --}}
                                            </li>
                                            
                                        @else 
                                            @if($menuname->RoleType1($smk->name) || $menuname->RoleType2($smk->name))                 
                                            <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/'.$smk->route.'/*') ? 'active' : null }}">
                                                <a href="{{ route($smk->route) }}" title="{{ translate_menu($smk->name) }}"> {{ translate_menu($smk->name) }}</a> 
                                            </li>
                                            @endif
                                        @endif
                                    </ul>                    
                                    @endforeach
                                    {{-- end sub menu kedua --}}
                            </li>
                        @endif
                        @else 
                        {{-- tidak memiliki submenu kedua --}}
                            @if ($menuname->RoleType1($sb->name) || $menuname->RoleType2($sb->name))
                            @if($sb->name === 'Abuse Transaction Report')
                                <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                                    <a   href="{{ route($sb->route) }}" title="{{ translate_menu($sb->name) }}"> 
                                        {{ translate_menu($sb->name) }} 
                                        @if($transaction_report_read->hitung !== 0)
                                            <span class="badge bg-red pull-right inbox-badge">{{ $transaction_report_read->hitung }}</span>
                                        @endif
                                    </a>                         
                                </li>
                            @else 
                                <li class="{{ Request::is($mnu->route.'/'.$sb->route.'/*') ? 'active' : null }}">
                                    <a   href="{{ route($sb->route) }}" title="{{ translate_menu($sb->name) }}"> {{ translate_menu($sb->name) }}</a>                         
                                </li>
                            @endif
                            @endif
                        {{-- end tidak memiliki submenu kedua --}}
                        @endif
                    @endforeach
                </ul>
                {{-- end submenu --}}
                 
            </li> 
        @endif
        @else 
        {{-- tidak memiliki submenu --}}
        @if ($menuname->RoleType1($mnu->name) || $menuname->RoleType2($mnu->name))
        <li class="{{ Request::is($mnu->route.'/*') ? ' active' : null }}">
            <a class="has-arrow" href="{{ route($mnu->route)}}" title="Admin"><span class="fa fa-lg fa-fw {{ $mnu->icon }}"></span> <span class="menu-item-parent">{{ translate_menu($mnu->name) }}</span>  </a>
        </li>
        @endif
        {{-- end tidak memiliki submenu --}}
        @endif
        {{-- end menu --}}
        @endforeach
</ul>





