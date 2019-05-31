@php
use App\Classes\RolesClass;
$menu = new RolesClass;
@endphp
<a class="has-arrow"   href="index.html" title="Slide Banner"><span class="fa fa-lg fa-fw fa-flag"></span> <span class="menu-item-parent">Slide Banner</span> 
    <b class="collapse-sign">
        <em class="fa fa-plus-square-o"></em>
        <em class="fa fa-minus-square-o"></em>
    </b>
</a>
<ul aria-expanded="true" class="sa-sub-nav collapse">
    @php
        $Slide_Banner	 = 'Slide Banner';
        $role_access40 = $menu->RoleType1($Slide_Banner);
        $role_acces40 = $menu->RoleType2($Slide_Banner);
    @endphp
    @if($role_access40 || $role_acces40)
    <li class="{{ Request::is('Slide-Banner/SlideBanner/*') ? 'active' : null }}">
        <a   href="{{ route('SlideBanner-view') }}" title="Slide Banner"> Slide Banner </a>
    </li>
    @endif
</ul>