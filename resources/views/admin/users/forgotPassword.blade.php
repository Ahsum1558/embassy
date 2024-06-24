<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@foreach($admin_login_header as $header)
    <title>{{ $header->title }} - {{ $header->footer_title }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ (!empty($header->logo)) ? url('public/admin/uploads/field/'.$header->logo) : url('public/admin/assets/images/avatar.png') }}">
@endforeach
    @include('admin.includes.meta')
    <link href="{{ asset('public/admin/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="h-100">
    <style>
        body{
            background-image: url({{ asset('public/admin/assets/images/front_bg.jpg') }});
            background-size: cover;
            background-position: center;
            padding: 10px 0px;
        }
    </style>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div id="content_wrapper" class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4 auth_header">Forgot Password</h4>
                                    @include('admin.includes.alert')
                                    <form action="{{ route('admin.forgotPasswordStore') }}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="text" name="email" class="form-control" placeholder="Enter Your email">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('public/admin/assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/deznav-init.js') }}"></script>

</body>

</html>