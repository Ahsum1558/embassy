<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline"><strong>{{ Auth::user()->name }}</strong> Profile Information</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Personal Information</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-3 ">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img class="img-fluid img_user rounded-circle" src="{{ (!empty($profile_data[0]->photo)) ? url('public/admin/uploads/user/'.$profile_data[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-sm-12">
                        <div class="profile-personal-info">
                        
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Full Name <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->name }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Username <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->username }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Designation <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->designation }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Level<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if($profile_data[0]->role == 'admin')
                                        {{ __('Admin') }}
                                        @elseif($profile_data[0]->role == 'author')
                                        {{ __('Author') }}
                                        @elseif($profile_data[0]->role == 'editor')
                                        {{ __('Editor') }}
                                        @elseif($profile_data[0]->role == 'contributor')
                                        {{ __('Contributor') }}
                                        @elseif($profile_data[0]->role == 'user')
                                        {{ __('User') }}
                                      @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                      @if($profile_data[0]->dateOfBirth !== NULL)
                                        {{ date('d-M-Y', strtotime($profile_data[0]->dateOfBirth)) }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($profile_data[0]->gender == 1)
                                    {{ __('Male') }}
                                    @elseif($profile_data[0]->gender == 2)
                                    {{ __('Female') }}
                                    @else
                                    {{ __('Other') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.info') }}">Update Info</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.username') }}">Update Username</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.email') }}">Update E-Mail</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.image') }}">Update Image</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.password') }}">Update Password</a>
            </div>
        </div>
    </div>
</div>