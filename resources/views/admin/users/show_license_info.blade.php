<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Licese Info Details in English</h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Licese Info in English</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-3 ">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img class="img-fluid img_user rounded-circle" src="{{ (!empty($profile_data[0]->logo)) ? url('public/admin/uploads/field/'.$profile_data[0]->logo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-sm-12">
                        <div class="profile-personal-info">
                        
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->title }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Short Name of Office<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->smalltitle }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->license }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Expiry Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if($profile_data[0]->licenseExpiry !== NULL)
                                        {{ date('d-M-Y', strtotime($profile_data[0]->licenseExpiry)) }}
                                    @else
                                        {{ __('N/A') }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->description }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->proprietor }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Owner Title<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->proprietortitle }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Contact Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->phone }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->email }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Zip Code<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->zipcode }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Police Station<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->policestationname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">District<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->districtname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Division<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->divisionname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">City<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->cityname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->countryname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Currency<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->currency }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country Phone Code<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $profile_data[0]->phone_code }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
            @if(Auth::check() && (Auth::user()->role == 'admin'))
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.editTitle') }}">Update Name</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.editShortTitle') }}">Update Short Name</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.editLicense') }}">Update License</a>
            @endif
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.editLogo') }}">Update Logo</a>
            </div>
        </div>
    </div>
</div>