@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Games"><span class="fa fa-lg fa-fw fa-gamepad"></span> <span class="menu-item-parent">Games</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>

<ul aria-expanded="true" class="sa-sub-nav collapse">
    <!-- GAME ASTA POKER -->
    <li class="{{ Request::is('Game-Asta-Poker/*') ? 'active' : null }}">
        <a   href="" title="Asta Poker"> Asta Poker 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level collapse">
            <li class="{{ Request::is('Game-Asta-Poker/Table/*') ? 'active' : null }}">
                <a   href="{{ route('Table-view') }}" title="Table"><span class="fa fa-table"></span> Table </a>
            </li>
            @php
                $category_asta_poker = 'Category Asta Poker';
                $role_access4 = $menu->RoleType1($category_asta_poker);
                $role_acces4 = $menu->RoleType2($category_asta_poker);
            @endphp
            @if($role_access4 || $role_acces4)
            <li class="{{ Request::is('Game-Asta-Poker/Category/*') ? 'active' : null }}">
                <a   href="{{ route('Category-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            @endif
            @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access5 = $menu->RoleType1($category_asta_big_two);
                $role_acces5 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access5 || $role_acces5)
            <li class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'active' : null }}">
                <a   href="{{ route('Season-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            @endif
            {{-- @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access6 = $menu->RoleType1($category_asta_big_two);
                $role_acces6 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access6 || $role_acces6) --}}
            <li class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('SeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            @endif
            {{-- @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access7 = $menu->RoleType1($category_asta_big_two);
                $role_acces7 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access7 || $role_acces7) --}}
            <li class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('Tournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access8 = $menu->RoleType1($category_asta_big_two);
                $role_acces8 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access8 || $role_acces8) --}}
            <li class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('JackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
            {{-- @endif --}}
        </ul>
    </li>

    <!-- GAME BIG 2 -->
    <li class="{{ Request::is('Game-Asta-BigTwo/*') ? 'active' : null }}">
        <a   href="" title="Asta Big 2"> Asta Big 2 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            @php
                $category_asta_big_two = 'Table Asta Big Two';
                $role_access9 = $menu->RoleType1($category_asta_big_two);
                $role_acces9 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access9 || $role_acces9)
            <li class="{{ Request::is('Game-Asta-BigTwo/Table/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoTable-view') }}" title="Table"><span class="fa fa-table"></span> Table </a>
            </li>
            @endif
            @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access10 = $menu->RoleType1($category_asta_big_two);
                $role_acces10 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access10 || $role_acces10)
            <li class="{{ Request::is('Game-Asta-BigTwo/Category/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoCategory-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            @endif
            @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access11 = $menu->RoleType1($category_asta_big_two);
                $role_acces11 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access11 || $role_acces11)
            <li class="{{ Request::is('Game-Asta-BigTwo/Season/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoSeason-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            @endif
            {{-- @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access12 = $menu->RoleType1($category_asta_big_two);
                $role_acces12 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access12 || $role_acces12) --}}
            <li class="{{ Request::is('Game-Asta-BigTwo/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoSeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access13 = $menu->RoleType1($category_asta_big_two);
                $role_acces13 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access13 || $role_acces13) --}}
            <li class="{{ Request::is('Game-Asta-BigTwo/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoTournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $category_asta_big_two = 'Category Asta Big Two';
                $role_access14 = $menu->RoleType1($category_asta_big_two);
                $role_acces14 = $menu->RoleType2($category_asta_big_two);
            @endphp
            @if($role_access14 || $role_acces14) --}}
            <li class="{{ Request::is('Game-Asta-BigTwo/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('BigTwoJackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
            {{-- @endif --}}
        </ul>
    </li>

    <!-- GAME DOMINO SUSUN -->
    <li class="{{ Request::is('Game-Asta-DominoSusun/*') ? 'active' : null }}">
        <a   href="" title="Domino Susun"> Domino Susun 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            @php
                $Table_Domino_Susun = 'Table Domino Susun';
                $role_access15 = $menu->RoleType1($Table_Domino_Susun);
                $role_acces15 = $menu->RoleType2($Table_Domino_Susun);
            @endphp
            @if($role_access15 || $role_acces15)
            <li class="{{ Request::is('Game-Asta-Poker/Table/*') ? 'active' : null }}">
                <a   href="{{ route('Table-view') }}" title="Table"><span class="fa fa-gamepad"></span> Table </a>
            </li>
            @endif
            @php
                $Category_Domino_Susun = 'Category Domino Susun';
                $role_access16 = $menu->RoleType1($Category_Domino_Susun);
                $role_acces16 = $menu->RoleType2($Category_Domino_Susun);
            @endphp
            @if($role_access16 || $role_acces16)
            <li class="{{ Request::is('Game-Asta-Poker/Category/*') ? 'active' : null }}">
                <a   href="{{ route('Category-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            @endif
            {{-- @php
                $Category_Domino_Susun = 'Category Domino Susun';
                $role_access17 = $menu->RoleType1($Category_Domino_Susun);
                $role_acces17 = $menu->RoleType2($Category_Domino_Susun);
            @endphp
            @if($role_access17 || $role_acces17) --}}
            <li class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSSeason-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $Category_Domino_Susun = 'Category Domino Susun';
                $role_access18 = $menu->RoleType1($Category_Domino_Susun);
                $role_acces18 = $menu->RoleType2($Category_Domino_Susun);
            @endphp
            @if($role_access18 || $role_acces18) --}}
            <li class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSSeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $Category_Domino_Susun = 'Category Domino Susun';
                $role_access19 = $menu->RoleType1($Category_Domino_Susun);
                $role_acces19 = $menu->RoleType2($Category_Domino_Susun);
            @endphp
            @if($role_access19 || $role_acces19) --}}
            <li class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSTournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $Category_Domino_Susun = 'Category Domino Susun';
                $role_access20 = $menu->RoleType1($Category_Domino_Susun);
                $role_acces20 = $menu->RoleType2($Category_Domino_Susun);
            @endphp
            @if($role_access20 || $role_acces20) --}}
            <li class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('DominoSJackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
            @endif
        </ul>
    </li>

    <!-- GAME DOMINO QQ -->
    <li class="{{ Request::is('Game-Asta-DominoQQ/*') ? 'active' : null }}">
        <a   href="" title="Domino QQ"> Domino QQ 
            <b class="collapse-sign">
                <em class="fa fa-plus-square-o"></em>
                <em class="fa fa-minus-square-o"></em>
            </b>
        </a>
        <ul aria-expanded="true" class="sa-sub-nav-second-level">
            @php
                $Table_Domino_QQ = 'Table Domino QQ';
                $role_access21 = $menu->RoleType1($Table_Domino_QQ);
                $role_acces21 = $menu->RoleType2($Table_Domino_QQ);
            @endphp
            @if($role_access21 || $role_acces21)
            <li class="{{ Request::is('Game-Asta-Poker/Table/*') ? 'active' : null }}">
                <a   href="{{ route('Table-view') }}" title="Table"><span class="fa fa-gamepad"></span> Table </a>
            </li>
            @endif
            @php
                $Category_Domino_QQ = 'Category Domino QQ';
                $role_access22 = $menu->RoleType1($Category_Domino_QQ);
                $role_acces22 = $menu->RoleType2($Category_Domino_QQ);
            @endphp
            @if($role_access22 || $role_acces22)
            <li class="{{ Request::is('Game-Asta-Poker/Category/*') ? 'active' : null }}">
                <a   href="{{ route('Category-view') }}" title="Category"><span class="fa fa-gamepad"></span> Category </a>
            </li>
            @endif
            {{-- @php
                $Category_Domino_QQ = 'Category Domino QQ';
                $role_access23 = $menu->RoleType1($Category_Domino_QQ);
                $role_acces23 = $menu->RoleType2($Category_Domino_QQ);
            @endphp
            @if($role_access23 || $role_acces23) --}}
            <li class="{{ Request::is('Game-Asta-Poker/Season/*') ? 'active' : null }}">
                <a   href="{{ route('Season-view') }}" title="Season"><span class="fa fa-gamepad"></span> Season </a>
            </li>
            {{-- @endif --}}
            {{-- @php
                $Category_Domino_QQ = 'Category Domino QQ';
                $role_access24 = $menu->RoleType1($Category_Domino_QQ);
                $role_acces24 = $menu->RoleType2($Category_Domino_QQ);
            @endphp
            @if($role_access24 || $role_acces24) --}}
            <li class="{{ Request::is('Game-Asta-Poker/SeasonReward/*') ? 'active' : null }}">
                <a   href="{{ route('SeasonReward-view') }}" title="Season Reward"><span class="fa fa-gamepad"></span> Season Reward </a>
            </li>
            @endif
            @php
                $Category_Domino_QQ = 'Category Domino QQ';
                $role_access25 = $menu->RoleType1($Category_Domino_QQ);
                $role_acces25 = $menu->RoleType2($Category_Domino_QQ);
            @endphp
            @if($role_access25 || $role_acces25)
            <li class="{{ Request::is('Game-Asta-Poker/Tournament/*') ? 'active' : null }}">
                <a   href="{{ route('Tournament-view') }}" title="Tournament"><span class="fa fa-gamepad"></span> Tournament </a>
            </li>
            @endif
            @php
                $Category_Domino_QQ = 'Category Domino QQ';
                $role_access26 = $menu->RoleType1($Category_Domino_QQ);
                $role_acces26 = $menu->RoleType2($Category_Domino_QQ);
            @endphp
            @if($role_access26 || $role_acces26)
            <li class="{{ Request::is('Game-Asta-Poker/Jackpot-Paytable/*') ? 'active' : null }}">
                <a   href="{{ route('JackpotPaytable-view') }}" title="Jackpot Paytable"><span class="fa fa-gamepad"></span> Jackpot Paytable </a>
            </li>
            @endif
        </ul>
    </li>
</ul>