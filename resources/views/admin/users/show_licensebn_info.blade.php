<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Licese Info Details in Bengali</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">বাংলায় অফিসের তথ্য</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->title_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->license_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->description_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Full Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->address_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->proprietor_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Title<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->proprietortitle_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Contact Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->telephone_bn }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @if(Auth::check() && (Auth::user()->role == 'admin'))
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.editTitlebn') }}">Update Name BN</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.editLicensebn') }}">Update License BN</a>
            </div>
        @endif
        </div>
    </div>
</div>