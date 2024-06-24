<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@foreach($admin_headers as $header)
    <title>{{ $header->title }} - {{ $header->footer_title }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ (!empty($header->logo)) ? url('public/admin/uploads/field/'.$header->logo) : url('public/admin/assets/images/avatar.png') }}">
@endforeach
    @include('admin.includes.meta')
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('public/admin/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/chosen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/LineIcons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">    
    <script src="{{ asset('public/admin/assets/js/jquery.min.js') }}"></script>

    @include('admin.includes.css')

</head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
        <div id="main-wrapper">
           <div class="nav-header" id="header_nav">
            <a href="{{ url('/') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ (!empty(Auth::user()->logo)) ? url('public/admin/uploads/field/'.Auth::user()->logo) : url('public/admin/assets/images/avatar.png') }}" alt="">
                <h3 class="logo-compact" id="header_logotitle">{{ Auth::user()->smalltitle }}</h3>
                <h3 class="brand-title" id="header_logotitle">{{ Auth::user()->smalltitle }}</h3>
            </a>
            <div class="nav-control" id="control_nav">
                <div class="hamburger">
                    <span class="line" id="line_nav"></span><span class="line" id="line_nav"></span><span class="line" id="line_nav"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="header_bar w-100">
                                <span class="office_name">{{ Auth::user()->title }}</span>
                                <span class="licene_no">({{ Auth::user()->license }})</span>
                                <span class="current_time">
                                    <?php 
                                        date_default_timezone_set('Asia/Dhaka');
                                        echo date('F j, Y');
                                    ?>
                                </span>
                        @foreach($user_headers as $user_head)
                            @if(Auth::user()->id == $user_head->id)
                                <span class="doc_num">{{ Auth::user()->address }}, {{ $user_head->policestationname }}, {{ $user_head->districtname }}</span>
                            @endif
                        @endforeach
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span class="user_name">{{ Auth::user()->name }}</span>
                                        <span id="ourTime"></span>
                                    </div>
                                    <img class="header_img" src="{{ (!empty(Auth::user()->photo)) ? url('public/admin/uploads/user/'.Auth::user()->photo) : url('public/admin/assets/images/avatar.png') }}" alt="" width="20px">  
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item ai-icon">
                                        <i class="fas fa-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                   
                                    <a href="{{ url('logout') }}" class="dropdown-item ai-icon logout_option"><i class='fas fa-sign-out-alt'></i>
                                        <span class="ml-2">{{ __('Log Out') }}</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

@include('admin.includes.menu')