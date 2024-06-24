@foreach ($stamping_single_docs as $stamping)
<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Stamping Info Details of <strong>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Stamping Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Stamped Visa Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $stamping->stamped_visano }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Issue Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($stamping->visa_issue)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Expiry Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($stamping->visa_expiry)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Duration of Stay<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $stamping->stay_duration }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Issuing Country<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $stamping->foreign_country }}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($stamping->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editStamping', ['id'=>$customer_single_data[0]->id]) }}">Update Stamped Visa Info</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editVisano', ['id'=>$customer_single_data[0]->id]) }}">Update Stamped Visa No.</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
            </div>

        </div>
    </div>
</div>
@endforeach