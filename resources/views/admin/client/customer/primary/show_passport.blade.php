@foreach ($passport_single_data as $passport_data)
<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Passport Info Details of <strong>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Passport Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Father Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->father }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Mother Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->mother }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Spouse Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->spouse }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Passport Issue Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($passport_data->passportIssue)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Passport Expiry Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($passport_data->passportExpiry)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Passport Type<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($passport_data->passportType == 5)
                                    {{ __('5 Years') }}
                                    @elseif($passport_data->passportType == 10)
                                    {{ __('10 Years') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">NID Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->nid }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Date of Birth<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($passport_data->dateOfBirth)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Marital Status<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($passport_data->maritalStatus == 1)
                                    {{ __('Single') }}
                                    @elseif($passport_data->maritalStatus == 2)
                                    {{ __('Married') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Passport Issue Place<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if(isset($passport_data->issuePlace))
                                        {{ $passport_data->issuePlace }}
                                    @else
                                        {{ __('Dip/Dhaka') }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Police Station<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->policestationname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">District<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->districtname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Division<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $passport_data->divisionname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if(isset($passport_data->countryname))
                                        {{ $passport_data->countryname }}
                                    @else
                                        {{ __('Bangladesh') }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Present Nationality<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if(isset($passport_data->nationality))
                                        {{ $passport_data->nationality }}
                                    @else
                                        {{ __('Bangladeshi') }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Previous Nationality<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                    @if(isset($passport_data->nationality))
                                        {{ $passport_data->nationality }}
                                    @else
                                        {{ __('Bangladeshi') }}
                                    @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($passport_data->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
            
            @if($customer_single_data[0]->value == 2)
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.embassy', ['id'=>$customer_single_data[0]->id]) }}">Add Embassy Info</a>
            @endif
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editPassport', ['id'=>$customer_single_data[0]->id]) }}">Update Passport Info</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editInfoShort', ['id'=>$customer_single_data[0]->id]) }}">Update Passport Info Short</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editAddress', ['id'=>$customer_single_data[0]->id]) }}">Update Address Info Short</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
            </div>

        </div>
    </div>
</div>
@endforeach