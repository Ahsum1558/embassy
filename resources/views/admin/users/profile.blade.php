@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4><strong>{{ Auth::user()->name }}</strong> welcome back!</h4>
        </div>

@include('admin.includes.alert')
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
</div>
@if(Auth::check() && (Auth::user()->title === NULL || Auth::user()->license === NULL || Auth::user()->title_bn === NULL || Auth::user()->license_bn === NULL || Auth::user()->title_ar === NULL || Auth::user()->license_ar === NULL))
    <div class="mybtn">
        <a href="{{ route('admin.profile.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add Company Info</a>
    </div>
@endif

<div class="row">
    {{-- User Information --}}  
@include('admin.users.show_user_info')
    {{-- License Information in English --}}
@include('admin.users.show_license_info')
    {{-- License Information in Bengali --}}  
@include('admin.users.show_licensebn_info')
{{-- License Information in Arabic --}}  
@include('admin.users.show_licensear_info')
{{-- License Approval Information --}}  
@include('admin.users.show_approval_info')

</div>
@endsection