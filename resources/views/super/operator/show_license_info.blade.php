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
                                <img class="img-fluid img_user rounded-circle" src="{{ (!empty($single_user[0]->logo)) ? url('public/admin/uploads/field/'.$single_user[0]->logo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-sm-12">
                        <div class="profile-personal-info">
                        
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->title }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Short Name of Office<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->smalltitle }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->license }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Expiry Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if($single_user[0]->licenseExpiry !== NULL)
                                        {{ date('d-M-Y', strtotime($single_user[0]->licenseExpiry)) }}
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
                                <div class="col-9"><span>{{ $single_user[0]->description }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->proprietor }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Title<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->proprietortitle }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Contact Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->phone }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->email }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Zip Code<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->zipcode }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Police Station<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->policestationname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">District<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->districtname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Division<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->divisionname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">City<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->cityname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->countryname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Currency<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->currency }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country Phone Code<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $single_user[0]->phone_code }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.operator.editTitle', ['id'=>$single_user[0]->id]) }}">Update Name</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.operator.editShortTitle', ['id'=>$single_user[0]->id]) }}">Update Short Name</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.operator.editLicense', ['id'=>$single_user[0]->id]) }}">Update License</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.operator.editEn', ['id'=>$single_user[0]->id]) }}">Update En</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.operator.editLogo', ['id'=>$single_user[0]->id]) }}">Update Logo</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator') }}">Back</a>
            </div>
        </div>
    </div>
</div>