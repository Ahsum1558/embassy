@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4><strong>{{ Auth::guard('super')->user()->fullname }}</strong> welcome back!</h4>
        </div>

@include('super.includes.alert')
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Controller</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Super Username Update</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Super Profile Username Update</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Update Username</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <form action="{{ route('super.profile.usernameUpdate') }}" class="form-group" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Username<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="username" class="form-control d-inline-block inline_setup" value="{{ $superData->username }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3"></div>
                            <div class="col-9 mybtn">
                                <button type="submit" name="updateUsername" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.profile') }}">Back</a>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection