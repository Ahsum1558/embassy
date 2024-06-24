<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav" id="nav_menu">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ url('/super') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Controller</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('super.profile') }}">Profile</a></li>
                    <li><a href="{{ route('super.theme') }}">Theme Option</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-user-circle"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('super.operator') }}">All User License</a></li>
                    <li><a href="{{ route('super.approve') }}">Approved License</a></li>
                    <li><a href="{{ route('super.pending') }}">Pending License</a></li>
                    <li><a href="{{ route('super.disable') }}">Disabled License</a></li>
                    <li><a href="{{ route('super.expired') }}">Expired License</a></li>
                    <li><a href="{{ route('super.near') }}"> Near Expiry</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-map-marker"></i>
                    <span class="nav-text">Location</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('super.country') }}">Country</a></li>
                    <li><a href="{{ route('super.division') }}">Division</a></li>
                    <li><a href="{{ route('super.district') }}">District</a></li>
                    <li><a href="{{ route('super.policestation') }}">Police Station</a></li>
                    <li><a href="{{ route('super.city') }}">City</a></li>
                    <li><a href="{{ route('super.issue') }}">Issue Place</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Site Option</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('super.field') }}">Option in English</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('super.meta') }}">Meta</a></li>
                    <li><a href="{{ route('super.setting') }}">Header and Footer</a></li>
                </ul>
            </li>
            <li><a href="{{ url('super/logout') }}" class="ai-icon" aria-expanded="false">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>

    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">