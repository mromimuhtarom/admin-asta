<div class="col">
    <div class="search">
        <i class="fas fa-search fa-lg" style="color:white;"></i>
        <input type="text" placeholder="click and type to search anywhere">
    </div>
</div>
<div class="col h-100 d-flex flex-row justify-content-end profile" align="right">
    <div class="row w-100 h-100">
        <div class="col username-profile">
            <div class="">
                {{ Session::get('fullname') }}
            </div>
        </div>
        <div class="col-1 h-100 d-flex flex-row img-profile">
            <img src="/images/profile/avatar.png" alt="" class="rounded-circle img-fluid aii-img-profile" width="60px" height="40px">
            <div class="line-right"></div>
        </div>
        <div class="col-2 aii-date d-flex flex-column" align="left">
            <div class="date-now">
                17-02-2018
            </div>
            
            <div class="time-now">
                2.45 AM
            </div>
        </div>
        <div class="col-1 logout">
            <a href="{{ route("logout") }}"><div class="logoutgambar"></div></a>
        </div>
    </div>
    
</div>