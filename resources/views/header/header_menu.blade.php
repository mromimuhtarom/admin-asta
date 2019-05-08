
<div class="menu-icon">
    <ul class="nav">
        <li class="nav-item">
            <a href="{{ route('UserAdmin-view') }}" class="h-100 w-100">
                <div class="menu1 {{ Request::is('Admin/*') ? 'menu1 active' : null }}"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('Banking-view') }}" class="h-100 w-100">
                <div class="menu2 {{ Request::is('Transaction/*') ? 'menu2 active' : null }}"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('Active-view') }}" class="h-100 w-100">
                <div class="menu3 {{ Request::is('Players/*') ? 'menu3 active' : null }}"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('SlideBanner-view') }}" class="h-100 w-100">
                <div class="menu4 {{ Request::is('Slide-Banner/*') ? 'menu4 active' : null }}"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('DailyGift-view') }}" class="h-100 w-100">
                <div class="menu5 {{ Request::is('Daily-Gift/*') ? 'menu5 active' : null }}"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('Table-view') }}" class="h-100 w-100">
                <div class="menu6 {{ Request::is('Game-Asta-Poker/*') ? 'menu6 active' : null }}"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="h-100 w-100">
                <div class="menu7"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="#">
                <div class="menu8"></div>
            </a>
        </li>

        <li class="nav-item">
            <a href="#">
                <div class="menu9"></div>
            </a>
        </li>
    </ul>
</div>