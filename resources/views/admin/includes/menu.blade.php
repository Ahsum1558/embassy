<!--**********************************
    Sidebar start
***********************************-->
<div class="deznav" id="nav_menu">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{ url('/') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-user"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.profile') }}">Profile</a></li>
                    <li><a href="{{ route('admin.theme') }}">Theme Option</a></li>
                </ul>
            </li>
            @php
                if (Auth::check() && Auth::user()->type === 'approve') {
        }
        
            @endphp
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-map-marker"></i>
                    <span class="nav-text">Location</span>
                </a>
                <ul aria-expanded="false">
            @if(Auth::check() && Auth::user()->type === 'approve')
                @if(strtotime(Auth::user()->userExpiry) >= strtotime(date('Y-m-d')))
                    <li><a href="{{ route('admin.country') }}">Country</a></li>
                    <li><a href="{{ route('admin.division') }}">Division</a></li>
                    <li><a href="{{ route('admin.district') }}">District</a></li>
                @endif
            @endif
                    <li><a href="{{ route('admin.policestation') }}">Police Station</a></li>
                @if(Auth::check() && Auth::user()->type === 'approve' && strtotime(Auth::user()->userExpiry) >= strtotime(date('Y-m-d')))
                    <li><a href="{{ route('admin.city') }}">City</a></li>
                    <li><a href="{{ route('admin.issue') }}">Issue Place</a></li>
                @endif
                </ul>
            </li>
    @if(Auth::check() && Auth::user()->type === 'approve')
        @if(strtotime(Auth::user()->userExpiry) >= strtotime(date('Y-m-d')))
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-address-card-o"></i>
                    <span class="nav-text">Visa</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.visa') }}">Visa Info</a></li>
                    <li><a href="{{ route('admin.visaTrade') }}">Visa Trade</a></li>
                    <li><a href="{{ route('admin.visaType') }}">Visa Type</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Delegate</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.delegate') }}">Delegate Info</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <span class="nav-text">Customer</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.customer') }}">Customer Info</a></li>
                    <li><a href="{{ route('admin.customer.insertOnce') }}">Customer Once</a></li>
                    <li><a href="{{ route('admin.customer.insertShort') }}">Customer Short</a></li>
                    <li><a href="{{ route('admin.customer.medical') }}">Medical Info</a></li>
                    <li><a href="{{ route('admin.submission') }}">Submission Info</a></li>
                    <li><a href="{{ route('admin.manpower') }}">Manpower Info</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-link"></i>
                    <span class="nav-text">Important Links</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.link') }}">Links</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-calculator"></i>
                    <span class="nav-text">Age Calculator</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.calculateAge') }}">Calculate Age</a></li>
                </ul>
            </li>
        @endif
    @endif
            <li><a href="{{ url('logout') }}" class="ai-icon" aria-expanded="false">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>

        @if(strtotime(Auth::user()->userExpiry) < strtotime(date('Y-m-d')))

            <li>
                <a href="" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                    <span class="nav-text"><strong class="bg-white text-danger delete_option">Expired</strong></span>
                </a>
            </li>
        @else
            <li>
                <a href="" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                    <span class="nav-text"><strong>{{ date('F j, Y', strtotime(Auth::user()->userExpiry)) }}</strong></span>
                </a>
            </li>
        @endif
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